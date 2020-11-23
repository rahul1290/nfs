<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assignment_model extends CI_Model {
    
    
    function allReport($date1,$date2){
        $result = $this->db->query("SELECT convert(varchar(20),Date,103) as Date, sum(case when Approval_status = 'Approve' then 1 else 0 end) as Approved, sum(case when Approval_status = 'Decline' then 1 else 0 end) as Rejected, sum(case when Approval_status IS null then 1  else 0 end) as NotSeen,COUNT(*) as Total from storyidea where date between '".$date1."' and '".$date2."' group by date order by Date")->result_array();
        return $result;
    }
    
    function yesterdayDashboard(){
        $result = $this->db->query("SELECT convert(varchar(50),Date,103) as Date, sum(case when Approval_status = 'Approve' then 1 else 0 end) as Approved, sum(case when Approval_status = 'Decline' then 1 else 0 end) as Rejected, sum(case when Approval_status IS null then 1  else 0 end) as NotSeen,COUNT(*) as Total from storyidea where date = '".date('Y-m-d',strtotime("-1 days"))."' group by date order by Date")->result_array();
        return $result;
    }
    
    function assign_today_activity(){
        $result['cg_red_zone'] = $this->db->query("Select * from Login where PERMISSION ='Stringer' and Active ='ACTIVE' and UID not in (select distinct UID from StoryIdea  where DATE='".date('Y-m-d')."') and stateCode = 'CG' order by StateCode,CityCode")->result_array();
        $result['mp_red_zone'] = $this->db->query("Select * from Login where PERMISSION ='Stringer' and Active ='ACTIVE' and UID not in (select distinct UID from StoryIdea  where DATE='".date('Y-m-d')."') and stateCode = 'MP'  order by StateCode,CityCode")->result_array();
        
        $result['cg_green_zone'] = $this->db->query("select Sno,StoryIdeaID,Name,Location,CityCode,StateCode,StoryID,UID,convert(varchar(50),Date,103) as Date1,Approval_Status,Approval_Remarks,Approval_date,Approved_By,substring(Description,0,100) as Description from storyIdea where date = '".date('Y-m-d')."' and approval_Status is NULL and stateCode ='CG' order by Sno desc")->result_array();
        $result['mp_green_zone'] = $this->db->query("select Sno,StoryIdeaID,Name,Location,CityCode,StateCode,StoryID,UID,convert(varchar(50),Date,103) as Date1,Approval_Status,Approval_Remarks,Approval_date,Approved_By,substring(Description,0,100) as Description from storyIdea where date = '".date('Y-m-d')."' and approval_Status is NULL and stateCode ='MP' order by Sno desc")->result_array();
        return $result;
    }
    
    function assign_daily_feed(){
        $result['cg_feed'] = $this->db->query("Select Sno ,Name ,Location ,CityCode ,StateCode ,Category ,SlugID ,UID ,Folder_Name ,Type ,substring(LogSheet,0,100) as LogSheet,substring(Description,0,100) as Description   ,Date ,convert(char(5), Time, 108) as Time ,Final_SlugID ,Assign_Status ,Assign_Remarks ,Input_Status ,Input_Remarks ,Editor_Status ,Editor_Remarks ,Expected_OnAir ,Output_Status ,Output_Remarks from FeedInfo where Date = '".date('Y-m-d')."' and assign_status='NA.jpg' and Input_status='NA.jpg' and  Editor_status ='NA.jpg' and Output_Status ='NA.jpg' and StateCode = 'CG' order by Sno desc ")->result_array();
        $result['mp_feed'] = $this->db->query("Select Sno ,Name ,Location ,CityCode ,StateCode ,Category ,SlugID ,UID ,Folder_Name ,Type ,substring(LogSheet,0,100) as LogSheet,substring(Description,0,100) as Description   ,Date ,convert(char(5), Time, 108) as Time ,Final_SlugID ,Assign_Status ,Assign_Remarks ,Input_Status ,Input_Remarks ,Editor_Status ,Editor_Remarks ,Expected_OnAir ,Output_Status ,Output_Remarks from FeedInfo where Date = '".date('Y-m-d')."' and assign_status='NA.jpg' and Input_status='NA.jpg' and  Editor_status ='NA.jpg' and Output_Status ='NA.jpg' and StateCode = 'MP' order by Sno desc ")->result_array();
        $result['cg_feed_red_zone'] = $this->db->query("Select * from Login where PERMISSION ='Stringer' and Active ='ACTIVE' and UID not in (select distinct UID from FeedInfo  where DATE='".date('Y-m-d')."') and stateCode = 'CG' order by Sno desc")->result_array();
        $result['mp_feed_red_zone'] = $this->db->query("Select * from Login where PERMISSION ='Stringer' and Active ='ACTIVE' and UID not in (select distinct UID from FeedInfo  where DATE='".date('Y-m-d')."') and stateCode = 'MP' order by Sno desc")->result_array();
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
    
    function assign_report_today_activity(){
        $result = $this->db->query("select *,convert(varchar(5),Copy_date,108)  as Copy_Date1,convert(varchar(5),BP_date,108)  as BP_Date1,convert(varchar(5),VSat_date,108)  as Vsat_Date1,convert(varchar(5),VTEditor_date,108)  as VTEditor_Date1,convert(varchar(5),assign_date,108)  as Assign_Date1,convert(varchar(5),Input_date,108)  as Input_Date1,convert(varchar(5),Editor_date,108)  as Editor_Date1 ,convert(varchar(5),Output_date,108)  as Output_Date1   ,substring(LogSheet,1,50) as LogSheet1,substring(DESCRIPTION,1,50) as DESCRIPTION1  from FeedInfo where   Date = '".date('Y-m-d')."' order by Sno desc")->result_array();
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
