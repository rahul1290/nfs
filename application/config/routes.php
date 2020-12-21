<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Auth';

$route['search/(:any)'] = 'search_ctrl/search/$1';

/////Assignment///////////
$route['Assignment/Daily-Feed-Status/CG/(:any)/MP/(:any)']  = 'Assignment_ctrl/daily_feed_status/$1/$2';
$route['Assignment/Daily-Feed-Status/(:any)']               = 'Assignment_ctrl/daily_feed_detail/$1';
$route['Assignment/Story-File-Entry']                       = 'Assignment_ctrl/story_file_entry';
$route['Assignment/story-idea/today-activity']              = "Assignment_ctrl/todayActivity";
$route['Assignment/story-idea/yesterday-dashboard']         = "Assignment_ctrl/yesterdayDashboard";
$route['Assignment/story-idea/all-report']                  = "Assignment_ctrl/allReport";
$route['Assignment/story-idea/all-report/(:any)/(:any)']    = "Assignment_ctrl/allReport/$1/$2";
$route['Assignment/story-idea/report/all-report-list']      = "Assignment_ctrl/all_report_list/";  //ajax call
$route['Assignment/report/today-activity']                  = "Assignment_ctrl/today_activity";
$route['Assignment/report/today-activity/(:any)']           = "Assignment_ctrl/today_activity/$1";
$route['Assignment/report/all-report']                      = "Assignment_ctrl/all_report";
$route['Assignment/report/all-report/(:any)']        = "Assignment_ctrl/allreport_detail/$1";

$route['Assignment_ctrl/report/reporter_report/bifurcation'] = "Assignment_ctrl/bifurcation"; //ajax call
$route['Assignment/report/all-report/(:any)/(:any)']        = "Assignment_ctrl/all_report/$1/$2";
$route['Assignment/report/reporter-summary']                = "Assignment_ctrl/reporter_summary";
$route['Assignment/report/reporter-summary/(:any)']         = "Assignment_ctrl/reporter_summary/$1";
$route['Assignment/report/stringer-summary']                = "Assignment_ctrl/stringer_summary";
$route['Assignment/report/stringer-summary/(:any)']         = "Assignment_ctrl/stringer_summary/$1";
$route['Assignment_ctrl/report/reporter_report']            = "Assignment_ctrl/reporter_report";       //ajax call


//$route['Assignment/report/scriptFileReport/(:any)']         = "Assignment_ctrl/report_script_file_report/$1";

$route['Assignment/report/stringer/script/(:any)']         = "Assignment_ctrl/report_script_file_report/$1";


/////////VSAT///////////////////
$route['Vsat/daily-status']                                 = 'Vsat_ctrl/daily_status';
$route['Vsat/report/today-activity']                        = 'Vsat_ctrl/today_activity';
$route['Vsat/report/today-activity/(:any)']                 = "Vsat_ctrl/today_activity_detail/$1";
$route['Vsat/report/location-wise']                         = "Vsat_ctrl/location_wise";
$route['Vsat/report/location-wise/(:any)']                  = "Vsat_ctrl/location_wise/$1";
$route['Vsat/report/all-report']                            = "Vsat_ctrl/all_report";
$route['Vsat/report/all-report/(:any)/(:any)']              = "Vsat_ctrl/all_report/$1/$2";
$route['Vsat/report/all-report-list']                       = "Vsat_ctrl/all_report_list/";  //ajax call
$route['vsat/report/all-report/(:any)']                     = "Vsat_ctrl/all_report_list/$1";

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
