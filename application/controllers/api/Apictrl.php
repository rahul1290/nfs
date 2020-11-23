<?php  
require APPPATH . 'libraries/REST_Controller.php';
class Apictrl extends REST_Controller{
   
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','session','Authorization_Token'));
		$this->load->model(array('Auth_model'));
	}
	
	function currentAppVersion_post(){
		$version = $this->post('version');
		if($version == '0.3'){
		    $this->response(array('msg'=>'valid.'), 200);
		} else {
			$data[] = array('msg'=>'New version lauched.','androidAppId'=>'com.ibc24.newsflow','iOSAppId'=>'585027354');
			$this->response($data, 500);
		}
	}
	
	function login_post(){
		$data['identity'] = trim($this->post('identity'));
		$data['password'] = trim($this->post('password'));
		
		$login_result = $this->Auth_model->login($data);
				
		if(count($login_result) > 0){
			$jwt['id'] = $login_result[0]['Sno'];
			$jwt['uid'] = $login_result[0]['UID'];
			$jwt['username'] = $login_result[0]['NAME'];
			$jwt['email'] = $login_result[0]['EmailId'];
			$jwt['stateCode'] = $login_result[0]['STATECODE'];
			$jwt['cityCode'] = $login_result[0]['CITYCODE'];
			$jwt['folderName'] = $login_result[0]['Folder_Name'];
			$jwt['place'] = $login_result[0]['PLACE'];
			$jwt['role'] = $login_result[0]['Permission'];
			$jwt['Active'] = $login_result[0]['Active'];
			$jwt['profile_pic'] = $login_result[0]['Photo'];
			$jwt['time'] = time();
			$login_result[0]['key'] = $this->authorization_token->generateToken($jwt);			
		    $this->response($login_result, 200);
		} else {
		    $this->response( [
		        'status' => 500,
		        'message' => 'No such user found'
		    ], 404 );
		}
	}
}
	