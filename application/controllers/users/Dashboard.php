<?php
class Dashboard extends CI_Controller
{
  function __construct()
    {
         parent::__construct();
         if(!$this->session->userdata('front_user'))
		 redirect('admin');

		  $this->load->model('users/dashboard_model');
		  $this->load->model('users/incidents_model'); 

		 
	}
	function index()  
	{
	 $user_id = $this->session->userdata('front_user');
	 	 //$user_id = 51;
	$data['ProjectsNumber']= $this->dashboard_model->getProjectsNumber($user_id);
     // $data['StaffsNumber'] = $this->dashboard_model->getStaffsNumber();
      $data['IncidentsNumber'] = $this->dashboard_model->getIncidentsNumber($user_id);
	 $data['TasksNumber'] = $this->dashboard_model->getTasksNumber($user_id);
	//  $data['numberOfUserProjects']= $this->profile_model->getUserProjectsNumber($user_id);
	// 		 $data['numberOfUserTasks'] = $this->profile_model->getUserTasksNumber($user_id);
	// 		 $data['numberOfUserIncidents'] = $this->profile_model->getUserIncidentsNumber($user_id);


	  $data['inProgressIncidents']= $this->incidents_model->getInProgressIncidentsNumber($user_id);
      $data['completedIncidents'] = $this->incidents_model->getcompletedIncidentsNumber($user_id);
      $data['openIncidents'] = $this->incidents_model->getOpenIncidentsNumber($user_id);
      $data['onHoldIncidents'] = $this->incidents_model->getOnHoldIncidentsNumber($user_id);




	  if(!empty($user_id)){

	  }else{
		  echo "login first";
		  redirect('admin');
	  }
       $this->load->view('users/dashboard' ,$data);
       //$data
    }

	function logout()
	{  
		//echo "sdf";die;
		 $this->session->sess_destroy();
		 redirect('admin');
	}
	


}