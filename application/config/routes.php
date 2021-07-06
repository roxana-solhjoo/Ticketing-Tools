<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['admin'] = 'admin/login';
$route['forgotPassword'] = 'welcome/forgotPassword';
$route['forgotPasswordPost'] = 'welcome/forgotPasswordPost';
$route['resetPassword/(:any)'] = 'welcome/resetPassword/$1';
$route['resetPasswordPost'] = 'welcome/resetPasswordPost';
$route['dashboard'] = 'admin/dashboard';

$route['logout/(:any)'] = 'admin/dashboard/logout/s1';



$route['staff'] = 'admin/staff/index';
$route['staff_add'] = 'admin/staff/add';
$route['staff_edit/(:any)'] = 'admin/staff/edit/$1';
$route['staff_delete/(:any)'] = 'admin/staff/delete/$1';
$route['staff_update/(:any)'] = 'admin/staff/update/$1';


$route['company'] = 'admin/company/index';
$route['company_add'] = 'admin/company/add';
$route['company_edit/(:any)'] = 'admin/company/edit/$1';
$route['company_delete/(:any)'] = 'admin/company/delete/$1';

$route['role_add'] = 'admin/settings/addRole';
$route['setting'] = 'admin/settings/index';

$route['project'] = 'admin/project/index';
$route['project_add'] = 'admin/project/add';
$route['project_edit/(:any)'] = 'admin/project/edit/$1';
$route['project_delete/(:any)'] = 'admin/project/delete/$1';

$route['getManager'] = 'admin/project/getManager';
$route['getMangerList'] = 'admin/project/getMangerList';

$route['tasks'] = 'admin/tasks/index';
$route['tasks_add'] = 'admin/tasks/add';
$route['tasks_edit/(:any)'] = 'admin/tasks/edit/$1';
$route['tasks_delete/(:any)'] = 'admin/tasks/delete/$1';
$route['taskUpdate/(:any)'] = 'admin/tasks/update/$1';
$route['taskView/(:any)'] = 'admin/tasks/taskView/$1';
$route['tasks_onHold'] = 'admin/tasks/onHoldTasks';
$route['OnHoldTasks'] = 'admin/tasks/OnHoldTasks';
$route['CompletedTasks'] = 'admin/tasks/CompletedTasks';
$route['OpenTasks'] = 'admin/tasks/OpenTasks';
$route['TotalTasks'] = 'admin/tasks/TotalTasks';
$route['InProgressTasks'] = 'admin/tasks/InProgressTasks';
$route['get_pdf_task/(:any)'] ='admin/tasks/get_pdf_test/$1';



$route['incidents'] = 'admin/incidents/index';
$route['incidents/(:any)'] = 'admin/incidents/index/$1';
$route['incidents_add'] = 'admin/incidents/add';
$route['incidents_edit/(:any)'] = 'admin/incidents/edit/$1';
$route['incidents_delete/(:any)'] = 'admin/incidents/delete/$1';
$route['incidentUpdate/(:any)'] = 'admin/incidents/update/$1';
$route['incidentsView/(:any)'] = 'admin/incidents/incidentsView/$1';
$route['OnHoldIncidents'] = 'admin/incidents/OnHoldIncidents';
$route['InProgressIncidents'] = 'admin/incidents/InProgressIncidents';
$route['OpenIncidents'] = 'admin/incidents/OpenIncidents';
$route['CompletedIncidents'] = 'admin/incidents/CompletedIncidents';
$route['TotalIncidents'] = 'admin/incidents/TotalIncidents';

$route['get_pdf_test/(:any)'] = 'admin/incidents/get_pdf_test/$1';

$route['downloadfile/(:any)'] = 'admin/incidents/downloadFile/$1';
$route['generatepdf/(:any)'] = "admin/incidents/convertpdf/$1";
// $route['_do_upload'] = "admin/incidents/do_upload";     


        


$route['getAllProject'] = 'admin/tasks/getAllProject';
//$route['getAllStaff'] = 'admin/tasks/getAllStaff';
$route['getstaffsList'] = 'admin/incidents/getstaffsList';
$route['getAllStaffsList'] = 'admin/project/getAllStaffsList';
$route['getStaff'] = 'admin/incidents/getAllStaff';
$route['getProject'] = 'admin/incidents/getAllProject';
$route['getProjectList'] = 'admin/incidents/getProjectList';

$route['myProfile'] = 'admin/profile/index';
$route['profile_edit/(:any)'] = 'admin/profile/edit/$s1';
$route['edit_password'] = 'admin/profile/edit_password';
//$route['login_validation(:any)']= 'admin/login/validation//$s1';
$route['do_upload'] = 'admin/profile/do_upload';
$route['profile_update'] = 'admin/profile/update/';

$route['sendemail'] = 'admin/staff/sendemail';


//userSide
$route['dashboardd'] = 'users/dashboard';

$route['front_tasks'] = 'users/tasks/index';
$route['front_tasks_add'] = 'users/tasks/add';
$route['front_tasks_edit/(:any)'] = 'users/tasks/edit/$1';
$route['front_tasks_delete/(:any)']  = 'users/tasks/delete/$1';
$route['front_taskView/(:any)'] = 'users/tasks/taskView/$1';
$route['Front_OnHoldTasks'] = 'users/tasks/OnHoldTasks';
$route['Front_CompletedTasks'] = 'users/tasks/CompletedTasks';
$route['Front_OpenTasks'] = 'users/tasks/OpenTasks';
$route['Front_TotalTasks'] = 'users/tasks/TotalTasks';
$route['Front_InProgressTasks'] = 'users/tasks/InProgressTasks';

$route['user_get_pdf_task/(:any)'] = 'users/tasks/get_pdf_test/$1';


$route['front_incidents'] = 'users/incidents/index';
$route['front_incidents/(:any)'] = 'users/incidents/index/$1';
$route['front_incidents_add'] = 'users/incidents/add';
$route['front_incidents_edit/(:any)'] = 'users/incidents/edit/$1';
$route['front_incidents_delete/(:any)']  = 'users/incidents/delete/$1';
$route['front_incidentsView/(:any)'] = 'users/incidents/incidentsView/$1';
$route['Front_OnHoldIncidents'] = 'users/incidents/OnHoldIncidents';
$route['Front_InProgressIncidents'] = 'users/incidents/InProgressIncidents';
$route['Front_OpenIncidents'] = 'users/incidents/OpenIncidents';
$route['Front_CompletedIncidents'] = 'users/incidents/CompletedIncidents';
$route['Front_TotalIncidents'] = 'users/incidents/TotalIncidents';

$route['user_get_pdf_incident/(:any)'] = 'users/incidents/get_pdf_test/$1';


$route['front_getProject'] = 'users/incidents/getAllProject';
$route['front_getStaff'] = 'users/incidents/getAllStaff';
$route['front_getProjectList'] = 'users/incidents/getProjectList';
$route['front_getstaffsList'] = 'users/incidents/getstaffsList';

$route['front_edit_password'] = 'users/profile/edit_password';

// $route['sendemail'] = 'admin/staff/sendemail';


$route['front_myProfile'] = 'users/profile/index';
$route['front_profile_update'] = 'users/profile/update/';
$route['front_profile_edit'] = 'users/profile/edit/';

//manager   
$route['manager_dashboard'] = 'manager/dashboard';
$route['manager_company'] = 'manager/company/index';

$route['manager_staff'] = 'manager/staff/index';
$route['manager_staff_add'] = 'manager/staff/add';
$route['manager_staff_edit/(:any)'] = 'manager/staff/edit/$1';
$route['manager_staff_delete/(:any)'] = 'manager/staff/delete/$1';
$route['manager_staff_update/(:any)'] = 'manager/staff/update/$1';


$route['manager_project'] = 'manager/project/index';
$route['manager_project_add'] = 'manager/project/add';
$route['manager_project_edit/(:any)'] = 'manager/project/edit/$1';
$route['manager_project_delete/(:any)'] = 'manager/project/delete/$1';
$route['manager_project_update/(:any)'] = 'manager/project/update/$1';

$route['manager_getManager'] = 'manager/project/getManager';
$route['manager_getMangerList'] = 'manager/project/getMangerList';
$route['manager_getAllStaffsList'] = 'manager/project/getAllStaffsList';
$route['manager_getstaffsList'] = 'manager/incidents/getstaffsList';
$route['manager_getStaff'] = 'manager/incidents/getAllStaff';



// $route['getManager'] = 'manager/project/getManager';






$route['manager_incidents'] = 'manager/incidents/index';
$route['manager_incidents/(:any)'] = 'manager/incidents/index/$1';
$route['manager_incidents_add'] = 'manager/incidents/add';
$route['manager_incidents_edit/(:any)'] = 'manager/incidents/edit/$1';
$route['manager_incidents_delete/(:any)'] = 'manager/incidents/delete/$1';
$route['manager_incidentUpdate/(:any)'] = 'manager/incidents/update/$1';
$route['manager_incidentsView/(:any)'] = 'manager/incidents/incidentsView/$1';
$route['manager_OnHoldIncidents'] = 'manager/incidents/OnHoldIncidents';
$route['manager_InProgressIncidents'] = 'manager/incidents/InProgressIncidents';
$route['manager_OpenIncidents'] = 'manager/incidents/OpenIncidents';
$route['manager_CompletedIncidents'] = 'manager/incidents/CompletedIncidents';
$route['manager_TotalIncidents'] = 'manager/incidents/TotalIncidents';

$route['manager_getProject'] = 'manager/incidents/getAllProject';
$route['manager_getStaff'] = 'manager/incidents/getAllStaff';
$route['manager_getProjectList'] = 'manager/incidents/getProjectList';

$route['manager_get_pdf_incident/(:any)'] ='manager/incidents/get_pdf_test/$1';




$route['manager_tasks'] = 'manager/tasks/index';
$route['manager_tasks_add'] = 'manager/tasks/add';
$route['manager_tasks_edit/(:any)'] = 'manager/tasks/edit/$1';
$route['manager_tasks_delete/(:any)'] = 'manager/tasks/delete/$1';
$route['manager_taskUpdate/(:any)'] = 'manager/tasks/update/$1';
$route['manager_taskView/(:any)'] = 'manager/tasks/taskView/$1';
$route['manager_tasks_onHold'] = 'manager/tasks/onHoldTasks';
$route['manager_OnHoldTasks'] = 'manager/tasks/OnHoldTasks';
$route['manager_CompletedTasks'] = 'manager/tasks/CompletedTasks';
$route['manager_OpenTasks'] = 'manager/tasks/OpenTasks';
$route['manager_TotalTasks'] = 'manager/tasks/TotalTasks';
$route['manager_InProgressTasks'] = 'manager/tasks/InProgressTasks';
$route['manager_get_pdf_task/(:any)'] ='manager/tasks/get_pdf_test/$1';


$route['manager_myProfile'] = 'manager/profile/index';
$route['manager_profile_edit/(:any)'] = 'manager/profile/edit/$1';
$route['manager_edit_password'] = 'manager/profile/edit_password';
//$route['manager_login_validation(:any)']= 'manager/login/validation/$1';
$route['manager_do_upload'] = 'manager/profile/do_upload';
$route['manager_profile_update/(:any)'] = 'manager/profile/update/$1';





$route['management_dashboard'] = 'management/dashboard';
$route['management_staff'] = 'management/staff/index';
$route['management_staff_add'] = 'management/staff/add';
$route['management_staff_edit/(:any)'] = 'management/staff/edit/$1';
$route['management_staff_delete/(:any)'] = 'management/staff/delete/$1';
$route['management_staff_update/(:any)'] = 'management/staff/update/$1';


$route['management_company'] = 'management/company/index';
$route['management_company_add'] = 'management/company/add';
$route['management_company_edit/(:any)'] = 'management/company/edit/$1';
$route['management_company_delete/(:any)'] = 'management/company/delete/$1';

$route['management_role_add'] = 'management/settings/addRole';
$route['management_setting'] = 'management/settings/index';

$route['management_project'] = 'management/project/index';
$route['management_project_add'] = 'management/project/add';
$route['management_project_edit/(:any)'] = 'management/project/edit/$1';
$route['management_project_delete/(:any)'] = 'management/project/delete/$1';

$route['management_getManager'] = 'management/project/getManager';
$route['management_getMangerList'] = 'management/project/getMangerList';

$route['management_tasks'] = 'management/tasks/index';
$route['management_tasks_add'] = 'management/tasks/add';
$route['management_tasks_edit/(:any)'] = 'management/tasks/edit/$1';
$route['management_tasks_delete/(:any)'] = 'management/tasks/delete/$1';
$route['management_taskUpdate/(:any)'] = 'management/tasks/update/$1';
$route['management_taskView/(:any)'] = 'management/tasks/taskView/$1';
$route['management_tasks_onHold'] = 'management/tasks/onHoldTasks';
$route['management_OnHoldTasks'] = 'management/tasks/OnHoldTasks';
$route['management_CompletedTasks'] = 'management/tasks/CompletedTasks';
$route['management_OpenTasks'] = 'management/tasks/OpenTasks';
$route['management_TotalTasks'] = 'management/tasks/TotalTasks';
$route['management_InProgressTasks'] = 'management/tasks/InProgressTasks';
$route['management_get_pdf_task/(:any)'] = 'management/tasks/get_pdf_test/$1';



$route['management_incidents'] = 'management/incidents/index';
$route['management_incidents/(:any)'] = 'management/incidents/index/$1';
$route['management_incidents_add'] = 'management/incidents/add';
$route['management_incidents_edit/(:any)'] = 'management/incidents/edit/$1';
$route['management_incidents_delete/(:any)'] = 'management/incidents/delete/$1';
$route['management_incidentUpdate/(:any)'] = 'management/incidents/update/$1';
$route['management_incidentsView/(:any)'] = 'management/incidents/incidentsView/$1';
$route['management_OnHoldIncidents'] = 'management/incidents/OnHoldIncidents';
$route['management_InProgressIncidents'] = 'management/incidents/InProgressIncidents';
$route['management_OpenIncidents'] = 'management/incidents/OpenIncidents';
$route['management_CompletedIncidents'] = 'management/incidents/CompletedIncidents';
$route['management_TotalIncidents'] = 'management/incidents/TotalIncidents';

$route['management_get_pdf_incident/(:any)'] = 'management/incidents/get_pdf_test/$1';



        


$route['management_getAllProject'] = 'management/tasks/getAllProject';
//$route['getAllStaff'] = 'admin/tasks/getAllStaff';
$route['management_getstaffsList'] = 'management/incidents/getstaffsList';
$route['management_getAllStaffsList'] = 'management/project/getAllStaffsList';
$route['management_getStaff'] = 'management/incidents/getAllStaff';
$route['management_getProject'] = 'management/incidents/getAllProject';
$route['management_getProjectList'] = 'management/incidents/getProjectList';

$route['management_myProfile'] = 'management/profile/index';
$route['management_profile_edit/(:any)'] = 'management/profile/edit/$s1';
$route['management_edit_password'] = 'management/profile/edit_password';
//$route['login_validation(:any)']= 'management/login/validation//$s1';
$route['management_do_upload'] = 'management/profile/do_upload';
$route['management_profile_update'] = 'management/profile/update/';

$route['management_sendemail'] = 'management/staff/sendemail';


 


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
