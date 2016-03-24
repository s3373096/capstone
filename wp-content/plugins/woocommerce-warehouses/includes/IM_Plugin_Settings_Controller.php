<?php
namespace Hellodev\InventoryManager;

if (! defined('ABSPATH')) {
    exit();
}

class IM_Plugin_Settings_Controller
{

    private $viewRender;

    public function __construct()
    {
        add_action('admin_init', array(
            $this,
            'settings_init'
        ));
    }

    public function renderView($values = null)
    {
        $this->viewRender = IM_View_Render::get_instance();
        $this->viewRender->render("plugin-settings", array());
    }

    public function settings_init()
    {
        $settings = array(
            array(
                'name' => 'hd_warehouses_settings',
                'title' => __('Warehouses Settings', "woocommerce-inventorymanager"),
                'page' => 'hellodev-inventory-manager-plugin-settings',
                'settings' => array(
                    array(
                        'name' => 'hd_warehouses_csv_export_delimiter',
                        'title' => __('Stock Report Export CSV delimiter', "woocommerce-inventorymanager")
                    ),
                    array(
                        'name' => 'stock_reduction_state',
                        'title' => __('WooCommerce Stock Reduction State', "woocommerce-inventorymanager")
                    ),
                    array(
                        'name' => 'hd_warehouses_custom_meta_stock_export',
                        'title' => __('Custom meta fields in Stock Export', "woocommerce-inventorymanager")
                    )
                )
            )
        );
        
        foreach ($settings as $sections => $section) {
            // add the main part
            add_settings_section($section['name'], $section['title'], array(
                $this,
                $section['name']
            ), $section['page']);
            
            // loop each settings of the block
            foreach ($section['settings'] as $setting => $option) {
                // add & register the settings field
                add_settings_field($option['name'], $option['title'], array(
                    $this,
                    $option['name']
                ), $section['page'], $section['name']);
                
                register_setting($section['page'], $option['name']);
            }
        }
    }

    public function hd_warehouses_custom_meta_stock_export()
    {
        echo '<input type="text" name="hd_warehouses_custom_meta_stock_export" id="hd_warehouses_custom_meta_stock_export" value="' . get_option('hd_warehouses_custom_meta_stock_export') . '" autocomplete="off" />';
        echo '<label for="hd_warehouses_custom_meta_stock_export">' . __("Please input the fields (seperated by ;).", "woocommerce-inventorymanager") . '</label>';
    }

    public function hd_warehouses_settings()
    {
        echo '<p>' . __('Please fill in the necessary settings below.', "woocommerce-inventorymanager") . '</p>';
    }

    public function hd_warehouses_csv_export_delimiter()
    {
        echo '<input type="text" name="hd_warehouses_csv_export_delimiter" id="hd_warehouses_csv_export_delimiter" value="' . get_option('hd_warehouses_csv_export_delimiter') . '" autocomplete="off" />';
        echo '<label for="hd_warehouses_csv_export_delimiter">' . __('This will be used when you export a CSV Stock Report. European format is ";" and american is ",". Default: ";"', "woocommerce-inventorymanager") . '</label>';
    }

    public function stock_reduction_state()
    {
        $statuses = wc_get_order_statuses();
        ?>
<select id="stock_reduction_state" name="stock_reduction_state">
        <?php foreach ($statuses as $key => $value): ?>
        	<option value="<?php echo $key ?>"
		<?php $this->if_selected($key); ?>> <?php echo $value; ?></option>
        <?php endforeach; ?>
        </select>
<?php
    }

    public function if_selected($value)
    {
        $selected = get_option('stock_reduction_state');
        if ($selected == $value)
            echo 'selected="selected"';
    }
}
