<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Search_ctrl extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session','my_library'));
		$this->load->model(array('Auth_model','Vsat_model','Report_model'));
		if(!$this->session->userdata('uid'))	    
			redirect('Auth');
		}
	
		function permission(){
		    if($this->session->userdata('role') != 'VSAT'){
		        redirect('Auth/notauthorized');
		    } else {
		        return true;
		    }
		}
		
		function search_slug($str){
		    $data['uid'] = $this->session->userdata('uid');
		    $result = $this->db->query("select * ,substring(LogSheet,1,100) as LogSheet1,substring(DESCRIPTION,1,100) as DESCRIPTION1  
                    from FeedInfo where  UID = '" .$data['uid']. "' and slugID like '%" .$str. "%' order by Sno desc")->result_array();
		    return $result;
		}
		
		function search($str){
		    $data['fileresults'] = $this->search_slug($str);
		    //print_r($data['fileresults']); die;
		    $data['header'] = $this->load->view('common/header','',true);
		    $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
		    $data['sidenavbar'] = $this->load->view('common/sidenavbar','',true);
		    $data['footer'] = $this->load->view('common/footer','',true);
		    $data['body'] = $this->load->view('pages/search_slug',$data,true);
		    $this->load->view('common/layout',$data);
		}
}