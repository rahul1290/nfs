<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Channelmonitor extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session','my_library'));
		$this->load->model(array('Nfs_model','Report_model'));
		if(!$this->session->userdata('uid')){
			redirect('Auth');
		}
	}
	
	function index(){
		$data['header'] = $this->load->view('common/header','',true);
		$data['topnavbar'] = $this->load->view('common/topnavbar','',true);
		$data['sidenavbar'] = $this->load->view('common/sidenavbar','',true);
		$data['footer'] = $this->load->view('common/footer','',true);
		$data['body'] = $this->load->view('pages/channelmonitor','',true);
		$this->load->view('common/layout',$data);
	}
}