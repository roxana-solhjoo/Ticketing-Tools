<?php
class Staff_model extends CI_Model
{
    //table name: user_login
    function getCompanyName($user_id)
    {
      $company_name=$this->db->select('company_name')->from('user_login')->where(array('id' => $user_id,'delete_flag'=>0))->get()->row();
      return  $company_name->company_name; 
    }
    function getStaffDetails($company_name)
    { 
     $delete_flag=1;
    return  $this->db->get_where('user_login',array('delete_flag!='=>$delete_flag , 'company_name'=>$company_name))->result();
    }
    function getStatus()
    {
     $query = $this->db->get_where('user_login',array('status' ))->result();
     return  $query;
    
   }

    function getById($id)
    { 
       return $this->db->get_where('user_login',array('id'=>$id))->row();
    }
    function add()
    {
        $arr['username'] = $this->input->post('Uname');  
        $arr['first_name'] = $this->input->post('Fname');
        $arr['last_name'] = $this->input->post('Lname');
        $arr['email'] = $this->input->post('Email');
        $arr['employee_id'] = $this->input->post('Emp_id');
        $arr['status'] = $this->input->post('Status');
        $arr['mobile_no'] = $this->input->post('Mobno');
        $arr['role'] = $this->input->post('role');
        $arr['company_name'] = $this->input->post('Subcom');
        $arr['manager'] = $this->input->post('manager');
        $arr['flag'] = 3;
        $arr['password'] ='$2y$10$mpRJnQQtqbyunWRuA/IN.e2YvinhiZd4EkJ06XDExOis0qO14L/Cu';
        //$arr['password'] = '2y$10$mpRJnQQtqbyunWRuA/IN.e2YvinhiZd4EkJ06XDExOis0qO14L/Cu';
     //   $arr = $this->input->post('2y$10$mpRJnQQtqbyunWRuA/IN.e2YvinhiZd4EkJ06XDExOis0qO14L/Cu') ?: 'password';
// $2y$10$mpRJnQQtqbyunWRuA/IN.e2YvinhiZd4EkJ06XDExOis0qO14L/Cu
        $this->db->insert('user_login',$arr);

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
        $arr['company_name'] = $this->input->post('Subcom');
        $arr['manager'] = $this->input->post('manager');
        $arr['flag'] = 3;

        $this->db->where(array('id'=>$id));
        $this->db->update('user_login',$arr);
    }
    function delete($id)
    {
      $arr['flag'] = 3; 
      $this->db->update('user_login',$arr);
      $delete_flag=1;
      $this->db->where('id',$id)->update('user_login',array('delete_flag'=>$delete_flag));
    }

     function getAllRole()
    {
      $this->load->model('settings_model');
      $this->settings_model->getRoleDetails();  
      $query = $this->db->get('roles_settings');

      $query = $this->db->query('SELECT id,role_name FROM roles_settings');
      
       return $query->result();
 
    }
    function getAllCompanyName($user_id)
    { 
        return $this->db->select('company_name')->from('user_login')->where(array('id' => $user_id,'delete_flag'=>0))->get()->row();

    }

    public function get_manager_query($company_name)
    {
        $query = $this->db->get_where('user_login', array('company_name' => $company_name,'role'=>'Manager','delete_flag'=>0));
        return $query->result();
    } 

    
   function sendEmailToUser($email)
   {
     $this->load->library('email');
     
     $config['protocol'] = 'smtp';
     $config['smtp_secure'] = 'mail';
     $config['smtp_host'] = '*******';
     $config['smtp_port'] = '587'; 
     $config['smtp_timeout'] = '7';
     $config['smtp_user'] = '*****';
     $config['smtp_pass'] = '****';
     $config['mailtype'] = 'html';
     //$config['charset'] = 'iso-8859-1';
     $config['charset'] = 'utf-8';
     $config['newline']    = "\r\n"; 
     $config['validation'] = TRUE;
     $config['wordwrap'] = TRUE;
     $config['_smtp_auth'] = TRUE;
      
   
      $this->email->initialize($config);
      $this->email->from('ticket@aaaa.com.my', "Admin Team");
      $this->email->to($email);  
      $this->email->subject("Confirmation Email ");
     
      $username = $this->input->post('Uname');

      $this->email->message("Dear User,\nPlease click on below URL or paste it into your browser to Login\n\n https://aaaa.superapp.com.my/"."\n"."\n\n To process login please use  Username: $username And Password 12345 , we recommend you change your password after login Thanks \n Admin Team.");
      $send = $this->email->send();
      if($send){
        return true;
      }else{
        return false;
      }
   } 


}




