<?php
namespace Hellodev\InventoryManager;

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

class IM_Product_Warehouse_Repository extends IM_Database {

  public function __construct() {
    $this->tableName = IM_PLUGIN_DATABASE_TABLE_PRODUCT_WAREHOUSE;
  }

  public function refresh_relations($id, $keep_stock = 0) {
    $product_factory = new \WC_Product_Factory();
    $product = $product_factory->get_product($id);
    if($product->managing_stock()) {
      $repository = new IM_Warehouse_Repository();
      $product_warehouse_repository = new IM_Product_Warehouse_Repository();
      $warehouses = $repository->get_all();
      if(!empty($warehouses)) {
        foreach($warehouses as $warehouse) {
          $product_warehouses = $product_warehouse_repository->getByProductWarehouseID($id, $warehouse->id);
          /* if it is an empty product object */
          if($product_warehouses->getId() == NULL) {
            $values = array();
            $values["warehouse_id"] = $warehouse->id;
            $values["product_id"] = $id;
            if($keep_stock == 1) {
                $values["stock"] = $product->get_stock_quantity();
            } else {
                $values["stock"] = 0;
            }
            $values["priority"] = 0;
            parent::insert($values);
          }
        }
      }
    }
    $children_array = $product->get_children();
    $repository = new IM_Warehouse_Repository();
    $product_warehouse_repository = new IM_Product_Warehouse_Repository();
    $warehouses = $repository->get_all();
    if(!empty($children_array)) {
      foreach($children_array as $children) {
        foreach($warehouses as $warehouse) {
          $product_warehouses = $product_warehouse_repository->getByProductWarehouseID($children, $warehouse->id);
          /* if it is an empty product object */
          if($product_warehouses->getId() == NULL) {
            $values = array();
            $values["warehouse_id"] = $warehouse->id;
            $values["product_id"] = $children;
            $values["stock"] = 0;
            $values["priority"] = 0;
            parent::insert($values);
          }
        }
      }
    }
  }

  public function get_all($orderBy = NULL) {
    $array = parent::get_all($orderBy);
    $objects = array();
    $i = 0;
    foreach($array as $row) {
      $objects[$i] = new IM_Product_Warehouse($row);
      $i++;
    }
    return $objects;
  }

  public function get($id) {
    $pair = array();
    $pair["id"] = $id;
    $array = parent::get_by($pair);
    return new IM_Product_Warehouse($array[0]);
  }

  public function getByProductWarehouseID($product_id, $warehouse_id) {
    $pair = array();
    $pair["product_id"] = $product_id;
    $pair["warehouse_id"] = $warehouse_id;
    $array = parent::get_by($pair, "=");
    if(!empty($array)) {
      return new IM_Product_Warehouse($array[0]);
    } else {
      return new IM_Product_Warehouse();
    }
  }

  public function getByProductID($product_id) {
    $pair = array();
    $pair["product_id"] = $product_id;
    $array = parent::get_by($pair, "=", "priority ASC");
    return $array;
  }
}
