<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vsat_ctrl extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session','my_library'));
		$this->load->model(array('Auth_model','Vsat_model'));
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
		
		function daily_status(){
		    $this->permission();
		}
		
		function daily_status_detail(){
		    
		}
		
		function today_activity(){
		    $this->permission();
		    $data['activities'] = $this->Vsat_model->report_today_activity();
		    $data['header'] = $this->load->view('common/header','',true);
		    $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
		    $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
		    $data['footer'] = $this->load->view('common/footer','',true);
		    $data['body'] = $this->load->view('pages/vsat/report/today_activity/today_activity',$data,true);
		    $this->load->view('common/layout',$data);
		}
		function today_activity_detail($scriptfileId){
		    $this->permission();
		    $data['singleresultview'] = $this->Vsat_model->today_activity_detail($scriptfileId);
		    $data['header'] = $this->load->view('common/header','',true);
		    $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
		    $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
		    $data['footer'] = $this->load->view('common/footer','',true);
		    $data['body'] = $this->load->view('pages/vsat/report/today_activity/today_activity_detail',$data,true);
		    $this->load->view('common/layout',$data);
		}
		
		function location_wise($scriptfileId=null){
		    if($scriptfileId == null){ 
		        $this->permission();
    		    $data['locations'] = $this->Vsat_model->all_location('CG');
    		    $data['header'] = $this->load->view('common/header','',true);
    		    $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
    		    $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
    		    $data['footer'] = $this->load->view('common/footer','',true);
    		    $data['body'] = $this->load->view('pages/vsat/report/location_wise/location_wise',$data,true);
    		    $this->load->view('common/layout',$data);
		    } else {
		        $this->permission();
		        $data['singleresultview'] = $this->Vsat_model->assign_feed_detail($scriptfileId);
		        $data['header'] = $this->load->view('common/header','',true);
		        $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
		        $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
		        $data['footer'] = $this->load->view('common/footer','',true);
		        $data['body'] = $this->load->view('pages/vsat/report/location_wise/script_file_report',$data,true);
		        $this->load->view('common/layout',$data);
		    }
		}
		
		function all_report($date1=null,$date2=null){
		    $this->permission();
		    
		    $this->permission();
		    if(is_null($date1)){
		        $date1 = date('Y-m-d',strtotime("-1 days"));
		        $date2 = date('Y-m-d');
		    } else {
		        $date1 = date('Y-m-d',strtotime($date1));
		        $date2 = date('Y-m-d',strtotime($date2));
		    }
		    $data['feed'] = $this->Vsat_model->all_report($date1,$date2);
		    $data['header'] = $this->load->view('common/header','',true);
		    $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
		    $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
		    $data['footer'] = $this->load->view('common/footer','',true);
		    $data['body'] = $this->load->view('pages/vsat/report/all_report/all_report',$data,true);
		    $this->load->view('common/layout',$data);
		}
		
		/*
		 * "all_report_list" is called by ajax call, called by "Vsat/report/all-report" page
		 */
		function all_report_list($scriptfileId=null){
		    if($scriptfileId ==null){ 
    		    $date = date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('date'))));
    		    $result = $this->Vsat_model->all_report_list($date);
    		    if(count($result)>0){
    		        echo json_encode(array('data'=>$result,'status'=>200));
    		    } else {
    		        echo json_encode(array('status'=>500));
    		    }
		    } else {
		        $this->permission();
		        $data['singleresultview'] = $this->Vsat_model->assign_feed_detail($scriptfileId);
		        $data['header'] = $this->load->view('common/header','',true);
		        $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
		        $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
		        $data['footer'] = $this->load->view('common/footer','',true);
		        $data['body'] = $this->load->view('pages/vsat/report/all_report/script_file_report',$data,true);
		        $this->load->view('common/layout',$data);
		    }
		}
}