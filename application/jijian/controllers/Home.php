<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('article_model', 'model', true);
	}

	public function index() {
		$limit = 20; //定义首页条数
		$arrWhere['limit'] = $limit;
		$arrArticlelist = $this->model->getHomeArticle($arrWhere);
		$data['list'] = $arrArticlelist;
		// $arrTempIdList = $this->model->getTemp();
		// $data['templist'] =$arrTempIdList;

		$arrtopiclist = $this->model->getTopic();
		$data['topiclist'] = $arrtopiclist;
		$this->load->myview('home', $data);
	}
	//根据topic 获取文章
	public function topic($tid) {
		$limit = 20; //定义首页条数
		$arrWhere['limit'] = $limit;
		$arrWhere['tid'] = $tid;
		$arrArticlelist = $this->model->getHomeArticleByTid($arrWhere);
		$data['list'] = $arrArticlelist;

		$arrtopiclist = $this->model->getTopic();
		$data['topiclist'] = $arrtopiclist;

		$data['home_title_data'] = array(
			'tmp_TITLE' => empty($arrtopiclist[$tid]) ? "" : $arrtopiclist[$tid],
		);
		$this->load->myview('home', $data);
	}

	public function article($id) {
		if (!$id) {
			$this->load->show_404();
		}
		$arrArticle = $this->model->getArticleById($id);

		$arrArticleTopic = $this->model->getTopicByAid($id);

		if (!$data['article'] = $arrArticle) {
			$this->load->show_404();
		}

		$arrtopiclist = $this->model->getTopic();
		$data['topiclist'] = $arrtopiclist;
		$data['article_topic'] = $arrArticleTopic;

		$this->load->myview('detail/article', $data);
	}
	function mic() {
		$str = microtime();
		$arr = explode(" ", $str);
		return $arr[1] . $arr[0];
		// return time();
	}
}
