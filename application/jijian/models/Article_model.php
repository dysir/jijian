<?php
class Article_model extends MY_Model
{
	public $_db = "";
	public $_tableAritcleDesc = "dp_article_description";
	public $_tableAritcleCon = "dp_article_centent";
	public $_tableTopic = "dp_topic";
	public $_tableTopicArticle = "dp_article_topic";

	function __construct()
	{
		$this->_db =  $this->load->database ( 'default', TRUE );
	}
	/*
		limit 必传
	*/
	function getHomeArticle($arrWhere)
	{
		$arrSqlWhere = array();
		$str = "ad.*,ac.content";
		$sql = "select {$str} from {$this->_tableAritcleDesc} as ad left join {$this->_tableAritcleCon} as ac on ac.article_id = ad.article_id where status = 2 ";
		/*
		where 条件
		*/
		$sql.= " order by ad.id desc ";
		if($arrSqlWhere[] = $arrWhere['limit'])
		{
			$sql.=" limit 0,?";
		}
		return $this->_db->query($sql , $arrSqlWhere)->result_array();
	}
	/*
		limit
		tid
	*/
	function getHomeArticleByTid($arrWhere)
	{
		$arrSqlWhere = array();
		$str = "ad.*,ac.content";
		$sql = "select {$str} from {$this->_tableTopicArticle} as ta left join {$this->_tableAritcleDesc} as ad on ta.article_id=ad.article_id left join {$this->_tableAritcleCon} as ac on ac.article_id = ad.article_id  where ta.tid = ? and ad.status = 2  ";
		/*
		where 条件
		*/
		$sql.= " order by ad.id desc ";

		$arrSqlWhere[] = $arrWhere['tid'];

		if($arrSqlWhere[] = $arrWhere['limit'])
		{
			$sql.=" limit 0,?";
		}
		return $this->_db->query($sql , $arrSqlWhere)->result_array();
	}
	//获取分类列表
	function getTopic()
	{
		$arrTopic = $this->_db->get($this->_tableTopic)->result_array();

		$arrIdTopic = array();
		foreach ($arrTopic as $key => $value) {
			$arrIdTopic[$value['id']] = $value['name'];
		}

		return $arrIdTopic;
	}
	/*
	根据文摘id 
	获取分类
	id=>name
	*/
	function getTopicByAid($aid)
	{
		$sql = "select t.name,t.id from {$this->_tableTopicArticle} as ta left join {$this->_tableTopic} as t on t.id = ta.tid where ta.article_id = ? ";
		$arrTopic = $this->_db->query($sql , array($aid))->result_array();

		$arrIdTopic = array();
		if($arrTopic)
		{
			foreach ($arrTopic as $key => $value) {
				$arrIdTopic[$value['id']] = $value['name'];
			}
		}
		return $arrIdTopic;
	}
	//文章详情页
	function getArticleById($id)
	{
		$arr = array(
				'id'=>$id
			);
		$sql = "select ad.*,ac.content from {$this->_tableAritcleDesc} as ad left join {$this->_tableAritcleCon} as ac on ad.article_id = ac.article_id where ad.article_id = ? and ad.status = 2  ";
		return $this->_db->query($sql , array($id))->row_array();
	}

	function getArticleByWhere($where)
	{
		return $this->_db->get_where($this->_tableAritcleDesc , $where)->result_array();
	}

}