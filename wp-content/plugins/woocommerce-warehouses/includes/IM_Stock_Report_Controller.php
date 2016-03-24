<?php
namespace Hellodev\InventoryManager;

if (! defined('ABSPATH')) {
    exit();
}

class IM_Stock_Report_Controller
{

    private $viewRender;

    public function __construct()
    {
        add_action('admin_init', array(
            $this,
            'change_headers'
        ));
    }

    public function renderView($values = null)
    {
        $values = array();
        $this->viewRender = IM_View_Render::get_instance();
        $this->viewRender->render("stock-report", $values);
    }

    public function exportStockReportCSV()
    {
        header('Content-Type: application/csv');
        header('Content-Disposition: attachement; filename="stock.csv";');
        
        $delimiter = get_option("hd_warehouses_csv_export_delimiter");
        
        $warehouses_repository = new IM_Warehouse_Repository();
        $warehouses = $warehouses_repository->get_all();
        
        $args = array(
            'post_type' => array(
                'product',
                'product_variation'
            ),
            'posts_per_page' => -1
        );
        $products = new \WP_Query($args);
        
        /**
         * open raw memory as file, no need for temp files, be careful not to run out of memory thought
         */
        $f = fopen('php://memory', 'w');
        
        $line = array(
            __("Product ID", "woocommerce-inventorymanager"),
            __("Product Name", "woocommerce-inventorymanager")
        );
        
        $warehouses_ids = array();
        
        foreach ($warehouses as $warehouse) {
            $line[] = sprintf(__("Warehouse %s stock", "woocommerce-inventorymanager"), $warehouse->name);
            $warehouses_ids[] = $warehouse->id;
        }
        
        $options_raw = get_option("hd_warehouses_custom_meta_stock_export");
        // they're splitted by ;
        $options = array_filter(explode(";", $options_raw));
        
        if ($options != false && count($options) > 0) {
            foreach ($options as $value) {
                $line[$value] = $value;
            }
        }
        
        fputcsv($f, $line, $delimiter);
        
        /**
         * loop through all products
         */
        foreach ($products->posts as $value) {
            
            $product_warehouse_repository = new IM_Product_Warehouse_Repository();
            $product_warehouses = $product_warehouse_repository->getByProductID($value->ID);
            
            $line = array(
                $value->ID,
                $value->post_title
            );
            
            $warehouses_added = 0;
            $i = 0;
            
            /**
             * loop through all warehouses with this product
             */
            foreach ($product_warehouses as $product_warehouse) {
                /**
                 * if is the same by the same order provided before add it
                 */
                if ($warehouses_ids[$i] == $product_warehouse->warehouse_id) {
                    $line[] = $product_warehouse->stock;
                    $warehouses_added ++;
                }
                $i ++;
            }
            
            /**
             * In case stock control is disabled, mark it *
             */
            if ($warehouses_added == 0) {
                foreach ($warehouses as $warehouse) {
                    $line[] = __("Stock control disabled", "woocommerce-inventorymanager");
                }
            }
            
            $options_raw = get_option("hd_warehouses_custom_meta_stock_export");
            // they're splitted by ;
            $options = array_filter(explode(";", $options_raw));
            
            if ($options != false && count($options) > 0) {
                foreach ($options as $value2) {
                    $line[] = get_post_meta($value->ID, $value2, true);
                }
            }
            
            /**
             * default php csv handler *
             */
            fputcsv($f, $line, $delimiter);
        }
        /**
         * rewrind the "file" with the csv lines *
         */
        fseek($f, 0);
        /**
         * Send file to browser for download
         */
        fpassthru($f);
        die();
    }
}
