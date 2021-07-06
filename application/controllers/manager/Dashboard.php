<?php
class Dashboard extends CI_Controller
{
  function __construct()
    {
        parent::__construct(); 
         if(!$this->session->userdata('manager'))
		 redirect('admin');

		 $this->load->model('manager/dashboard_model');
		 $this->load->model('manager/project_model');
		 $this->load->model('manager/task_model');
		 $this->load->model('manager/incidents_model');

		 
	}
	function index()
	{
	  $user_id =  $this->session->userdata('manager');
	  $project_manager = $this->project_model->getmanager($user_id);
	  $project_manager_projects = $this->task_model->getProjectDetails($project_manager);
	//    print_r($project_manager);
    //      die;

	  $data['ProjectsNumber']= $this->dashboard_model->getProjectsNumber($project_manager);
	//   print_r($data);
    //       die;
      $data['StaffsNumber'] = $this->dashboard_model->getStaffsNumber($project_manager);
      $data['IncidentsNumber'] = $this->dashboard_model->getIncidentsNumber($project_manager_projects);
	  $data['TasksNumber'] = $this->dashboard_model->getTasksNumber($project_manager_projects);
	  

	  $data['inProgressIncidents']= $this->incidents_model->getInProgressIncidentsNumber($project_manager_projects);
      $data['completedIncidents'] = $this->incidents_model->getcompletedIncidentsNumber($project_manager_projects);
      $data['openIncidents'] = $this->incidents_model->getOpenIncidentsNumber($project_manager_projects);
      $data['onHoldIncidentsNumber'] = $this->incidents_model->getOnHoldIncidentsNumber($project_manager_projects);
	  
       $this->load->view('manager/dashboard' ,$data);
    }

	function logout()
	{  
		//echo "sdf";die;
		 $this->session->sess_destroy();
		 redirect('admin');
	}
	


}
		 