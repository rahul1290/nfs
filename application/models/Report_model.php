<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {
	
	function storyIdeaReport($uid){
		$this->db->select('*');
		$this->db->order_by('Sno','desc');
		return $result = $this->db->get_where('StoryIdea',array('UID'=>$uid))->result_array();
	}
	
	function reportetTodayfilereport($uid = null){
		$this->db->select('convert(char(5), Assign_Date, 108) [ASSIGNMENT_TIME],
		convert(char(5), VSat_Date, 108) [VSAT_TIME],
		convert(char(5), Editor_Date, 108) [EDITOR_TIME],
		convert(char(5), Output_Date, 108) [OUTPUT_TIME],
		convert(char(5), Copy_Date, 108) [COPY_TIME],
		convert(char(5), Input_Date, 108) [INPUT_TIME],*');
		$this->db->where('date >=',date('Y-m-d'));
		$this->db->where('date <=',date('Y-m-d'));
		$this->db->order_by('Sno','desc');
		if($uid == null){
		  $result = $this->db->get('FeedInfo')->result_array();
		} else {
		  $result = $this->db->get_where('FeedInfo',array('UID'=>$uid))->result_array();
		}
		return $result;
	}
	
	function reportetfilereport($data,$role=null){
		$this->db->select('convert(char(5), Assign_Date, 108) [ASSIGNMENT_TIME],
		convert(char(5), VSat_Date, 108) [VSAT_TIME],
		convert(char(5), Editor_Date, 108) [EDITOR_TIME],
		convert(char(5), Output_Date, 108) [OUTPUT_TIME],
		convert(char(5), Copy_Date, 108) [COPY_TIME],
		convert(char(5), Input_Date, 108) [INPUT_TIME],*');
		$this->db->where('date >=',$data['from_date']);
		$this->db->where('date <=',$data['to_date']);
		$this->db->order_by('Sno','desc');
		if($role != null){
		    $result = $this->db->get('FeedInfo')->result_array();
		} else {
		  $result = $this->db->get_where('FeedInfo',array('UID'=>$data['uid']))->result_array();
		}
		return $result;
	}
	
	function reportetfilereportView($sno){
		$result = $this->db->query("
		select fi.*,
		convert(char(5), fi.Assign_Date, 108) [ASSIGNMENT_TIME],
		convert(char(5), fi.Input_Date, 108) [INPUT_TIME],
		convert(char(5), fi.Editor_Date, 108) [EDITOR_TIME],
		convert(char(5), fi.VSat_Date, 108) [VSAT_TIME],
		convert(char(5), fi.Output_Date, 108) [OUTPUT_TIME],
		STUFF((
		select ',' + ft.Thumb_Name
		from FeedTrans ft
		where ft.SlugID = fi.SlugID
		FOR XML PATH(''), TYPE).value('.', 'NVARCHAR(MAX)'), 1, 1, '') as thubm,
		STUFF((
		select ',' + ft.file_Name
		from FeedTrans ft
		where ft.SlugID = fi.SlugID
		FOR XML PATH(''), TYPE).value('.', 'NVARCHAR(MAX)'), 1, 1, '') as files
		from FeedInfo fi where fi.SlugID = (select SlugID from FeedInfo where Sno = '".$sno."')
		")->result_array();
		return $result;
	}
	
	
	function storyIdeaView($sno){
		$this->db->select('*');
		$result = $this->db->get_where('StoryIdea',array('Sno'=>$sno))->result_array();
		return $result;
	}
	
	
}