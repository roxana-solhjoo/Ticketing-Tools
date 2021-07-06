<?php
class Project_model extends CI_Model
 {
    public function __construct() 
    {
        parent::__construct(); 
    } 
    function getmanager($user_id)
    {
      $first_name =$this->db->select('first_name')->from('user_login')->where(array('id' => $user_id,'delete_flag'=>0))->get()->row();
     return  $first_name->first_name; 

      // $project_manager=$this->db->select('project_manager')->from('projects')->where(array('id' => $user_id,'delete_flag'=>0))->get()->row();
      // return  $project_manager;
    } 
    function getProjectDetails($project_manager)
    {
    //table  (projects)
     $delete_flag=1;
     return  $this->db->get_where('projects',array('delete_flag!='=>$delete_flag,'project_manager'=>$project_manager))->result();

    }

    function getById($id)
    {
       return $this->db->get_where('projects',array('id'=>$id))->row();
    }
 
    function add()
     {
        $arr['project_name'] = $this->input->post('Pname');
        $arr['client_name'] = $this->input->post('Cname');
        $arr['company'] = $this->input->post('PassignTo');
        $arr['project_manager'] = $this->input->post('manager');
        $arr['support_staff'] = $this->input->post('staff');
        $value = implode(",",($this->input->post('staff')));
        $arr['support_staff'] = $value;
        $arr['flag'] = 3;
        $this->db->insert('projects',$arr);
        
     } 
     function update($id)
      {
        $arr['project_name'] = $this->input->post('Pname');
        $arr['client_name'] = $this->input->post('Cname');
        $arr['company'] = $this->input->post('PassignTo');
        $arr['project_manager'] = $this->input->post('manager');
        $arr['support_staff'] = $this->input->post('staff');
        $value = implode(",",($this->input->post('staff')));
        $arr['support_staff'] = $value;
        $arr['flag'] = 3;
        $this->db->where(array('id'=>$id));  
        $this->db->update('projects',$arr);
       }

     function delete($id)
     { 
      $delete_flag=1;
      $this->db->where('id',$id)->update('projects',array('delete_flag'=>$delete_flag,'flag'=>3));
      }
    
    function getAllCompanyName($user_id)
     { 
     return $this->db->select('company_name')->from('user_login')->where(array('id' => $user_id,'delete_flag'=>0))->get()->row();

      // $query = $this->db->get('company_details');
      // $query = $this->db->query('SELECT company_name FROM company_details where delete_flag =0');
      // return $query->result();
     }
 
    public function get_manager_query($company_name,$user_id)
    {
        $query = $this->db->get_where('user_login', array('company_name' => $company_name,'role'=>'Manager','delete_flag'=>0, 'id'=>$user_id));
        return $query->result();
    }   

    function getMangerList($company_name,$project_manager,$user_id)
      {
       $query = $this->db->get_where('user_login', array('company_name' => $company_name,'role'=>'Manager','delete_flag'=>0,'id'=>$user_id));
        // print_r($query->result());die;
        $output = '<option value="">Select Manager </option>';
       foreach($query->result() as $row)
       {
         if($row->first_name == $project_manager){
            $output .= '<option value="'.$row->first_name.'" selected="selected">'.$row->first_name.'</option>';
         }else{
           $output .= '<option value="'.$row->first_name.'">'.$row->first_name.'</option>';
         }
       }
       return $output;
      }

      function getManagerFirstname($user_id)
      {
          return $this->db->select('firstname')->from('user_login')->where(array('id' => $user_id,'delete_flag'=>0))->get()->row();
          //  print_r($query->result());die;

      }

    public function get_all_staff($company_name,$manager)
    {
         $query = $this->db->get_where('user_login', array('company_name' => $company_name,'role !='=>'Manager','manager'=>$manager,'role!='=>'Management Office' ,'delete_flag'=>0, 'role!='=>'Admin'));
         return $query->result(); 
    }

   
    function getAllStaffsList($company_name,$support_staff,$manager)
    {
       $query = $this->db->get_where('user_login', array('company_name' => $company_name,'role !='=>'Manager','role!='=>'Management Office' , 'role!='=>'Admin','delete_flag'=>0,'manager'=>$manager));
        // print_r($query->result());die;
       $output = '<option value="">Select Staffs </option>';
       $support_staff =  $support_staff;
       $support_staff_array = explode(',',$support_staff);
      foreach($query->result() as $row)
      {
       if( in_array($row->first_name, $support_staff_array)){
          $output .= '<option value="'.$row->first_name.'" selected="selected">'.$row->first_name.'</option>';
       }else{
         $output .= '<option value="'.$row->first_name.'">'.$row->first_name.'</option>';
       }
      }
      // print_r($output);
      // die;
     return $output;
    }

    function explodeStaff()
    {
      //print_r(explode(',',$str,0));
     // $data = implode(",",($this->input->post('staff')));
      $value = explode("," , 'support_staff'); 
      return $value;

    }

   
 }