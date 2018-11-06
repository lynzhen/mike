<?php
require_once __DIR__ . '/AdminController.php';

use \LeanCloud\LeanObject;
use \LeanCloud\Query;
use \LeanCloud\File;

class Warehouse extends AdminController {
	function __construct() {
		parent::__construct();
		$this->load->model('Category_model', 'category_model');
	}
// 仓库管理
	// 实时库存
	public function realtime(){
		$data['title'] = "实时库存";
		$this->layout->view('warehouse/realtime',$data);
	} 

	// 出库管理
	public function shipping(){
		$data['title'] = "出库管理";
		$this->layout->view('warehouse/shipping',$data);
	}


}
