<?php
class Staff extends CI_Controller
{ 
    function __construct()
    {
        parent::__construct(); 
         if(!$this->session->userdata('manager')) 
           redirect('admin');
          //$this->load->library('email');
          $this->load->model('manager/staff_model'); 
          //$this->load->library('form_validation');
    } 
    function index()
    {
       $user_id =  $this->session->userdata('manager');
        $company_name = $this->staff_model->getCompanyName($user_id);
            


       $data['staff'] = $this->staff_model->getStaffDetails($company_name);
    //   print_r($company_name); 
    //  die;
        $data['status'] =  $this->staff_model->getStatus();
       $this->load->view('manager/staff/index',$data);
    }
     function add() 
    {  
      //print_r($_REQUEST); 
    // die;
      $this->form_validation->set_rules('Uname', 'User Name', 'required|is_unique[user_login.username]');
      $this->form_validation->set_rules('Fname', 'First Name', 'required');
      $this->form_validation->set_rules('Lname', 'Last Name' , 'required');
      $this->form_validation->set_rules('Mobno', 'Mobile No', 'required|max_length[10]|min_length[9]|greater_than[0]');
      $this->form_validation->set_rules('Email', 'Email' , 'required');
      $this->form_validation->set_rules('Emp_id', 'Employee Id' , 'required|is_unique[user_login.employee_id]');
      $this->form_validation->set_rules('Status', 'Status' , 'required');
      // $this->form_validation->set_rules('role', 'Role', 'required');
      $this->form_validation->set_rules('Subcom', 'Sub Company' , 'required');
      //$this->form_validation->set_rules('manager', 'manager' , 'required');

      $user_id =  $this->session->userdata('manager');
      $company_name = $this->staff_model->getCompanyName($user_id);

      $data['staff'] = $this->staff_model->getStaffDetails($company_name); 
      $data['role_name'] = $this->staff_model->getAllRole();
      $data['company_name'] = $this->staff_model->getAllCompanyName($user_id);
      //  print_r($data);
      //   die;
 
      if ($this->form_validation->run() ==true)
      { 
        $this->staff_model->add(); 
         
      $email = $this->staff_model->sendEmailToUser($this->input->post('Email'));
        // print_r($_REQUEST);
        // die;
        if($email)  
      {
          $this->session->set_flashdata('success', 'A confirmation email has been sent to ' .$this->input->post('Email') ,$data);
          redirect('manager/staff/index');
          
      } else { 
          show_error($this->email->print_debugger());
          redirect('');
      }
    
        $this->session->set_flashdata ('success','Staff Added Sucessfully');

        redirect('manager/staff/index',$data);
      }
      else{
        $this->load->view('manager/staff/add',$data);
      }
    }

    function edit($id)
     {
       $user_id =  $this->session->userdata('manager');
       $data['staff'] = $this->staff_model->getById($id); 
       $data['role_name'] = $this->staff_model->getAllRole();
       $data['company_name'] = $this->staff_model->getAllCompanyName($user_id);

       $this->load->view('manager/staff/edit', $data);

    } 
    
    function update($id)
    {
      $this->form_validation->set_rules('Uname', 'User Name', 'required');
      $this->form_validation->set_rules('Fname', 'First Name', 'required');
      $this->form_validation->set_rules('Lname', 'Last Name' , 'required');
      $this->form_validation->set_rules('Mobno', 'Mobile No', 'required');
      $this->form_validation->set_rules('Email', 'Email' , 'required');
      $this->form_validation->set_rules('Emp_id', 'Employee Id' , 'required');
      //$this->form_validation->set_rules('Status', 'Status' , 'required'); 
      // $this->form_validation->set_rules('role', 'Role', 'required');
      $this->form_validation->set_rules('Subcom', 'Sub Company' , 'required');
       if ($this->form_validation->run() ==true)
      {
      $this->staff_model->update($id); 
    
      $this->session->set_flashdata ('success','Staff updated Sucessfully');
      redirect('manager_staff');}
      else{
       $user_id =  $this->session->userdata('manager');
       $data['staff'] = $this->staff_model->getById($id); 
       $data['role_name'] = $this->staff_model->getAllRole();
       $data['company_name'] = $this->staff_model->getAllCompanyName($user_id);

       $this->session->set_flashdata  ('Successmessages','Something Went Wrong, Please Fill Up All The Required Information');

       $this->load->view('manager/staff/edit', $data);
      }
    }
 
    function delete($id)
    {
       $this->staff_model->delete($id); 
       $this->session->set_flashdata ('success','Staff Deleted Sucessfully');
       redirect('manager_staff');
    }

    // public function sendemail(){
    //   echo "sdf";
    //   $email = $this->staff_model->sendEmailToUser('elangomsk@gmail.com');
    // }

}