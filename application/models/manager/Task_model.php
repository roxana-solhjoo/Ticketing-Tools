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
    function getmanager($user_id)
    {
      $first_name =$this->db->select('first_name')->from('user_login')->where(array('id' => $user_id,'delete_flag'=>0))->get()->row();
     return  $first_name->first_name; 

    } 
    function getProjectDetails($project_manager)
    {
    //table  (projects)
     $delete_flag=1;
     $project_name =$this->db->get_where('projects',array('delete_flag!='=>$delete_flag,'project_manager'=>$project_manager))->result();
    return  $project_name;

    } 

    function getTasksDetails($project_manager_projects)
    {
      
       $projects = array();
    foreach($project_manager_projects as $project) {
        $projects[] = $project->project_name;
    }
    if (empty($projects)) {
        return array();
    }
    return $this->db->select('*,tasks.id as id, tasks.status as status')
        ->join('user_login', 'tasks.assign_to = user_login.id')
        ->where('tasks.delete_flag','0')
        ->where_in('tasks.project_name' ,$projects)
        ->get('tasks')
        ->result(); 
   
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
      $this->db->select('*');
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
        $arr['flag'] = 3;

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
       $arr['flag'] = 3;
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
        // $exits1 = $this->db->get_where('tasks',array('tasks_id'=>$this->input->post('T_id')));
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
        $this->db->where('id',$id)->update('tasks',array('delete_flag'=>$delete_flag, 'flag'=>3));
     }
     function getAllCompanyName($user_id)
     {
       return $this->db->select('company_name')->from('user_login')->where(array('id' => $user_id,'delete_flag'=>0))->get()->row();
      }
   //   function getAllProject($company_name)
   //   {
   //     $this->db->where('company', $company_name);
   //     $this->db->order_by('project_name', 'ASC');
   //     $query = $this->db->get('projects');
   //     $output = '<option value="">Select Project Name</option>';
   //     foreach($query->result() as $row)
   //     {
   //      $output .= '<option value="'.$row->project_name.'">'.$row->project_name.'</option>';
   //     }
   //      return $output;
   //   }
     function getInProgressTasksNumber($project_manager_projects)
     {
       $InProgress = "In Progress";
       $projects = array();
       foreach($project_manager_projects as $project) {
        $projects[] = $project->project_name;
       }
       if (empty($projects)) {
        return array();
       }
      $inProgressTasks = $this->db->select('*,tasks.id as id, tasks.status as status')
        ->join('user_login', 'tasks.assign_to = user_login.id')
        ->where('tasks.delete_flag','0')
         ->where('tasks.status', $InProgress)
        ->where_in('tasks.project_name' ,$projects)
        ->get('tasks');
       return $inProgressTasks->num_rows(); 
     }

     function getcompletedTasksNumber($project_manager_projects)
     {
       $Completed = "Completed";
       $projects = array();
       foreach($project_manager_projects as $project) {
        $projects[] = $project->project_name;
       }
       if (empty($projects)) {
        return array();
       }
       $completedTasks = $this->db->select('*,tasks.id as id, tasks.status as status')
        ->join('user_login', 'tasks.assign_to = user_login.id')
        ->where('tasks.delete_flag','0')
        ->where('tasks.status', $Completed )
        ->where_in('tasks.project_name' ,$projects)
        ->get('tasks');
        return $completedTasks->num_rows();

     }
      function getOpenTasksNumber($project_manager_projects)
      {
         $initial_status = 1;
       $projects = array();
       foreach($project_manager_projects as $project) {
        $projects[] = $project->project_name;
       }
       if (empty($projects)) {
        return array();
       }
      $openTasks = $this->db->select('*,tasks.id as id, tasks.status as status')
        ->join('user_login', 'tasks.assign_to = user_login.id')
        ->where('tasks.delete_flag','0')
        ->where('tasks.initial_status', $initial_status)
        ->where_in('tasks.project_name' ,$projects)
        ->get('tasks');
       return $openTasks->num_rows(); 
      }

      function getAllTasksNumber($project_manager_projects)
      {
        $projects = array();
        foreach($project_manager_projects as $project) {
        $projects[] = $project->project_name;
        }
        if (empty($projects)) {
        return array();
       }
       $totalTasks=  $this->db->select('*,tasks.id as id, tasks.status as status')
        ->join('user_login', 'tasks.assign_to = user_login.id')
        ->where('tasks.delete_flag','0')
        ->where_in('tasks.project_name' ,$projects)
        ->get('tasks');
        return $totalTasks->num_rows();
      }

      function getOnHoldTasksNumber($project_manager_projects)
      {
       $OnHold = "On Hold";
       $projects = array();
       foreach($project_manager_projects as $project) {
        $projects[] = $project->project_name;
       }
       if (empty($projects)) { 
        return array();
       }
        $onHoldTasks = $this->db->select('*,tasks.id as id, tasks.status as status')
        ->join('user_login', 'tasks.assign_to = user_login.id')
        ->where('tasks.delete_flag','0')
         ->where('tasks.status', $OnHold)
        ->where_in('tasks.project_name' ,$projects)
        ->get('tasks');
        return $onHoldTasks->num_rows();
      }

      function OnHoldTasks($project_manager_projects)
      {
       $OnHold = "On Hold";
       $projects = array();
       foreach($project_manager_projects as $project) {
        $projects[] = $project->project_name;
       }
       if (empty($projects)) {
        return array();
       }
       return $this->db->select('*,tasks.id as id, tasks.status as status')
        ->join('user_login', 'tasks.assign_to = user_login.id')
        ->where('tasks.delete_flag','0')
         ->where('tasks.status', $OnHold)
        ->where_in('tasks.project_name' ,$projects)
        ->get('tasks')
        ->result(); 
      }
      
      function InProgressTasks($project_manager_projects)
      {
       $InProgress = "In Progress";
       $projects = array();
       foreach($project_manager_projects as $project) {
        $projects[] = $project->project_name;
       }
       if (empty($projects)) {
        return array();
       }
       return $this->db->select('*,tasks.id as id, tasks.status as status')
        ->join('user_login', 'tasks.assign_to = user_login.id')
        ->where('tasks.delete_flag','0')
         ->where('tasks.status', $InProgress)
        ->where_in('tasks.project_name' ,$projects)
        ->get('tasks')
        ->result(); 
      }

      function OpenTasks($project_manager_projects) 
      { 
       $initial_status = 1;
       $projects = array();
       foreach($project_manager_projects as $project) {
        $projects[] = $project->project_name;
       }
       if (empty($projects)) {
        return array();
       }
       return $this->db->select('*,tasks.id as id, tasks.status as status')
        ->join('user_login', 'tasks.assign_to = user_login.id')
        ->where('tasks.delete_flag','0')
        ->where('tasks.initial_status', $initial_status)
        ->where_in('tasks.project_name' ,$projects)
        ->get('tasks')
        ->result(); 
      }

      function CompletedTasks($project_manager_projects) 
      {
       $Completed = "Completed";
       $projects = array();
       foreach($project_manager_projects as $project) {
        $projects[] = $project->project_name;
       }
       if (empty($projects)) {
        return array();
       }
       return $this->db->select('*,tasks.id as id, tasks.status as status')
        ->join('user_login', 'tasks.assign_to = user_login.id')
        ->where('tasks.delete_flag','0')
        ->where('tasks.status', $Completed )
        ->where_in('tasks.project_name' ,$projects)
        ->get('tasks')
        ->result(); 
      }

      function TotalTasks($project_manager_projects)
      {
       $projects = array();
       foreach($project_manager_projects as $project) {
        $projects[] = $project->project_name;
       }
       if (empty($projects)) {
        return array();
       }
       return $this->db->select('*,tasks.id as id, tasks.status as status')
        ->join('user_login', 'tasks.assign_to = user_login.id')
        ->where('tasks.delete_flag','0')
        ->where_in('tasks.project_name' ,$projects)
        ->get('tasks')
        ->result(); 
    
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



   




