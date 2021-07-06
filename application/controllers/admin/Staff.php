<?php
class Staff extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
         if(!$this->session->userdata('admin')) 
           redirect('admin');

          //$this->load->library('email');

          $this->load->model('staff_model'); 
          $this->load->model('CommonQuery'); 
          //$this->load->library('form_validation');
    }  
    function index()
    {
      $data['staff'] = $this->staff_model->getStaffDetails();
      $data['status'] =  $this->staff_model->getStatus();
    //     print_r($data);  
    // die;
       $this->load->view('admin/staff/index',$data);
    }
     function add() 
    {  
      //print_r($_REQUEST);  
    // die;
      $this->form_validation->set_rules('Uname', 'User Name', 'required|is_unique[user_login.username]');
      $this->form_validation->set_rules('Fname', 'First Name', 'required');
      $this->form_validation->set_rules('Lname', 'Last Name' , 'required');
      $this->form_validation->set_rules('Mobno', 'Mobile No', 'required|max_length[10]|min_length[9]|greater_than[0]');
      $this->form_validation->set_rules('Email', 'Email' , 'required|is_unique[user_login.email]');
      $this->form_validation->set_rules('Emp_id', 'Employee Id' , 'required|is_unique[user_login.employee_id]');
      $this->form_validation->set_rules('Status', 'Status' , 'required');
      $this->form_validation->set_rules('role', 'Role', 'required');
      $this->form_validation->set_rules('Subcom[]', 'Sub Company' , 'required');

      
      $data['staff'] = $this->staff_model->getStaffDetails();
      $data['role_name'] = $this->staff_model->getAllRole();
      $data['company_name'] = $this->staff_model->getAllCompanyName();
      
 
      if ($this->form_validation->run() ==true)
      {
        $this->staff_model->add(); 
   
       $email = $this->staff_model->sendEmailToUser($this->input->post('Email'));
        // print_r($_REQUEST);
        // die;
        if($email)  
      {
          $this->session->set_flashdata('success', 'A confirmation email has been sent to ' .$this->input->post('Email') );
          redirect('admin/staff/index');
          
      } else { 
          show_error($this->email->print_debugger());
          redirect('');
      }
    
        $this->session->set_flashdata ('success','Staff Added Sucessfully');

        redirect('admin/staff/index',$data);
      }
      else{
        $this->load->view('admin/staff/add',$data);
      }

 
    }

    function edit($id)
     {
       $data['staff'] = $this->staff_model->getById($id); 
       $data['role_name'] = $this->staff_model->getAllRole();
       $data['company_name'] = $this->staff_model->getAllCompanyName();
       $data['selectedCompany'] = $this->staff_model->selectedCompany($id);

       $this->load->view('admin/staff/edit', $data);

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
      $this->form_validation->set_rules('role', 'Role', 'required');
      $this->form_validation->set_rules('Subcom[]', 'Sub Company' , 'required');
       if ($this->form_validation->run() ==true)
      {
        $where  = array('username' => $this->input->post('Uname'),'id !='=>$id );
        $getUsername = $this->CommonQuery->getTableData('user_login','',$where,'','','')->num_rows();
        if($getUsername > 0){
           $this->session->set_flashdata ('success','Username should be unique');
            redirect('staff');
        }

        $where  = array('email' => $this->input->post('Email'),'id !='=>$id );
        $getEmail = $this->CommonQuery->getTableData('user_login','',$where,'','','')->num_rows();
        if($getEmail > 0){
           $this->session->set_flashdata ('success','Email should be unique');
            redirect('staff');
        }

        $where  = array('employee_id' => $this->input->post('Emp_id'),'id !='=>$id );
        $getEmployeeId = $this->CommonQuery->getTableData('user_login','',$where,'','','')->num_rows();
        if($getEmployeeId > 0){
           $this->session->set_flashdata ('success','Employee id should be unique');
            redirect('staff');
        }


      $this->staff_model->update($id); 
    
      $this->session->set_flashdata ('success','Staff updated Sucessfully');
      redirect('staff');}
      else{

       $data['staff'] = $this->staff_model->getById($id); 
       $data['role_name'] = $this->staff_model->getAllRole();
       $data['company_name'] = $this->staff_model->getAllCompanyName();

       $this->session->set_flashdata  ('Successmessages','Something Went Wrong, Please Fill Up All The Required Information');

       $this->load->view('admin/staff/edit', $data);
      }
    }
 
    function delete($id)
    {
       $this->staff_model->delete($id); 
       $this->session->set_flashdata ('success','Staff Deleted Sucessfully');
       redirect('staff');

    }

    public function sendemail(){
      echo "sdf";
      $email = $this->staff_model->sendEmailToUser('elangomsk@gmail.com');
    }

}