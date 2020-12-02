<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Auth';

/////Assignment///////////
$route['Assignment/Daily-Feed-Status/CG/(:any)/MP/(:any)']  = 'Assignment_ctrl/index/$1/$2';
$route['Assignment/feed-detail/(:any)']                     = 'Assignment_ctrl/Assign_feed_detail/$1';
$route['Assignment/Story-File-Entry']                       = 'Assignment_ctrl/story_file_entry';
$route['Assignment/story-idea/today-activity']              = "Assignment_ctrl/todayActivity";
$route['Assignment/story-idea/yesterday-dashboard']         = "Assignment_ctrl/yesterdayDashboard";
$route['Assignment/story-idea/all-report']                  = "Assignment_ctrl/allReport";
$route['Assignment/story-idea/all-report/(:any)/(:any)']    = "Assignment_ctrl/allReport/$1/$2";
$route['Assignment/story-idea/report/all-report-list']      = "Assignment_ctrl/all_report_list/";  //ajax call


$route['Assignment/report/today-activity']                  = "Assignment_ctrl/report_today_activity";
$route['Assignment/report/all-report']                      = "Assignment_ctrl/all_report";
$route['Assignment/report/all-report/scriptFileReport/(:any)']         = "Assignment_ctrl/report_allreport_script_file_report/$1";
$route['Assignment_ctrl/report/reporter_report/bifurcation'] = "Assignment_ctrl/bifurcation"; //ajax call
$route['Assignment/report/all-report/(:any)/(:any)']        = "Assignment_ctrl/all_report/$1/$2";
$route['Assignment/report/reporter-summary']                = "Assignment_ctrl/reporter_summary";
$route['Assignment/report/reporter/script/(:any)']          = "Assignment_ctrl/reporter_script_detail/$1";
$route['Assignment_ctrl/report/reporter_report']            = "Assignment_ctrl/reporter_report";       //ajax call
$route['Assignment/report/scriptFileReport/(:any)']         = "Assignment_ctrl/report_script_file_report/$1";


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
