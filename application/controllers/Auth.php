<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
		
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session','email'));
		$this->load->model(array('Auth_model'));
	}
	
	function session_detail(){
		print_r($this->session->all_userdata());
	}
	
	function index(){
		if($this->is_login()){
		    $role = $this->session->userdata('role');
		    if( $role == 'STRINGER' || $role == 'REPORTER'){
			     redirect('Entryform/storyfile');
		    } 
		    else if($role == 'WEBTEAM'){
		        redirect('Report/scriptFile');
		    }
		    else if($role == 'ASSIGNMENT'){
		        redirect('Assignment/Daily-Feed-Status/CG/green/MP/green');
		    }
		    else if($role == 'VSAT'){
		        redirect('Vsat/daily-status');
		    }
		} else {
			redirect('Auth/login');
		}
	}
	
	function is_login(){
		if($this->session->userdata('uid')){
			return true;
		} else {
			return false;
		}
	}
	
	function logout(){
		$this->session->sess_destroy();
		redirect('Auth','refresh');
	}
	
	
	function login(){
		if($this->is_login()){
			redirect('Entryform/storyfile');
			exit;
		}
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$this->form_validation->set_rules('identity', 'Identity', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required',
					array('required' => 'You must provide a %s.')
			);
			$this->form_validation->set_error_delimiters('<span class="error text-danger">', '</span>');
			
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('msg', '<p class="text-center">Invalid Credentials.</p>');
			} else {
				$data['password'] = $this->input->post('password');
				$data['identity'] = $this->input->post('identity');
				$result = $this->Auth_model->login($data);
				if($result){
					$userdata = array(
							'uid'		=> $result[0]['UID'],
							'username'  => $result[0]['NAME'],
							'email'     => $result[0]['EmailId'],
							'stateCode'	=> $result[0]['STATECODE'],
							'cityCode' 	=> $result[0]['CITYCODE'],
							'folderName' => $result[0]['Folder_Name'],
							'place'		=> $result[0]['PLACE'],
							'role'		=>  $result[0]['Permission'],
							'Active' 	=> $result[0]['Active'],
							'profile_pic'	=> $result[0]['Photo']
					);
					$this->session->set_userdata($userdata);
					
					redirect('Auth','refresh');
				} else{
					$this->session->set_flashdata('msg', '<p class="text-center text-danger"><b>Invalid Credentials.</b></p>');
				}
			}
		} 
		$data['header'] = $this->load->view('common/header','',true);
		//$data['footer'] = $this->load->view('common/footer','',true);
		$data['body'] = $this->load->view('pages/login',$data,true);
		$this->load->view('common/login_layout',$data);
	}
	
	
	function notauthorized(){
	    $data['header'] = $this->load->view('common/header','',true);
	    $data['topnavbar'] = $this->load->view('common/topnavbar','',true);
	    $data['sidenavbar'] = $this->load->view('common/sidenavbar','',true);
	    $data['footer'] = $this->load->view('common/footer','',true);
	    $data['body'] = $this->load->view('not_authorized',$data,true);
	    $this->load->view('common/layout',$data);
	}
	
	function profile(){
		$data['profile'] = $this->Auth_model->profile($this->session->userdata('uid'));
		$data['header'] = $this->load->view('common/header','',true);
		$data['topnavbar'] = $this->load->view('common/topnavbar','',true);
		$data['sidenavbar'] = $this->load->view('common/sidenavbar','',true);
		$data['footer'] = $this->load->view('common/footer','',true);
		$data['body'] = $this->load->view('pages/profile',$data,true);
		$this->load->view('common/layout',$data);
	}
	
	function checkCurrentPassword(){
		$data['identity'] = $this->session->userdata('uid');
		$data['password'] = $this->input->post('password');
		if($this->Auth_model->checkCurrentPassword($data)){
			echo json_encode(array('msg'=>'password matched.','status'=>200));
		} else {
			echo json_encode(array('msg'=>'password not matched.','status'=>500));
		}
	}
	
	function changePassword(){
		$data['uid'] = $this->session->userdata('uid');
		$data['password'] = $this->input->post('password');
		if($this->Auth_model->changePassword($data)){
			echo json_encode(array('msg'=>'password changed.','status'=>200));
		} else {
			echo json_encode(array('msg'=>'password not changed.','status'=>500));
		}
	}
	
	function forgotPassword(){
		$identity = $this->input->post('identity');
		$detail = $this->Auth_model->validIdentity($identity);
		
		if($detail){
			
			$config = Array(
            'protocol' => 'smtp',
			'smtp_host' => 'mail.ibc24.in',
            'smtp_port' => 465,
			'smtp_user' => 'rahul1.sinha@ibc24.in',
            'smtp_pass' => 'rahul1',
	     // 'smtp_user' => 'No_reply@ibc24.in',
         // 'smtp_pass' => 'ibc@24',
			
            'mailtype'  => 'html',
			'wordwrap' 	=> TRUE,
            'charset'   => 'utf-8'
        );
			
			$this->email->set_mailtype("html");
			$this->load->library('email', $config);
			$this->email->from('Newsflow@ibc24.in');
			$this->email->to($detail[0]['EmailId']);
			//$this->email->to('ajay.tiwari@ibc24.in');
			//$this->email->cc('kishore.karmakar@ibc24.in');
			$this->email->subject('Newsflow Password');
			$this->email->message('Your NewsFlow password is: <b style="color:red;">'.$detail[0]['Pwd'].'</b><br><br><br><br><span style="font-size:13px;">For more information:   <a target="_blank" href="https://newsflow.ibc24.in"> Click here</a></span>');
			if (!$this->email->send()){
				$error =  $this->email->print_debugger();
				echo json_encode(array('msg'=>$error,'status'=>500));
			} else {
				//print_r('mail send');
				echo json_encode(array('msg'=>'Mail sent.','status'=>200));
			}
		
		} else {
			echo json_encode(array('msg'=>'Invalid User. Please try again.','status'=>401));
		}	
	}
	
	function profileUpload(){
	    $this->load->library('upload');
	    $configVideo['upload_path'] = './assets/'.$this->session->userdata('role').'/';
	    $configVideo['allowed_types'] = 'jpeg|jpg|png|PNG';
	    $configVideo['overwrite'] = TRUE;
	    $configVideo['remove_spaces'] = TRUE;
	    
	    $messages = array();
	    //foreach($_FILES['file'] as $key=>$file){
	        $_FILES['userfile']['name']= $_FILES['file']['name'];
	        $_FILES['userfile']['type']= $_FILES['file']['type'];
	        $_FILES['userfile']['tmp_name']= $_FILES['file']['tmp_name'];
	        $_FILES['userfile']['error']= $_FILES['file']['error']['error'];
	        $_FILES['userfile']['size']= $_FILES['file']['size']['size'];
	        
	        $fileName = str_replace(str_split(' \\/:*?"<>()|'),"_",$_FILES['file']['name']);
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
				
				$fname = $_FILES['userfile']['name'];
				$ext = end((explode(".", $fname)));
				
				
				$file = $filePath.'.'.$ext;
				$image = imagecreatefromstring(file_get_contents($file));
				ob_start();
				imagejpeg($image,NULL,70);
				$cont = ob_get_contents();
				ob_end_clean();
				imagedestroy($image);
				$content = imagecreatefromstring($cont);
				$output = './assets/'.$this->session->userdata('role').'/'.$fileName.'.webp';
				imagewebp($content,$output);
				imagedestroy($content);
				unlink($filePath.'.'.$ext);
				
				$this->db->where('UID',$this->session->userdata('uid'));
				$this->db->update('Login',array('Photo'=>$fileName.'.webp'));
				
				$this->session->set_userdata('profile_pic', $fileName.'.webp');
	      }
	    echo json_encode(array('data'=>'','status'=>200));
	}
}