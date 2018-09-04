<?php
class Ajax extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	function getUserInfo()
	{
		$uid = $this->input->get("uid" , true);
		$this->load->model("User_model" , "" , true);
		$userinfo = $this->User_model->getUserInfoByUid($uid);
		gor("OK" ,$userinfo );
	}
}