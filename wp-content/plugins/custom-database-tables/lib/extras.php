<?php

namespace CustomDataBaseTables\Lib;


/**
 * Trait of custom extensions for this plugin 
 *
 * @since 2.0.0
 *
 */
trait CdbtExtras {

  /**
   * Filter to attribute of class in the body tag of rendered page
   *
   * @since 2.0.0
   * @updated 2.0.4
   *
   * @param mixed $classes It is `String` when "is_admin()" is true; otherwise is `Array`
   * @return mixed $classes
   */
  public function add_body_classes( $classes ) {
    if (is_array($classes)) {
      $classes[] = 'fuelux';
    } else {
      $classes_array = explode(' ', $classes);
      $classes_array[] = 'fuelux';
      $classes = implode(' ', $classes_array);
    }
    return $classes;
  }
  // CdbtFrontend : add_filter( 'body_class', array($this, 'add_body_classes') );


  /**
   * Condition of features during trial
   *
   * @since 2.0.0
   *
   * @param string $feature_name
   * @return void
   */
  public function during_trial( $feature_name ) {
    $new_features = [
      'enable_core_tables', 
      'display_datetime_format', 
      'debug_mode', 
      'default_charset', 
      'localize_timezone', 
      'default_db_engine', 
      'default_per_records', 
      'auto_add_columns', 
      'user_permission_view', 
      'user_permission_entry', 
      'user_permission_edit', 
      'import_table', 
      'export_table', 
      'duplicate_table', 
      'backup_table', 
      'view_data', 
      'entry_data', 
      'edit_data', 
      'shortcode_list', 
      'shortcode_register', 
      'shortcode_edit', 
      'hosts_list', 
      'apikey_generator', 
      'apikey_requests', 
      'allow_rendering_shortcodes', 
      'include_assets', 
    ];
    if (in_array($feature_name, $new_features)) {
      printf( '<span class="label label-warning">%s</span>', __('Trialling', CDBT) );
    }
  }

  /**
   * Create datasource of table list for repeater of fuelux
   *
   * @since 2.0.0
   *
   * @param array $data Array of table name
   * @return array $datasource Array for repeater of fuelux
   */
  public function create_tablelist_datasorce( $data ) {
    $datasource = [];
    if (is_array($data)) {
      $is_assoc = $this->is_assoc($data);
      if ($is_assoc) {
        asort($data);
      } else {
        sort($data);
      }
      
      $index = 0;
      foreach ($data as $key => $value) {
        $current_data = $this->array_flatten($this->get_data($value, 'count(*)', 'ARRAY_N'));
        $table_info = $this->get_table_option($value);
        if (!$table_info) {
        	$table_info = $this->get_table_status($value);
        	$table_info['primary_key'] = [];
        	foreach ($this->get_table_schema($value) as $column => $scheme) {
        	  if ($scheme['primary_key']) 
        	    $table_info['primary_key'][] = $column;
        	}
        } else {
          $table_info = array_merge($table_info, $this->get_table_status($value));
        }
        $datasource[$index] = [
          'cdbt_index_id' => $is_assoc ? ($index + 1) : $key, 
          'table_name' => $value, 
          'logical_name' => !empty($table_info['table_comment']) ? $table_info['table_comment'] : ($is_assoc ? $key : $value), 
          'records' => $current_data[0], 
          'primary_key' => !empty($table_info['primary_key']) ? implode(', ', $table_info['primary_key']) : '-', 
          'charset' => isset($table_info['table_charset']) ? $table_info['table_charset'] : $this->db_default_charset, 
          'collation' => isset($table_info['table_collation']) ? $table_info['table_collation'] : $table_info['Collation'], 
          'engine' => isset($table_info['db_engine']) ? $table_info['db_engine'] : $table_info['Engine'], 
          'per_records' => isset($table_info['show_max_records']) ? $table_info['show_max_records'] : $this->options['default_per_records'], 
          'avg_row_length' => $table_info['Avg_row_length'], 
          'data_lenght' => $table_info['Data_length'], 
          'create_time' => $table_info['Create_time'], 
          'operate_table_url' => './' . basename( esc_url(admin_url(add_query_arg([ 'tab'=>'operate_table' ]))) ), 
          'operate_data_url' => './' . basename( esc_url(admin_url(add_query_arg([ 'tab'=>'operate_data' ]))) ), 
          'thumbnail_src' => $this->plugin_url . $this->plugin_assets_dir . '/images/database-table.png', // optional
          'thumbnail_title' => $value, // optional
          'thumbnail_bgcolor' => 'transparent', // optional
          'thumbnail_width' => 64, // optional
          'thumbnail_height' => 64, // optional
          'thumbnail_class' => null, // optional
        ];
        
        $index++;
      }
    }
    
    // Filter
    $datasource = apply_filters( 'cdbt_fuelux_tablelist_datasource', $datasource );
    
    return $datasource;
  }
  
  
  /**
   * Create scheme of datasource for repeater of fuelux
   *
   * @since 2.0.0
   *
   * @param string $conponent_id [require] Id attribute of top level element of repeater conponent
   * @param integer $page_index [require] Start page index number
   * @param integer $page_size [require] Default per page rows
   * @param mixed $columns [require] Array of column definitions of repeater, or string of preset name
   * @param array $datasource [require] Datasource created by `create_tablelist_datasorce()`
   * @param array $reject_columns [optional] Array of column properties that want to reject
   * @return array $conponent_options Array for repeater of fuelux
   */
  public function create_scheme_datasource( $conponent_id='cdbtRepeater', $page_index=0, $page_size=10, $columns=null, $datasource=[], $reject_columns=[] ) {
    
    $custom_row_scripts = [];
    
    if (!is_array($columns) && in_array($columns, [ 'table_list', 'shortcode_list', 'host_list' ])) {
      if ('table_list' === $columns) {
        // For customColumnRenderer() in the repeater script
        $custom_column_content = "'<div class=\"tl-operation-buttons\"><div class=\"btn-group operate-table-btn-group\" role=\"group\" aria-label=\"operateTableButtons\">";
        $custom_column_content .= "<button type=\"button\" data-target-table=\"'+rowData.table_name+'\" data-operate-action=\"detail\" data-base-url=\"'+rowData.operate_table_url+'\" class=\"btn btn-default\" title=\"". __('Oparate Table', CDBT) ."\"><span class=\"sr-only\">". __('Oparate Table', CDBT) ."</span><i class=\"fa fa-sliders\"></i></button>";
        $custom_column_content .= "</div><div class=\"btn-group operate-data-btn-group\" role=\"group\" aria-label=\"operateDataButtons\">";
        $custom_column_content .= "<button type=\"button\" data-target-table=\"'+rowData.table_name+'\" data-operate-action=\"view\" data-base-url=\"'+rowData.operate_data_url+'\" class=\"btn btn-default\" title=\"". __('View Data', CDBT) ."\"><span class=\"sr-only\">". __('View Data', CDBT) ."</span><i class=\"fa fa-eye\"></i></button>";
        $custom_column_content .= "<button type=\"button\" data-target-table=\"'+rowData.table_name+'\" data-operate-action=\"entry\" data-base-url=\"'+rowData.operate_data_url+'\" class=\"btn btn-default\" title=\"". __('Entry Data', CDBT) ."\"><span class=\"sr-only\">". __('Entry Data', CDBT) ."</span><i class=\"fa fa-plus\"></i></button>";
        $custom_column_content .= "<button type=\"button\" data-target-table=\"'+rowData.table_name+'\" data-operate-action=\"edit\" data-base-url=\"'+rowData.operate_data_url+'\" class=\"btn btn-default\" title=\"". __('Edit Data', CDBT) ."\"><span class=\"sr-only\">". __('Edit Data', CDBT) ."</span><i class=\"fa fa-pencil-square-o\"></i></button>";
        $custom_column_content .= "</div></div>'";
        
        $repeater_custom_methods = [];
        // For customRowRenderer() in the repeater script
        $repeater_custom_methods['customRowScripts'] = [
          "item.attr('id', 'row-' + helpers.rowData.table_name);", 
          "item.attr('class', 'cdbt-repeater-row');"
        ];
        //$custom_row_scripts[] = "item.attr('id', 'row-' + helpers.rowData.table_name);";
        //$custom_row_scripts[] = "item.attr('class', 'cdbt-repeater-row');";
        
        $columns = [
          [ 'label' => __('TableName', CDBT), 
            'property' => 'table_name', 
            'sortable' => true, 
            'sortDirection' => 'asc', 
            'className' => 'col-tl-tablename', 
            'customColumnRenderer' => "'<div class=\"cdbt-repeater-left-main\"><a href=\"#\" data-target-table=\"'+rowData.table_name+'\" data-operate-action=\"detail\" data-base-url=\"'+rowData.operate_table_url+'\">'+rowData.table_name+'</a></div><div class=\"small text-muted cdbt-repeater-left-sub\">'+rowData.logical_name+'</div>'"
          ], 
          [ 'label' => __('Records', CDBT), 
            'property' => 'records', 
            'sortable' => true, 
            'sortDirection' => 'asc', 
            'dataNumric' => true, 
            'className' => 'col-tl-records', 
          ], 
          [ 'label' => __('PrimaryKey', CDBT), 
            'property' => 'primary_key', 
            'sortable' => false, 
            'className' => 'col-tl-pk', 
          ], 
          [ 'label' => __('Charset', CDBT), 
            'property' => 'charset', 
            'sortable' => false, 
            'className' => 'col-tl-charset', 
          ], 
          [ 'label' => __('Collation', CDBT), 
            'property' => 'collation', 
            'sortable' => false, 
            'className' => 'col-tl-collation', 
          ], 
          [ 'label' => __('Engine', CDBT), 
            'property' => 'engine', 
            'sortable' => false, 
            'className' => 'col-tl-engine', 
          ], 
          [ 'label' => __('PerPageRecords', CDBT), 
            'property' => 'per_records', 
            'sortable' => false, 
            'dataNumric' => true, 
            'className' => 'col-tl-ppr', 
          ], 
//          [ 'label' => __('AvgRowLength', CDBT), 
//            'property' => 'avg_row_length', 
//            'sortable' => true, 
//            'dataNumric' => true, 
//          ], 
//          [ 'label' => __('DataLength', CDBT), 
//            'property' => 'data_length', 
//            'sortable' => true, 
//            'dataNumric' => true, 
//          ], 
//          [ 'label' => __('CreateDatetime', CDBT), 
//            'property' => 'create_time', 
//            'sortable' => false, 
//          ], 
          [ 'label' => __('Operation', CDBT), 
            'property' => 'operate_table_url', 
            'sortable' => false, 
            'className' => 'col-tl-operation', 
            'customColumnRenderer' => $custom_column_content, 
          ], 
        ];
      } else
      if ('shortcode_list' === $columns) {
        // For customColumnRenderer() in the repeater script
        $custom_column_content = "'<div class=\"scl-operation-buttons\"><div class=\"btn-group operate-shortcode-register-btn-group\" role=\"group\" aria-label=\"operateShortcodeButtons\">";
        $custom_column_content .= "<button type=\"button\" data-target-sc=\"'+rowData.shortcode_name+'\" data-target-scid=\"\" data-operate-action=\"register\" data-base-url=\"'+rowData.operate_shortcode_url+'register\" class=\"btn btn-default\" title=\"". __('Register Shortcode', CDBT) ."\"><span class=\"sr-only\">". __('Register Shortcode', CDBT) ."</span><i class=\"fa fa-plus\"></i></button>";
        $custom_column_content .= "</div><div class=\"btn-group operate-shortcode-edit-btn-group\" role=\"group\" aria-label=\"operateShortcodeButtons\">";
        $custom_column_content .= "<button type=\"button\" data-target-sc=\"\" data-target-scid=\"'+rowData.shortcode_id+'\" data-operate-action=\"edit\" data-base-url=\"'+rowData.operate_shortcode_url+'edit\" class=\"btn btn-default\" title=\"". __('Edit Shortcode', CDBT) ."\"><span class=\"sr-only\">". __('Edit Shortcode', CDBT) ."</span><i class=\"fa fa-edit\"></i></button>";
        $custom_column_content .= "<button type=\"button\" data-target-sc=\"\" data-target-scid=\"'+rowData.shortcode_id+'\" data-operate-action=\"delete\" data-base-url=\"'+rowData.operate_shortcode_url+'list\" class=\"btn btn-default\" title=\"". __('Delete Shortcode', CDBT) ."\"><span class=\"sr-only\">". __('Delete Shortcode', CDBT) ."</span><i class=\"fa fa-trash-o\"></i></button>";
        $custom_column_content .= "</div></div>'";
        
        $repeater_custom_methods = [];
        // For customRowRenderer() in the repeater script
        $repeater_custom_methods['customRowScripts'] = [
          "item.attr('id', 'row-' + helpers.rowData.shortcode_name + ('-' === helpers.rowData.shortcode_id ? '' : '-' + helpers.rowData.shortcode_id));", 
          "item.attr('class', 'cdbt-repeater-row');"
        ];
        // For after rendered
        $repeater_custom_methods['afterRender'] = "function(){ console.info('rendered'); }";
        
        $columns = [
          [ 'label' => __('CSID', CDBT), 
            'property' => 'shortcode_id', 
            'sortable' => true, 
            'sortDirection' => 'asc', 
            'className' => 'col-scl-id', 
          ], 
          [ 'label' => __('Shortcode Name / Alias Shortcode', CDBT), 
            'property' => 'shortcode_name', 
            'sortable' => true, 
            'sortDirection' => 'asc', 
            'className' => 'col-scl-name', 
            'customColumnRenderer' => "'<div class=\"cdbt-repeater-left-main\"><a href=\"#\" data-target-sc=\"'+rowData.shortcode_name+'\" data-target-scid=\"'+rowData.shortcode_id+'\" data-operate-action=\"\" data-base-url=\"'+rowData.operate_shortcode_url+'register\">'+rowData.shortcode_name+'</a></div>'"
          ], 
          [ 'label' => __('Description', CDBT), 
            'property' => 'description', 
            'sortable' => false, 
            'className' => 'col-scl-desc', 
          ], 
          [ 'label' => __('Type', CDBT), 
            'property' => 'shortcode_type', 
            'sortable' => true, 
            'sortDirection' => 'asc', 
            'className' => 'col-scl-type', 
          ], 
          [ 'label' => __('Author', CDBT), 
            'property' => 'shortcode_author', 
            'sortable' => true, 
            'sortDirection' => 'asc', 
            'className' => 'col-scl-author', 
          ], 
          [ 'label' => __('Permission', CDBT), 
            'property' => 'permission', 
            'sortable' => false, 
            'className' => 'col-scl-permission', 
          ], 
          [ 'label' => __('Operation', CDBT), 
            'property' => 'operate_shortcode_url', 
            'sortable' => false, 
            'className' => 'col-scl-operation', 
            'customColumnRenderer' => $custom_column_content, 
          ], 
        ];
        
      } else
      if ('host_list' === $columns) {
        // For customColumnRenderer() in the repeater script
        $custom_column_content = "'<div class=\"ahl-operation-buttons\"><div class=\"btn-group operate-webapi-deletion-btn-group\" role=\"group\" aria-label=\"operateShortcodeButtons\">";
        $custom_column_content .= "<button type=\"button\" data-target-host=\"host_name\" data-target-hostid=\"'+rowData.host_id+'\" data-operate-action=\"delete\" data-base-url=\"'+rowData.operate_webapi_url+'\" class=\"btn btn-default\" title=\"". __('Delete Host', CDBT) ."\"><span class=\"sr-only\">". __('Delete Shortcode', CDBT) ."</span><i class=\"fa fa-trash-o\"></i></button>";
        $custom_column_content .= "</div>'";
        
        $repeater_custom_methods = [];
        // For customRowRenderer() in the repeater script
        $repeater_custom_methods['customRowScripts'] = [
          "item.attr('id', 'row-' + helpers.rowData.host_name + '-' + helpers.rowData.host_id);", 
          "item.attr('class', 'cdbt-repeater-row');"
        ];
        
        $columns = [
          [ 'label' => __('ID', CDBT), 
            'property' => 'host_id', 
            'sortable' => true, 
            'sortDirection' => 'asc', 
            'className' => 'col-ahl-id', 
          ], 
          [ 'label' => __('Host Name', CDBT), 
            'property' => 'host_name', 
            'sortable' => true, 
            'sortDirection' => 'asc', 
            'className' => 'col-ahl-name', 
          ], 
          [ 'label' => __('API Key', CDBT), 
            'property' => 'api_key', 
            'sortable' => true, 
            'sortDirection' => 'asc', 
            'className' => 'col-ahl-apikey', 
          ], 
          [ 'label' => __('Description Host', CDBT), 
            'property' => 'description', 
            'sortable' => false, 
            'className' => 'col-ahl-desc', 
          ], 
          [ 'label' => __('Permission', CDBT), 
            'property' => 'permission', 
            'sortable' => false, 
            'className' => 'col-ahl-permission', 
          ], 
          [ 'label' => __('Generated Date', CDBT), 
            'property' => 'generated', 
            'sortable' => true, 
            'sortDirection' => 'asc', 
            'className' => 'col-ahl-generated', 
          ], 
          [ 'label' => __('Deletion', CDBT), 
            'property' => 'operate_webapi_url', 
            'sortable' => false, 
            'className' => 'col-ahl-operation', 
            'customColumnRenderer' => $custom_column_content, 
          ], 
        ];

      }
    }
    
    // For rejecting columns
    if (!empty($reject_columns)) {
      foreach ($columns as $i => $column) {
        if (in_array($column['property'], $reject_columns )) {
          unset($columns[$i]);
        }
      }
    }
    
    $conponent_options = [
      'id' => $conponent_id, 
      'enableView' => false, 
      'listSelectable' => 'single', 
      'pageIndex' => $page_index, 
      'pageSize' => $page_size, 
      'columns' => $columns, 
      'data' => $datasource, 
    ];
    
    if (isset($repeater_custom_methods) && !empty($repeater_custom_methods)) {
      foreach ($repeater_custom_methods as $_key => $_val) {
        $conponent_options[$_key] = $_val;
      }
    }
    
    return $conponent_options;
    
  }




}