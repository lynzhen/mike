<?php
require_once __DIR__ . '/AdminController.php';

use \LeanCloud\Object;
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
		$data['editingId'] = $objectId;
		// 编辑状态，读取原来分类信息
		$query = new Query('Category');
		$editingCategory = $query->get($objectId);
		// 判断是否已经是顶级分类了
		$data['objectId'] = '';
		if ($editingCategory->get('parent') != null) {
			$data['objectId'] = $editingCategory->get('parent')->get('objectId');
		} 
		// 全部分类
		$data['categories'] = $this->category_model->findAll();
		$data['editingCategory'] = $editingCategory;
		$this->layout->view('category/edit', $data);
	}
	
	// 保存分类
	public function save() {
		// 父类id
		$objectId = $this->input->post('category');
		$category = null;
		if ($objectId != "") {
			// 创建的非顶级分类
			$category = Object::create('Category', $objectId);
		}
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
		$object = new Object("Category");
		$editingId = $this->input->post('editingId');
		// 默认是新建一个Category对象，如果存在$editingId，则读取
		if (isset($editingId)) {
			$query = new Query('Category');
			$object = $query->get($editingId);
		}
		// 获取参数
		$title = $this->input->post('title');
		// 标题
		$object->set("title", $title);
		// 将category转为LeanCloud对象
		$object->set("parent", $category);
		// 序号
		$object->set("index", (int)$index);
		// 图片
		if (isset($avatar)) {
			$object->set("avatar", $avatar);
		}
		if (isset($banner)) {
			$object->set("banner", $banner);
		}
		// 提示信息 
		$data['redirect'] = 'index';
		try {
			$object->save();
			$data['msg'] = '保存成功';
			$data['level'] = 'info';
			$this->layout->view('category/msg', $data);
		} catch (Exception $ex) {
			$data['msg'] = '操作失败';
			$data['level'] = 'warning';
			var_dump($ex);
		} finally {
			$this->layout->view('category/msg', $data);
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
	// 商品分类-adminlte
	// public function index() {
	// 	//查询顶级分类
	// 	$data['categories'] = $this->category_model->findAll();
	
	// 	// 获取get参数
	// 	$pageIndex = $this->input->get('per_page');
	// 	// 分页查询数据
	// 	$query = new Query("Category");
	// 	$query->descend("updatedAt");
	// 	$query->limit($this->config->item('per_page'));
	// 	$query->skip($this->config->item('per_page') * ($pageIndex - 1));
	// 	// 查询一级分类
	// 	$result = $query->find();
		
	// 	// 分页控件
	// 	// url路径前缀
	// 	$config['base_url'] = base_url(uri_string());
	// 	// 总条数
	// 	$config['total_rows'] = (new Query("Category"))->count();
	// 	// 初始化
	// 	$this->pagination->initialize($config); 
	// 	$data['pagination'] = $this->pagination->create_links();
	// 	// 渲染
	// 	// $data['result'] = $result;
	// 	$data['title'] = '商品分类';

	// 	$querys = new Query("Category");
	// 	foreach ($result as $value) {	
	// 		$pid = $value->get('pid');
	// 		// var_dump($pid);
			
	// 		if($pid == '0'){
	// 			$value->set('pname', '无');
	// 			// var_dump('无');
	// 		}else{
	// 			$querys->equalTo('objectId', $pid);
	// 			$parent = $querys->find();
	// 			forEach($parent as $item) {
	// 				$title = $item->get("title");
	// 			}
	// 			// var_dump($title);
	// 			$value->set('pname', $title);
	// 		}
	// 	}	
	// 	$data['result'] = $result;

	// 	var_dump($result);
	// 	// die();
	// 	$this->layout->view('goods/category', $data);
	// }

	// // 跳转添加商品一级分类-adminlte
	// public function addcate() {
	// 	// 获取顶级分类
	// 	$data['categories'] = $this->category_model->findAll();
	// 	$data['title'] = '添加商品';
	// 	$this->layout->view('goods/addcate', $data);
	// }

	// // 跳转添加商品二级分类-adminlte
	// public function addcates() {
	// 	// 获取顶级分类
	// 	$data['categories'] = $this->category_model->findAll();
	// 	$data['title'] = '添加商品';
	// 	$this->layout->view('goods/addcates', $data);
	// }
	// // 保存商品一级分类
	// public function savecate() {
	// 	// 获取参数 //zhixing 
	// 	$title = $this->input->post('title');
	// 	$category = $this->input->post('category');
	// 	$price = $this->input->post('price');
	// 	$isHot = $this->input->post('isHot');
	// 	$isNew = $this->input->post('isNew');
	// 	$images = $this->input->post('images');
	// 	$detail = $this->input->post('detail');
	// 	// echo $title;
	// 	// die();
	// 	// 主图是第一个产品图
	// 	$avatar = sizeof(json_decode($images)) > 0 ? json_decode($images)[0] : null;
	// 	$file = File::createWithUrl("111.png", $avatar);
	// 	// var_dump($avatar);
	// 	// die();
	// 	// save to leanCloud
	// 	$category = new Object("Category");
	// 	$objectId = $this->input->post('objectId'); 
	// 	if (isset($objectId)) {
	// 		// 编辑产品
	// 		$category = Object::create('Category', $objectId);
	// 		$data['redirect'] = 'index';
	// 		$data['msg'] = '修改成功';
	// 	}
	// 	$category->set("title", $title);
	// 	$category->set("banner", $file);
	// 	$category->set("pid", '0');
	// 	$category->set("parent", $category);

	// 	$data['redirect'] = 'add';
	// 	try {
	// 		$category->save();
	// 		$this->echo_json('发布成功');
	// 	} catch (Exception $ex) {
	// 		$this->echo_json('添加分类失败！'+$ex);
	// 	}
	// }
	// // 保存商品二级分类
	// public function savecates() {
	// 	// 获取参数
	// 	$title = $this->input->post('title');
	// 	$category = $this->input->post('category');
	// 	$images = $this->input->post('images');
	// 	$detail = $this->input->post('detail');
	// 	// echo $title;
	// 	// die();
	// 	// 主图是第一个产品图
	// 	$avatar = sizeof(json_decode($detail)) > 0 ? json_decode($detail)[0] : null;
	// 	$file = File::createWithUrl("111.png", $avatar);
	// 	// var_dump($avatar);
	// 	// die();
	// 	// save to leanCloud
	// 	$category = new Object("Category");
	// 	// 获取传过来的objectId
	// 	$objectId = $this->input->post('objectId'); 
	// 	// 如果没有传objectId 就自动生成
	// 	if (isset($objectId)) {
	// 		// 编辑产品
	// 		$category = Object::create('Category', $objectId);
	// 		$data['redirect'] = 'index';
	// 		$data['msg'] = '修改成功';
	// 	}
	// 	$category->set("title", $title);
	// 	$category->set("avatar", $file);
	// 	$category->set("pid", $category);
	// 	$category->set("parent", $category);

	// 	$data['redirect'] = 'add';
	// 	try {
	// 		$category->save();
	// 		$this->echo_json('发布成功');
	// 	} catch (Exception $ex) {
	// 		$this->echo_json('操作失败');
	// 	}
	// }

}
