<?php
class Dp_article_model extends CI_Model 
{
    
    private $_strDpTopic = 'dp_topic';
	private $_strDpArticleTopic = 'dp_article_topic';
	private $_strDpArticleLink = 'dp_article_link';
	private $_strDpArticleDescription = 'dp_article_description';
	private $_strDpArticleCentent = 'dp_article_centent';
    private $_db = "";

    function __construct()
    {
        parent::__construct();
        if (empty($this->_db)) {
            $this->_db = $this->load->database("default", true);
        }
    }

    function getTopicWhere($arrWhere = []){
        return $this->_db->get_where($this->_strDpTopic,$arrWhere)->result_array();
    }

    function getaritcleDesc($arrWhere){
        return $this->_db->get_where($this->_strDpArticleDescription,$arrWhere)->result_array();
    }
    function insertaritcleDesc($insert){
        return $this->_db->insert($this->_strDpArticleDescription,$insert);
    }

    function insertaritcleCentent($insert){
        return $this->_db->insert($this->_strDpArticleCentent,$insert);
    }

    function getdpArticleLink($arrWhere = []){

    	$this->_db->order_by("id" , "desc");
    	return $this->_db->get_where($this->_strDpArticleLink,$arrWhere)->result_array();
    }

    function deldparticlelink($arrWhere){
    	return $this->_db->delete($this->_strDpArticleLink , $arrWhere);
    }

    function insertdparticlelink($insert){
    	return $this->_db->insert($this->_strDpArticleLink , $insert);
    }

    function insertArticleTopic($insert){
        return $this->_db->insert($this->_strDpArticleTopic , $insert);
    }


}
