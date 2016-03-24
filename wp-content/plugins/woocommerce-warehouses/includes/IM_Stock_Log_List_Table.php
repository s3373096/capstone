<?php
namespace Hellodev\InventoryManager;

if (! defined('ABSPATH')) {
    exit();
}

class IM_Stock_Log_List_Table extends IM_List_Table
{

    private $table_name;

    /**
     * Constructor, we override the parent to pass our own arguments
     * We usually focus on three parameters: singular and plural labels, as well as whether the class supports AJAX.
     */
    public function __construct()
    {
        $this->table_name = IM_PLUGIN_DATABASE_TABLE_STOCK_LOG;
        parent::__construct(array(
            'singular' => 'wp_list_im_stock_log', // Singular label
            'plural' => 'wp_list_im_stocks_logs', // plural label, also this well be one of the table css class
            'ajax' => false
        ));
    }

    /**
     * Add extra markup in the toolbars before or after the list
     *
     * @param string $which,
     *            helps you decide if you add the markup after (bottom) or before (top) the list
     */
    public function extra_tablenav($which)
    {}

    /**
     * Define the columns that are going to be used in the table
     *
     * @return array $columns, the array of columns to use with the table
     */
    public function get_columns()
    {
        return array(
            'cb' => '<input type="checkbox" />',
            'product' => __('Product', "woocommerce-inventorymanager"),
            'warehouse_name' => __('Warehouse name', "woocommerce-inventorymanager"),
            'stock' => __('Stock', "woocommerce-inventorymanager"),
            'timestamp' => __('Timestamp', "woocommerce-inventorymanager"),
            'description' => __('Description', "woocommerce-inventorymanager")
        );
    }

    public function column_cb($item)
    {
        return sprintf('<th scope="row" class="check-column"><input type="checkbox" name="%1$s[]" value="%2$s" /></th>',
    /*$1%s*/ $this->_args['singular'], // Let's simply repurpose the table's singular label ("video")
        /* $2%s */
        $item->id); // The value of the checkbox should be the record's id
    }

    /**
     * Returns the list of available bulk actions.
     */
    public function get_bulk_actions()
    {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

    /**
     * How the bulk actions are processed for this table.
     */
    public function process_bulk_action()
    {
        if ('delete' === $this->current_action()) {
            foreach ($_GET[$this->_args['singular']] as $item) {
                $this->delete_this_log($item);
            }
        }
    }

    /**
     * Checks between action and action2.
     */
    public function current_action()
    {
        if (isset($_REQUEST['action']) && - 1 != $_REQUEST['action'])
            return $_REQUEST['action'];
        
        if (isset($_REQUEST['action2']) && - 1 != $_REQUEST['action2'])
            return $_REQUEST['action2'];
        
        return false;
    }

    /**
     * Decide which columns to activate the sorting functionality on
     *
     * @return array $sortable, the array of columns that can be sorted by the user
     *        
     */
    public function get_sortable_columns()
    {
        return array(
            'product' => array(
                'product_id',
                true
            ),
            'timestamp' => array(
                'timestamp',
                false
            )
        );
    }

    /**
     * Prepare the table with different parameters, pagination, columns and table elements
     */
    public function prepare_items()
    {
        global $wpdb;
        $screen = get_current_screen();
        
        /* -- Check if there are bulk actions -- */
        $this->process_bulk_action();
        
        /* -- Preparing your query -- */
        $query = "SELECT * FROM $this->table_name";
        
        /* -- Ordering parameters -- */
        // Parameters that are going to be used to order the result
        $orderby = ! empty($_GET["orderby"]) ? mysql_real_escape_string($_GET["orderby"]) : 'timestamp';
        $order = ! empty($_GET["order"]) ? mysql_real_escape_string($_GET["order"]) : 'DESC';
        if (! empty($orderby) & ! empty($order)) {
            $query .= ' ORDER BY ' . $orderby . ' ' . $order;
        }
        
        /* -- Pagination parameters -- */
        // Number of elements in your table?
        $totalitems = $wpdb->query($query); // return the total number of affected rows
                                            // How many to display per page?
        $perpage = 25;
        // Which page is this?
        $paged = ! empty($_GET["paged"]) ? mysql_real_escape_string($_GET["paged"]) : '';
        // Page Number
        if (empty($paged) || ! is_numeric($paged) || $paged <= 0) {
            $paged = 1;
        }
        // How many pages do we have in total?
        $totalpages = ceil($totalitems / $perpage);
        // adjust the query to take pagination into account
        if (! empty($paged) && ! empty($perpage)) {
            $offset = ($paged - 1) * $perpage;
            $query .= ' LIMIT ' . (int) $offset . ',' . (int) $perpage;
        }
        
        /* -- Register the pagination -- */
        $this->set_pagination_args(array(
            "total_items" => $totalitems,
            "total_pages" => $totalpages,
            "per_page" => $perpage
        ));
        // The pagination links are automatically built according to those parameters
        
        /* -- Register the Columns -- */
        $columns = $this->get_columns();
        $_wp_column_headers[$screen->id] = $columns;
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array(
            $columns,
            $hidden,
            $sortable
        );
        
        /* -- Fetch the items -- */
        $this->items = $wpdb->get_results($query);
    }

    /**
     * Display the rows of records in the table
     *
     * @return string, echo the markup of the rows
     *        
     */
    public function display_rows()
    {
        
        // Get the records registered in the prepare_items method
        $records = $this->items;
        
        // Get the columns registered in the get_columns and get_sortable_columns methods
        list ($columns, $hidden) = $this->get_column_info();
        
        // Loop for each record
        if (! empty($records)) {
            foreach ($records as $rec) {
                // Open the line
                echo '<tr id="record_' . $rec->id . '">';
                
                foreach ($columns as $column_name => $column_display_name) {
                    
                    // Style attributes for each col
                    $class = "class='$column_name column-$column_name'";
                    $style = "";
                    if (in_array($column_name, $hidden))
                        $style = ' style="display:none;"';
                    $attributes = $class . $style;
                    
                    // edit link
                    $editlink = '/wp-admin/link.php?action=edit&link_id=' . (int) $rec->id;
                    
                    $product_factory = new \WC_Product_Factory();
                    $warehouse_repository = new IM_Warehouse_Repository();
                    $product = $product_factory->get_product($rec->product_id);
                    $warehouse_results = $warehouse_repository->get_by(array(
                        "id" => $rec->warehouse_id
                    ));
                    $warehouse = $warehouse_results[0];
                    
                    // Display the cell
                    switch ($column_name) {
                        case "id":
                            echo '<td ' . $attributes . '>' . stripslashes($rec->id) . '</td>';
                            break;
                        case "product":
                            echo '<td ' . $attributes . '><a href="' . get_edit_post_link($rec->product_id) . '">' . $product->get_formatted_name() . '</a></td>';
                            break;
                        case "warehouse_name":
                            echo '<td ' . $attributes . '>' . stripslashes($warehouse->name) . '</td>';
                            break;
                        case "stock":
                            echo '<td ' . $attributes . '>' . stripslashes($rec->stock) . '</td>';
                            break;
                        case "timestamp":
                            echo '<td ' . $attributes . '>' . stripslashes($rec->timestamp) . '</td>';
                            break;
                        case "description":
                            echo '<td ' . $attributes . '>' . stripslashes($rec->reason) . '</td>';
                            break;
                        case "cb":
                            echo $this->column_cb($rec);
                            break;
                    }
                }
                
                // Close the line
                echo '</tr>';
            }
        }
    }

    public function delete_this_log($log_id)
    {
        global $wpdb;
        /* -- Preparing the delete query to avoid SQL injection -- */
        $query = $wpdb->prepare("DELETE FROM $this->table_name WHERE id = %d", $log_id);
        
        $wpdb->query($query); // return the total number of affected rows
    }
}
