<?php 
require APPPATH . 'libraries/REST_Controller.php';

class Entryform_rest extends REST_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session','Authorization_Token'));
		$this->load->model(array('Auth_model'));
	}
	
	
	
	function checkSlug_post(){
		$slug = $this->post('slug');
		$is_valid_token = $this->authorization_token->validateToken();
		if(!empty($is_valid_token) && $is_valid_token['status'] === true){
			$slug = date('dm').' '.$is_valid_token['data']->cityCode.' '.$slug;
			$slug = strtoupper($slug); 
			
			$this->db->select('*');
			$result = $this->db->get_where('FeedInfo',array('SlugID'=>$slug))->result_array();
			if(count($result)>0){
				$this->response(array('msg'=>'Invalid slug.'),500);
			} else {
				$this->response(array('msg'=>'Valid slug.','slug'=>$slug),200);
			}	
		} else {
			$this->response(array('status'=>FALSE,'msg'=>$is_valid_token['message']),404);
		}
	}
	
	function feedsubmit_post(){
		$is_valid_token = $this->authorization_token->validateToken();
		if(!empty($is_valid_token) && $is_valid_token['status'] === true){
			$data['slug'] = trim($this->post('slug'));
			$data['anchor'] = trim($this->post('anchor'));
			$data['vo'] = trim($this->post('vo'));
			$data['bytes'] = trim($this->post('bytes'));
			$data['logsheet'] = trim($this->post('logsheet'));
			
			$data['slug'] = strtoupper(date('dm').' '.$is_valid_token['data']->cityCode.' '.$data['slug']);
			
			$this->db->trans_begin();
			$this->db->query("insert into FeedInfo (Name,Location,CityCode,StateCode,Category,SlugID,UID,Folder_Name,Type,Description,Logsheet,Date,Time,Final_SlugID,Assign_Status,Input_Status,Editor_Status,Output_Status,Vsat_Status,Copy_Status,LSlugId,VO,Byte,O_Script,O_VO,O_Byte) VALUES ('".$this->session->userdata('username')."','".$this->session->userdata('place')."','".$this->session->userdata('cityCode')."','".$this->session->userdata('stateCode')."','NULL','".$data['slug']."','".$this->session->userdata('uid')."','".$this->session->userdata('folderName')."','NULL',N'".$data['anchor']."',N'".$data['logsheet']."','".date('Y-m-d')."','".date('H:i:s').'.0000000'."','".$data['slug']."','NA.jpg','NA.jpg','NA.jpg','NA.jpg','NA.jpg','NA.jpg','".$data['slug']."',N'".$data['vo']."',N'".$data['bytes']."',N'".$data['anchor']."',N'".$data['vo']."',N'".$data['bytes']."') ");
			
			
			$this->db->where(array('UID'=>$this->session->userdata('uid'),'Archive'=>1));
			$this->db->update('FeedTrans',array(
				'SlugID' => $data['slug'],
				'LSlugId' => $data['slug'],
				'Archive' => 0
			));
			
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				$this->response(array('msg'=>'Something wrong.'),500);
			}
			else{
				$this->db->trans_commit();
				$this->response(array('msg'=>'Record submitted.'),200);
			}
		} else {
			$this->response(array('status'=>FALSE,'msg'=>$is_valid_token['message']),404);
		}
	}
	
	
	function upload_post(){
		$is_valid_token = $this->authorization_token->validateToken();
		if(!empty($is_valid_token) && $is_valid_token['status'] === true){
			$this->load->library('upload');
		
			$configVideo['upload_path'] = 'uploads/'; 
			$configVideo['allowed_types'] = 'mp4|MP4|wmv|mxf|avi'; 
			$configVideo['overwrite'] = TRUE;
			$configVideo['remove_spaces'] = TRUE;
			
			$messages = array();
			foreach($_FILES['file']['name'] as $key => $v_files){
				$_FILES['userfile']['name']= $_FILES['file']['name'][$key];
				$_FILES['userfile']['type']= $_FILES['file']['type'][$key];
				$_FILES['userfile']['tmp_name']= $_FILES['file']['tmp_name'][$key];
				$_FILES['userfile']['error']= $_FILES['file']['error'][$key];
				$_FILES['userfile']['size']= $_FILES['file']['size'][$key];

				//$fileName = date('dm').'_'.$this->session->userdata('folderName').'_'.date('U').'.mp4';
				
				$fileName = str_replace(" ","_",$_FILES['file']['name'][$key]);
				$fileName = date('U').'_'.$fileName;
				$images[] = $fileName;

				$configVideo['file_name'] = $fileName;
				
				$this->upload->initialize($configVideo);

				if (!$this->upload->do_upload()){
					//print_r($this->upload->display_errors());
					$messages[] = '';
				}
				else{
					$client_name = $this->upload->data('client_name');
					$Path = $this->upload->data('file_path');
					$fullPath = $this->upload->data('full_path'); 
					
					$fileName = pathinfo($this->upload->data('file_name'), PATHINFO_FILENAME);
					$filePath = $Path.$fileName;
					
					$cmd = "ffmpeg -i $fullPath -ss 00:00:01.000 -vframes 1 $filePath.jpg 2>&1";
					exec($cmd, $output, $retval);
					
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
						
						$this->db->insert('FeedTrans',array(
							'Name'			=> $is_valid_token['data']->username,
							'Location'		=> $is_valid_token['data']->place,
							'CityCode'		=> $is_valid_token['data']->cityCode,
							'StateCode'		=> $is_valid_token['data']->stateCode,
							'SlugID'		=> 'slug',
							'UID'			=> $is_valid_token['data']->uid,
							'Folder_Name'	=> $is_valid_token['data']->folderName,
							'File_Name'		=> $this->upload->data('file_name'),
							'Date'			=> date('Y-m-d'),
							'Time'			=> date('H:i:s').'.0000000',
							'Thumb_Name'		=> $this->upload->data('raw_name').'.jpg',
							'Status'		=> NULL,
							'SessionId'		=> NULL,
							'File_name_Rename'	=> NULL,
							'LSlugId'		=> 'slug',
							'Archive'		=> 1,
							'Device'		=> NULL
						));
						$temp['dbId'] = $this->db->insert_id();
						
						$this->ftpUpload($this->upload->data('file_name'));
						$this->ftpthumbUpload($temp['image']);
					}
					$messages[] = $temp;
				}
				$data = $messages;
				$this->response(array('data'=>$data),200);
			}
		} else {
			$this->response(array('status'=>FALSE,'msg'=>$is_valid_token['message']),404);
		}
	}
	
	function rahul(){
		echo "rahul"; die;
	}
	
	function ftpUpload($file){
        $ch = curl_init();
        $localfile = realpath('./uploads/'.$file);
        $fp = fopen($localfile, 'r');
        curl_setopt($ch, CURLOPT_URL, 'ftp://192.168.25.13/'.$this->session->userdata('folderName').'/'.$file);
        curl_setopt($ch, CURLOPT_USERPWD, "newsflow:newsflow");
        curl_setopt($ch, CURLOPT_UPLOAD, 1);
        curl_setopt($ch, CURLOPT_INFILE, $fp);
        curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));
        curl_exec ($ch);
        $error_no = curl_errno($ch);
        //echo $error_no;
        curl_close ($ch);
        if ($error_no == 0) {
			unlink('./uploads/'.$file);
			//return true;
        } else {
			//return false;
        } 
    }
}