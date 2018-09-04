<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test_goods extends MY_Controller {

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

		$this->load->myview("test_goods/index", $data);
	}
}
?>