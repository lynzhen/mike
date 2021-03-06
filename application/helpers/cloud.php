<?php
use \LeanCloud\Engine\Cloud;
use \LeanCloud\LeanObject;

Cloud::define("send", function($params, $user) {
	// 参数依次为 className、objectId
	$order = LeanObject::create("Order", $params['objectId']);
	// 修改 content
	$order->set("status", 2);
	// 保存到云端
	$order->save();
	return $order;
});