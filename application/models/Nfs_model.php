<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nfs_model extends CI_Model {
	
	function archives($uid){ 
		$this->db->select('*');
		return $result = $this->db->get_where('FeedTrans',array('UID'=>$uid,'status'=>NULL))->result_array();
	}
	
	function storyidea($data){
		// $this->db->insert('StoryIdea',array(
			// 'Name' => $data['name'],
			// 'Location'	=> $data['location'],
			// 'CityCode'	=>	$data['citycode'],
			// 'StateCode'	=> $data['statecode'],
			// 'StoryId'	=> $data['storyid'],
			// 'UID'		=> $data['uid'],
			// 'Description' => $data['description'],	
			// 'Date'		=> $data['date'],
			// 'Approval_Status'	=> $data['approval_status'],
			// 'Approval_Remarks'	=> $data['approval_remarks'],
			// 'Approval_date' 	=> $data['approval_date'],
			// 'Approved_By'		=> $data['approved_by'],
			// 'StoryIdeaID'		=> $data['storyIdeaID'],
			// 'Time'				=> $data['time']
		// ));
		
		
		$this->db->query("INSERT INTO StoryIdea (Name,Location,CityCode,StateCode,StoryId,UID,Description,Date,Approval_Status,Approval_Remarks,Approval_date,Approved_By,StoryIdeaID,Time) VALUES ('".$data['name']."', '".$data['location']."', '".$data['citycode']."', '".$data['statecode']."', '".$data['storyid']."', '".$data['uid']."', N'".$data['description']."', '".$data['date']."', NULL, NULL, NULL, NULL, '".$data['storyIdeaID']."', '".$data['time']."')");
		
		return $this->db->insert_id();
	}
}