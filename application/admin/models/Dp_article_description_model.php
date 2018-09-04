<?php
class Dp_article_description_model extends CI_Model 
{
    
    private $_strDpArticleDescription = 'dp_article_description';
    private $_strDpArticleCentent = 'dp_article_centent';
    private $_strDpArticleTopic = 'dp_article_topic';
	private $_strDpTopic = 'dp_topic';
    private $_db = "";

    function __construct()
    {
        parent::__construct();
        if (empty($this->_db)) {
            $this->_db = $this->load->database("default", true);
        }
    }
    function getaritcleDesc($arrWhere){
        return $this->_db->get_where($this->_strDpArticleDescription,$arrWhere)->result_array();
    }
    function getList($arrWhere = array() )
    {
        
		$strSelect = 'article_id,title,uname,mtime,status';
        $sql = " select {$strSelect} from dp_article_description where status in (1,2)  ";
        $sqlNum = " select count(*) as num from dp_article_description where status in (1,2)  ";
        $arrParam = array();
        $arrParamNum = array();

        if (isset($arrWhere['ls'])) {
            $sql .= " limit ? , ?";
            $arrParam[] = $arrWhere['ls'];
            $arrParam[] = $arrWhere['le'];
        }
        $list = $this->_db->query($sql, $arrParam)->result_array();
        $arrCount = $this->_db->query($sqlNum, $arrParamNum)->row_array();
        return array(
            'list' => $list,
            'num' => $arrCount['num']
        );
    }

    function updateArticleDesc($data, $where){

        $ret = $this->_db->update($this->_strDpArticleDescription, $data, $where);
        return $ret;
    }

    function getArticleDescByAid($aid){
        $sql = "select * from {$this->_strDpArticleDescription} as ad left join {$this->_strDpArticleCentent} as ac on ad.article_id = ac.article_id where ad.article_id = ? ";

        return $this->_db->query($sql , [$aid])->row_array();
    }

    function getTopicByArticleId($aid){
        $sql = "select dt.id as tid,dt.name from {$this->_strDpTopic} as dt left join {$this->_strDpArticleTopic} as at on at.tid = dt.id where at.article_id = ? ";
        return $this->_db->query($sql ,[$aid])->result_array();
    }

    function getTopiclist(){
        $sql = "select id as tid,name from {$this->_strDpTopic}";
        return $this->_db->query($sql)->result_array();
    }
    function deleteArticleTopic($arrWHere){
        return $this->_db->delete($this->_strDpArticleTopic ,$arrWHere);
    }

    function updatearitcleCentent($arrEdit , $arrWhere){
        return $this->_db->update($this->_strDpArticleCentent,$arrEdit,$arrWhere);
    }
    function insertArticleTopic($insert){
        return $this->_db->insert($this->_strDpArticleTopic , $insert);
    }
}

?>