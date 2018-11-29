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

		echo $parentId."---".$objectId."----".$mc."-----".$onlyid."--------".$flno;
		die();

		// save to leanCloud
		$object = new LeanObject("Mike_GoodsType");
		// 默认是新建一个Category对象，如果存在$editingId，则读取
		if (isset($objectId)) {
			$query = new Query('Mike_GoodsType');
			$category = $query->get($objectId);
		}

		// $category = null;
		// if ($objectId != "") {
			// 创建的非顶级分类
			// $category = Object::create('Category', $objectId);
		// }

		// 分类图片上传
		if (!empty($_FILES['avatar']['tmp_name'])) {
			$avatar = File::createWithLocalFile($_FILES['avatar']['tmp_name'], $_FILES['avatar']['type']);
			// 保存图片
			$avatar->save();
		}
		// banner图片上传
		if (!empty($_FILES['banner']['tmp_name'])) {
			$banner = File::createWithLocalFile($_FILES['banner']['tmp_name'], $_FILES['banner']['type']);
			// 保存图片
			$banner->save();
		}

		$querys = new Query('Mike_GoodsType');
		$parent = $querys->equalTo('id',$parentId);
		$parentname = $parent->get('mc');

		// 标题
		$object->set("mc", $mc);
		$object->set("fid", (int)$parentId);
		$object->set("onlyid", $onlyid);
		$object->set("flno", $flno);
		$object->set("fathermc", $parentname);
		// 图片
		if (isset($avatar)) {
			$object->set("avatar", $avatar);
		}
		if (isset($banner)) {
			$object->set("banner", $banner);
		}
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
