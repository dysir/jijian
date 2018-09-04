<?php
class My_error extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	function e404()
	{
        $this->load->myview( "errors/my_404");
	}
}