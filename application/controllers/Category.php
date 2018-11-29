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
		// 正在编辑的category对象的objectId值
		$objectId = $this->input->get('objectId');
	
		// 编辑状态，读取原来分类信息
		$query = new Query('Mike_GoodsType');
		$category = $query->get($objectId);
		$data['categorys'] = $category;

		// 判断是否已经是顶级分类了
		// $data['objectId'] = $objectId;
		if ($category->get('fid') != 0) {
			$parentId = $category->get('fid');
			$query->equalTo('id',$parentId);
			$parent = $query->find();
			$data['parent'] = $parent;
		} 
		// 全部分类
		$data['categories'] = $this->category_model->findAll();
		$this->layout->view('category/edit', $data);
	}
	
	// 保存分类
	public function save() {
		// 父类id
		$parent = $this->input->post('category');
		// $category = null;
		// if ($objectId != "") {
			// 创建的非顶级分类
			// $category = Object::create('Category', $objectId);
		// }
		// 序号
		$index = $this->input->post('index');
		// 分类图片上传
		if (!empty($_FILES['avatar']['tmp_name'])) {
			$avatar = File::createWithLocalFile($_FILES['avatar']['tmp_name'], $_FILES['avatar']['type']);
			// 保存图片
			$avatar->save();
			// 分类图
		}
		// banner图片上传
		if (!empty($_FILES['banner']['tmp_name'])) {
			$banner = File::createWithLocalFile($_FILES['banner']['tmp_name'], $_FILES['banner']['type']);
			// 保存图片
			$banner->save();
			// banner图
		}
		// save to leanCloud
		$object = new LeanObject("Mike_GoodsType");
		$objectId = $this->input->post('objectId');
		// 默认是新建一个Category对象，如果存在$editingId，则读取
		if (isset($objectId)) {
			$query = new Query('Mike_GoodsType');
			$category = $query->get($objectId);
		}
		// 获取参数
		$mc = $this->input->post('mc');
		// 标题
		$object->set("mc", $mc);
		// 将category转为LeanCloud对象
		$object->set("parent", $category);
		// 序号
		// $object->set("index", (int)$index);
		// 图片
		if (isset($avatar)) {
			$object->set("avatar", $avatar);
		}
		if (isset($banner)) {
			$object->set("banner", $banner);
		}
		// 提示信息 
		$data['redirect'] = 'add';
		var_dump();
		try {
			$object->save();
			// $this->echo_json('保存成功');
			$data['msg'] = '保存成功';
			$data['level'] = 'info';
			// $this->layout->view('category/msg', $data);
		} catch (Exception $ex) {
			// $this->echo_json('保存失败');
			$data['msg'] = '操作失败';
			$data['level'] = 'warning';
			// var_dump($ex);
		} 
		// finally {
		// 	$this->layout->view('category/msg', $data);
		// }
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
