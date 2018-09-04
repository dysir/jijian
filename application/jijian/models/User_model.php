<?php
class User_model extends CI_Model
{
	public $_db = "";
	public $_tableUser = "dp_article_user";

	function __construct()
	{
		$this->_db =  $this->load->database ( 'default', TRUE );
	}

	function getUserInfoByUid($uid)
	{
		return $this->_db->get_where($this->_tableUser , array('uid'=>$uid))->row_array();
	}
}