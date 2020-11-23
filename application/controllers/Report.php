<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
	
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
	
	
	function scriptFile(){
	    if($this->session->userdata('role') == 'STRINGER' || $this->session->userdata('role') == 'REPORTER'){
		  $data['fileresults'] = $this->Report_model->reportetTodayfilereport($this->session->userdata('uid'));
	    } else {
	        $data['fileresults'] = $this->Report_model->reportetTodayfilereport();
	    }
		$data['header'] = $this->load->view('common/header','',true);
		$data['topnavbar'] = $this->load->view('common/topnavbar','',true);
		$data['sidenavbar'] = $this->load->view('common/sidenavbar','',true);
		$data['footer'] = $this->load->view('common/footer','',true);
		$data['body'] = $this->load->view('pages/script_file_dashboard',$data,true);
		$this->load->view('common/layout',$data);
	}
	
	function storyIdea(){
		$data['header'] = $this->load->view('common/header','',true);
		$data['topnavbar'] = $this->load->view('common/topnavbar','',true);
		$data['sidenavbar'] = $this->load->view('common/sidenavbar','',true);
		$data['footer'] = $this->load->view('common/footer','',true);
		$data['body'] = $this->load->view('pages/story_idea_dashboard','',true);
		$this->load->view('common/layout',$data);
	}
	
	function scriptFileReport($sno=null){
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$data['fromdate'] = $this->input->post('fromdate')?$this->input->post('fromdate'):date('d/m/Y');
			$data['todate'] = $this->input->post('todate')?$this->input->post('todate'):date('d/m/Y');
			
			$data['from_date'] = substr($data['fromdate'],0,10);
			$data['to_date'] = substr($data['todate'],0,10);
			
			$fd = explode('/',$data['from_date']);
			$data['from_date'] = $fd[2].'-'.$fd[1].'-'.$fd[0];
			
			$td = explode('/',$data['to_date']);
			$data['to_date'] = $td[2].'-'.$td[1].'-'.$td[0];
			
			$data['uid'] = $this->session->userdata('uid');
			
			if($this->session->userdata('role') == 'STRINGER' || $this->session->userdata('role') == 'REPORTER'){
			     $data['fileresults'] = $this->Report_model->reportetfilereport($data);
			} else {
			    $role = $this->session->userdata('role');
			    $data['fileresults'] = $this->Report_model->reportetfilereport($data,$role);
			}
		}
		
		$data['header'] = $this->load->view('common/header','',true);
		$data['topnavbar'] = $this->load->view('common/topnavbar','',true);
		$data['sidenavbar'] = $this->load->view('common/sidenavbar','',true);
		$data['footer'] = $this->load->view('common/footer','',true);
		
		if($sno != NULL){
			$data['sigalresultview'] = $this->Report_model->reportetfilereportView($sno);
			$data['body'] = $this->load->view('pages/script_file_report_view',$data,true);
		}else {
			$data['body'] = $this->load->view('pages/script_file_report',$data,true);
		}
		$this->load->view('common/layout',$data);
	}
	
	
	function storyIdeaReport($sno=null){
		if($sno != null){
			$data['storyideaview'] = $this->Report_model->storyIdeaView($sno);
		} else {
			$data['storyideas'] = $this->Report_model->storyIdeaReport($this->session->userdata('uid'));
		}
		$data['header'] = $this->load->view('common/header','',true);
		$data['topnavbar'] = $this->load->view('common/topnavbar','',true);
		$data['sidenavbar'] = $this->load->view('common/sidenavbar','',true);
		$data['footer'] = $this->load->view('common/footer','',true);
		if($sno != null){
			$data['body'] = $this->load->view('pages/story_idea_report_view',$data,true);
		} else {
			$data['body'] = $this->load->view('pages/story_idea_report',$data,true);
		}
		$this->load->view('common/layout',$data);
	}
}