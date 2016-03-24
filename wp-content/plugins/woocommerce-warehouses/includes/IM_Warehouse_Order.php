<?php
namespace Hellodev\InventoryManager;

if (! defined('ABSPATH')) {
    exit();
}

class IM_Warehouse_Order
{

    public function __construct()
    {
        // disable reduce order stock after payment
        add_action('woocommerce_admin_order_item_headers', array(
            $this,
            'admin_order_item_headers'
        ));
        add_action('woocommerce_admin_order_item_values', array(
            $this,
            'admin_order_item_values'
        ), 10, 3);
        add_action('woocommerce_before_delete_order_item', array(
            $this,
            'restock_deleted_item_line'
        ), 10, 1);
        add_action('save_post', array(
            $this,
            'warehouse_to_warehouse'
        ), 10, 1);
        add_action('woocommerce_process_shop_order_meta', array(
            $this,
            'warehouse_to_warehouse'
        ), 10, 1);
        add_action('woocommerce_process_shop_order_meta', array(
            $this,
            'warehouse_to_warehouse'
        ), 51, 1);
        add_filter('woocommerce_hidden_order_itemmeta', array(
            $this,
            'custom_woocommerce_hidden_order_itemmeta'
        ), 10, 1);
        add_action('woocommerce_admin_order_data_after_shipping_address', array(
            $this,
            'destination_warehouse'
        ), 10, 1);
        add_action('woocommerce_process_shop_order_meta', array(
            $this,
            'add_order_status_hooks'
        ), 11, 1);
        add_action('woocommerce_order_status_changed', array(
            $this,
            'add_order_status_hooks'
        ), 11, 1);
        add_action('woocommerce_checkout_order_processed', array(
            $this,
            'update_stocks_per_item'
        ), 11, 1);
        /*
         * add_action('woocommerce_refund_created', array(
         * $this,
         * 'process_partial_refund'
         * ), 10, 1);
         */
        add_action('woocommerce_order_refunded', array(
            $this,
            'process_partial_refund'
        ), 10, 2);
        
        /*
         * Mysterious hook that is not documented in WooCommerce docs (22 September 2015).
         * Traced via debugging.
         */
        add_action('woocommerce_refund_deleted', array(
            $this,
            'cancel_refund'
        ), 10, 2);
        
        add_action('add_meta_boxes', array(
            $this,
            'select_warehouse_container'
        ));
    }

    /**
     * This method processes a partial refund, considering a partial refund a refund
     * done inline and not by the full state change.
     *
     * @param int $refund_id            
     */
    public function process_partial_refund($order_id, $refund_id)
    {
        // create a order refund object from the id
        $order_refund = new \WC_Order_Refund($refund_id);
        // create a order object from the order id
        $order_object = new \WC_Order($order_refund->id);
        
        $order_items = $order_object->get_items();
        
        if (count($order_items) > 0) {
            // loop the order items
            foreach ($order_items as $item) {
                // get the warehouse id of this line.
                $warehouse_id = wc_get_order_item_meta($item["item_meta"]["_refunded_item_id"][0], "_warehouse_id", true);
                $item['item_meta']['_stock_reduced'][0] = $item['item_meta']['_qty'][0];
                $this->update_meta_order_stock_reduced($item["item_meta"]["_refunded_item_id"][0], $item, $warehouse_id, "wc-cancelled", $order_object->id);
                // Quick fix for issue #55
                wc_update_order_item_meta($item["item_meta"]["_refunded_item_id"][0], '_stock_reduced', $item['item_meta']['_qty'][0]);
            }
        }
    }

    public function cancel_refund($refund_id, $order_id)
    {
        // create a order object from the order id
        $order_object = new \WC_Order($order_id);
        
        $order_items = $order_object->get_items();
        
        if (count($order_items) > 0) {
            // loop the order items
            foreach ($order_items as $key => $item) {
                // get the warehouse id of this line.
                $warehouse_id = wc_get_order_item_meta($key, "_warehouse_id", true);
                $item['item_meta']['_stock_reduced'][0] = 0;
                $this->update_meta_order_stock_reduced($key, $item, $warehouse_id, "wc-completed", $order_object->id);
            }
        }
    }

    public function add_order_status_hooks($post_id)
    {
        $status = get_option('stock_reduction_state');
        $current_status = get_post_status($post_id);
        $statuses = wc_get_order_statuses();
        
        $number = 1;
        foreach ($statuses as $key => $value) {
            $statuses[$key] = $number;
            $number ++;
        }
        
        $started = 0;
        /*
         * Considered statuses:
         * 'wc-pending' => string 'Pending Payment' (length=15)
         * 'wc-processing' => string 'Processing' (length=10)
         * 'wc-on-hold' => string 'On Hold' (length=7)
         * 'wc-completed' => string 'Completed' (length=9)
         * 'wc-cancelled' => string 'Cancelled' (length=9)
         * 'wc-refunded' => string 'Refunded' (length=8)
         * 'wc-failed' => string 'Failed' (length=6)
         */
        
        // gets the current order status
        $current_status = get_post_status($post_id);
        
        $draft_status = array("draft" => 0);
        
        $total_statuses = $draft_status + $statuses;
                
        foreach ($total_statuses as $key => $value) {
            if ($status == $key) {
                $started = 1;
            }
            if ($started == 1) {
                $this->update_stocks_per_item($post_id);
                return;
            }
            // ignore the other states
            if ($current_status == $key) {
                return;
            }
        }
    }

    public function admin_order_item_headers()
    {
        ?>
<th class="warehouse"><?php _e('Warehouse', "woocommerce-inventorymanager"); ?></th>
<?php
    }

    public function destination_warehouse()
    {
        global $post;
        ?>
<div class="form-field form-field-wide">
	<h4><?php _e('Warehouse destination'); ?>:</h4>
	<select id="IM_Warehouse_destination" name="IM_Warehouse_destination">
        <?php
        $repository = new IM_Warehouse_Repository();
        $warehouses = $repository->get_all();
        $warehouse_destination_id = get_post_meta($post->ID, "_warehouse_destination_id", true);
        ?>
        <option
			<?php if($warehouse_destination_id == null) echo "selected"; ?>
			value=""><?php _e('none'); ?></option>
        <?php
        foreach ($warehouses as $warehouse) :
            ?>
          <option value="<?php echo $warehouse->id; ?>"
			<?php if($warehouse_destination_id == $warehouse->id) echo "selected"; ?>><?php echo $warehouse->name; ?></option>
          <?php
        endforeach
        ;
        ?>
      </select>
</div>
<?php
    }

    public function admin_order_item_values($product, $item, $item_id)
    {
        if (isset($product) && is_a($product, 'WC_Product_Variation')) {
            $id = $product->variation_id;
        } else 
            if (isset($product)) {
                $id = $product->id;
            }
        
        ?>
<td class="warehouse" style="width: 350px">
      <?php if (isset($product)) { ?>
        <div class="edit">
          <?php
            $repository = new IM_Warehouse_Repository();
            $warehouses = $repository->get_all();
            ?>
          <select name="warehouse[<?php echo absint($item_id); ?>]"
			style="width: 100%">
            <?php
            foreach ($warehouses as $warehouse) :
                $repository_product_warehouse = new IM_Product_Warehouse_Repository();
                $product_repository_row = $repository_product_warehouse->getByProductWarehouseID($id, $warehouse->id);
                ?>
              <option value="<?php echo $warehouse->id; ?>"
				<?php if(isset($item['warehouse_id']) && $item['warehouse_id'] == $warehouse->id) echo "selected"; ?>><?php echo $warehouse->name; ?> - Stock: <?php echo $product_repository_row->getStock(); ?></option>
                <?php
            endforeach
            ;
            ?>
            </select>
	</div>
          <?php } ?>
        </td>
<?php
    }

    /**
     * Updates the product warehouse with the specified stock.
     * 
     * @param int $product_id            
     * @param int $warehouse_id            
     * @param int $stock            
     */
    public function update_product_warehouse_stock($product_id, $warehouse_id, $stock)
    {
        $repository_product_warehouse = new IM_Product_Warehouse_Repository();
        $product_warehouse = $repository_product_warehouse->getByProductWarehouseID($product_id, $warehouse_id);
        $dto = array(
            "stock" => $stock
        );
        $condition = array(
            "id" => $product_warehouse->getId()
        );
        $repository_product_warehouse->update($dto, $condition);
    }

    /**
     * This method is used to restock deleted items from the order.
     */
    public function restock_deleted_item_line($item_id)
    {
        global $wpdb;
        
        $meta = wc_get_order_item_meta($item_id, "_variation_id");
        
        if (! empty($meta)) {
            $product_id = $meta;
        } else {
            $product_id = wc_get_order_item_meta($item_id, "_product_id");
        }
        
        $warehouse_id = wc_get_order_item_meta($item_id, "_warehouse_id");
        $stock_reduced = wc_get_order_item_meta($item_id, "_stock_reduced");
        
        if (! empty($product_id) && ! empty($warehouse_id)) {
            
            $repository_product_warehouse = new IM_Product_Warehouse_Repository();
            $product_warehouse = $repository_product_warehouse->getByProductWarehouseID($product_id, $warehouse_id);
            $total_stock = $product_warehouse->getStock();
            $stock = $total_stock + $stock_reduced;
            
            $this->update_product_warehouse_stock($product_id, $warehouse_id, $stock);
            
            wp_reset_query();
            // martelanço porque não consigo aceder ao $post
            $order_id = $wpdb->get_var($wpdb->prepare("SELECT order_id FROM " . $wpdb->prefix . "woocommerce_order_items WHERE order_item_id = %d", $item_id));
            
            $warehouse_destination_id = get_post_meta($order_id, "_warehouse_destination_id", true);
            if (! empty($warehouse_destination_id)) {
                $repository_product_warehouse = new IM_Product_Warehouse_Repository();
                $product_warehouse_destination = $repository_product_warehouse->getByProductWarehouseID($product_id, $warehouse_destination_id);
                $total_stock_destination = $product_warehouse_destination->getStock();
                $total_stock_destination = ($total_stock_destination - $stock_reduced);
                
                $this->update_product_warehouse_stock($product_id, $warehouse_destination_id, $total_stock_destination);
                
                $reason = "order #" . $order_id . " - restock deleted line";
                $this->add_stock_log($product_id, $warehouse_destination_id, $total_stock_destination, $reason);
            }
            
            // Issue #19
            $reason = "order #" . $order_id . " - restock deleted line";
            $this->add_stock_log($product_id, $warehouse_id, $stock, $reason);
            // end issue #19
            
            $this->update_total_stocks_woocommerce($product_id);
        }
    }

    /**
     * This is for issue #19, add a stock log to store the stock movements
     */
    public function add_stock_log($product_id, $warehouse_id, $stock, $reason)
    {
        // Issue #19
        $stock_log_content = array();
        $stock_log_content["product_id"] = $product_id;
        $stock_log_content["warehouse_id"] = $warehouse_id;
        $stock_log_content["stock"] = $stock;
        $stock_log_content["reason"] = $reason;
        $repository_product_stock_log = new IM_Stock_Log_Repository();
        $repository_product_stock_log->insert($stock_log_content);
        // end issue #19
    }

    /**
     * Method that adds the warehouse id to the item if needed.
     *
     * @param int $item_id            
     * @param int $warehouse_id            
     */
    public function add_warehouse_id_to_item($item_id, $warehouse_id)
    {
        $current_meta = wc_get_order_item_meta($item_id, '_warehouse_id', true);
        if (empty($current_meta)) {
            // persist the changes
            wc_add_order_item_meta($item_id, '_warehouse_id', $warehouse_id, true);
        }
    }

    /**
     * Method that adds the stock reduced to the item if needed
     *
     * @param int $item_id            
     */
    public function add_stock_reduced_to_item($item_id)
    {
        $current_meta = wc_get_order_item_meta($item_id, '_stock_reduced', true);
        if (empty($current_meta)) {
            // persist the changes
            wc_add_order_item_meta($item_id, '_stock_reduced', 0, true);
        }
    }
    
    // sort the elements using usort
    public function cmp($a, $b)
    {
        if ($a->priority == $b->priority) {
            return 0;
        }
        return ($a->priority < $b->priority) ? - 1 : 1;
    }

    /**
     * Method that applies the stock reduction by priorities.
     *
     * @param array $warehouse            
     * @param int $item_id            
     * @param array $item_array            
     * @return int $warehouse_id
     */
    public function apply_warehouse_stock_reduction_priorities($item_id, $item_array)
    {
        $repository_product_warehouse = new IM_Product_Warehouse_Repository();
        // grab the product warehouses that this product is in.
        $product_warehouses = $repository_product_warehouse->getByProductID($item_array['product_id']);
        // loop them
        for ($i = 0; $i < count($product_warehouses); $i ++) {
            // if the local priority is zero, we grab the global priority for the element
            if ($product_warehouses[$i]->priority == 0) {
                $repository_warehouse = new IM_Warehouse_Repository();
                $row = $repository_warehouse->get_by(array(
                    "id" => $product_warehouses[$i]->warehouse_id
                ));
                $row = $row[0];
                $product_warehouses[$i]->priority = $row->priority;
            }
        }
        
        usort($product_warehouses, array(
            $this,
            "cmp"
        ));
        
        // loop them after sorted.
        foreach ($product_warehouses as $product_warehouse) {
            // if it has stock then we can assign it and end the case.
            if ($product_warehouse->stock > 0) {
                return $product_warehouse->warehouse_id;
                break;
            }
        }
        
        return 0;
    }

    /**
     * Updates the stocks depending on the current order status, it will respect
     * the settings defined at the settings page.
     */
    public function update_stocks_per_item($post_id)
    {
        $factory = new \WC_Order_Factory();
        $order = $factory->get_order($post_id);
        $status = $order->get_status();
        $items = $order->get_items();
        
        if (isset($_POST['warehouse'])) {
            $warehouse = $_POST['warehouse'];
        } else {
            $warehouse = array();
            // issue #10 - warehouse priorities applied
            foreach ($items as $key => $item) {
                $warehouse[$key] = $this->apply_warehouse_stock_reduction_priorities($key, $item);
            }
            // end of issue #10
        }
        // end is set $_POST warehouse
        
        // add the warehouse id and the stock reduced to the item meta if needed
        foreach ($items as $key => $item) {
            $this->add_warehouse_id_to_item($key, $warehouse[$key]);
            $this->add_stock_reduced_to_item($key);
        }
        
        // reduce the stock
        $items = $order->get_items();
        foreach ($items as $key => $item) {
            $warehouse_id = $warehouse[$key];
            if (isset($warehouse_id)) {
                $item = $this->update_meta_order_stock_reduced($key, $item, $warehouse_id, $status, $post_id);
            }
        }
    }

    public function warehouse_to_warehouse($post_id)
    {
        $order = new \WC_Order($post_id);
        
        // checks if warehouse destination is set
        if (isset($_POST["IM_Warehouse_destination"]) && ! empty($_POST["IM_Warehouse_destination"])) {
            // save the warehouse if
            update_post_meta($post_id, '_warehouse_destination_id', $_POST["IM_Warehouse_destination"]);
            $warehouse_repository = new IM_Warehouse_Repository();
            $warehouse_object_results = $warehouse_repository->get_by(array(
                "id" => $_POST["IM_Warehouse_destination"]
            ));
            $warehouse_object = $warehouse_object_results[0];
            
            $address = array(
                'first_name' => $warehouse_object->name,
                'last_name' => "",
                'company' => $warehouse_object->name,
                'address_1' => $warehouse_object->address,
                'address_2' => "",
                'postcode' => $warehouse_object->postcode,
                'city' => $warehouse_object->city,
                'country' => $warehouse_object->country
            );
            
            update_post_meta($order->id, '_billing_VAT_code', $warehouse_object->vat);
            
            $order->set_address($address, 'billing');
            $order->set_address($address, 'shipping');
        }
    }

    /**
     * Function to update the meta field stock reduced.
     * This field lets us know how many
     * units have been removed from the stock.
     */
    public function update_meta_order_stock_reduced($key, $item, $warehouse_id, $status, $post_id = NULL)
    {
        $no_note = false;
        if (isset($item['item_meta']['_stock_reduced'][0]) && $item['item_meta']['_qty'][0] == $item['item_meta']['_stock_reduced'][0]) {
            $no_note = true;
        }
        if ($post_id == null) {
            global $post;
            $post_id = $post->ID;
        }
        // check if it a product variation
        if (! empty($item['variation_id'])) {
            $item_id = $item['variation_id'];
        } else {
            $item_id = $item['product_id'];
        }
        $repository_product_warehouse = new IM_Product_Warehouse_Repository();
        $product_warehouse = $repository_product_warehouse->getByProductWarehouseID($item_id, $warehouse_id);
        // total stock of this product
        $total_stock = $product_warehouse->getStock();
        // this way it is only reduced once for the units that have not been reduced yet.
        $stock = $this->stock_calculator($total_stock, $status, $item);
        // persist the content
        $dto = array(
            "stock" => $stock
        );
        $condition = array(
            "id" => $product_warehouse->getId()
        );
        $repository_product_warehouse->update($dto, $condition);
        $warehouse_destination_id = get_post_meta($post_id, "_warehouse_destination_id", true);
        if ($status == "wc-cancelled" || $status == "wc-refunded" || $status == "wc-failed") {
            // issue #18 - move stocks
            if ($warehouse_destination_id != "") {
                // so now we remove the stock from the destination warehouse
                $product_warehouse_destination = $repository_product_warehouse->getByProductWarehouseID($item_id, $warehouse_destination_id);
                $total_stock_destination = $product_warehouse_destination->getStock();
                
                if (isset($item['item_meta']['_stock_reduced'][0])) {
                    $reduced = (int) $item['item_meta']['_stock_reduced'][0];
                } else {
                    $reduced = 0;
                }
                $stock_destination_moved = (int) $total_stock_destination - (int) $reduced;
                $dto = array(
                    "stock" => $stock_destination_moved
                );
                $condition = array(
                    "id" => $product_warehouse_destination->getId()
                );
                $repository_product_warehouse->update($dto, $condition);
                $this->add_stock_log($item_id, $warehouse_destination_id, $stock_destination_moved, "order #" . $post_id . " - order updated");
            }
            // end of issue #18
            $item['item_meta']['_stock_reduced'][0] = 0;
            wc_update_order_item_meta($key, '_stock_reduced', 0);
        } else {
            // issue #18 - move stocks
            if ($warehouse_destination_id != "") {
                // so now we add the stock from the origin warehouse to the destination
                $product_warehouse_destination = $repository_product_warehouse->getByProductWarehouseID($item_id, $warehouse_destination_id);
                $total_stock_destination = $product_warehouse_destination->getStock();
                
                if (isset($item['item_meta']['_stock_reduced'][0])) {
                    $reduced = (int) $item['item_meta']['_stock_reduced'][0];
                } else {
                    $reduced = 0;
                }
                $qty = (int) $item['item_meta']['_qty'][0];
                $stock_destination_moved = ($total_stock_destination + ($qty - $reduced));
                $dto = array(
                    "stock" => $stock_destination_moved
                );
                $condition = array(
                    "id" => $product_warehouse_destination->getId()
                );
                $repository_product_warehouse->update($dto, $condition);
                $this->add_stock_log($item_id, $warehouse_destination_id, $stock_destination_moved, "order #" . $post_id . " - order updated");
            }
            // end of issue #18
            $item['item_meta']['_stock_reduced'][0] = $item['qty'];
            wc_update_order_item_meta($key, '_stock_reduced', $item['qty']);
        }
        $this->update_total_stocks_woocommerce($item_id);
        // Issue #19
        if ($no_note == false) {
            $this->add_stock_log($item_id, $warehouse_id, $stock, "order #" . $post_id . " - order updated");
        }
        // end issue #19
        return $item;
    }

    /**
     * This is how the stock qty is calculated in the plugin
     */
    public function stock_calculator($total_stock, $status, $item)
    {
        $stock = 0;
        switch ($status) {
            case 'wc-cancelled':
            case 'wc-refunded':
            case 'wc-failed':
                $stock = $total_stock + ((int) $item['item_meta']['_stock_reduced'][0]);
                break;
            
            default:
                $qty = (int) $item['item_meta']['_qty'][0];
                if (isset($item['item_meta']['_stock_reduced'])) {
                    $reduced = (int) $item['item_meta']['_stock_reduced'][0];
                } else {
                    $reduced = 0;
                }
                $stock = $total_stock - ($qty - $reduced);
                break;
        }
        return $stock;
    }

    public function update_total_stocks_woocommerce($product_id)
    {
        // repository pattern
        $repository_product_warehouse = new IM_Product_Warehouse_Repository();
        $product_warehouses = $repository_product_warehouse->getByProductID($product_id);
        
        $total_stock = 0;
        foreach ($product_warehouses as $product_warehouse) {
            $raw_stock = $product_warehouse->stock;
            $total_stock += $raw_stock;
        }
        
        if ($total_stock > 0) {
            update_post_meta($product_id, "_stock_status", "instock");
        } else {
            update_post_meta($product_id, "_stock_status", "outofstock");
        }
        
        update_post_meta($product_id, "_stock", $total_stock);
    }

    public function custom_woocommerce_hidden_order_itemmeta($arr)
    {
        $arr[] = '_warehouse_id';
        $arr[] = '_stock_reduced';
        return $arr;
    }

    public function select_warehouse_container()
    {
        global $post_id;
        $order = new \WC_Order($post_id);
        if (! $order->is_editable()) {
            return;
        }
        add_meta_box('im-warehouse-select-warehouse-container', __('Select warehouse to all lines', "woocommerce-inventorymanager"), array(
            $this,
            'create_select_warehouse_container'
        ), 'shop_order', 'side');
    }

    public function create_select_warehouse_container()
    {
        $repository = new IM_Warehouse_Repository();
        $warehouses = $repository->get_all();
        $values = array(
            "warehouses" => $warehouses
        );
        $this->viewRender = IM_View_Render::get_instance();
        $this->viewRender->render("select-warehouse-metabox", $values);
    }
}