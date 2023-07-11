<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operation extends CI_Controller {
	function __construct() {
    parent::__construct();

	}
	public function savedata(){
		if($this->input->is_ajax_request()){
			$temp = array();
			$index=$this->input->post('index');
			$data=$this->input->post('data');
			$this->db->truncate("naivebayes_textclassifier");
			$this->db->insert_batch("naivebayes_textclassifier",$data);
		}else{
			show_404();
		}
	}
}
