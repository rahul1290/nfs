<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entryform extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session','my_library','Authorization_Token'));
		$this->load->model(array('Nfs_model'));
		
		if(!$this->session->userdata('uid')){
			redirect('Auth');
		}
	}
	
	
	function checkdraft(){
		$data['slug'] = $this->input->post('slug');
		$data['anchor'] = $this->input->post('anchor');
		$data['vo'] = $this->input->post('vo');
		$data['bytes'] = $this->input->post('bytes');
		$data['logsheet'] = $this->input->post('logsheet');
		
		$this->db->select('*');
		$result = $this->db->get_where('Login',array('UID'=>urldecode($id),'Active'=>'ACTIVE'))->result_array();
		
			$userdata = array(
					'uid'		=> $result[0]['UID'],
					'username'  => $result[0]['NAME'],
					'email'     => $result[0]['EmailId'],
					'stateCode'	=> $result[0]['STATECODE'],
					'cityCode' 	=> $result[0]['CITYCODE'],
					'folderName' => $result[0]['Folder_Name'],
					'place'		=> $result[0]['PLACE'],
					'role'		=>  $result[0]['Permission'],
					'Active' 	=> $result[0]['Active']
			);
			$this->session->set_userdata($userdata);
		
		$userdata = array(
				'form_slug'		=> $this->input->post('slug'),
				'form_anchor'  => $this->input->post('anchor'),
				'form_vo'     => $this->input->post('vo'),
				'form_bytes'	=> $this->input->post('bytes'),
				'form_logsheet' 	=> $this->input->post('logsheet'),
			);
			$this->session->set_userdata('formdata',$userdata);
			
			echo json_encode(array('msg'=>'saved.','status'=>200));
	}
	
	function checkSlug(){
		$slug = $this->input->post('slug');
		
		$slug = date('dm').' '.$this->session->userdata('cityCode').' '.$slug;
		$slug = strtoupper($slug); 
		
		$this->db->select('*');
		$result = $this->db->get_where('FeedInfo',array('SlugID'=>$slug))->result_array();
		if(count($result)>0){
			echo json_encode(array('msg'=>'Invalid slug.','status'=>500));
		} else {
			echo json_encode(array('msg'=>'Valid slug.','slug'=>$slug,'status'=>200));
		}
	}
	
	function feedsubmit(){
		$data['slug'] =  str_replace("'","",trim($this->input->post('slug')));
		$data['anchor'] = str_replace("'","",trim($this->input->post('anchor')));
		$data['vo'] = str_replace("'","",trim($this->input->post('vo')));
		$data['bytes'] = str_replace("'","",trim($this->input->post('bytes')));
		$data['logsheet'] = str_replace("'","",trim($this->input->post('logsheet')));
		
		
		$data['slug'] = strtoupper(date('dm').' '.$this->session->userdata('cityCode').' '.$data['slug']);
		
		$this->db->trans_begin();
		// $this->db->insert('FeedInfo',array(
			// 'Name'				=> $this->session->userdata('username'),
			// 'Location' 			=> $this->session->userdata('place'),
			// 'CityCode'			=> $this->session->userdata('cityCode'),
			// 'StateCode'			=> $this->session->userdata('stateCode'),
			// 'Category'			=> NULL,
			// 'SlugID'			=> $data['slug'],
			// 'UID'				=> $this->session->userdata('uid'),
			// 'Folder_Name'		=> $this->session->userdata('folderName'),
			// 'Type'				=> NULL,
			// 'Description'		=> $data['anchor'],
			// 'Logsheet'			=> $data['logsheet'],	
			// 'Date'				=> date('Y-m-d'),
			// 'Time'				=> date('H:i:s').'.0000000',
			// 'Final_SlugID'		=> $data['slug'],
			// 'Assign_Status' 	=> 'NA.jpg',
			// 'Input_Status'		=> 'NA.jpg',
			// 'Editor_Status'		=> 'NA.jpg',
			// 'Output_Status'		=> 'NA.jpg',
			// 'Vsat_Status'		=> 'NA.jpg',
			// 'Copy_Status'		=> 'NA.jpg',
			// 'LSlugId'			=> $data['slug'],
			// 'VO'				=> $data['vo'],
			// 'Byte'				=> $data['bytes'],
			// 'O_Script'			=> $data['anchor'], 
			// 'O_VO'				=> $data['vo'],
			// 'O_Byte'			=> $data['bytes']
		// ));
		
		//$this->db->query("insert into FeedInfo (Name,Location,CityCode,StateCode,Category,SlugID,UID,Folder_Name,Type,Description,Logsheet,Date,Time,Final_SlugID,Assign_Status,Input_Status,Editor_Status,Output_Status,Vsat_Status,Copy_Status,LSlugId,VO,Byte,O_Script,O_VO,O_Byte) VALUES ('".$this->session->userdata('username')."','".$this->session->userdata('place')."','".$this->session->userdata('cityCode')."','".$this->session->userdata('stateCode')."','NULL','".$data['slug']."','".$this->session->userdata('uid')."','".$this->session->userdata('folderName')."','NULL',N'".$data['anchor']."',N'".$data['logsheet']."','".date('Y-m-d')."','".date('H:i:s').'.0000000'."','".$data['slug']."','NA.jpg','NA.jpg','NA.jpg','NA.jpg','NA.jpg','NA.jpg','".$data['slug']."',N'".$data['vo']."',N'".$data['bytes']."',N'".$data['anchor']."',N'".$data['vo']."',N'".$data['bytes']."') ");
		$this->db->query("insert into FeedInfo (Name,Location,CityCode,StateCode,Category,SlugID,UID,Folder_Name,Type,Description,Logsheet,Date,Time,Final_SlugID,Assign_Status,Input_Status,Editor_Status,Output_Status,Vsat_Status,Copy_Status,LSlugId,VO,Byte,O_Script,O_VO,O_Byte) VALUES ('".$this->session->userdata('username')."','".$this->session->userdata('place')."','".$this->session->userdata('cityCode')."','".$this->session->userdata('stateCode')."','NULL','".$data['slug']."','".$this->session->userdata('uid')."','".$this->session->userdata('folderName')."','NULL',N'".$data['anchor']."',N'".$data['logsheet']."','".date('Y-m-d')."','".date('H:i:s').'.0000000'."','NULL','NA.jpg','NA.jpg','NA.jpg','NA.jpg','NA.jpg','NA.jpg','".$data['slug']."',N'".$data['vo']."',N'".$data['bytes']."',N'".$data['anchor']."',N'".$data['vo']."',N'".$data['bytes']."') ");
		
		
		$this->db->where(array('UID'=>$this->session->userdata('uid'),'Status'=>NULL));
		$this->db->update('FeedTrans',array(
			'SlugID' => $data['slug'],
			'LSlugId' => $data['slug'],
			'Status' => 'send'
		));
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			echo json_encode(array('msg'=>'Record submitted.','status'=>500));
		}
		else{
			$this->db->trans_commit();
			echo json_encode(array('msg'=>'Record submitted.','status'=>200));
		}
	}
	
	function fileunlink(){
		$file = $this->input->post('file');
		$dbid = $this->input->post('dbId');
		
		$this->db->query("delete from FeedTrans where Sno = '".$dbid."'");
		
		$path_parts = pathinfo($file);
		
		$this->ftpDel($path_parts['basename']);
		
		$thumb = $path_parts['filename'].'.jpg';
		$this->ftpthumbDel($thumb);
		
		echo json_encode(array('msg'=>'File deleted.','status'=>200));
	}
	
	 function ftpUpload($file,$original_file){
        $ch = curl_init();
        //$localfile = realpath('./uploads/'.$file);
		$localfile  = $file;
        $fp = fopen($localfile, 'r');
        //curl_setopt($ch, CURLOPT_URL, 'ftp://192.168.25.29/'.$this->session->userdata('folderName').'/'.$file);
        curl_setopt($ch, CURLOPT_URL, 'ftp://192.168.25.29/'.$this->session->userdata('folderName').'/'.$original_file);
        curl_setopt($ch, CURLOPT_USERPWD, "Newsflow:newsflow@4321");
        curl_setopt($ch, CURLOPT_UPLOAD, 1);
        curl_setopt($ch, CURLOPT_INFILE, $fp);
        curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));
        curl_exec ($ch);
        $error_no = curl_errno($ch);
        //echo $error_no;
        curl_close ($ch);
        if ($error_no == 0) {
			//unlink('./uploads/'.$file);
			//return true;
        } else {
			//return false;
        } 
    }

	
	function ftpthumbUpload($file){
		$ch = curl_init();
        //$localfile = realpath('./uploads/'.$file);
        $localfile = '/tmp/'.$file;
        $fp = fopen($localfile, 'r');
        //curl_setopt($ch, CURLOPT_URL, 'ftp://192.168.25.13/VideoThumb/'.$file);
        curl_setopt($ch, CURLOPT_URL, 'ftp://192.168.25.29/'.$file);
        curl_setopt($ch, CURLOPT_USERPWD, "videothumb:videothumb@4321");
        curl_setopt($ch, CURLOPT_UPLOAD, 1);
        curl_setopt($ch, CURLOPT_INFILE, $fp);
        curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));
        curl_exec ($ch);
        $error_no = curl_errno($ch);
        //echo $error_no;
        curl_close ($ch);
        if ($error_no == 0) {
			//unlink('./uploads/'.$file);
			//return true;
        } else {
			//return false;
        } 
	}
	
	function ftpDel($file){
        $ch = curl_init();
        // $localfile = realpath('./uploads/'.$file);
        // $fp = fopen($localfile, 'r');
        //curl_setopt($ch, CURLOPT_URL, 'ftp://192.168.25.13/'.$this->session->userdata('folderName').'/'.$file);
        curl_setopt($ch, CURLOPT_URL, 'ftp://192.168.25.29/'.$this->session->userdata('folderName').'/'.$file);
        curl_setopt($ch, CURLOPT_USERPWD, "Newsflow:newsflow@4321");
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_QUOTE, array('DELE /' . $this->session->userdata('folderName')."/".$file));
		curl_exec ($ch);
        $error_no = curl_errno($ch);
        //echo $error_no;
        curl_close ($ch);
        if ($error_no == 0) {
			//return true;
        } else {
			//return false;
        } 
    }
	
	function ftpthumbDel($file){
        $ch = curl_init();
        // $localfile = realpath('./uploads/'.$file);
        // $fp = fopen($localfile, 'r');
        //curl_setopt($ch, CURLOPT_URL, 'ftp://192.168.25.13/VideoThumb/'.$file);
        curl_setopt($ch, CURLOPT_URL, 'ftp://192.168.25.29/'.$file);
        curl_setopt($ch, CURLOPT_USERPWD, "videothumb:videothumb@4321");
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_QUOTE, array('DELE /'.$file));
		curl_exec ($ch);
        $error_no = curl_errno($ch);
        //echo $error_no;
        curl_close ($ch);
        if ($error_no == 0) {
			//return true;
        } else {
			//return false;
        } 
    }
	
	function upload(){
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		$this->load->library('upload');
		$configVideo['upload_path'] = '/tmp';
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
				$client_name = $this->upload->data('client_name');
				$Path = $this->upload->data('file_path');
				$fullPath = $this->upload->data('full_path'); 
				
				$fileName = pathinfo($this->upload->data('file_name'), PATHINFO_FILENAME);
				$filePath = $Path.$fileName;
				
				if($_FILES['userfile']['type'] == 'image/jpeg' || $_FILES['userfile']['type'] == 'image/jpeg'){
				    $retval = false;
				} else {
				    $cmd = "ffmpeg -i $fullPath -ss 00:00:01.000 -vframes 1 $filePath.jpg 2>&1";
				    exec($cmd, $output, $retval);
				}
				
				
				if ($retval){
					$temp['image'] = null;
					$temp['msg'] = 'error in generating video thumbnail';
					$temp['file_name'] = $client_name;
					$temp['fullPath'] = $fullPath;
					$temp['status'] =  true;
				} else {
					$temp['image'] = $fileName.'.jpg';
					$temp['client_name'] = $client_name;
					$temp['file_name'] = $this->upload->data('file_name');
					$temp['fullPath'] = $fullPath;
					$temp['msg'] = 'File uploaded';
					$temp['status'] =  true;
					
					// $this->db->insert('FeedTrans',array(
						// 'Name'			=> $this->session->userdata('username'),
						// 'Location'		=> $this->session->userdata('place'),
						// 'CityCode'		=> $this->session->userdata('cityCode'),
						// 'StateCode'		=> $this->session->userdata('stateCode'),
						// 'SlugID'		=> date('d').date('m').$this->session->userdata('cityCode'),
						// 'UID'			=> $this->session->userdata('uid'),
						// 'Folder_Name'	=> $this->session->userdata('folderName'),
						// 'File_Name'		=> $this->upload->data('file_name'),
						// 'Date'			=> date('Y-m-d'),
						// 'Time'			=> date('H:i:s').'.0000000',
						// 'Thumb_Name'		=> $this->upload->data('raw_name').'.jpg',
						// 'Status'		=> NULL,
						// 'SessionId'		=> NULL,
						// 'File_name_Rename'	=> NULL,
						// 'LSlugId'		=> null,
						// 'Archive'		=> 0,
						// 'Device'		=> NULL
					// ));
					
					$this->db->query("insert into FeedTrans(Name,Location,CityCode,StateCode,SlugID,UID,Folder_Name,File_Name,Date,Time,Thumb_Name,Status,SessionId,File_name_Rename,LSlugId,Archive,Device) 
					values(
						'".$this->session->userdata('username')."',
						'".$this->session->userdata('place')."',
						'".$this->session->userdata('cityCode')."',
						'".$this->session->userdata('stateCode')."',
						'". date("d").date("m").$this->session->userdata("cityCode") ."',
						'".$this->session->userdata('uid')."',
						'".$this->session->userdata('folderName')."',
						N'".$this->upload->data('file_name')."',
						'".date('Y-m-d')."',
						'". date("H:i:s").".0000000"."',
						N'".$this->upload->data("raw_name").".jpg"."',
						NULL,NULL,NULL,NULL,0,NULL)");
					
					$temp['dbId'] = $this->db->insert_id();
					
					// if($_FILES['userfile']['type'] == 'image/jpeg' || $_FILES['userfile']['type'] == 'image/jpeg'){
					    
					// } else {
					    $this->ftpUpload($_FILES['userfile']['tmp_name'],$configVideo['file_name']);
					//}
					$this->ftpthumbUpload($temp['image']);
				}
				$messages[] = $temp;
			}
			
		}
		$data = $messages;
		echo json_encode(array('data'=>$data,'status'=>200));
	}
	
	
	function storyfile(){
		$data['archives'] = $this->Nfs_model->archives($this->session->userdata('uid'));
		
		$data['header'] = $this->load->view('common/header','',true);
		$data['topnavbar'] = $this->load->view('common/topnavbar','',true);
		$data['sidenavbar'] = $this->load->view('common/sidenavbar','',true);
		$data['footer'] = $this->load->view('common/footer','',true);
		$data['body'] = $this->load->view('pages/storyfile',$data,true);
		$this->load->view('common/layout',$data);
	}
	
	function storyidea(){
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$this->form_validation->set_rules('storyname', 'Story Name', 'trim|required');
			$this->form_validation->set_rules('script', 'Script', 'trim|required');
			$this->form_validation->set_rules('font', 'font', 'trim|required');
			
			$this->form_validation->set_error_delimiters('<span class="error text-danger">', '</span>');
			
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('msg', '<p class="text-center">Invalid Credentials.</p>');
			} else {
				$data['name'] =  $this->session->userdata('username');
				$data['location'] = $this->session->userdata('place');
				$data['citycode'] = $this->session->userdata('cityCode');
				$data['statecode'] = $this->session->userdata('stateCode');
				$data['storyid'] = str_replace("'","",trim($this->input->post('storyname'))); 
				$data['uid'] = $this->session->userdata('uid');
				$data['description'] = str_replace("'","",trim($this->input->post('script'))); 
				$data['date'] = date('Y-m-d');
				$data['approval_status'] = NULL;
				$data['approval_remarks'] = NULL;
				$data['approval_date'] = NULL;
				$data['approved_by'] = NULL;
				$data['storyIdeaID'] = $this->session->userdata('cityCode').'/'.date('dmyHi');
				$data['time'] = date('H:i:00').'.0000000';
				if($this->Nfs_model->storyidea($data)){
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><strong>Success!</strong> Story idea submitted.</div>');
					redirect('Entryform/storyidea','refresh');
					exit;
				}
			}
		}
		$data['header'] = $this->load->view('common/header','',true);
		$data['topnavbar'] = $this->load->view('common/topnavbar','',true);
		$data['sidenavbar'] = $this->load->view('common/sidenavbar','',true);
		$data['footer'] = $this->load->view('common/footer','',true);
		$data['body'] = $this->load->view('pages/storyidea','',true);
		$this->load->view('common/layout',$data);
	}
}