<?php
require_once __DIR__ . '/AdminController.php';

use \LeanCloud\LeanObject;
use \LeanCloud\Query;
use \LeanCloud\File;

class Report extends AdminController {
	function __construct() {
		parent::__construct();
		$this->load->model('Category_model', 'category_model');
	}
// 报表管理
	// 权限管理
	public function goods(){
		$data['title'] = "商品报表";
		$this->layout->view('report/goods',$data);
	} 

	// 部门管理
	public function order(){
		$data['title'] = "订单报表";
		$this->layout->view('report/order',$data);
	}

	// 员工管理
	public function stock(){
		$data['title'] = "库存报表";
		$this->layout->view('report/stock',$data);
	}

}
