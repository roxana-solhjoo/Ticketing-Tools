<?php
class Dashboard_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct(); 
    }	
   
    function getStaffsNumber($project_manager)
  {
    $delete_flag=1;
    $StaffsNumber = $this->db->get_where('user_login',array('delete_flag!='=>$delete_flag,'manager'=>$project_manager));
    return $StaffsNumber->num_rows();

  }
  function getProjectsNumber($project_manager)
  {
    $delete_flag=1;
    $ProjectsNumber = $this->db->get_where('projects',array('delete_flag!='=>$delete_flag,'project_manager'=>$project_manager));
    return $ProjectsNumber->num_rows();
  }
  function getIncidentsNumber($project_manager_projects)
  {
  // $delete_flag=1;
  // $IncidentsNumber=  $this->db->get_where('incidents',array('delete_flag!='=>$delete_flag,'project_name'=>$project_manager_projects));
  // return $IncidentsNumber->num_rows();
   $projects = array();
     foreach($project_manager_projects as $project) {
        $projects[] = $project->project_name;
    }
    if (empty($projects)) {
        return array();
    } 
     $IncidentsNumber =  $this->db->select('*,tasks.id as id, tasks.status as status')
        ->join('user_login', 'tasks.assign_to = user_login.id')
        ->where('tasks.delete_flag','0')
        ->where_in('tasks.project_name' ,$projects)
        ->get('tasks');
         return $IncidentsNumber->num_rows();

  }
  function getTasksNumber($project_manager_projects)
  {
  // $delete_flag=1;
  // $TasksNumber = $this->db->get_where('tasks',array('delete_flag!='=>$delete_flag,'project_name'=>$project_manager_projects));
  // $this->db->query("SELECT * FROM tasks WHERE delete_flag =$delete_flag");
  // return $TasksNumber->num_rows();
   $projects = array();
     foreach($project_manager_projects as $project) {
        $projects[] = $project->project_name;
    }
    if (empty($projects)) {
        return array();
    } 
     $TasksNumber =  $this->db->select('*,tasks.id as id, tasks.status as status')
        ->join('user_login', 'tasks.assign_to = user_login.id')
        ->where('tasks.delete_flag','0')
        ->where_in('tasks.project_name' ,$projects)
        ->get('tasks');
         return $TasksNumber->num_rows();

  }
}