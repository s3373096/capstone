<?php
namespace Hellodev\InventoryManager;

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

class IM_Stock_Log_Controller {
  private $viewRender;

  public function __construct() {
    $this->renderView();
  }

  public function renderView($values = null) {
    $values = array();
    $this->viewRender = IM_View_Render::get_instance();
    $this->viewRender->render("stock-log", $values);
  }
}
