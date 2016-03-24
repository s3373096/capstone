<?php
namespace Hellodev\InventoryManager;

if (! defined('ABSPATH')) {
    exit();
}

class IM_Warehouse extends IM_Database
{

    public $IM_Warehouse_id;

    public $IM_Warehouse_name;

    public $IM_Warehouse_address;

    public $IM_Warehouse_postcode;

    public $IM_Warehouse_city;

    public $IM_Warehouse_country;

    public $IM_Warehouse_vat;

    public $IM_Warehouse_slug;

    public $IM_Warehouse_priority;

    public function __construct($parameters = array())
    {
        $this->tableName = IM_PLUGIN_DATABASE_TABLE;
        // auto-populate object..
        foreach ($parameters as $key => $value) {
            $this->$key = $value;
        }
    }

    public function save()
    {
        $warehouse_array = array();
        $warehouse_array['name'] = $this->IM_Warehouse_name;
        $warehouse_array['address'] = $this->IM_Warehouse_address;
        $warehouse_array['postcode'] = $this->IM_Warehouse_postcode;
        $warehouse_array['city'] = $this->IM_Warehouse_city;
        $warehouse_array['country'] = $this->IM_Warehouse_country;
        $warehouse_array['vat'] = $this->IM_Warehouse_vat;
        $warehouse_array['slug'] = $this->IM_Warehouse_slug;
        $warehouse_array['priority'] = $this->IM_Warehouse_priority;
        $warehouse_array['time'] = date('Y-m-d H:i:s');
        if ($this->IM_Warehouse_id == NULL) {
            // lets make a new record
            // returns the id
            $this->IM_Warehouse_id = parent::insert($warehouse_array);
        } else {
            // update the existing record
            parent::update($warehouse_array, array(
                "id" => $this->IM_Warehouse_id
            ));
        }
    }
}
