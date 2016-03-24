<?php
namespace Hellodev\InventoryManager;

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

class IM_Stock_Log_Repository extends IM_Database {

  public function __construct() {
    $this->tableName = IM_PLUGIN_DATABASE_TABLE_STOCK_LOG;
  }
}
