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
		$query = new Query('Mike_Goods');
		$goods = $query->get($objectId);
		$data['goods'] = $goods;
		$this->layout->view('goods/edit', $data);
	}
	
	public function save() {
		  
		// 获取参数
		$images = $this->input->post('images');
		$detail = $this->input->post('detail');

		$mc = $this->input->post('mc');
		$longmc = $this->input->post('longmc');
		$flno = $this->input->post('flno');
		$spgg = $this->input->post('spgg');
		$spno = $this->input->post('spno');
		$package = $this->input->post('package');
		$bzdw = $this->input->post('bzdw');
		$lsj = $this->input->post('lsj');
		$dssl = $this->input->post('dssl');
		$pfj = $this->input->post('pfj');
		$bz = $this->input->post('bz');
		$mrcs = $this->input->post('mrcs');
		$kcsl = $this->input->post('kcsl');
		$jhj = $this->input->post('jhj');

		// 主图是第一个产品图
		$avatar = sizeof(json_decode($images)) > 0 ? json_decode($images)[0] : null;

		// save to leanCloud
		$object = new LeanObject("Mike_Goods");
		$objectId = $this->input->post('objectId'); 
		if (isset($objectId)) {
			// 编辑产品
			$object = LeanObject::create('Mike_Goods', $objectId);
			$data['redirect'] = 'index';
			$data['msg'] = '修改成功';
		}
		$object->set("MC", $mc);
		$object->set("LongMc", $longmc);
		$object->set("FLNO", $flno);
		$object->set("SPGG", $spgg);
		$object->set("spno", $spno);
		$object->set("package", $package);
		$object->set("BZDW", $bzdw);
		// $object->set("FCL", (bool)$FCL);
		$object->set("LSJ", $lsj);
		$object->set("DSSL", $dssl);
		$object->set("PFJ", $pfj);
		$object->set("bz", $bz);
		$object->set("Mrcs", $mrcs);
		$object->set("KCSL", $kcsl);
		$object->set("JHJ", $jhj);
		$object->set("avatar", $avatar);
		// 将category转为LeanCloud对象
		// $object->set("isHot", (bool)$isHot);
		// $object->set("isNew", (bool)$isNew);
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
		
		$query = new Query("Mike_Goods");
		// 分页查询数据
		// $query->_include("category");
		$query->ascend("FLNO");
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

	//获取商品分类
	public function showLists(){	
		$pageIndex = $this->input->post('pageIndex');
		// echo $pageIndex;die;

		$query = new Query("Mike_GoodsType");
		$query->ascend("flno");
		$query->select("flno","mc");
		$query->limit(60);
		$query->skip(60 * ($pageIndex - 1));
		$lists = $query->find();
		// var_dump($lists);
		$listArr = [];
		forEach($lists as $item) {
			$flno = $item->get("flno");
			$mc = $item->get("mc");
			$obj['flno'] = $flno;
			$obj['mc'] = $mc;
			array_push($listArr,$obj);
		}
		// var_dump($listArr);
		// $trueArr = array_unique($listArr);
		// $fllist = json_encode($listArr);

		// 总条数
		$count = (new Query("Mike_GoodsType"))->count();
		$ipage = ceil($count / 60);

		$data = array("ipage"=>$ipage, "list"=>$listArr);

		echo json_encode ($data);
		
	}


	public function flist(){
		// 获取get参数
		// $pageIndex = $this->input->get('per_page');
		$flno = $this->input->get('flno');


		$query = new Query("Mike_Goods");
		// 分页查询数据
		$query->equalTo('FLNO',$flno);
		$query->descend("updatedAt");
		$query->limit(1000);
		// $query->limit($this->config->item('per_page'));
		// $query->skip($this->config->item('per_page') * ($pageIndex - 1));
		$result = $query->find();

		// 分页控件
		// url路径前缀
		// $config['base_url'] = base_url(uri_string());
		// 总条数
		// $config['total_rows'] = $result->count();
		// 初始化
		// $this->pagination->initialize($config); 
		
		// $data['pagination'] = $this->pagination->create_links();
		// 渲染
		// $data['list'] = $trueArr;
		$data['result'] = $result;
		$data['title'] = '商品列表';
		$this->layout->view('goods/flist', $data);
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
