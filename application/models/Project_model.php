<?php
class Project_model extends CI_Model
 {
    public function __construct()
    {
        parent::__construct();
    } 
    function getProjectDetails()
    {
    //table  (projects)
     $delete_flag=1;
     return  $this->db->get_where('projects',array('delete_flag!='=>$delete_flag))->result();
    }

    function getById($id)
    {
       return $this->db->get_where('projects',array('id'=>$id))->row();
    }

    function getUserImage($userName)
    {
       return $this->db->get_where('user_login',array('first_name'=>$userName))->row('photo');
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
        $this->db->where(array('id'=>$id));  
        $this->db->update('projects',$arr);
       }

     function delete($id)
     {
      $delete_flag=1;
      $this->db->where('id',$id)->update('projects',array('delete_flag'=>$delete_flag));
      }
    
    function getAllCompanyName()
     {
      $query = $this->db->get('company_details');
      $query = $this->db->query('SELECT company_name FROM company_details where delete_flag =0');
      return $query->result();
     }
 
    public function get_manager_query($company_name)
    {
      $sql ="select * from user_login as a
      left join company_staff_details as b on b.userid = a.id
      left join company_details as c on c.id = b.companyid
      where c.company_name ='".$company_name."' and a.role = 'Manager' and a.delete_flag = '0'";

      $query = $this->db->query($sql);
        // $query = $this->db->get_where('user_login', array('company_name' => $company_name,'role'=>'Manager','delete_flag'=>0));
        return $query->result();
    }   

    function getMangerList($company_name,$project_manager)
      {
       $query = $this->db->get_where('user_login', array('company_name' => $company_name,'role'=>'Manager','delete_flag'=>0));
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


    public function get_all_staff($company_name)
    {
        // $query = $this->db->get_where('user_login', array('company_name' => $company_name,'role !='=>'Manager', 'role!='=>'Admin','delete_flag'=>0));
        // return $query->result();
        $sql ="select * from user_login as a
        left join company_staff_details as b on b.userid = a.id
        left join company_details as c on c.id = b.companyid
        where c.company_name ='".$company_name."' and a.role != 'Manager' and a.role != 'Management Office' and a.role != 'Admin' and a.delete_flag = '0'";


        // $this->db->where('company_name', $company_name);
        // $this->db->where('role !=', 'Management Office');
        // $this->db->where('role !=', 'Manager');
        // $this->db->where('role !=', 'Admin');
        // $this->db->where('delete_flag', '0');
        $query = $this->db->query($sql);
        return $query->result();
    }

   
    function getAllStaffsList($company_name,$support_staff)
    {
      //  $query = $this->db->get('user_login');
      //          $this->db->where('company_name', $company_name);
      //          $this->db->where('role !=', 'Management Office');
      //          $this->db->where('role !=', 'Manager');
      //          $this->db->where('role !=', 'Admin');
      //          $this->db->where('delete_flag', '0');
        $query = $this->db->get_where('user_login', array('company_name' => $company_name,'role !='=>'Manager' ,'role!='=>'Management Office', 'role!='=>'Admin','delete_flag'=>0));
        //  print_r($query->result());die;
        $output = '<option value="">Select Staffs </option>';
       // $ret = $query->row();
       $support_staff =  $support_staff;
       $support_staff_array = explode(',',$support_staff);
        //print_r($support_staff_array->result());die;
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