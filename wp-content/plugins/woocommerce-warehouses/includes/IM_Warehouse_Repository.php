<?php
namespace Hellodev\InventoryManager;

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

class IM_Warehouse_Repository extends IM_Database {

  public function __construct() {
    $this->tableName = IM_PLUGIN_DATABASE_TABLE;
  }
}
