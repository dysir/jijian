<?php
class Dp_topic_model extends CI_Model 
{
    
	private $_strDpTopic = 'dp_topic';
    private $_db = "";

    function __construct()
    {
        parent::__construct();
        if (empty($this->_db)) {
            $this->_db = $this->load->database("default", true);
        }
    }

    function getList($arrWhere = array() )
    {
        
		$strSelect = '*';
        $sql = " select {$strSelect} from dp_topic where 1=1  ";
        $sqlNum = " select count(*) as num from dp_topic where 1=1  ";
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

    function getTopicWhere($arrWhere = []){
        return $this->_db->get_where($this->_strDpTopic,$arrWhere)->result_array();
    }

    function insertTopic($arrInsert){
        return $this->_db->insert($this->_strDpTopic,$arrInsert);
    }

}

?>