<?php
require_once __DIR__ . '/AdminController.php';

use \LeanCloud\LeanObject;
use \LeanCloud\Query;
use \LeanCloud\File;

class Power extends AdminController {
	function __construct() {
		parent::__construct();
		$this->load->model('Category_model', 'category_model');
	}
// 权限管理
	// 权限管理
	public function index(){
		$data['title'] = "权限管理";
		$this->layout->view('power/index',$data);
	} 

	// 部门管理
	public function apart(){
		$data['title'] = "部门管理";
		$this->layout->view('power/apart',$data);
	}

	// 员工管理
	public function staff(){
		$data['title'] = "员工管理";
		$this->layout->view('power/staff',$data);
	}

}
