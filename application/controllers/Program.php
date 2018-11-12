<?php
require_once __DIR__ . '/AdminController.php';

use \LeanCloud\LeanObject;
use \LeanCloud\Query;
use \LeanCloud\File;

class Program extends AdminController {
	function __construct() {
		parent::__construct();
		$this->load->model('Category_model', 'category_model');
	}
	public function index(){

	}

	public function banner() {
		
		$query = new Query("Banner");
		$query->descend("paixu");
		$result = $query->find();
		
		$data['result'] = $result;
		$data['title'] = '轮播图';
		$this->layout->view('program/banner', $data);
	}

	
	public function save() {
		  
		// 获取参数
		$images = $this->input->post('images');

		// save to leanCloud
		$object = new LeanObject("Mike_Goods");
		$objectId = $this->input->post('objectId'); 
		if (isset($objectId)) {
			// 编辑产品
			$object = LeanObject::create('Mike_Goods', $objectId);
			$data['redirect'] = 'index';
			$data['msg'] = '修改成功';
		}
		$object->set("KCSL", $kcsl);
		$object->set("JHJ", $jhj);
		$object->set("avatar", $avatar);
		// 将category转为LeanCloud对象
		$object->set("images", json_decode($images));
		$object->set("detail", json_decode($detail));

		$data['redirect'] = 'add';
		try {
			$object->save();
			$this->echo_json('发布成功');
		} catch (Exception $ex) {
			$this->echo_json('操作失败');
		}
	}

	// 删除商品
	// public function delete() {
	// 	$objectId = $this->input->get('objectId');
	// 	$goods = LeanObject::create('Mike_Goods', $objectId);
	// 	$goods->destroy();
	// 	$data['msg'] = '删除成功';
	// 	$data['level'] = 'info';
	// 	$data['redirect'] = 'index';
	// 	$this->layout->view('goods/msg', $data);
	// }


	
}
