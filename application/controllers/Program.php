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

	public function banner() {
		
		$query = new Query("Banner");
		$query->descend("paixu");
		$result = $query->find();

		$arrUrl = [];
		foreach ($result as $value) {
			var_dump($value);
			// $url = $value->get('image')->get('url');
			// var_dump($url);
			// array_push($arrUrl,$url);
		}
		$result['url'] = $arrUrl;
		var_dump($result);
		
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

	// 商品列表-adminlte
	public function index() {
		// 获取get参数
		$pageIndex = $this->input->get('per_page');
		// 分页查询数据
		$query = new Query("Mike_Goods");
		// $query->_include("category");
		$query->descend("updatedAt");
		$query->limit($this->config->item('per_page'));
		$query->skip($this->config->item('per_page') * ($pageIndex - 1));
		$result = $query->find();
		// 分页控件
		// url路径前缀
		$config['base_url'] = base_url(uri_string());
		// 总条数
		$config['total_rows'] = (new Query("Mike_Goods"))->count();
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
		$query = new Query("Mike_HotSale");
		// $query->_include("category");
		$query->descend("updatedAt");
		$query->limit($this->config->item('per_page'));
		$query->skip($this->config->item('per_page') * ($pageIndex - 1));
		$result = $query->find();
		// 分页控件
		// url路径前缀
		$config['base_url'] = base_url(uri_string());
		// 总条数
		$config['total_rows'] = (new Query("Mike_HotSale"))->count();
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
		$goods = LeanObject::create('Mike_Goods', $objectId);
		$goods->destroy();
		$data['msg'] = '删除成功';
		$data['level'] = 'info';
		$data['redirect'] = 'index';
		$this->layout->view('goods/msg', $data);
	}


	
}
