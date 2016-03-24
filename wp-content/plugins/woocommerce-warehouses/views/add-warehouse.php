<?php
namespace Hellodev\InventoryManager;

if (! defined('ABSPATH')) {
    exit(); // Exit if accessed directly
}
?>
<style>
.input-add-warehouse {
	width: 25em !important;
}

textarea {
	height: 100px;
}

.copyright {
	font-size: 14px;
	padding-top: 50px;
}

.copyright img {
	vertical-align: middle;
	height: 28px;
}
</style>
<?php $options = ""; ?>
<div class="wrap">
	<h2><?php _e("Add warehouse", "woocommerce-inventorymanager"); ?></h2>
  <?php if(isset($values['error'])): ?>
  	<div class="error">
		<p><?php echo $values['error']; ?></p>
	</div>
  <?php endif; ?>
  <?php if(isset($values['success']) && isset($_REQUEST['saved'])): ?>
  	<div class="updated">
		<p><?php echo $values['success']; ?></p>
	</div>
  <?php endif; ?>
  <form method="post" action="">
		<table class="form-table">
			<tbody>
				<tr class="form-field">
					<th scope="row"><label for="IM_Warehouse_name"><?php _e("Name", "woocommerce-inventorymanager"); ?></label></th>
					<td><input type="text" name="IM_Warehouse_name"
						class="input-add-warehouse"
						value="<?php if(isset($values['IM_Warehouse_name'])) echo $values['IM_Warehouse_name'] ?>"
						<?php echo $options; ?> /></td>
				</tr>
				<tr class="form-field">
					<th scope="row"><label for="IM_Warehouse_address"><?php _e("Address", "woocommerce-inventorymanager"); ?></label></th>
					<td><textarea name="IM_Warehouse_address"
							class="input-add-warehouse" <?php echo $options; ?>><?php if(isset($values['IM_Warehouse_address'])) echo $values['IM_Warehouse_address'] ?></textarea></td>
				</tr>
				<tr class="form-field">
					<th scope="row"><label for="IM_Warehouse_city"><?php _e("City", "woocommerce-inventorymanager"); ?></label></th>
					<td><input type="text" name="IM_Warehouse_city"
						class="input-add-warehouse"
						value="<?php if(isset($values['IM_Warehouse_city'])) echo $values['IM_Warehouse_city'] ?>"
						<?php echo $options; ?> /></td>
				</tr>
				<tr class="form-field">
					<th scope="row"><label for="IM_Warehouse_postcode"><?php _e("Postcode", "woocommerce-inventorymanager"); ?></label></th>
					<td><input type="text" name="IM_Warehouse_postcode"
						class="input-add-warehouse"
						value="<?php if(isset($values['IM_Warehouse_postcode'])) echo $values['IM_Warehouse_postcode'] ?>"
						<?php echo $options; ?> /></td>
				</tr>
				<tr class="form-field">
					<th scope="row"><label for="IM_Warehouse_country"><?php _e("Country", "woocommerce-inventorymanager"); ?></label></th>
					<td><input type="text" name="IM_Warehouse_country"
						class="input-add-warehouse"
						value="<?php if(isset($values['IM_Warehouse_country'])) echo $values['IM_Warehouse_country'] ?>"
						<?php echo $options; ?> /></td>
				</tr>
				<tr class="form-field">
					<th scope="row"><label for="IM_Warehouse_vat"><?php _e("VAT", "woocommerce-inventorymanager"); ?></label></th>
					<td><input type="text" name="IM_Warehouse_vat"
						class="input-add-warehouse"
						value="<?php if(isset($values['IM_Warehouse_vat'])) echo $values['IM_Warehouse_vat'] ?>"
						<?php echo $options; ?> /></td>
				</tr>
				<tr class="form-field">
					<th scope="row"><label for="IM_Warehouse_slug"><?php _e("Slug", "woocommerce-inventorymanager"); ?></label></th>
					<td><input type="text" name="IM_Warehouse_slug"
						class="input-add-warehouse"
						value="<?php if(isset($values['IM_Warehouse_slug'])) echo $values['IM_Warehouse_slug'] ?>"
						<?php echo $options; ?> /></td>
				</tr>
				<tr class="form-field">
					<th scope="row"><label for="IM_Warehouse_priority"><?php _e("Global stock priority", "woocommerce-inventorymanager"); ?></label></th>
					<td><input type="text" name="IM_Warehouse_priority"
						class="input-add-warehouse"
						value="<?php if(isset($values['IM_Warehouse_priority'])) echo $values['IM_Warehouse_priority'] ?>"
						<?php echo $options; ?> /></td>
				</tr>
			</tbody>
		</table>

    <?php if(isset($values['IM_Warehouse_id'])): ?>
      <input type="hidden" name="IM_Warehouse_id" class="button-primary"
			value="<?php echo $values['IM_Warehouse_id']; ?>" />
    <?php endif; ?>

      <input type="submit" name="submit" class="button-primary"
			value="<?php _e("Save warehouse", "woocommerce-inventorymanager"); ?>" />
	</form>
</div>
