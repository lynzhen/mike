<?php
require_once __DIR__ . '/AdminController.php';

use \LeanCloud\LeanObject;
use \LeanCloud\Query;
use \LeanCloud\File;

class Goods extends AdminController {
	function __construct() {
		parent::__construct();
		$this->load->model('Category_model', 'category_model');
	}

	public function import() {
		// 获取顶级分类
		// $data['categories'] = $this->category_model->findAll();
		$data['title'] = '导入商品';
		$this->layout->view('goods/import', $data);
	}

	public function add() {
		// 获取顶级分类
		$data['categories'] = $this->category_model->findAll();
		$data['title'] = '添加商品';
		$this->layout->view('goods/add', $data);
	}

	public function edit() {
		// 获取顶级分类
		$data['categories'] = $this->category_model->findAll();
		$objectId = $this->input->get('objectId');
		$query = new Query('Goods');
		$goods = $query->get($objectId);
		$data['goods'] = $goods;
		$this->layout->view('goods/edit', $data);
	}
	
	public function save() {
		// 获取参数
		$title = $this->input->post('title');
		$category = $this->input->post('category');
		$singleCode = $this->input->post('singleCode');
		$suppliers = $this->input->post('suppliers');
		$price = $this->input->post('price');
		$boxnumber = $this->input->post('boxnumber');
		$FCL = $this->input->post('FCL');
		$size = $this->input->post('size');
		$boxprice = $this->input->post('boxprice');
		$singleTP = $this->input->post('singleTP');
		$singleSize = $this->input->post('singleSize');
		$barcode = $this->input->post('barcode');
		$isHot = $this->input->post('isHot');
		$isNew = $this->input->post('isNew');
		$images = $this->input->post('images');
		$detail = $this->input->post('detail');
		// 主图是第一个产品图
		$avatar = sizeof(json_decode($images)) > 0 ? json_decode($images)[0] : null;
		// var_dump($avatar);
		// die();
		// save to leanCloud
		$object = new LeanObject("Goods");
		$objectId = $this->input->post('objectId'); 
		if (isset($objectId)) {
			// 编辑产品
			$object = LeanObject::create('Goods', $objectId);
			$data['redirect'] = 'index';
			$data['msg'] = '修改成功';
		}
		$object->set("title", $title);
		$object->set("singleCode", $singleCode);
		$object->set("suppliers", $suppliers);
		$object->set("price", $price);
		$object->set("boxnumber", $boxnumber);
		$object->set("FCL", (bool)$FCL);
		$object->set("size", $size);
		$object->set("boxprice", $boxprice);
		$object->set("singleSize", $singleSize);
		$object->set("singleTP", $singleTP);
		$object->set("barcode", $barcode);
		$object->set("avatar", $avatar);
		// 将category转为LeanCloud对象
		$object->set("category", LeanObject::create('Category', $category));
		$object->set("isHot", (bool)$isHot);
		$object->set("isNew", (bool)$isNew);
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

	// 商品列表-adminlte
	public function index() {
		// 获取get参数
		$pageIndex = $this->input->get('per_page');
		// 分页查询数据
		$query = new Query("Goods");
		$query->_include("category");
		$query->descend("updatedAt");
		$query->limit($this->config->item('per_page'));
		$query->skip($this->config->item('per_page') * ($pageIndex - 1));
		$result = $query->find();
		// 分页控件
		// url路径前缀
		$config['base_url'] = base_url(uri_string());
		// 总条数
		$config['total_rows'] = (new Query("Goods"))->count();
		// 初始化
		$this->pagination->initialize($config); 
		$data['pagination'] = $this->pagination->create_links();
		// 渲染
		$data['result'] = $result;
		$data['title'] = '商品列表';
		$this->layout->view('goods/index', $data);
	}

	// 商品热销-adminlte
	public function hot() {
		// 获取get参数
		$pageIndex = $this->input->get('per_page');
		// 分页查询数据
		$query = new Query("Goods");
		$query->_include("category");
		$query->descend("updatedAt");
		$query->limit($this->config->item('per_page'));
		$query->skip($this->config->item('per_page') * ($pageIndex - 1));
		$result = $query->find();
		// 分页控件
		// url路径前缀
		$config['base_url'] = base_url(uri_string());
		// 总条数
		$config['total_rows'] = (new Query("Goods"))->count();
		// 初始化
		$this->pagination->initialize($config); 
		$data['pagination'] = $this->pagination->create_links();
		// 渲染
		$data['result'] = $result;
		$data['title'] = '商品热销';
		$this->layout->view('goods/hot', $data);
	}

	// 删除商品
	public function delete() {
		$objectId = $this->input->get('objectId');
		$goods = LeanObject::create('Goods', $objectId);
		$goods->destroy();
		$data['msg'] = '删除成功';
		$data['level'] = 'info';
		$data['redirect'] = 'index';
		$this->layout->view('goods/msg', $data);
	}


	
}
