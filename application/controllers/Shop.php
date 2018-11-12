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
		// $query->equalTo("isRefuse",false);
		$query->_include("user");
		$result = $query->find();
		// var_dump($result);
		// $query->_include("shop");
		$query->descend("updatedAt");
		$query->limit($this->config->item('per_page'));
		$query->skip($this->config->item('per_page') * ($pageIndex - 1));
		$result = $query->find();

		// 查询出地址表中的每一个user
		$userArr = [];
		foreach ($result as $item) {
			$val = $item->get('user');
			array_push($userArr,$val);
		}
		// 生成user数组
		// var_dump($userArr);

		// 查询shop表中的所有数据
		$queryshop = new Query('Shop');
		$queryshop->_include('user');
		$shopresult = $queryshop->find();
		// 查询结果数组
		// var_dump($shopresult);

		// 定义一个装shopname的空数组
		$shopArr = [];
		foreach ( $userArr as $user) {
			$userid = $user->get('objectId');
			foreach ($shopresult as $shopobj) {
				$getuser = $shopobj->get('user');
				if($getuser === NULL){

				}else{
					$shopuser = $getuser->get('objectId');
					if($userid == $shopuser){
						$shopname = $shopobj->get('shopname');
						array_push($shopArr,$shopname);
					}
				}
			}
		}
		// echo 'Shop数组';
		// var_dump($shopArr);

		for($i=0;$i<count($shopArr);$i++){
			$result[$i]->set('shopname',$shopArr[$i]);
			// var_dump($result[$i]->get('shopname'));
		}

		foreach ($result as  $value) {			
			$date = $value->get('updatedAt');
			$datetime = $date->format('Y-m-d H:i:s');
			for($i=0;$i<count($result);$i++){
				$result[$i]->set('updatetime',$datetime);
			}
		}
		// var_dump($result);
		
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
	public function addrPass(){
		// 获取post参数
		$objectId = $this->input->post('objectId');
		// 查询商家数据
		$query = new Query("Address");
		$addr = $query->get($objectId);
		// 改变拉黑标志
		$addr->set("isPass", true);
		try {
			$addr->save();
			$this->echo_json('审核通过成功');
		} catch (Exception $ex) {
			$this->echo_json('审核通过失败');
		}
	}
	public function addrRefuse(){
		// 获取post参数
		$objectId = $this->input->post('objectId');
		// 查询商家数据
		$query = new Query("Address");
		$addr = $query->get($objectId);
		// 改变拉黑标志
		$addr->set("isRefuse", true);
		try {
			$addr->save();
			$this->echo_json('驳回成功');
		} catch (Exception $ex) {
			$this->echo_json('驳回失败');
		}
	}

}
