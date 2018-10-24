<?php
require_once __DIR__ . '/AdminController.php';

use \LeanCloud\Object;
use \LeanCloud\Query;
use \LeanCloud\File;

class Goods extends AdminController {
	function __construct() {
		parent::__construct();
		$this->load->model('Category_model', 'category_model');
	}

	// 商家入驻
	public function join(){
		$data['title'] = "商家入驻";
		$this->layout->view('shop/join',$data);
	} 

	// 商家黑名单
	public function blacklist(){
		$data['title'] = "商家黑名单";
		$this->layout->view('shop/blacklist',$data);
	}

}
