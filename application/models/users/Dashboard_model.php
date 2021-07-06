 <?php
class Dashboard_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();


    }	
   
//     function getStaffsNumber()
//   {
//     $delete_flag=0;
//     $StaffsNumber = $this->db->query("SELECT * FROM user_login WHERE delete_flag =$delete_flag");
//     return $StaffsNumber->num_rows();

//   }
  function getProjectsNumber($user_id)
  {
   
    $ProjectsNumber = $this->db->query("SELECT * FROM projects WHERE delete_flag = 0 ");
    return $ProjectsNumber->num_rows();
  }
  function getIncidentsNumber($user_id)
  {
  $delete_flag=0; //AND assign_to = $user_id
  $IncidentsNumber= $this->db->query("SELECT * FROM incidents WHERE delete_flag =$delete_flag ");
  return $IncidentsNumber->num_rows();
  
  }
  function getTasksNumber($user_id)
  {
  $delete_flag=0;
  $TasksNumber = $this->db->query("SELECT * FROM tasks WHERE delete_flag =$delete_flag AND assign_to = $user_id");
  return $TasksNumber->num_rows();

  }
}