<?php
namespace Hellodev\InventoryManager;

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

class IM_Product_Warehouse {
  public $id;
  public $product_id;
  public $warehouse_id;
  public $stock;
  public $priority;

  public function __construct($parameters = array()) {
    // auto-populate object..
    foreach($parameters as $key => $value) {
      $this->$key = $value;
    }
  }

  public function getId() {
    return $this->id;
  }

  public function getStock() {
    return $this->stock;
  }

  public function getPriority() {
    return $this->priority;
  }
}
