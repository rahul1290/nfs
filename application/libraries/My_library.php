<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
 
class My_library {
	protected $CI;
	
	function __construct(){
        $this->CI =& get_instance();
		$this->CI->load->helper('url');
		$this->CI->load->library('session');
		$this->CI->load->database();
		$this->CI->load->library('email');
    }
	
	function myfolder(){
		return '/uploads/'.$this->CI->session->userdata('folderName').'/';
	}
}