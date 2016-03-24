<?php
namespace Hellodev\InventoryManager;

if (! defined('ABSPATH')) {
    exit();
}

class IM_Warehouse_Controller
{

    private $viewRender;

    public function __construct()
    {
        $this->handleRequest();
    }

    public function handleRequest()
    {
        $values = array();
        // handle post and validate data
        if (isset($_REQUEST['IM_Warehouse_id']) && ! empty($_REQUEST['IM_Warehouse_id'])) {
            $values["success"] = __("Saved with success.", "woocommerce-inventorymanager");
            $id = $_REQUEST['IM_Warehouse_id'];
            $values['IM_Warehouse_id'] = $id;
            $repository_warehouse = new IM_Warehouse_Repository();
            $rows = $repository_warehouse->get_by(array(
                "id" => $id
            ));
            $row = $rows[0];
            $values["IM_Warehouse_name"] = $row->name;
            $values["IM_Warehouse_address"] = $row->address;
            $values["IM_Warehouse_city"] = $row->city;
            $values["IM_Warehouse_postcode"] = $row->postcode;
            $values["IM_Warehouse_country"] = $row->country;
            $values["IM_Warehouse_vat"] = $row->vat;
            $values["IM_Warehouse_slug"] = $row->slug;
            $values['IM_Warehouse_priority'] = $row->priority;
        }
        if (isset($_POST['IM_Warehouse_name']) && ! empty($_POST['IM_Warehouse_name'])) {
            $values['IM_Warehouse_name'] = $_POST['IM_Warehouse_name'];
        }
        if (isset($_POST['IM_Warehouse_address']) && ! empty($_POST['IM_Warehouse_address'])) {
            $values['IM_Warehouse_address'] = $_POST['IM_Warehouse_address'];
        }
        if (isset($_POST['IM_Warehouse_city']) && ! empty($_POST['IM_Warehouse_city'])) {
            $values['IM_Warehouse_city'] = $_POST['IM_Warehouse_city'];
        }
        if (isset($_POST['IM_Warehouse_postcode']) && ! empty($_POST['IM_Warehouse_postcode'])) {
            $values['IM_Warehouse_postcode'] = $_POST['IM_Warehouse_postcode'];
        }
        if (isset($_POST['IM_Warehouse_country']) && ! empty($_POST['IM_Warehouse_country'])) {
            $values['IM_Warehouse_country'] = $_POST['IM_Warehouse_country'];
        }
        if (isset($_POST['IM_Warehouse_vat']) && ! empty($_POST['IM_Warehouse_vat'])) {
            $values['IM_Warehouse_vat'] = $_POST['IM_Warehouse_vat'];
        }
        if (isset($_POST['IM_Warehouse_slug']) && ! empty($_POST['IM_Warehouse_slug'])) {
            $values['IM_Warehouse_slug'] = $_POST['IM_Warehouse_slug'];
        }
        if (isset($_POST['IM_Warehouse_priority']) && ! empty($_POST['IM_Warehouse_priority'])) {
            $values['IM_Warehouse_priority'] = $_POST['IM_Warehouse_priority'];
        }
        
        $warehouse = new IM_Warehouse($values);
        if (isset($_POST["submit"])) {
            $warehouse->save();
        }
        $values = (array) $warehouse;
        
        $warehouse_repository = new IM_Warehouse_Repository();
        $all = $warehouse_repository->get_all();
        
        $repository = new IM_Product_Warehouse_Repository();
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => - 1
        );
        
        $loop = new \WP_Query($args);
        if ($loop->have_posts()) {
            while ($loop->have_posts()) {
                $loop->the_post();
                $product = get_product();
                if ($product->managing_stock()) {
                    if (count($all) == 1) {
                        $repository->refresh_relations($product->id, 1);
                    } else {
                        $repository->refresh_relations($product->id);
                    }
                }
            }
        }
        wp_reset_postdata();
        
        if (isset($_POST["submit"]) && isset($values["IM_Warehouse_id"])) {
            ?>
<script type="text/javascript">
        window.location.href = "<?php echo menu_page_url("hellodev-inventory-manager-add-warehouse", 0).'&IM_Warehouse_id='.(int)$values["IM_Warehouse_id"]; ?>&saved=true";
        </script>
<?php
        }
        $this->renderView($values);
    }

    public function renderView($values = null)
    {
        $this->viewRender = IM_View_Render::get_instance();
        $this->viewRender->render("add-warehouse", $values);
    }
}
