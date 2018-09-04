<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dp_article_description extends MY_Controller {

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

		$this->load->myview("dp_article_description/index", $data);
	}

	function changestatus(){
		$arrGet = $this->input->get(null , true);

		if(empty($arrGet['aid']) || empty($arrGet['astatus'])){
			ajax(-1 , null , "缺少参数");
		}

		$arrWhere = array(
			'article_id'=>$arrGet['aid']
		);
		$edit = array(
			'status'=>$arrGet['astatus']
		);
		$this->model->updateArticleDesc($edit ,$arrWhere);

		ajax(1 , null , "ok");
	}

	function editview(){
		$article_id = $this->input->get("article_id" , true);

		if(empty($article_id)){
			gor("缺少参数");
		}
		$articleinfo = $this->model->getArticleDescByAid($article_id);

		$arrTopic = getTopicList($article_id);
		//分类应该是支持多选的 在此只选一个吧
		$arrTopicInfo = empty($arrTopic[0])?[]:$arrTopic[0];

	// var_dump($data);exit;
		$data = array(
			'articleinfo'=>$articleinfo,
			'topicinfo'=>$arrTopicInfo,
			'arrtopic'=>getTopicList()
		);
		$this->load->myview("dp_article_description/editview", $data);
	}
	function savearticle(){
		$arrPost = $this->input->post();

		if(empty($arrPost['atitle'])||empty($arrPost['amarkdown'])||empty($arrPost['atype']) ||empty($arrPost['amarkdown']) ){
			ajax(-1 , array() , "缺少参数");
		}

		$atitle = $arrPost['atitle'];
		$amarkdown = $arrPost['amarkdown'];
		$atype = $arrPost['atype'];
		$athml = $arrPost['athml'];

		$article_id = $arrPost['aid'];
		$arrWhere = array(
			'article_id'=>$article_id
		);
		$arrRes = $this->model->getaritcleDesc($arrWhere);
		if(empty($arrRes)){
			ajax(-1 , array() , "不存在的文章");
		}


		$arrEdit = array(
			"title"=>$atitle,
			"description"=>mb_substr(strip_tags(trim($athml)), 0, 200, 'utf-8'),
			"mtime"=>date("Y-m-d H:i:s"),
		);

		$res = $this->model->updateArticleDesc($arrEdit,$arrWhere);

		if(!$res){
			ajax(-1 , null ,"修改失败");
		}

		$arrEdit = array(
			"content"=>$athml,
			"markdown"=>$amarkdown,
		);
		$res = $this->model->updatearitcleCentent($arrEdit,$arrWhere);
		if(!$res){
			ajax(-1 , null ,"修改失败");
		}

		$this->model->deleteArticleTopic($arrWhere);
		$arrInsert = array(
			'article_id'=>$article_id,
			'tid'=>$atype,
		);
		$this->model->insertArticleTopic($arrInsert);
		if(!$res){
			ajax(-1 , null ,"插入失败");
		}

		ajax(1 , null , 'ok');
	}
}
?>