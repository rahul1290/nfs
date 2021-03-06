<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assignment_ctrl extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session','my_library'));
		$this->load->model(array('Auth_model','Assignment_model'));
		if(!$this->session->userdata('uid'))	    
			redirect('Auth');
		}
	
		function permission(){
		    if($this->session->userdata('role') != 'ASSIGNMENT'){
		        redirect('Auth/notauthorized');
		    } else {
		        return true;
		    }
		}
	
		function daily_feed_status($cgzone,$mpzone){
	    $this->permission();
	    $data['feed'] = $this->Assignment_model->assign_daily_feed();
	    $data['header'] = $this->load->view('common/header','',true);
	    $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
	    $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
	    $data['footer'] = $this->load->view('common/footer','',true);
	    $data['body'] = $this->load->view('pages/assignment/daily_feed_status/daily_feed_status',$data,true);
	    $this->load->view('common/layout',$data);
	}
	
	function daily_feed_detail($id){
	    $this->permission();
	    $data['sigalresultview'] = $this->Assignment_model->assign_feed_detail($id);
	    $data['header'] = $this->load->view('common/header','',true);
	    $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
	    $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
	    $data['footer'] = $this->load->view('common/footer','',true);
	    $data['body'] = $this->load->view('pages/assignment/daily_feed_status/daily_feed_detail',$data,true);
	    $this->load->view('common/layout',$data);
	}
	
	
	function assign_feed_detail_submit(){
	    $data = array();
	    $sno                       = $this->input->post('feedId');
	    $data['Assign_ID']         = $this->session->userdata('uid');
	    $data['Assign_Status']     = $this->input->post('status');
	    $data['Assign_Remarks']    = $this->input->post('remark');
	    $data['raw_slug']          = $this->input->post('fslug');
	    $data['fslug']             = strtoupper($this->input->post('fslug'));
	    $data['Assign_date']       = date('Y-m-d');
	    $data['Description']       = trim(str_replace("'","''",$this->input->post('anchor')));
	    $data['VO']                = trim(str_replace("'","''",$this->input->post('vo')));
	    $data['Byte']              = trim(str_replace("'","''",$this->input->post('byte')));
	    $data['A_Script']          = trim(str_replace("'","''",$this->input->post('logsheet')));
	    $data['A_VO']              = trim(str_replace("'","''",$this->input->post('vo')));
	    $data['A_Byte']            = trim(str_replace("'","''",$this->input->post('byte')));
	    $data['A']                 = 0;
	    
	    if($this->Assignment_model->assign_feed_detail_submit($sno,$data)){
	       echo json_encode(array('msg'=>'Feed updated successfully.','status'=>200));
	    }
	}
	

	function check_slug(){
	    $slug = $this->input->post('slug');
	    if(!$this->Assignment_model->check_slug($slug)){
	        echo json_encode(array('status'=>200));
	    } else {
	        echo json_encode(array('status'=>500));
	    }
	}
	
	
	function ftpUpload($file,$folderName,$original_file){
	    $ch = curl_init();
	    $localfile  = $file;
	    $fp = fopen($localfile, 'r');
	    curl_setopt($ch, CURLOPT_URL, 'ftp://192.168.25.29/'.$folderName.'/'.$original_file);
	    curl_setopt($ch, CURLOPT_USERPWD, "Newsflow:newsflow@4321");
	    curl_setopt($ch, CURLOPT_UPLOAD, 1);
	    curl_setopt($ch, CURLOPT_INFILE, $fp);
	    curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));
	    curl_exec ($ch);
	    $error_no = curl_errno($ch);
	    curl_close ($ch);   
	}
	
	function ftpthumbUpload($file){
	    $ch = curl_init();
	    $localfile = '/tmp/'.$file;
	    $fp = fopen($localfile, 'r');
	    curl_setopt($ch, CURLOPT_URL, 'ftp://192.168.25.29/'.$file);
	    curl_setopt($ch, CURLOPT_USERPWD, "videothumb:videothumb@4321");
	    curl_setopt($ch, CURLOPT_UPLOAD, 1);
	    curl_setopt($ch, CURLOPT_INFILE, $fp);
	    curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));
	    curl_exec ($ch);
	    $error_no = curl_errno($ch);
	    curl_close ($ch);
	}
	
	function story_file_entry(){
	    if($_SERVER['REQUEST_METHOD'] === 'POST'){
	        $this->form_validation->set_rules('reporter', 'Reporter', 'required');
	        $this->form_validation->set_rules('slug', 'Slug', 'required|trim');
	        $this->form_validation->set_rules('source', 'Source', 'required');
	        $this->form_validation->set_error_delimiters('<div class="error text-danger">', '</div>');
	        if ($this->form_validation->run() == FALSE) {
	            $this->permission();
	            $data['repoters'] = $this->Auth_model->reporter_list();
	            $data['header'] = $this->load->view('common/header','',true);
	            $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
	            $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
	            $data['footer'] = $this->load->view('common/footer','',true);
	            $data['body'] = $this->load->view('pages/assignment/story_file_entry',$data,true);
	            $this->load->view('common/layout',$data);
	        }
	        else {
    	        $this->load->library('upload');
    	        $configVideo['upload_path'] = './uploads';
    	        $configVideo['allowed_types'] = 'mp4|MP4|wmv|mxf|avi|jpeg|jpg';
    	        $configVideo['overwrite'] = TRUE;
    	        $configVideo['remove_spaces'] = TRUE;
    	        
    	        
    	        $messages = array();
    	        foreach($_FILES['file']['name'] as $key => $v_files){
    	            $_FILES['userfile']['name']= $_FILES['file']['name'][$key];
    	            $_FILES['userfile']['type']= $_FILES['file']['type'][$key];
    	            $_FILES['userfile']['tmp_name']= $_FILES['file']['tmp_name'][$key];
    	            $_FILES['userfile']['error']= $_FILES['file']['error'][$key];
    	            $_FILES['userfile']['size']= $_FILES['file']['size'][$key];
    	            
    	            $fileName = str_replace(str_split(' \\/:*?"<>()|'),"_",$_FILES['file']['name'][$key]);
    	            $fileName = date('U').'_'.$fileName;
    	            $images[] = $fileName;
    	            
    	            $configVideo['file_name'] = $fileName;
    	            $this->upload->initialize($configVideo);
    	            
    	            if (!$this->upload->do_upload()){
    	                print_r($this->upload->display_errors());
    	                $messages[] = '';
    	            }
    	            else{
                        $this->db->trans_begin();
                        
    	                $this->db->select('*');
    	                $userDetail = $this->db->get_where('Login',array('UID'=>$this->input->post('reporter')))->result_array();
    	                $folder = $userDetail[0]['Folder_Name'];
    	                
    	                $client_name = $this->upload->data('client_name');
    	                $Path = $this->upload->data('file_path');
    	                $fullPath = $this->upload->data('full_path');
    	                
    	                $fileName = pathinfo($this->upload->data('file_name'), PATHINFO_FILENAME);
    	                $filePath = $Path.$fileName;$temp['client_name'] = $client_name;
	                    $temp['file_name'] = $this->upload->data('file_name');
	                    $temp['fullPath'] = $fullPath;
	                    $temp['msg'] = 'File uploaded';
	                    $temp['status'] =  true;
    	                $messages[] = $temp;
    	                
    	               $this->db->query("insert into FeedInfo(
                                Name,
                                Location,
                                CityCode,
                                StateCode,
                                SlugID,
                                UID,
                                Folder_Name,
                                Description,
                                Date,
                                Time,
                                Logsheet,
                                Assign_Status,
                                Input_Status,
                                Editor_Status,
                                Output_Status,
                                Vsat_Status,
                                VTEditor_Status,
                                Copy_Status,
                                LSlugId,
                                VO,
                                Byte,
                                SourceOfFeed) 
                                
                                values(
                                    '".$userDetail[0]['NAME']."',
                                    '".$userDetail[0]['PLACE']."',
                                    '".$userDetail[0]['CITYCODE']."',
                                    '".$userDetail[0]['STATECODE']."',
                                    N'".strtoupper(date('DM').' '.$userDetail[0]['CITYCODE'].' '.str_replace("'","''",trim($this->input->post('slug'))))."',
                                    '".$userDetail[0]['UID']."',
                                    '".$userDetail[0]['Folder_Name']."',
                                    N'',
                                    '".date('Y-m-d')."',
                                    '".date('H:i:s').'.0000000'."',
                                    N'',
                                    'NA.jpg',
                                    'NA.jpg',
                                    'NA.jpg',
                                    'NA.jpg',
                                    'NA.jpg',
                                    'NA.jpg',
                                    'NA.jpg',
                                    N'".strtoupper(date('DM').' '.$userDetail[0]['CITYCODE'].' '.str_replace("'","''",trim($this->input->post('slug'))))."',
                                    N'',
                                    N'',
                                    '".$this->input->post('source')."'
                                )"); 
    	               
    	               
    	                       $this->db->query("update feedtrans  set 
                                    LslugID=N'".strtoupper(date('DM').' '.$userDetail[0]['CITYCODE'].' '.str_replace("'","''",trim($this->input->post('slug'))))."',
                                    status = 'Send',
                                    SlugId = N'".strtoupper(date('DM').' '.$userDetail[0]['CITYCODE'].' '.str_replace("'","''",trim($this->input->post('slug'))))."' 
                                    where UID = '".$userDetail[0]['UID']."' and status is NULL");
    	                       
            	               //$this->ftpUpload($_FILES['userfile']['tmp_name'],$folder,$configVideo['file_name']);
            	               //$this->ftpthumbUpload($temp['image']);
    	               
    	                       if ($this->db->trans_status() === FALSE){
    	                           $this->db->trans_rollback();
    	                       }
    	                       else {
    	                           $this->db->trans_commit();
    	                           $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><strong>Success!</strong> Story File submitted.</div>');
    	                           redirect('Assignment/Story-File-Entry','refresh');
    	                           exit;
    	                       }
    	            }
    	        }
	        }
	        
	    } else {
    	    $this->permission();
    	    $data['repoters'] = $this->Auth_model->reporter_list();
    	    $data['header'] = $this->load->view('common/header','',true);
    	    $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
    	    $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
    	    $data['footer'] = $this->load->view('common/footer','',true);
    	    $data['body'] = $this->load->view('pages/assignment/story_file_entry',$data,true);
    	    $this->load->view('common/layout',$data);
	    }
	}
	
	
	function checkSlug(){
	    $slug = trim($this->input->post('slug'));
	    $cityCode = trim($this->input->post('citycode'));
	    $slug = date('dm').' '.$cityCode.' '.$slug;
	    $slug = strtoupper($slug);
	    
	    $this->db->select('*');
	    $result = $this->db->get_where('FeedInfo',array('SlugID'=>$slug))->result_array();
	    if(count($result)>0){
	        echo json_encode(array('msg'=>'Invalid slug.','status'=>500));
	    } else {
	        echo json_encode(array('msg'=>'Valid slug.','slug'=>$slug,'status'=>200));
	    }
	}
	
	
	function todayActivity(){
	    $this->permission();
	    $data['feed'] = $this->Assignment_model->assign_today_activity();
	    $data['header'] = $this->load->view('common/header','',true);
	    $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
	    $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
	    $data['footer'] = $this->load->view('common/footer','',true);
	    $data['body'] = $this->load->view('pages/assignment/story_idea/today_activity',$data,true);
	    $this->load->view('common/layout',$data);
	}
	
	function yesterdayDashboard(){
	    $this->permission();
	    $data['feed'] = $this->Assignment_model->yesterdayDashboard();
	    $data['header'] = $this->load->view('common/header','',true);
	    $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
	    $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
	    $data['footer'] = $this->load->view('common/footer','',true);
	    $data['body'] = $this->load->view('pages/assignment/story_idea/yesterday_dashbaord',$data,true);
	    $this->load->view('common/layout',$data);
	}
	
	function allReport($date1=null,$date2=null){
	    $this->permission();
	    if(is_null($date1)){
	        $date1 = date('Y-m-d',strtotime("-1 days"));
	        $date2 = date('Y-m-d');
	    } else {
	        $date1 = date('Y-m-d',strtotime($date1));
	        $date2 = date('Y-m-d',strtotime($date2));
	    }
	    $data['feed'] = $this->Assignment_model->allReport($date1,$date2);
	    $data['header'] = $this->load->view('common/header','',true);
	    $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
	    $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
	    $data['footer'] = $this->load->view('common/footer','',true);
	    $data['body'] = $this->load->view('pages/assignment/story_idea/all_report',$data,true);
	    $this->load->view('common/layout',$data);
	}
	
	function today_activity($scriptfileId=null){
	    if($scriptfileId == null){
    	    $this->permission();
    	    $data['activities'] = $this->Assignment_model->assign_report_today_activity();
    	    $data['header'] = $this->load->view('common/header','',true);
    	    $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
    	    $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
    	    $data['footer'] = $this->load->view('common/footer','',true);
    	    $data['body'] = $this->load->view('pages/assignment/report/today_activity/today_activity',$data,true);
    	    $this->load->view('common/layout',$data);
	    } else {
	        $this->permission();
	        $data['singleresultview'] = $this->Assignment_model->assign_feed_detail($scriptfileId);
	        $data['header'] = $this->load->view('common/header','',true);
	        $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
	        $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
	        $data['footer'] = $this->load->view('common/footer','',true);
	        $data['body'] = $this->load->view('pages/assignment/report/today_activity/today_activity_detail',$data,true);
	        $this->load->view('common/layout',$data);
	    }
	}

	
	function reporter_summary($scriptfileId=null){
	    if($scriptfileId == null){ 
    	    $this->permission();
    	    $data['locations'] = $this->Assignment_model->all_reporter_location_list();
    	    $data['header'] = $this->load->view('common/header','',true);
    	    $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
    	    $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
    	    $data['footer'] = $this->load->view('common/footer','',true);
    	    $data['body'] = $this->load->view('pages/assignment/report/reporter/reporter_summary',$data,true);
    	    $this->load->view('common/layout',$data);
	    } else {
	        $this->permission();
	        $data['singleresultview'] = $this->Assignment_model->assign_feed_detail($scriptfileId);
	        $data['header'] = $this->load->view('common/header','',true);
	        $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
	        $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
	        $data['footer'] = $this->load->view('common/footer','',true);
	        $data['body'] = $this->load->view('pages/assignment/report/reporter/reporter_summary_detail',$data,true);
	        $this->load->view('common/layout',$data);
	    }
	}
	
	
// 	function reporter_script_detail($scriptfileId){
// 	    $this->permission();
// 	    $data['singleresultview'] = $this->Assignment_model->assign_feed_detail($scriptfileId);
// 	    $data['header'] = $this->load->view('common/header','',true);
// 	    $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
// 	    $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
// 	    $data['footer'] = $this->load->view('common/footer','',true);
// 	    $data['body'] = $this->load->view('pages/assignment/report/reporter/script_file_report',$data,true);
// 	    $this->load->view('common/layout',$data);
// 	}
	
	
	function stringer_summary($scriptfileId=null){
	    if($scriptfileId == null){
    	    $this->permission();
    	    $data['locations'] = $this->Assignment_model->all_location('CG');
    	    $data['header'] = $this->load->view('common/header','',true);
    	    $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
    	    $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
    	    $data['footer'] = $this->load->view('common/footer','',true);
    	    $data['body'] = $this->load->view('pages/assignment/report/stringer/stringer_summary',$data,true);
    	    $this->load->view('common/layout',$data);
	    } else {
    	    $this->permission();
    	    $data['singleresultview'] = $this->Assignment_model->assign_feed_detail($scriptfileId);
    	    $data['header'] = $this->load->view('common/header','',true);
    	    $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
    	    $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
    	    $data['footer'] = $this->load->view('common/footer','',true);
    	    $data['body'] = $this->load->view('pages/assignment/report/stringer/stringer_summary_detail',$data,true);
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
	    $data['feed'] = $this->Assignment_model->all_report($date1,$date2);
	    $data['header'] = $this->load->view('common/header','',true);
	    $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
	    $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
	    $data['footer'] = $this->load->view('common/footer','',true);
	    $data['body'] = $this->load->view('pages/assignment/report/all_report/all_report',$data,true);
	    $this->load->view('common/layout',$data);
	}
	
	
	function allreport_detail($scriptfileId){
	    $this->permission();
	    $data['singleresultview'] = $this->Assignment_model->assign_feed_detail($scriptfileId);
	    $data['header'] = $this->load->view('common/header','',true);
	    $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
	    $data['sidenavbar'] = $this->load->view('common/'.$this->session->userdata('role').'_sidenavbar','',true);
	    $data['footer'] = $this->load->view('common/footer','',true);
	    $data['body'] = $this->load->view('pages/assignment/report/all_report/all_report_detail',$data,true);
	    $this->load->view('common/layout',$data);
	}
	
	function all_report_list(){
	    $date = date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('date'))));
	    $result = $this->Assignment_model->all_report_list($date);
	    if(count($result)>0){
	       echo json_encode(array('data'=>$result,'status'=>200));
	    } else {
	        echo json_encode(array('status'=>500));
	    }
	}
	
	function reporter_location_wise(){
	    $location = $this->input->post('location');
	    $result = $this->Assignment_model->all_reporter_location_list($location);
	    if(count($result)>0){
	        echo json_encode(array('data'=>$result,'msg'=>'reporter list','status'=>200));
	    } else {
	        echo json_encode(array('msg'=>'','status'=>500));
	    }
	}
	
	function reporter_report(){
	    $data['fromdate'] = date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('fromdate'))));
	    $data['todate'] = date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('todate'))));
	    $data['location'] = $this->input->post('location');
	    $data['reporter'] = $this->input->post('reporter');
	    $result = $this->Assignment_model->reporter_report($data);
	    
	    if(count($result)>0){
	        echo json_encode(array('data'=>$result,'msg'=>'all records','status'=>200));
	    } else {
	        echo json_encode(array('data'=>$result,'msg'=>'all records','status'=>500));
	    }
	}
	

	function bifurcation(){
	    $this->permission();
	    $data['reporterId'] = $this->input->post('reporterId');
	    $data['fromdate'] = date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('fromdate'))));
	    $data['todate'] = date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('todate'))));
	    $result = $data['singleresultview'] = $this->Assignment_model->bifurcation($data);
	    if(count($result)>0){
	        echo json_encode(array('data'=>$result,'status'=>200));
	    } else {
	        echo json_encode(array('status'=>500));
	    }
	}
	
	function reporter_feed_list_dateWise(){
	    $data['reporterId'] = $this->input->post('uid');
	    $data['date'] = date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('date'))));
	    $result = $this->Assignment_model->reporter_feed_list($data['date'],$data['reporterId']);
	    if(count($result)>0){
	       echo json_encode(array('data'=>$result,'status'=>200));
	    } else {
	        echo json_encode(array('status'=>500));
	    }
	}
	
	
	function stringer_report(){
	    $data['fromdate'] = date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('fromdate'))));
	    $data['todate'] = date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('todate'))));
	    $data['state'] = $this->input->post('state');
	    $data['location'] = $this->input->post('location');
	    $result = $this->Assignment_model->stringer_report($data);

	    if(count($result)>0){
	        echo json_encode(array('data'=>$result,'msg'=>'all records','status'=>200));
	    } else {
	        echo json_encode(array('data'=>$result,'msg'=>'all records','status'=>500));
	    }
	}
	
	function stringer_feed_list_dateWise(){
	    $data['stringerId'] = $this->input->post('uid');
	    $data['fromdate'] = date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('fromdate'))));
	    $data['todate'] = date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('todate'))));
	    
	    $result = $this->Assignment_model->stringer_feed_list($data);
	    if(count($result)>0){
	        echo json_encode(array('data'=>$result,'status'=>200));
	    } else {
	        echo json_encode(array('status'=>500));
	    }
	}
	
	
	function all_location($state){
	    $result = $this->Assignment_model->all_location($state);
	    if(count($result)>0){
	        echo json_encode(array('data'=>$result,'status'=>200));
	    } else {
	        echo json_encode(array('data'=>$result,'status'=>500));
	    }
	}
	
}