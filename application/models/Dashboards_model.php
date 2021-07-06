<?php
class Dashboards_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }	
   
    function getStaffsNumber()
  {
    $delete_flag=0;
    $StaffsNumber = $this->db->query("SELECT * FROM user_login WHERE delete_flag =$delete_flag and role != 'Admin'");
    return $StaffsNumber->num_rows();

  }
  function getProjectsNumber()
  {
   $delete_flag=0;
    $ProjectsNumber = $this->db->query("SELECT * FROM projects WHERE delete_flag =$delete_flag");
    return $ProjectsNumber->num_rows();
  }
  function getIncidentsNumber()
  {
  $delete_flag=0;
  $IncidentsNumber= $this->db->query("SELECT * FROM incidents WHERE delete_flag =$delete_flag");
  return $IncidentsNumber->num_rows();

  }
  function getTasksNumber()
  {
  $delete_flag=0;
  $TasksNumber = $this->db->query("SELECT * FROM tasks WHERE delete_flag =$delete_flag");
  return $TasksNumber->num_rows();

  }
}