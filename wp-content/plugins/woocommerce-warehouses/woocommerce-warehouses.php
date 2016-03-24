<?php
/*
 * Plugin Name: WooCommerce Warehouses
 * Plugin URI: http://www.hellodev.us
 * Description: Add the possiblity of having mutiple warehouses and stock control inside WooCommerce.
 * Version: 1.1
 * Author: HelloDev
 * Author URI: http://www.hellodev.us
 * License: Closed source
 * Text Domain: woocommerce-inventorymanager
 * Domain Path: /assets/translations
 */

if (! defined('ABSPATH')) {
    exit(); // Exit if accessed directly
}

// use composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

global $wpdb;

define('IM_PLUGIN_FILE', __FILE__);
define('IM_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('IM_PLUGIN_DATABASE_TABLE', $wpdb->prefix . 'inventory_manager_warehouses');
define('IM_PLUGIN_DATABASE_TABLE_PRODUCT_WAREHOUSE', $wpdb->prefix . 'inventory_manager_product_warehouse');
define('IM_PLUGIN_DATABASE_TABLE_STOCK_LOG', $wpdb->prefix . 'inventory_manager_stock_log');

new Hellodev\InventoryManager\InventoryManager();