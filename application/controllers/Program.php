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
		$query = new Query("Banner");
		$query->descend("paixu");
		$result = $query->find();
		
		$data['result'] = $result;
		$data['title'] = '轮播图';
		$this->layout->view('program/banner', $data);
	}

	public function banner() {
		
		$query = new Query("Banner");
		$query->descend("paixu");
		$result = $query->find();
		
		$data['result'] = $result;
		$data['title'] = '轮播图';
		$this->layout->view('program/banner', $data);
	}	
	
	// 添加banner图
	public function add() {
		
		$this->layout->view('program/add');
	}

	// 编辑banner图
	public function edit() {
		// objectId值
		$objectId = $this->input->get('objectId');
	
		// 查找分类对象
		$query = new Query('Banner');
		$banner = $query->get($objectId);

		$data["banner"] = $banner;
		$data['title'] = '轮播图';
		$this->layout->view('program/edit', $data);
	}
	
	public function save() {
		  
		// 获取参数
		$objectId = $this->input->post('objectId'); 
		$title = $this->input->post('title');
		$paixu = $this->input->post('paixu');
		$avatar = $this->input->post('avatar');

		// save to leanCloud
		$object = new LeanObject("Banner");
		// 默认是新建一个Category对象，如果存在$editingId，则读取
		if (isset($objectId)) {
			$object = LeanObject::create('Banner', $objectId);
		}
		$object->set("title", $title);
		$object->set("paixu",(int) $paixu);
		$object->set("avatar", $avatar);
		// 将category转为LeanCloud对象

		try {
			$object->save();
			$this->echo_json('发布成功');
		} catch (Exception $ex) {
			$this->echo_json('操作失败');
		}
	}

	// 删除banner图
	public function delete() {
		$objectId = $this->input->get('objectId');
		$banner = LeanObject::create('Banner', $objectId);
		$banner->destroy();
		$data['msg'] = '删除成功';
		$data['level'] = 'info';
		$data['redirect'] = 'banner';
		$this->layout->view('program/msg', $data);
	}


	
}
