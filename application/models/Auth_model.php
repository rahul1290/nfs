<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth_model extends CI_Model {
	
	function login($data){
		$this->db->select('*');
		$result = $this->db->get_where('Login',array('UID'=>$data['identity'],'Pwd'=>$data['password'],'Active'=>'ACTIVE'))->result_array();
		if(count($result)>0){
			return $result;
		}
	}
	
	function reporter_list(){
	    $this->db->select('UID,CITYCODE,NAME,PLACE,Folder_Name');
	    $this->db->order_by('NAME','ASC');
	    $result = $this->db->get_where('Login',array('Permission'=>'REPORTER','Active'=>'ACTIVE'))->result_array();
	    return $result;
	}
	
	function profile($uid){
		$this->db->select('*');
		$result = $this->db->get_where('Login',array('UID'=>$uid,'Active'=>'ACTIVE'))->result_array();
		if(count($result)>0){
			return $result;
		}
	}
	
	function checkCurrentPassword($data){
		$this->db->select('*');
		$result = $this->db->get_where('Login',array('UID'=>$data['identity'],'Pwd'=>$data['password'],'Active'=>'ACTIVE'))->result_array();
		if(count($result)>0){
			return $result;
		} else {
			return false;
		}
	}
	
	function changePassword($data){
		$this->db->where('uid',$data['uid']);
		$this->db->update('Login',array('Pwd'=>$data['password']));
		return true;
	}
	
	function validIdentity($identity){
		$this->db->select('*');
		$result = $this->db->get_where('Login',array('UID'=>$identity,'Active'=>'ACTIVE'))->result_array();
		if(count($result)>0){
			return $result;
		} else {
			return false;
		}
	}
	
	function userlist(){
		$this->db->select('*');
		$this->db->limit(20);
		$result = $this->db->get_where('Login',array('Active'=>'ACTIVE'))->result_array();
		if(count($result)>0){
			return $result;
		}
	}
}