<?php
class Task_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    function get_task_count()
    {
    //table  (tasks)
     return $this->db->get('tasks')->num_rows();
    }
     function getTasksDetails() 
     {
      $delete_flag=1; 
      return  $this->db->get_where('tasks',array('delete_flag!='=>$delete_flag))->result();
    } 

    function getById($id) 
    {
       return $this->db->get_where('tasks',array('id'=>$id))->row();
    }
    function getAllTasks()
    {
        $this->db->select('*');
        $this->db->join('user_login', 'tasks.assign_to = user_login.id');
        $this->db->where('tasks.delete_flag','0');
       return $this->db->get('tasks')->result();
    } 

    function getTaskByUserID($user_id)
    {
      $this->db->select('*,tasks.id as id, tasks.status as status');
      $this->db->join('user_login', 'tasks.assign_to = user_login.id');
      return $this->db->get_where('tasks',array('assign_to'=>$user_id,'tasks.delete_flag'=>0))->result();
    }
    function getById_history($id)
    {
        $query=$this->db->query("SELECT tasks_id FROM tasks WHERE id = $id");
        $get_row = $query->row();
        $task_id = $get_row->tasks_id;

        $this->db->select('*');
        $this->db->where(array('tasks.tasks_id'=>$task_id));
        $this->db->join('task_status', 'tasks.id = task_status.task_id');
        // $this->db->join('task_status', 'tasks.tasks_id = task_status.task_id');

        return $this->db->get('tasks')->result();
    }

    function add($image_name)
    {
        $arr['tasks_id'] = $this->input->post('T_id');
        $arr['task_name'] = $this->input->post('Tname');
        $arr['company_name'] = $this->input->post('Cname');
        $arr['project_name'] = $this->input->post('Pname');
        $arr['project_version'] = $this->input->post('Pversion');
        $arr['report_form'] = $this->input->post('Rform');
        $arr['internal'] = $this->input->post('Internal');
        $arr['assign_to'] = $this->input->post('Assignto');
        $arr['start_date'] = $this->input->post('Sdate');
        $arr['end_date'] = $this->input->post('Edate');
        $arr['status'] = $this->input->post('Status');
        $arr['priority'] = $this->input->post('Priority');
        $arr['description'] = $this->input->post('Description');
        $arr['file'] = $image_name;
        $arr['initial_status'] = 0;
        $arr['flag'] = 2;
        $this->db->insert('tasks',$arr);
        $insert_id = $this->db->insert_id();
        $arr1['task_id'] = $insert_id;
        $arr1['task_status'] = $this->input->post('Status');
        $arr1['task_description'] = $this->input->post('Description');
        $this->db->insert('task_status',$arr1);

     }
     function update($id,$imageName)
    {
       $arr['tasks_id'] = $this->input->post('T_id');
       $arr['task_name'] = $this->input->post('Tname');
       $arr['company_name'] = $this->input->post('Cname');
       $arr['project_name'] = $this->input->post('Pname');
       $arr['project_version'] = $this->input->post('Pversion');
       $arr['report_form'] = $this->input->post('Rform');
       $arr['internal'] = $this->input->post('Internal');
       $arr['assign_to'] = $this->input->post('Assignto');
       $arr['start_date'] = $this->input->post('Sdate');
       $arr['end_date'] = $this->input->post('Edate');
       $arr['status'] = $this->input->post('Status');
       $arr['priority'] = $this->input->post('Priority');
       $arr['description'] = $this->input->post('Description');
       $arr['file'] = $imageName;
       $arr['initial_status'] = 1;
       $arr['flag'] = 2; 
       $this->db->where(array('tasks_id'=>$this->input->post('T_id'))); 
       $this->db->update('tasks',$arr);

        $exits2 = $this->db->get_where('tasks',array('tasks_id'=>$this->input->post('T_id')));
         $res2= $exits2->row();

       $exits = $this->db->get_where('task_status',array('task_id'=>$res2->id,'task_status'=>$this->input->post('Status')));

      
       if($exits->num_rows() > 0){ // update
        $UPDATE_ID = $exits->row();
         $arr2['task_description'] = $this->input->post('Description');
         $this->db->where(array('id'=>$UPDATE_ID->id));
         $this->db->update('task_status',$arr2);
       }else{
         //$exits1 = $this->db->get_where('tasks',array('tasks_id'=>$this->input->post('T_id')));
         //$res= $exits1->row();
         $arr1['task_id'] = $res2->id;
         $arr1['task_status'] = $this->input->post('Status');
         $arr1['task_description'] = $this->input->post('Description');
         $this->db->insert('task_status',$arr1);
        
       }
     }
      
    
     function delete($id) 
     {
        $delete_flag=1;
        $user_flag=2;
        $this->db->where('id',$id)->update('tasks',array('delete_flag'=>$delete_flag,'flag'=>$user_flag ));
     }
     function getAllCompanyName()
     {
       $query = $this->db->get('company_details');
       $query = $this->db->query('SELECT company_name FROM company_details where delete_flag =0');
       return $query->result();

      //  $this->db->order_by("company_name", "ASC");
      //  $query = $this->db->get("company_details");
      //  return $query->result();
      }

     function getAllProject($company_name)
     {
       $this->db->where('company', $company_name);
       $this->db->order_by('project_name', 'ASC');
       $query = $this->db->get('projects');
       $output = '<option value="">Select Project Name</option>';
       foreach($query->result() as $row)
       {
        $output .= '<option value="'.$row->project_name.'">'.$row->project_name.'</option>';
       }
        return $output;
     }
     
     function getAllStaff($project_name)
     {
       $this->db->where('project_name', $project_name);
       $this->db->order_by('support_staff', 'ASC');
       $query = $this->db->get('projects');
       $output = '<option value="">Select Staff</option>';

       $GetDetails = $query->row();
       if($query->num_rows() > 0){ 
          $Staff_ID = $GetDetails->support_staff;
          $To_array = explode(",",$Staff_ID);
          foreach($To_array as $row){
            $this->db->where('first_name', $row);
          //  $this->db->where('id', $row);

            $query1 = $this->db->get('user_login');
            $GetUserDetails = $query1->row();

            $output .= '<option value="'.$row->first_name.'">'.$GetUserDetails->first_name.'</option>';
          }
       }
       return $output;
     } 

     function getInProgressTasksNumber($user_id)
     {
      $delete_flag=0;
      $inProgressTasks = $this->db->get_where('tasks', array('delete_flag'=> $delete_flag,'status' =>'In Progress','assign_to'=>$user_id));
      return $inProgressTasks->num_rows();
    }

  
  function getcompletedTasksNumber($user_id)
  {
      $delete_flag=0;
      $completedTasks = $this->db->get_where('tasks', array('delete_flag'=> $delete_flag,'status' =>'Completed','assign_to'=>$user_id));
      return $completedTasks->num_rows();

   }
  function getOpenTasksNumber($user_id)
  {
      $delete_flag=0;
      $initial_status = 1;
      $openTasks = $this->db->get_where('tasks', array('delete_flag'=> $delete_flag,'initial_status' => $initial_status,'assign_to'=>$user_id ));
      return $openTasks->num_rows();
  }
  function getAllTasksNumber($user_id)
  {
      $delete_flag=0;
      //$totalTasks= $this->db->query("SELECT * FROM tasks WHERE delete_flag =$delete_flag");
     $totalTasks = $this->db->get_where('tasks', array('delete_flag'=> $delete_flag,'assign_to'=>$user_id ));
      return $totalTasks->num_rows();
  }
  function getOnHoldTasksNumber($user_id)
 {
    $delete_flag=0;
    $onHoldTasks = $this->db->get_where('tasks', array('delete_flag'=> $delete_flag,'status' =>'On Hold','assign_to'=>$user_id));
    return $onHoldTasks->num_rows();
 }
 function OnHoldTasks($user_id)
  {
    $OnHold = "On Hold";
    $this->db->select('*,tasks.id as id, tasks.status as status');
    $this->db->join('user_login', 'tasks.assign_to = user_login.id');
    $this->db->where('tasks.delete_flag','0');
    $this->db->where('tasks.assign_to',$user_id);
    $this->db->where('tasks.status',$OnHold);
    return $this->db->get('tasks')->result();
  }
  function InProgressTasks($user_id)
  {
    $InProgress = "In Progress";
    $this->db->select('*,tasks.id as id, tasks.status as status');
    $this->db->join('user_login', 'tasks.assign_to = user_login.id');
    $this->db->where('tasks.delete_flag','0');
    $this->db->where('tasks.assign_to',$user_id);
    $this->db->where('tasks.status',$InProgress);
     return $this->db->get('tasks')->result();
  }
  function OpenTasks($user_id) 
  {
    $initial_status = 1;
    $this->db->select('*,tasks.id as id, tasks.status as status');
    $this->db->join('user_login', 'tasks.assign_to = user_login.id');
    $this->db->where('tasks.delete_flag','0');
    $this->db->where('tasks.assign_to',$user_id);
    $this->db->where('tasks.initial_status',$initial_status);
    return $this->db->get('tasks')->result();
   }
  function CompletedTasks($user_id)
  {
    $Completed = "Completed";
    $this->db->select('*,tasks.id as id, tasks.status as status');
    $this->db->join('user_login', 'tasks.assign_to = user_login.id');
    $this->db->where('tasks.delete_flag','0');
    $this->db->where('tasks.assign_to',$user_id);
    $this->db->where('tasks.status',$Completed);
    return $this->db->get('tasks')->result();
  }
  
  function TotalTasks($user_id)
  {
      $this->db->select('*,tasks.id as id, tasks.status as status');
      $this->db->join('user_login', 'tasks.assign_to = user_login.id');
      return $this->db->get_where('tasks',array('assign_to'=>$user_id,'tasks.delete_flag'=>0))->result();
   }
     function getById_history_pdf($id)
      {
        $query=$this->db->query("SELECT tasks_id FROM tasks WHERE id = $id");
        $get_row = $query->row();
        $task_id = $get_row->tasks_id;

        $this->db->select('*');
        $this->db->where(array('tasks.tasks_id'=>$task_id));
        $this->db->join('task_status', 'tasks.id = task_status.task_id');
        // $this->db->join('task_status', 'tasks.tasks_id = task_status.task_id');

        return $this->db->get('tasks')->result_array();
       }
       
  
       function getByIdPdf($id) 
      {
       return $this->db->get_where('tasks',array('id'=>$id))->row_array();
      }
        function uploadFile($file_name) 
     {
       $arr['file'] = $file_name; 
       $arr['flag'] = 1;
       $this->db->where(array('tasks_id'=>$this->input->post('T_id')));
       $this->db->insert('tasks',$arr);
      
     }


     function getfile($task_id )
     {
       $file = $this->db->select('file');
               $this->db->from('tasks');
               $this->db->where('tasks_id' , $task_id );
       $query =  $this->db->get();

       if ($query->num_rows() > 0) {
         return $query->row()->file;
     }
     return false;
      
     }
}



   




