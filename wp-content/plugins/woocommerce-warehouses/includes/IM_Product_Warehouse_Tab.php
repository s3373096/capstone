<?php
namespace Hellodev\InventoryManager;

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

class IM_Product_Warehouse_Tab {

  public function __construct() {
    add_action("woocommerce_product_options_stock_fields", array($this, 'add_stock_fields') );
    add_action("woocommerce_product_after_variable_attributes", array($this, 'add_stock_fields_variation'), 10, 3 );
    add_action('save_post', array($this, 'update_product_stock'), 10, 1);
  }

  public function refresh_database($id) {
    $repository = new IM_Product_Warehouse_Repository();
    /* this method adds non existent warehouses to the current product warehouse relation */
    $repository->refresh_relations($id);
  }

  public function render_warehouse_stock_fields_product($product_id) {
    $repository = new IM_Warehouse_Repository();
    $warehouses = $repository->get_all();
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
      $("._stock_field").remove();
      $(".input_stock_warehouse").change(function() {
        var sum = 0;
        $(".input_stock_warehouse").each(function(){
          sum += parseFloat(this.value);
        });
        $("#_stock").val(sum);
      });

      $(".show_if_variation_manage_stock .form-row-first").remove();
      $(".wc_input_stock").remove();
    });
    </script>
    <div class="wrap" style="padding-top: 15px; padding-bottom: 15px; width: 75%; margin:0 auto;">
      <?php
      $product = get_product($product_id);
      $get_stock = $product->get_stock_quantity();
      $stock_qty = empty($get_stock) ? 0 : $get_stock;
      ?>
      <div class="stock_fields show_if_variation_manage_stock" style="display: block;">
        <?php
        $i = 0;
        $values = array();
        $warehouses_values = array();
        foreach($warehouses as $warehouse) :
          $warehouse_id = $warehouse->id;
          $repository_product_warehouse = new IM_Product_Warehouse_Repository();
          $product_object = $repository_product_warehouse->getByProductWarehouseID($product_id, $warehouse_id);
          $warehouses_values[$i]["product_id"] = $product_id;
          $warehouses_values[$i]["warehouse"] = $warehouse;
          $warehouses_values[$i]["stock"] = $product_object->getStock();
          $warehouses_values[$i]["priority"] = $product_object->getPriority();
          $i++;
        endforeach;
        $values["warehouses"] = $warehouses_values;
        $values["total_stock"] = $stock_qty;
        $this->viewRender = IM_View_Render::get_instance();
        $this->viewRender->render("stock-per-warehouse", $values);
        ?>
      </div>
      <input type="hidden" name="_stock" id="_stock" value="<?php echo $stock_qty; ?>" />
    </div>
    <?php
  }

  public function render_warehouse_stock_fields_variation($product_id) {
    $repository = new IM_Warehouse_Repository();
    $warehouses = $repository->get_all();
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
      $("._stock_field").remove();
      $(".input_stock_warehouse").change(function() {
        var sum = 0;
        $(".input_stock_warehouse").each(function(){
          sum += parseFloat(this.value);
        });
        $("#_stock").val(sum);
      });

      $(".show_if_variation_manage_stock .form-row-first").remove();
      $(".wc_input_stock").remove();
    });
    </script>
    <div class="wrap" style="padding-top: 15px; padding-bottom: 15px; width: 75%; margin:0 auto;">
      <?php
      $product = get_product($product_id);
      $get_stock = $product->get_stock_quantity();
      $stock_qty = empty($get_stock) ? 0 : $get_stock;
      ?>
      <div class="stock_fields show_if_variation_manage_stock" style="display: block;">
        <?php
        $i = 0;
        $values = array();
        $warehouses_values = array();
        foreach($warehouses as $warehouse) :
          $warehouse_id = $warehouse->id;
          $repository_product_warehouse = new IM_Product_Warehouse_Repository();
          $product_object = $repository_product_warehouse->getByProductWarehouseID($product_id, $warehouse_id);
          $warehouses_values[$i]["product_id"] = $product_id;
          $warehouses_values[$i]["warehouse"] = $warehouse;
          $warehouses_values[$i]["stock"] = $product_object->getStock();
          $warehouses_values[$i]["priority"] = $product_object->getPriority();
          $i++;
        endforeach;
        $values["warehouses"] = $warehouses_values;
        $values["total_stock"] = $stock_qty;
        $this->viewRender = IM_View_Render::get_instance();
        $this->viewRender->render("stock-per-warehouse", $values);
        ?>
      </div>
    </div>
    <?php
  }

  public function add_stock_fields_variation($loop, $variation_data, $variation) {
    global $post;
    $this->refresh_database($post->ID);
    $this->render_warehouse_stock_fields_variation($variation->ID);
  }

  public function add_stock_fields() {
    global $post;
    $this->refresh_database($post->ID);
    $this->render_warehouse_stock_fields_product($post->ID);
  }

  /**
  * Updates the product stock
  */
  public function update_product_stock($post_id) {
    $post = get_post( $post_id );
    $product = get_product( $post_id );
    $repository = new IM_Warehouse_Repository();
    $warehouses = $repository->get_all();
    $total = 0;
    foreach($warehouses as $warehouse) :
      $warehouse_id = $warehouse->id;
      if(isset($_POST["product"]))
      {
        $repository_product_warehouse = new IM_Product_Warehouse_Repository();
        $new_stock = $_POST["product"];
        $new_stock = $new_stock[$post_id][$warehouse_id];
        $new_stock_pair = array();
        $new_stock_pair["stock"] = $new_stock;
        $condition_pair = array();
        $condition_pair["product_id"] = $post_id;
        $condition_pair["warehouse_id"] = $warehouse_id;
        $updated = $repository_product_warehouse->update($new_stock_pair, $condition_pair);
        // Issue #19
        $stock_log_content = array();
        $stock_log_content["product_id"] = $post_id;
        $stock_log_content["warehouse_id"] = $warehouse_id;
        $stock_log_content["stock"] = $new_stock;
        $stock_log_content["reason"] = "direct change";
        $repository_product_stock_log = new IM_Stock_Log_Repository();
        $repository_product_stock_log->insert($stock_log_content);
        // end issue #19
        $total += $new_stock;
      }
      if(isset($_POST["product-priority"]))
      {
        $repository_product_warehouse = new IM_Product_Warehouse_Repository();
        $new_stock_pair = array();
        $priority = $_POST["product-priority"];
        $new_stock_pair["priority"] = $priority[$post_id][$warehouse_id];
        $condition_pair = array();
        $condition_pair["product_id"] = $post_id;
        $condition_pair["warehouse_id"] = $warehouse_id;
        $repository_product_warehouse->update($new_stock_pair, $condition_pair);
      }
    endforeach;
    $product->set_stock($total);
    $children_array = $product->get_children();
    if(sizeof($children_array) > 0) {
      foreach($children_array as $children) :
        $total = 0;
        $post_id = $children;
        foreach($warehouses as $warehouse) :
          $warehouse_id = $warehouse->id;
          if(isset($_POST["product"]))
          {
            $repository_product_warehouse = new IM_Product_Warehouse_Repository();
            $new_stock = $_POST["product"];
            $new_stock = $new_stock[$post_id][$warehouse_id];
            $new_stock_pair = array();
            $new_stock_pair["stock"] = $new_stock;
            $condition_pair = array();
            $condition_pair["product_id"] = $post_id;
            $condition_pair["warehouse_id"] = $warehouse_id;
            $updated = $repository_product_warehouse->update($new_stock_pair, $condition_pair);
            // Issue #19
            $stock_log_content = array();
            $stock_log_content["product_id"] = $post_id;
            $stock_log_content["warehouse_id"] = $warehouse_id;
            $stock_log_content["stock"] = $new_stock;
            $stock_log_content["reason"] = "direct change";
            $repository_product_stock_log = new IM_Stock_Log_Repository();
            $repository_product_stock_log->insert($stock_log_content);
            // end issue #19
            $total += $new_stock;
          }
          if(isset($_POST["product-priority"]))
          {
            $repository_product_warehouse = new IM_Product_Warehouse_Repository();
            $new_stock_pair = array();
            $priority = $_POST["product-priority"];
            $new_stock_pair["priority"] = $priority[$post_id][$warehouse_id];
            $condition_pair = array();
            $condition_pair["product_id"] = $post_id;
            $condition_pair["warehouse_id"] = $warehouse_id;
            $repository_product_warehouse->update($new_stock_pair, $condition_pair);
          }
        endforeach;
        $product = get_product($children);
        $product->set_stock($total);
      endforeach;
    }
  }
}