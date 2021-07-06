<?php
class Staff_model extends CI_Model
{
    //table name: profile_details
    function getStaffDetails()
    { 
    $delete_flag=1;
    return  $this->db->get_where('user_login',array('delete_flag!='=>$delete_flag,'role !=' => 'Admin'))->result();
    }
    function getById($id)
    { 
       return $this->db->get_where('user_login',array('id'=>$id))->row();
    }
    function getStatus()
    {
     $query = $this->db->get_where('user_login',array('role !=' => 'Admin'))->result();
     return  $query;
    
   }
    function add()
    {
        // echo "<pre>"; print_r($this->input->post());die;
        $arr['username'] = $this->input->post('Uname');  
        $arr['first_name'] = $this->input->post('Fname');
        $arr['last_name'] = $this->input->post('Lname');
        $arr['email'] = $this->input->post('Email');
        $arr['employee_id'] = $this->input->post('Emp_id');
        $arr['status'] = $this->input->post('Status');
        $arr['mobile_no'] = $this->input->post('Mobno');
        $arr['role'] = $this->input->post('role');
        $arr['company_name'] = '';
        // $arr['manager'] = $this->input->post('manager');
        $arr['flag'] = 1;
        $arr['password'] ='$2y$10$mpRJnQQtqbyunWRuA/IN.e2YvinhiZd4EkJ06XDExOis0qO14L/Cu';
     
        $user_id = ($this->db->insert('user_login',$arr)) ? $this->db->insert_id()  :   false;

        if($user_id){
          $Subcom = $this->input->post('Subcom');

          foreach ($Subcom as $key => $value) {
              $array = array(
                'userid' => $user_id,
                'companyid' => $value,
                'createdat' =>  date('Y-m-d H:i:s')
              );
               $compid = ($this->db->insert('company_staff_details',$array)) ? $this->db->insert_id()  :   false;              
          }
        }

    }   
     function update($id)  
    {
        $arr['username'] = $this->input->post('Uname');
        $arr['first_name'] = $this->input->post('Fname');
        $arr['last_name'] = $this->input->post('Lname');
        $arr['email'] = $this->input->post('Email');
        $arr['employee_id'] = $this->input->post('Emp_id');
        $arr['status'] = $this->input->post('Status');
        $arr['mobile_no'] = $this->input->post('Mobno');
        $arr['role'] = $this->input->post('role');
        $arr['company_name'] = '';
        // $arr['manager'] = $this->input->post('manager');
        if(!empty($this->input->post('Password'))){

            $arr['password'] =password_hash($this->input->post('Password'), PASSWORD_DEFAULT);
        }
        $arr['flag'] = 1;

        $this->db->where(array('id'=>$id));
        $this->db->update('user_login',$arr);



        $this->db->where(array('userid' => $id));
        $this->db->delete('company_staff_details');

        $Subcom = $this->input->post('Subcom');

        foreach ($Subcom as $key => $value) {
            $array = array(
              'userid' => $id,
              'companyid' => $value,
              'createdat' =>  date('Y-m-d H:i:s')
            );
            $compid = ($this->db->insert('company_staff_details',$array)) ? $this->db->insert_id()  :   false;              
        }

    }
    function delete($id)
    {
       $arr['flag'] = 1; 
      $this->db->update('user_login',$arr);
      $delete_flag=1;
      $this->db->where('id',$id)->update('user_login',array('delete_flag'=>$delete_flag));
    }

     function getAllRole()
    {
      $this->load->model('settings_model');
      $this->settings_model->getRoleDetails(); 
      $query = $this->db->get('roles_settings');

      $query = $this->db->query('SELECT id,role_name FROM roles_settings where delete_flag != 1');
      
       return $query->result();
 
    }
    function getAllCompanyName() 
    {
      $this->load->model('company_model');
      $this->company_model->getCompanyDetails(); 
      $query = $this->db->get('company_details');

      $query = $this->db->query('SELECT id,company_name FROM company_details WHERE delete_flag=0');

       return $query->result();
    }
    function selectedCompany($id)
    {

      $query = $this->db->query('SELECT companyid FROM company_staff_details WHERE userid='.$id);

      $arr = $query->result();
      $imp =$this->array_map_assoc($arr);
      return ($imp);
    }

    function array_map_assoc($array){
      $r = array();
      foreach ($array as $key=>$value)
        $r[$key] = $value->companyid;
      return $r;
    }

    public function get_manager_query($company_name)
    {
        $query = $this->db->get_where('user_login', array('company_name' => $company_name,'role'=>'Manager'));
        return $query->result();
    } 

    
   function sendEmailToUser($email)
   {
     $this->load->library('email');

      $smtp_host = "*******";
      $smtp_port = 587;
      $smtp_username = "*****";
      $smtp_password = "*****";


     $config['protocol'] = 'smtp';
     $config['smtp_host'] = $smtp_host;
     $config['smtp_port'] = $smtp_port; 
     $config['smtp_timeout'] = 30;
     $config['smtp_user'] = $smtp_username;
     $config['smtp_pass'] = $smtp_password;
     $config['mailtype'] = 'html';
     $config['charset'] = 'iso-8859-1';
     $config['newline']    = "\r\n"; 
     $config['wordwrap'] = TRUE;
      
   
      $this->email->initialize($config);
      $this->email->from($smtp_username, "Admin Team");
      $this->email->to($email);  
      $this->email->subject("Confirmation Email ");
     
      $username = $this->input->post('Uname');

      // $this->email->message("Dear User,\nPlease click on below URL or paste it into your browser to Login\n\n https://aaaa.superapp.com.my/"."\n"."\n\n To process login please use  Username: $username And Password 12345 , we recommend you change your password after login Thanks \n Admin Team.");
      
      $this->email->message("Dear $username  <br>Please click on below URL or paste it into your browser to Login<br>\n\n https://aaaa.superapp.com.my/"."\n"."\n\n<br> To process login please use <br> Username: $username <br> Password 12345 <br> We recommend you change your password after login <br>Thanks \n Admin Team.");

      $send = $this->email->send();
      if($send){
        return true;
      }else{
        return false;
      }
   } 


}




