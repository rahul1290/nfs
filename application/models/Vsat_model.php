<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vsat_model extends CI_Model {
    
    function report_today_activity(){
        $result = $this->db->query("select *,convert(varchar(5),Copy_date,108)  as Copy_Date1,convert(varchar(5),BP_date,108)  as BP_Date1,convert(varchar(5),VSat_date,108)  as Vsat_Date1,convert(varchar(5),VTEditor_date,108)  as VTEditor_Date1,convert(varchar(5),assign_date,108)  as Assign_Date1,convert(varchar(5),Input_date,108)  as Input_Date1,convert(varchar(5),Editor_date,108)  as Editor_Date1 ,convert(varchar(5),Output_date,108)  as Output_Date1   ,substring(LogSheet,1,50) as LogSheet1,substring(DESCRIPTION,1,50) as DESCRIPTION1  from FeedInfo where   Date = '".date('Y-m-d')."' order by Sno desc")->result_array();
        return $result;
    }
    
    function today_activity_detail($sno){
        $result = $this->db->query("
		select fi.*,REPLACE(REPLACE(REPLACE(fi.Description, CHAR(13),' '), CHAR(10),' '),'&amp;','&') as Description1,REPLACE(REPLACE(REPLACE(fi.VO, CHAR(13),' '), CHAR(10),' '),'&amp;','&') as VO1,REPLACE(REPLACE(REPLACE(fi.Byte, CHAR(13),' '), CHAR(10),' '),'&amp;','&') as Byte1,len(fi.description) as LDescription,len(fi.VO) as LVO ,len(fi.Byte) as LByte,
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
    
    function all_location($state){
        $this->db->select('place');
        $this->db->group_by('PLACE');
        $result = $this->db->get_where('Login',array('STATECODE'=>$state,'Permission'=>'STRINGER','Active'=>'ACTIVE'))->result_array();
        return $result;
    }
    
    function assign_feed_detail($sno){
        $result = $this->db->query("
		select fi.*,REPLACE(REPLACE(REPLACE(fi.Description, CHAR(13),' '), CHAR(10),' '),'&amp;','&') as Description1,REPLACE(REPLACE(REPLACE(fi.VO, CHAR(13),' '), CHAR(10),' '),'&amp;','&') as VO1,REPLACE(REPLACE(REPLACE(fi.Byte, CHAR(13),' '), CHAR(10),' '),'&amp;','&') as Byte1,len(fi.description) as LDescription,len(fi.VO) as LVO ,len(fi.Byte) as LByte,
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
    
    function all_report($date1,$date2){
        $result = $this->db->query("select convert(varchar(20),Date,103) as Date,COUNT(*) as Total from FeedInfo where DATE between '".$date1."' and '".$date2."' group by date order by Date")->result_array();
        return $result;
    }
    
    function all_report_list($date){
        $result = $this->db->query("select *,convert(varchar(5),Copy_date,108)  as Copy_Date1,convert(varchar(5),BP_date,108)  as BP_Date1,convert(varchar(5),Copy_date,108)  as Copy_Date1,convert(varchar(5),VSat_date,108)  as Vsat_Date1,convert(varchar(5),VTEditor_date,108)  as VTEditor_Date1,convert(varchar(5),assign_date,108)  as Assign_Date1,convert(varchar(5),Input_date,108)  as Input_Date1,convert(varchar(5),Editor_date,108)  as Editor_Date1 ,convert(varchar(5),Output_date,108)  as Output_Date1   ,substring(LogSheet,1,50) as LogSheet1,substring(DESCRIPTION,1,50) as DESCRIPTION1  from FeedInfo where Date='".$date."' ORDER BY SNO DESC")->result_array();
        return $result;
    }
    
}
