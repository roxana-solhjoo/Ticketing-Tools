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
    //          $delete_flag=1;
    // return  $this->db->get_where('user_login',array('delete_flag!='=>$delete_flag))->result();       
    
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

     function getById_myProjects($user_id)
    
       { // print_r($_SESSION);
        // die;
        

         $query = $this->db->query("SELECT support_staff FROM projects");
        $get_row = $query->row();
        $role = $get_row->support_staff;

        $this->db->select('*');
        $this->db->where(array('projects.support_staff'=>$role));
        $this->db->join('user_login', 'projects.support_staff = user_login.role');
        return $this->db->get('projects')->result();


    //   $this->db->select('*');
    //   $this->db->join('user_login', 'projects.support_staff = user_login.id');
    //   return $this->db->get_where('projects',array('support_staff'=>$user_id,'projects.delete_flag'=>0))->result();
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
    

    function getUserProjectsNumber($id)
    {
        $query=$this->db->query("SELECT support_staff FROM projects");
        $get_row = $query->row();
         $role = $get_row->support_staff;
         $delete_flag = 0;

        $this->db->select('*');
        $this->db->where(array('projects.support_staff'=>$role));
        $this->db->join('user_login', 'projects.support_staff = user_login.role');
        //return $this->db->get('projects')->result();
        $numberOfUserProjects = $this->db->query("SELECT * FROM projects WHERE support_staff= $id and delete_flag =$delete_flag");
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


    function getUserTasksNumber($user_id)
    {
        // echo "dfgfd";die;
        $numberOfUserTasks = $this->db->query("SELECT * FROM tasks WHERE delete_flag = 0 AND assign_to = $user_id");
       //$numberOfUserTasks = $this->db->get_where('tasks',array('assign_to'=>$user_id,'tasks.delete_flag'=>0));
    //    echo "dfgfd";die;
       return $numberOfUserTasks->num_rows();

    }
    function getAllIncidentsNumber()
    {
        $delete_flag=1;
        $numberOfUserIncidents = $this->db->query("SELECT * FROM incidents WHERE delete_flag!=$delete_flag");
        return $numberOfUserIncidents->num_rows();
    }

    function getUserIncidentsNumber($user_id)
    {
        $numberOfUserIncidents = $this->db->query("SELECT * FROM incidents WHERE delete_flag = 0 AND assign_to = $user_id");
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
