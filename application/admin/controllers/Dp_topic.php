<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dp_topic extends MY_Controller {

	function __construct() {
		parent::__construct();
		$class = $this->router->fetch_class();
		$this->load->model("{$class}_model", "model", true);
	}
	function index() {

		$this->load->library('page');
		$page = new Page();
		$page->num = 50;
		$arrLimit = $page->getlimit();
		$arrWhere = $this->input->get(null , true);
		$arrWhere['ls'] = $arrLimit['ls'];
		$arrWhere['le'] = $arrLimit['le'];

		$arrRes = $this->model->getList($arrWhere);

		$data['list'] = $arrRes['list'];
		$data['page_view'] = $page->view(array(
			'all' => $arrRes['num'],
		));

		$this->load->myview("dp_topic/index", $data);
	}

	function addtopic(){
		$strTopic = $this->input->get("topic");
		if(empty($strTopic)){
			ajax(-1 , null , "缺少参数");
		}

		$arrWhere = array(
			'name'=>$strTopic
		);
		$boolRes = $this->model->getTopicWhere($arrWhere);

		if(!empty($boolRes)){
			ajax(-1 , null , "已存在");
		}

		$arrInsert = array(
			'name'=>$strTopic,
			'ctime'=>date("Y-m-d H:i:s")
		);
		$this->model->insertTopic($arrInsert);

		ajax(1 , null , "ok");
	}
}
?>