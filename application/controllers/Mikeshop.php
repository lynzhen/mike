<?php
require_once __DIR__ . '/AdminController.php';

use \LeanCloud\LeanObject;
use \LeanCloud\Query;
use \LeanCloud\File;

class Mikeshop extends AdminController {
	function __construct() {
		parent::__construct();
		$this->load->model('Category_model', 'category_model');
	}

	// 门店列表
	public function index(){
		
		// 获取get参数
		$pageIndex = $this->input->get('per_page');
		// 分页查询数据
		$query = new Query("Mike_Shop");
		$query->descend("updatedAt");
		$query->limit($this->config->item('per_page'));
		$query->skip($this->config->item('per_page') * ($pageIndex - 1));
		$result = $query->find();
		// var_dump($result);
		// 分页控件
		// url路径前缀
		$config['base_url'] = base_url(uri_string());
		// 总条数
		$config['total_rows'] = (new Query("Mike_Shop"))->count();
		// 初始化
		$this->pagination->initialize($config); 
		$data['pagination'] = $this->pagination->create_links();
		// 渲染
		$data['result'] = $result;
		$data['title'] = "门店列表";
		$this->layout->view('mikeshop/index',$data);
	} 

	// 修改门店
	public function edit(){
		
		// 获取get参数
		$id = $this->input->get('id');
		// 分页查询数据
		$query = new Query("Mike_Shop");
		$mikeshop = $query->get($id);
		// $result = $query->find();
		var_dump($result);
		// 渲染
		$data['mikeshop'] = $mikeshop;
		$data['title'] = "门店列表";
		$this->layout->view('mikeshop/edit',$data);
	} 

	// 保存门店信息
	public function save(){
		// 获取参数
		$mc = $this->input->post('mc');
		$address = $this->input->post('address');
		$zcpsc = $this->input->post('zcpsc');

		$object = new LeanObject("Mike_Shop");
		$objectId = $this->input->post('objectId'); 
		if (isset($objectId)) {
			// 编辑产品
			$object = LeanObject::create('Mike_Shop', $objectId);
			$data['redirect'] = 'index';
			$data['msg'] = '修改成功';
		}
		$object->set("mc", $mc);
		$object->set("address", $address);
		$object->set("zcpsc", $zcpsc);
		$data['redirect'] = 'add';
		try {
			$object->save();
			$this->echo_json('发布成功');
		} catch (Exception $ex) {
			$this->echo_json('操作失败');
		}
	} 


}
