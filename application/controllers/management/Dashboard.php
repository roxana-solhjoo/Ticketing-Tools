<?php
class Dashboard extends CI_Controller 
{
  function __construct()
    {
        parent::__construct();
         if(!$this->session->userdata('management'))
		 redirect('admin');

		 $this->load->model('management/dashboards_model');
		$this->load->model('management/incidents_model');		 
	}
	function index()
	{
	  $data['ProjectsNumber']= $this->dashboards_model->getProjectsNumber();
      $data['StaffsNumber'] = $this->dashboards_model->getStaffsNumber();
      $data['IncidentsNumber'] = $this->dashboards_model->getIncidentsNumber();
	  $data['TasksNumber'] = $this->dashboards_model->getTasksNumber();

	  $data['inProgressIncidents']= $this->incidents_model->getInProgressIncidentsNumber();
      $data['completedIncidents'] = $this->incidents_model->getcompletedIncidentsNumber();
      $data['openIncidents'] = $this->incidents_model->getOpenIncidentsNumber();
      $data['onHoldIncidentsNumber'] = $this->incidents_model->getOnHoldIncidentsNumber();
	  
       $this->load->view('management/dashboard' ,$data);
    }

	function logout()
	{  
		//echo "sdf";die;
		 $this->session->sess_destroy();
		 redirect('admin');
	}
	


}
		 