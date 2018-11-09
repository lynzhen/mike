<?php
require_once __DIR__ . '/AdminController.php';

use \LeanCloud\LeanObject;
use \LeanCloud\Query;
use \LeanCloud\File;

class Shop extends AdminController {
	function __construct() {
		parent::__construct();
		$this->load->model('Category_model', 'category_model');
	}

	// 商家入驻
	public function join(){
		
		// 获取get参数
		$pageIndex = $this->input->get('per_page');
		// 分页查询数据
		$query = new Query("Shop");
		$query->equalTo('isBlack',false);
		$query->_include("category");
		$query->descend("updatedAt");
		$query->limit($this->config->item('per_page'));
		$query->skip($this->config->item('per_page') * ($pageIndex - 1));
		$result = $query->find();
		// var_dump($result);
		// 分页控件
		// url路径前缀
		$config['base_url'] = base_url(uri_string());
		// 总条数
		$config['total_rows'] = (new Query("Shop"))->count();
		// 初始化
		$this->pagination->initialize($config); 
		$data['pagination'] = $this->pagination->create_links();
		// 渲染
		$data['result'] = $result;
		$data['title'] = "商家入驻";
		$this->layout->view('shop/join',$data);
	} 

	// 商家黑名单
	public function blacklist(){		
		// 获取get参数
		$pageIndex = $this->input->get('per_page');
		// 分页查询数据
		$query = new Query("Blacklist");
		$query->_include("category");
		$query->descend("updatedAt");
		$query->limit($this->config->item('per_page'));
		$query->skip($this->config->item('per_page') * ($pageIndex - 1));
		$result = $query->find();
		// 分页控件
		// url路径前缀
		$config['base_url'] = base_url(uri_string());
		// 总条数
		$config['total_rows'] = (new Query("Shop"))->count();
		// 初始化
		$this->pagination->initialize($config); 
		$data['pagination'] = $this->pagination->create_links();
		// 渲染
		$data['result'] = $result;
		$data['title'] = "商家黑名单";
		$this->layout->view('shop/blacklist',$data);
	}

	// 通过商家入驻申请
	public function pass(){
		
		// 获取post参数
		$objectId = $this->input->post('objectId');
		// var_dump($objectId);
		// 查询商家数据
		$query = new Query("Shop");
		$shop = $query->get($objectId);
		// 改变通过标志
		$shop->set("isPass", true);

		try {
			$shop->save();
			$this->echo_json('通过成功');
		} catch (Exception $ex) {
			$this->echo_json('通过失败');
		}

	} 

	// 拒绝商家入驻申请
	public function refuse(){
		
		// 获取post参数
		$objectId = $this->input->post('objectId');
		// 查询商家数据
		$query = new Query("Shop");
		$shop = $query->get($objectId);
		// 改变通过标志
		$shop->set("isRefuse", true);
		try {
			$shop->save();
			$this->echo_json('拒绝成功');
		} catch (Exception $ex) {
			$this->echo_json('拒绝失败');
		}

	} 

	// 拉黑
	public function black(){
		
		// 获取post参数
		$objectId = $this->input->post('objectId');
		// 查询商家数据
		$query = new Query("Shop");
		$shop = $query->get($objectId);
		// 改变拉黑标志
		$shop->set("isBlack", true);
		try {
			$shop->save();
			$this->echo_json('拉黑成功');
		} catch (Exception $ex) {
			$this->echo_json('拉黑失败');
		}

	} 

	// 收货地址审核
	public function address(){
		
		// 获取get参数
		$pageIndex = $this->input->get('per_page');
		// 分页查询数据
		$query = new Query("Address");
		$query->_include("user");
		$result = $query->find();
		// $query->_include("shop");
		$query->descend("updatedAt");
		$query->limit($this->config->item('per_page'));
		$query->skip($this->config->item('per_page') * ($pageIndex - 1));
		$result = $query->find();

		$userArr = [];
		foreach ($result as $item) {
			$val = $item->get('user');
			echo '每个user';
			var_dump($val);
			array_push($userArr,$val);
		}
		echo 'user数组';
		var_dump($userArr);
		$shopArr = [];
		foreach ( $userArr as $user) {
			$queryshop = new Query('Shop');
			$userid = $user->get('objectId');
			$shopname = $queryshop->_include('user');
			array_push($shopArr,$shopname);
		}
		echo 'Shop数组';
		var_dump($shopArr);


		// $querys = new Query("Address");
		// $results = $querys->find();

		// var_dump($result);die();
		// 分页控件
		// url路径前缀
		$config['base_url'] = base_url(uri_string());
		// 总条数
		$config['total_rows'] = (new Query("Address"))->count();
		// 初始化
		$this->pagination->initialize($config); 
		$data['pagination'] = $this->pagination->create_links();
		// 渲染
		$data['result'] = $result;
		$data['title'] = "商家地址审核";
		$this->layout->view('shop/address',$data);

	}

}
