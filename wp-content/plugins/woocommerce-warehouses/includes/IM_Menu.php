<?php
namespace Hellodev\InventoryManager;

if (! defined('ABSPATH')) {
    exit();
}

class IM_Menu
{

    public function __construct()
    {
        add_action('admin_menu', array(
            $this,
            'add_my_custom_menu'
        ));
        add_action('admin_init', array(
            $this,
            'register_mysettings'
        ));
    }

    function register_mysettings()
    {
        // must be in admin init to change the headers
        if (isset($_GET["page"]) && $_GET["page"] == "hellodev-inventory-manager-stock-report-csv") {
            $this->stock_report_csv();
        }
    }

    public function add_my_custom_menu()
    {
        // add an item to the menu
        if (current_user_can("manage_options") || current_user_can("hellodev_im_stock_log") || current_user_can("hellodev_im_manage_warehouses")) {
            add_menu_page(__('WooCommerce Warehouses', "woocommerce-inventorymanager"), __('Warehouses', "woocommerce-inventorymanager"), 'read', 'hellodev-inventory-manager', array(
                $this,
                'inventory_manager'
            ), 'dashicons-store', '59');
        }
        
        if (current_user_can("manage_options") || current_user_can("hellodev_im_manage_warehouses")) {
            add_submenu_page('hellodev-inventory-manager', __('WooCommerce Warehouses - Add Warehouse', "woocommerce-inventorymanager"), __("Add Warehouse", "woocommerce-inventorymanager"), 'read', 'hellodev-inventory-manager-add-warehouse', array(
                $this,
                'add_warehouse'
            ));
        }
        
        if (current_user_can("manage_options") || current_user_can("hellodev_im_stock_log")) {
            add_submenu_page('hellodev-inventory-manager', __('WooCommerce Warehouses - Stock Log', "woocommerce-inventorymanager"), __("Stock Log", "woocommerce-inventorymanager"), 'read', 'hellodev-inventory-manager-stock-log', array(
                $this,
                'stock_log'
            ));
            add_submenu_page('hellodev-inventory-manager', __('WooCommerce Warehouses - Stock Report', "woocommerce-inventorymanager"), __("Stock Report", "woocommerce-inventorymanager"), 'read', 'hellodev-inventory-manager-stock-report', array(
                $this,
                'stock_report'
            ));
            add_submenu_page(null, __('WooCommerce Warehouses - Stock Report', "woocommerce-inventorymanager"), __("Stock Report", "woocommerce-inventorymanager"), 'read', 'hellodev-inventory-manager-stock-report-csv', array(
                $this,
                'stock_report_csv'
            ));
        }
        
        if (current_user_can("manage_options") || current_user_can("hellodev_im_plugin_settings")) {
            add_submenu_page('hellodev-inventory-manager', __('WooCommerce Warehouses - Plugin Settings', "woocommerce-inventorymanager"), __("Plugin Settings", "woocommerce-inventorymanager"), 'read', 'hellodev-inventory-manager-plugin-settings', array(
                $this,
                'plugin_settings'
            ));
        }
        
        if (current_user_can("manage_options") || current_user_can("hellodev_im_stock_log") || current_user_can("hellodev_im_manage_warehouses")) {
            add_submenu_page('hellodev-inventory-manager', __('WooCommerce Warehouses - Plugin Documentation', "woocommerce-inventorymanager"), __("Documentation", "woocommerce-inventorymanager"), 'read', 'hellodev-inventory-manager-documentation', array(
                $this,
                'documentation'
            ));
        }
    }

    public function inventory_manager()
    {
        $values = array();
        $this->viewRender = IM_View_Render::get_instance();
        $this->viewRender->render("list-warehouses", $values);
    }

    public function add_warehouse()
    {
        new IM_Warehouse_Controller();
    }

    public function stock_log()
    {
        new IM_Stock_Log_Controller();
    }

    public function stock_report()
    {
        $controller = new IM_Stock_Report_Controller();
        $controller->renderView();
    }

    public function stock_report_csv()
    {
        $controller = new IM_Stock_Report_Controller();
        $controller->exportStockReportCSV();
    }

    public function plugin_settings()
    {
        $this->viewRender = IM_View_Render::get_instance();
        $this->viewRender->render("plugin-settings", array());
    }

    public function documentation()
    {
        ?>
        <style type="text/css">
        #wpcontent, #wpbody, #wpbody-content, #wpbody-content .wrap {
        	min-height: 100%;
        	padding: 0 !important;
        	margin: 0 !important;
        }
        
        iframe {
        	position: relative;
        	z-index: 0;
        }
        </style>
        <div class="wrap">
        	<iframe style="min-height: 100%"
        		src="<?php echo plugin_dir_url( IM_PLUGIN_FILE ) . "docs/index.html"; ?>"
        		onload="this.width=screen.width;this.height=document.getElementById('wpwrap').offsetHeight;"></iframe>
        </div>
        <?php
    }
}
