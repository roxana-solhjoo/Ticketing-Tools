<?php
class Dashboard extends CI_Controller
{
  function __construct()
    {
        parent::__construct();
         if(!$this->session->userdata('admin'))
		 redirect('admin');

		 $this->load->model(array('dashboards_model','incidents_model'));
		 
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
	  
       $this->load->view('admin/dashboard' ,$data);
    }

	function logout()
	{  
		//echo "sdf";die;
		 $this->session->sess_destroy();
		 redirect('admin');
	}
	


}
		 