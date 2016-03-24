<?php
global $im_db_version;
$im_db_version = '1.0.5';

function im_install()
{
    global $wpdb;
    global $im_db_version;
    $installed_ver = get_option("im_db_version");
    
    if ($installed_ver != $im_db_version) {
        
        // warehouses table
        $table_name = IM_PLUGIN_DATABASE_TABLE;
        
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
    name tinytext NULL,
    address text NULL,
    postcode text NULL,
    city text NULL,
    country text NULL,
    vat text NULL,
    slug text NOT NULL,
    priority int(255) NULL,
    PRIMARY KEY id (id)
    ) $charset_collate;";
        
        require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        
        // product-warehouse table
        $table_name = IM_PLUGIN_DATABASE_TABLE_PRODUCT_WAREHOUSE;
        
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    product_id mediumint(9),
    warehouse_id mediumint(9),
    stock int(255) NULL,
    priority int(255) NULL,
    PRIMARY KEY id (id, product_id, warehouse_id),
    FOREIGN KEY (warehouse_id) REFERENCES " . IM_PLUGIN_DATABASE_TABLE . "(id) ON DELETE CASCADE,
    UNIQUE KEY `product_warehouse_unique` (`product_id`, `warehouse_id`)
    ) $charset_collate;";
        
        require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        
        // stock log table
        $table_name = IM_PLUGIN_DATABASE_TABLE_STOCK_LOG;
        
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    product_id mediumint(9),
    warehouse_id mediumint(9),
    stock int(255) NULL,
    reason varchar(255) NULL,
    timestamp timestamp,
    PRIMARY KEY id (id),
    FOREIGN KEY (warehouse_id) REFERENCES " . IM_PLUGIN_DATABASE_TABLE . "(id) ON DELETE SET NULL
    ) $charset_collate;";
        
        require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        
        if ($installed_ver != null) {
            update_option("im_db_version", $im_db_version);
        } else {
            add_option("im_db_version", $im_db_version);
        }
        
        $stock_reduction_state = get_option("stock_reduction_state");
        
        if ($stock_reduction_state != null) {
            update_option("stock_reduction_state", "pending");
        } else {
            add_option("stock_reduction_state", "pending");
        }
        
        $csv_export_delimiter = get_option("hd_warehouses_csv_export_delimiter");
        
        if ($csv_export_delimiter != null) {
            update_option("hd_warehouses_csv_export_delimiter", ";");
        } else {
            add_option("hd_warehouses_csv_export_delimiter", ";");
        }
    }
}

/**
 * This function can be used to insert data into the database newly created.
 */
function im_install_data()
{
    global $wpdb;
    
    $welcome_name = 'Dear user';
    $welcome_text = 'Congratulations, you just completed the installation!';
    
    $table_name = $wpdb->prefix . 'inventory_manager_warehouses';
}

register_activation_hook(__FILE__, 'im_install');
register_activation_hook(__FILE__, 'im_install_data');

function im_update_db_check()
{
    global $im_db_version;
    if (get_site_option('im_db_version') != $im_db_version) {
        im_install();
    }
}

add_action('plugins_loaded', 'im_update_db_check');
