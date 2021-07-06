<?php
class Incidents_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    } 
    function get_task_count() 
    {
    //table  (incidents) 
    return $this->db->get('incidents')->num_rows();
    }
    // function getIncidentsDetails()
    // {
    //   $this->db->select('*,incidents.id as id'); 
    //   $this->db->join('user_login', 'incidents.assign_to = user_login.id');
    //   $this->db->where('incidents.delete_flag','0');
    //   return $this->db->get('incidents')->result();
    //  $delete_flag=1;
    //  return  $this->db->get_where('incidents',array('delete_flag!='=>$delete_flag))->result();
    // }

    function getById($id) 
    {
       return $this->db->get_where('incidents',array('id'=>$id))->row();
    }
    function getAllIncidents()
    {
        $this->db->select('*');
        $this->db->join('user_login', 'incidents.assign_to = user_login.id');
        $this->db->where('incidents.delete_flag','0'); 
       return $this->db->get('incidents')->result();
    }
    function getIncidentByUserID($user_id)
    {
      //'assign_to'=>$user_id,
      $this->db->select('*,incidents.id as id,incidents.status as status');
      $this->db->join('user_login', 'incidents.assign_to = user_login.id');
       return $this->db->get_where('incidents',array('incidents.delete_flag'=>0))->result();
    }
    function getById_history($id)
    {
        $query=$this->db->query("SELECT incidents_id FROM incidents WHERE id = $id");
        $get_row = $query->row();
        $incident_id = $get_row->incidents_id;
        
        $this->db->select('*');
        $this->db->where(array('incidents.incidents_id'=>$incident_id));
        $this->db->join('incident_status', 'incidents.id = incident_status.incident_id');
        return $this->db->get('incidents')->result(); 
    } 
  
    function add($image_name)
    {
        $arr['incidents_id'] = $this->input->post('T_id');
        $arr['incident_name'] = $this->input->post('Tname');
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
        // $arr['estimate_hours'] = $this->input->post('Ehours');
        $arr['description'] = $this->input->post('Description');
        $arr['initial_status'] = 0 ;
        $arr['flag'] = 2;
        $arr['file'] = $image_name; 
        $this->db->insert('incidents',$arr); 
        $insert_id = $this->db->insert_id();
        $arr1['incident_id'] = $insert_id;
        $arr1['incident_status'] = $this->input->post('Status');
        $arr1['incident_description'] = $this->input->post('Description');
        $this->db->insert('incident_status',$arr1);
    }
    function update($id,$imageName)
    {
        $arr['incidents_id'] = $this->input->post('T_id');
        $arr['incident_name'] = $this->input->post('Tname'); 
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
        // $arr['estimate_hours'] = $this->input->post('Ehours');
        $arr['description'] = $this->input->post('Description');
         $arr['initial_status'] = 1;
         $arr['flag'] = 2;
         $arr['file'] = $imageName;
        $this->db->where(array('incidents_id'=>$this->input->post('T_id')));
        $this->db->update('incidents',$arr);

         $exits2 = $this->db->get_where('incidents',array('incidents_id'=>$this->input->post('T_id')));
         $res2= $exits2->row();


        $exits = $this->db->get_where('incident_status',array('incident_id'=>$res2->id,'incident_status'=>$this->input->post('Status')));

      
       if($exits->num_rows() > 0){ // update 
         $UPDATE_ID = $exits->row();
         $arr2['incident_description'] = $this->input->post('Description');
         $this->db->where(array('id'=>$UPDATE_ID->id));
         $this->db->update('incident_status',$arr2);
       }else{
        
         $arr1['incident_id'] = $res2->id;
         $arr1['incident_status'] = $this->input->post('Status');
         $arr1['incident_description'] = $this->input->post('Description');
         $this->db->insert('incident_status',$arr1);
       }       
    }
     
    function delete($id)
    {
       $delete_flag=1;
      $this->db->where('id',$id)->update('incidents',array('delete_flag'=>$delete_flag,'flag'=>2));
    }
    function getAllCompanyName()
    {
      $query = $this->db->get('company_details');
      $query = $this->db->query('SELECT company_name FROM company_details where delete_flag =0');
      return $query->result();
     
    }
    function getAllClients()
    {
      $query = $this->db->get('clients');
      $query = $this->db->query('SELECT id,client_name FROM clients where delete_flag =0');
      return $query->result();
    }

    function getAllProject($company_name)
    {
     $this->db->where('company', $company_name);
      $this->db->where('delete_flag','0');
     $this->db->order_by('project_name', 'ASC');
     $query = $this->db->get('projects');
     $output = '<option value="">Select Project </option>';
     foreach($query->result() as $row)
     {
      $output .= '<option value="'.$row->project_name.'">'.$row->project_name.'</option>';
     }
     return $output;
    }

    function getProjectList($company_name,$project_name)
    {
      // echo $company_name.'dfgdfg';
      // die;
     $this->db->where('company', $company_name);
     $this->db->where('delete_flag','0');
     $this->db->order_by('project_name', 'ASC');
     $query = $this->db->get('projects');
    //  print_r($query->result());die;
     $output = '<option value="">Select Project </option>';
     foreach($query->result() as $row)
     {
       if($row->project_name == $project_name){
          $output .= '<option value="'.$row->project_name.'" selected="selected">'.$row->project_name.'</option>';
       }else{
         $output .= '<option value="'.$row->project_name.'">'.$row->project_name.'</option>';
       }
     }
    //  echo $project_name; project_name  project_name
    //    die;
     return $output;
    }


    function getstaffsList($project_name,$support_staff_2)
    {
      // echo $project_name;
      //   die;
     $this->db->where('project_name', $project_name);
     $this->db->where('delete_flag','0');
     $this->db->order_by('support_staff', 'ASC');
     $query = $this->db->get('projects');
     $output = '<option value="">Select Staff </option>';
      $ret = $query->row();
      $support_staff =  $ret->support_staff;

      $support_staff_array = explode(',',$support_staff);


     foreach($support_staff_array as $row)
     {
       if($this->getIDByUsername($row) == $support_staff_2){
          $output .= '<option value="'.$this->getIDByUsername($row).'" selected="selected">'.$this->getUsernameByID($row).'</option>';
       }else{
         $output .= '<option value="'.$this->getIDByUsername($row).'">'.$this->getUsernameByID($row).'</option>';
       }
     }
     return $output;
    }

    function getUsernameByID($id){
      $this->db->select('first_name');
      $this->db->where('id', $id);
      $this->db->or_where('first_name', $id);
      $query = $this->db->get('user_login');
      $ret = $query->row();
      return $first_name =  $ret->first_name;
    }

    function getIDByUsername($id)
    {
      $this->db->select('id');
      $this->db->where('id', $id);
      $this->db->or_where('first_name', $id);
      $query = $this->db->get('user_login');
      $ret = $query->row();
      return $first_name =  $ret->id;
    }

  function getAllStaff($project_name)
  {
   $this->db->where('project_name', $project_name);
   $this->db->where('delete_flag','0');
   $this->db->order_by('support_staff', 'ASC');
   $query = $this->db->get('projects');
   $output = '<option value="">Select Staff</option>';

   $GetDetails = $query->row();
   if($query->num_rows() > 0){
      $Staff_ID = $GetDetails->support_staff;
      $To_array = explode(",",$Staff_ID);
      foreach($To_array as $row){
      $this->db->where('id', $row);
      $this->db->or_where('first_name', $row);
      $query1 = $this->db->get('user_login');
      $GetUserDetails = $query1->row();

      $output .= '<option value="'.$GetUserDetails->id.'">'.$GetUserDetails->first_name.'</option>';
      }
    }
    return $output;
  }

  function getInProgressIncidentsNumber($user_id)
  {
    $delete_flag=0; //,'assign_to'=>$user_id
    $inProgressIncidents = $this->db->get_where('incidents', array('delete_flag'=> $delete_flag,'status' =>'In Progress'));
    return $inProgressIncidents->num_rows();
  }
  function getcompletedIncidentsNumber($user_id)
  {
    $delete_flag=0; //,'assign_to'=>$user_id
    $completedIncidents = $this->db->get_where('incidents', array('delete_flag'=> $delete_flag,'status' =>'Completed'));
    return $completedIncidents->num_rows();

  }
  function getOpenIncidentsNumber($user_id)
  {
   $delete_flag=0;
    $initial_status = 1; //,'assign_to'=>$user_id
    $openTasks = $this->db->get_where('incidents', array('delete_flag'=> $delete_flag,'initial_status' => $initial_status));
    return $openTasks->num_rows();
  }
  function getAllIncidentsNumber($user_id)
  {
  $delete_flag=0;
  $totalIncidents = $this->db->get_where('incidents', array('delete_flag'=> $delete_flag,'assign_to'=>$user_id ));
  return $totalIncidents->num_rows();

  }
  function getOnHoldIncidentsNumber($user_id)
  {
  $delete_flag=0;//,'assign_to'=>$user_id
  $onHoldIncidents = $this->db->get_where('incidents', array('delete_flag'=> $delete_flag,'status' =>'On Hold' ));
  return $onHoldIncidents->num_rows();

  }
  function OnHoldIncidents($user_id)
   {
    $onHold = "On Hold";
    $this->db->select('*,incidents.id as id,incidents.status as status');
    $this->db->join('user_login', 'incidents.assign_to = user_login.id');
    $this->db->where('incidents.delete_flag','0');
    $this->db->where('incidents.status',$onHold);
    // $this->db->where('incidents.assign_to',$user_id);
    return $this->db->get('incidents')->result();

  }
 function  InProgressIncidents($user_id) 
 {
   $inProgress = "In Progress";
    $this->db->select('*,incidents.id as id,incidents.status as status');
    $this->db->join('user_login', 'incidents.assign_to = user_login.id');
    $this->db->where('incidents.delete_flag','0');
    $this->db->where('incidents.status',$inProgress);
    // $this->db->where('incidents.assign_to',$user_id);
    return $this->db->get('incidents')->result();

 }
 function OpenIncidents($user_id){
  //'assign_to'=>$user_id,
    $this->db->select('*,incidents.id as id,incidents.status as status');
    $this->db->join('user_login', 'incidents.assign_to = user_login.id');
   $initial_status = 1;
    return $this->db->get_where('incidents',array('initial_status' => $initial_status,'incidents.delete_flag'=>0))->result();

 } 
 function CompletedIncidents($user_id)
 {
   $Completed = "Completed";
    $this->db->select('*,incidents.id as id,incidents.status as status');
    $this->db->join('user_login', 'incidents.assign_to = user_login.id');
    $this->db->where('incidents.delete_flag','0');
    $this->db->where('incidents.status',$Completed);
    // $this->db->where('incidents.assign_to',$user_id);
    return $this->db->get('incidents')->result();
 }

 function TotalIncidents($user_id)
 {
   $this->db->select('*,incidents.id as id,incidents.status as status');
   $this->db->join('user_login', 'incidents.assign_to = user_login.id');
   return $this->db->get_where('incidents',array('assign_to'=>$user_id,'incidents.delete_flag'=>0))->result();

 }
 function getById_history_pdf($id)
    {
        $query=$this->db->query("SELECT incidents_id FROM incidents WHERE id = $id");
        $get_row = $query->row();
        $incident_id = $get_row->incidents_id;
        
        $this->db->select('*');
        $this->db->where(array('incidents.incidents_id'=>$incident_id));
        $this->db->join('incident_status', 'incidents.id = incident_status.incident_id');
        return $this->db->get('incidents')->result_array(); 
    } 
    

    function getByIdPdf($id) 
    {
       return $this->db->get_where('incidents',array('id'=>$id))->row_array();
    }

    function uploadFile($file_name) 
     {
       $arr['file'] = $file_name; 
       $arr['flag'] = 1;
       $this->db->where(array('incidents_id'=>$this->input->post('T_id')));
       $this->db->insert('incidents',$arr);
      

     }


     function getfile($Incident_id )
     {
       $file = $this->db->select('file');
               $this->db->from('incidents');
               $this->db->where('incidents_id' , $Incident_id );
       $query =  $this->db->get();
      //  return $query->row();
      if ($query->num_rows() > 0) {
         return $query->row()->file;
     }
     return false;
      
     }

}