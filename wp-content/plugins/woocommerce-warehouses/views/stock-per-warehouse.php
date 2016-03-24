<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}
?>
<table class="widefat fixed">
  <thead>
    <tr>
      <th colspan="3" style="text-align: center; font-weight: bold"><?php _e("Warehouse Stocks Plugin Options", "woocommerce-inventorymanager"); ?> - <?php _e("List of warehouses", "woocommerce-inventorymanager"); ?></th>
    </tr>
    <tr>
      <th class="left manage-column column-columnname" style="text-align: center"><?php _e("Warehouse name", "woocommerce-inventorymanager"); ?></th>
      <th class="left manage-column column-columnname" style="text-align: center"><?php _e("Stock", "woocommerce-inventorymanager"); ?></th>
      <th class="left manage-column column-columnname" style="text-align: center"><?php _e("Stock reduction priority", "woocommerce-inventorymanager"); ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($values['warehouses'] as $warehouse): ?>
      <tr class="form-field">
        <td class="right column-columnname">
          <p><?php echo $warehouse["warehouse"]->name; ?></p>
        </td>
        <td class="left column-columnname">
          <p><input type="text" class="input_stock_warehouse" name="product[<?php echo $warehouse["product_id"]; ?>][<?php echo $warehouse["warehouse"]->id; ?>]" value="<?php if(isset($warehouse["priority"]) && $warehouse["priority"] != "") { echo $warehouse["stock"]; } else { echo "0"; } ?>" /></p>
        </td>
        <td class="left column-columnname">
          <p><input type="text" class="input_priority_warehouse" name="product-priority[<?php echo $warehouse["product_id"]; ?>][<?php echo $warehouse["warehouse"]->id; ?>]" value="<?php if(isset($warehouse["priority"]) && $warehouse["priority"] != "") { echo $warehouse["priority"]; } else { echo "0"; } ?>" /></p>
        </td>
      </tr>
    <?php endforeach; ?>
    <tr>
      <td class="right column-columnname">
        <p style="font-weight: bold"><?php _e("Total stock in all warehouses", "woocommerce-inventorymanager"); ?></p>
      </td>
      <td class="left column-columnname">
        <p style="font-weight: bold"><?php echo $values['total_stock']; ?> <?php _e("units", "woocommerce-inventorymanager"); ?></p>
      </td>
    </tr>
  </tbody>
</table>
