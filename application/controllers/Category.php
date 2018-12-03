<?php
require_once __DIR__ . '/AdminController.php';

use \LeanCloud\LeanObject;
use \LeanCloud\Query;
use \LeanCloud\File;

class Category extends AdminController {
	function __construct() {
		parent::__construct();
		$this->load->model('Category_model', 'category_model');
	}

	// 分类列表
	public function index() {
		$categories = $this->category_model->findAll();
		$data['categories'] = $categories;

		$this->layout->view('category/index', $data);
	}

	// 添加分类
	public function add() {
		// 父类category对象的objectId
		$objectId = $this->input->get('objectId');
		$data['objectId'] = $objectId;
		// 全部分类
		$data['categories'] = $this->category_model->findAll();
		$this->layout->view('category/add', $data);
	}

	// 编辑分类
	public function edit() {
		// objectId值
		$objectId = $this->input->get('objectId');
	
		// 查找分类对象
		$query = new Query('Mike_GoodsType');
		$category = $query->get($objectId);

		// 判断是否已经是顶级分类了
		$parentId = $category->get('fid');
		if ($parentId != 0) {
			$querys = new Query('Mike_GoodsType');
			$querys->equalTo('id',$parentId);
			$parent = $querys->find();
			$data['parent'] = $parent;
		} 
		// 全部分类
		$data['categories'] = $this->category_model->findAll();
		$data['categorys'] = $category;
		$this->layout->view('category/edit', $data);
	}
	
	// 保存分类
	public function save() {
		// 父类id
		$objectId = $this->input->post('objectId');
		$mc = $this->input->post('mc');
		$parentId = $this->input->post('parentId');
		$onlyid = $this->input->post('onlyid');
		$flno = $this->input->post('flno');

		$avatar = $this->input->post('avatar');
		$banner = $this->input->post('banner');

		$object = new LeanObject("Mike_GoodsType");
		// 默认是新建一个Category对象，如果存在$editingId，则读取
		if (isset($objectId)) {
			$object = LeanObject::create('Mike_GoodsType', $objectId);
		}

		$querys = new Query('Mike_GoodsType');
		$querys->get($parentId);
		$parent = $querys->find();
		// var_dump($parent[0]);die();
		$parentname = $parent[0]->get('mc');
		$pid = $parent[0]->get('id');
		// var_dump($parentname);die();


		// 标题
		$object->set("mc", $mc);
		$object->set("fid", (int)$pid);
		$object->set("onlyid", $onlyid);
		$object->set("flno", $flno);
		$object->set("fathermc", $parentname);

		$object->set("avatar", $avatar);
		$object->set("banner", $banner);
		
		// 提示信息 
		$data['redirect'] = 'add';
		try {
			$object->save();
			$this->echo_json('发布成功');
		} catch (Exception $ex) {
			$this->echo_json('操作失败');
		}
	}

	// 删除分类
	public function delete() {
		$objectId = $this->input->get('objectId');
		$this->category_model->delete($objectId);
		$data['msg'] = '删除成功';
		$data['level'] = 'info';
		$data['redirect'] = 'index';
		$this->layout->view('category/msg', $data);
	}


}
