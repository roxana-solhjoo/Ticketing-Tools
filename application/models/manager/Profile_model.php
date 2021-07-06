<?php
class Profile_model extends CI_Model
{
    //table name: user_login
    
    public function __construct()
    {
        parent::__construct();
    }
    function getUserId ($id)
    {
        return $this->db->get_where('user_login','id',$id)->row->id;
    }
     function getById($id)
    {
       return $this->db->get_where('projects',array('id'=>$id))->row();
    }
    function myProfile($user_id) 
    {
       $query = $this->db->query("SELECT * FROM user_login WHERE id = $user_id");
       return $query->result();        
    
    } 
    function editMyProfile($user_id) 
     {
       $query = $this->db->query("SELECT * FROM user_login WHERE id = $user_id");
       return $query->row();
     }

     function updateImageById($id,$file_name)
     {
       $arr['photo'] = $file_name;
        $arr['flag'] = 2;
       $this->db->where(array('id'=>$id));
       $this->db->update('user_login',$arr);
     }
     function update($user_id) 
     {
        
        //$arr['photo'] = $this->input->post('Img');      
        $arr['first_name'] = $this->input->post('Fname');   
        $arr['last_name'] = $this->input->post('Lname');
        $arr['email'] = $this->input->post('Email');
        $arr['mobile_no'] = $this->input->post('Mobno');
        $arr['role'] = $this->input->post('role');
        $arr['company_name'] = $this->input->post('Subcom');
        $arr['flag'] = 2;

        $this->db->where(array('id'=>$user_id));
        $this->db->update('user_login',$arr);
     }

     function getById_myProjects($project_manager) 
     { 
         $delete_flag=1;
         return  $this->db->get_where('projects',array('delete_flag!='=>$delete_flag,'project_manager'=>$project_manager))->result();
     }

     public function getAdminProjects()
     {
       $delete_flag=1;
       return  $this->db->get_where('projects',array('delete_flag!='=>$delete_flag))->result();
     }

    public function getUsernameByID($id)
    {
        $query = $this->db->query("SELECT first_name FROM user_login where id='".$id."'");
        return $query->row();
    }
    function getUserProjectsNumber($project_manager)
    {
        $delete_flag=1;
       $numberOfUserProjects = $this->db->get_where('projects',array('delete_flag!='=>$delete_flag,'project_manager'=>$project_manager));
       return $numberOfUserProjects->num_rows();
    }

    function getAllProjectsNumber()
    {
         $delete_flag=1;
         $numberOfUserProjects = $this->db->query("SELECT * FROM projects WHERE delete_flag!=$delete_flag");
        return $numberOfUserProjects->num_rows();
    }

    function getAllTasksNumber()
    {
        $delete_flag=1;
        $numberOfUserTasks = $this->db->query("SELECT * FROM tasks WHERE delete_flag!=$delete_flag");
        return $numberOfUserTasks->num_rows();
    }


    function getUserTasksNumber($project_manager_projects)
    {
       $projects = array();
     foreach($project_manager_projects as $project) {
        $projects[] = $project->project_name;
    }
    if (empty($projects)) {
        return array();
    } 
     $numberOfUserTasks =  $this->db->select('*,tasks.id as id, tasks.status as status')
        ->join('user_login', 'tasks.assign_to = user_login.id')
        ->where('tasks.delete_flag','0')
        ->where_in('tasks.project_name' ,$projects)
        ->get('tasks');
         return $numberOfUserTasks->num_rows();

    }
    function getAllIncidentsNumber()
    { 
        $delete_flag=1;
        $numberOfUserIncidents = $this->db->query("SELECT * FROM incidents WHERE delete_flag!=$delete_flag");
        return $numberOfUserIncidents->num_rows();
    }

    function getUserIncidentsNumber($project_manager_projects)
    {
         $projects = array();
    foreach($project_manager_projects as $project) {
        $projects[] = $project->project_name;
    }
    if (empty($projects)) {
        return array();
    }
    $numberOfUserIncidents = $this->db->select('*,incidents.id as id, incidents.status as status')
        ->join('user_login', 'incidents.assign_to = user_login.id')
        ->where('incidents.delete_flag','0')
        ->where_in('incidents.project_name' ,$projects)
        ->get('incidents');
        return $numberOfUserIncidents->num_rows();
    
    }  
    public function updateImage($data, $user_id){
        $this->db->set($data);
        $this->db->where('id', $user_id);
        if ($this->db->update('user_login') ===true) {
            return true;
        }else{
            return false;
        }

    }
    
}
