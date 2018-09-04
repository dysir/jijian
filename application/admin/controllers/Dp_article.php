<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dp_article extends MY_Controller {
	function __construct() {
		parent::__construct();
		$class = $this->router->fetch_class();
		$this->load->model("{$class}_model", "model", true);
	}
	function index() {
		$userinfo = checkLogin();

		$uid = $userinfo['uid'];

		$arrTopic = $this->model->getTopicWhere();
		$back = array(
			'arrtopic'=>$arrTopic
		);

		$linklist = $this->model->getdpArticleLink(array(
			'uid'=>$uid
		));
		$back['linklist'] = $linklist;

		$this->load->myview("dp_article/editview",$back);
	}

	function savearticle(){
		$arrPost = $this->input->post();


		if(empty($arrPost['atitle'])||empty($arrPost['amarkdown'])||empty($arrPost['atype'])){
			ajax(-1 , array() , "缺少参数");
		}


		$atitle = $arrPost['atitle'];
		$amarkdown = $arrPost['amarkdown'];
		$atype = $arrPost['atype'];
		$athml = $arrPost['athml'];
		$userinfo = checkLogin();
		$uid = $userinfo['uid'];
		$article_id = date("ymdHi").mt_rand(1000,9999);
		$n = 10 ; 
		while ($n>0) {
			$n--;
			$arrWhere = array(
				'article_id'=>$article_id
			);
			$arinfo = $this->model->getaritcleDesc($arrWhere);
			if(empty($arinfo)){
				break;
			}
			$article_id = date("ymdHi").mt_rand(1000,9999);
		}
		if($n<=0){
			ajax(-1 , array() , "插入失败,请稍后重试");
		}
		$arrInsert = array(
			"article_id"=>$article_id ,
			"title"=>$atitle,
			"description"=>mb_substr(strip_tags(trim($athml)), 0, 200, 'utf-8'),
			"uid"=>$uid,
			"uname"=>$userinfo['nick_name'],
			"mtime"=>date("Y-m-d H:i:s"),
			"ctime"=>date("Y-m-d H:i:s"),
			"status"=>1,
		);

		$res = $this->model->insertaritcleDesc($arrInsert);

		if(!$res){
			ajax(-1 , null ,"插入失败");
		}

		$arrInsert = array(
			"article_id"=>$article_id,
			"content"=>$athml,
			"markdown"=>$amarkdown,
			"ctime"=>date("Y-m-d H:i:s"),
		);
		$res = $this->model->insertaritcleCentent($arrInsert);


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
	function zssave(){
		$arrPost = $this->input->post();
		if(empty($arrPost['atitle'])){
			ajax(-1 , array() , "缺少参数");
		}
		$userinfo = checkLogin();

		$uid = $userinfo['uid'];

		$arrInsert = array(
			"title"=>$arrPost['atitle'],
			"tid"=>$arrPost['atype'],
			"ahtml"=>$arrPost['athml'],
			"amarkdown"=>$arrPost['amarkdown'],
			"uid"=>$uid,
			"mtime"=>date("Y-m-d H:i:s"),
			"ctime"=>date("Y-m-d H:i:s"),
		);

		$res = $this->model->insertdparticlelink($arrInsert);

		if(!$res){
			ajax(-1 , null ,"插入失败");
		}
		ajax(1 , null , 'ok');
	}

	function delzcsave(){
		$arrPost = $this->input->get();
		if(empty($arrPost['id'])){
			ajax(-1 , array() , "缺少参数");
		}
		$id = $arrPost['id'];


		$arrWhere = array(
			'id'=>$id,
		);

		$res = $this->model->deldparticlelink($arrWhere);
		if(!$res){
			ajax(-1 , null ,"删除失败");
		}
		ajax(1 , null , 'ok');

	}

	function hflinkaritcle(){
		$arrPost = $this->input->get();
		if(empty($arrPost['id'])){
			ajax(-1 , array() , "缺少参数");
		}
		$id = $arrPost['id'];


		$arrWhere = array(
			'id'=>$id,
		);

		$res = $this->model->getdpArticleLink($arrWhere);
		if(!$res){
			ajax(-1 , null ,"数据不存在");
		}
		ajax(1 , $res[0] , 'ok');
	}

}