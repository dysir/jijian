<?php

// 获取配置文件信息
function c($item, $config = 'custom') {
	$ci = & get_instance ();
	$ci->config->load ( $config );
	return $ci->config->item ( $item );
}


/*
 * 接口返回数据
 */
function ajax($code, $data, $msg) {
	$info = array ();
	$info ['data'] = $data;
	$info ['msg'] = $msg;
	$info ['code'] = $code;
	if (isset ( $_REQUEST ['callback'] )) {
		// jsonp
		header ( 'Content-Type: application/javascript;charset=utf-8' );
		exit ( $_REQUEST ['callback'] . '(' . json_encode ( $info ) . ')' );
	} else {
		// json
		header ( 'Content-Type: application/json;charset=utf-8' );
		exit ( json_encode ( $info ) );
	}
}
function gor($error, $data = array(),$z = false) {
	$area = empty ( $area ) ? "zh" : "";
	$error1 = ErrorCode::getError ( $error, $area );
	if (! isset ( $error1 ['code'] ) || $error1 ['code'] != 1) {
		$ci = &get_instance ();
		wlog ( $ci->router->fetch_class () . "/" . $ci->router->fetch_method () . " -- " . $error );
	}
	if ($z&&is_string($data)) {
		$error1 ['msg'] = $error1 ['msg'].":".$data;
	}
	ajax ( $error1 ['code'], $data, $error1 ['msg'] );
}

/*返回pubic 目录下地址*/
function asset($url)
{
	$baseUrl = base_url();
	return $baseUrl . (substr($url , 0 ,1)=="/"?substr($url,1):$url);
}

/*加载前端组件*/
function load_component($view , $data = array())
{
    $ci = & get_instance();
	echo $ci->load->view("component/{$view}", $data ,true);
}
//
function strData($timestamp)
{
	$str = "";
	if($timestamp > date("Y-m-d 00:00:00" , time()))
	{
		$str = "今天发布";
	}elseif($timestamp > date("Y-m-d 00:00:00" , time()-86400 ))
	{
		$str = "昨天发布";
	}elseif($timestamp > date("Y-m-d 00:00:00" , time()-86400*2 )){
		$str = "前天发布";
	}else{
		$str = date("Y-m-d" , strtotime($timestamp)) ;
	}

	return $str;
}
