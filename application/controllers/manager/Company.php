<?php
class Company extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
         if(!$this->session->userdata('manager'))
           redirect('admin');
           $this->load->model('manager/company_model');
    }
 
    function index()
    {
       $data['company'] = $this->company_model->getCompanyDetails();
      //  print_r($data);die; 
       $this->load->view('manager/company/index', $data);
    }

    function add()
    {
      
      $this->form_validation->set_rules('Cname' , 'Company Name' , 'required');
      $this->form_validation->set_rules('shname' , 'Short Name' , 'required');
      $this->form_validation->set_rules('regNo' , 'Registration No' , 'required');

      $data['company'] = $this->company_model->getCompanyDetails();

      if($this->form_validation->run() == true)
      {
        $this->company_model->add();
        $this->session->set_flashdata ('success','Company Added Sucessfully');
        redirect('manager/company/index', $data);
      }
      else
      {
        $this->load->view('manager/company/add',$data); 
        
      }
    }
    function edit($id)
     {
       $data['company'] = $this->company_model->getById($id); 
       $this->load->view('manager/company/edit', $data);

    } 
     function update($id)
     
    {
      $this->form_validation->set_rules('Cname' , 'Company Name' , 'required');
      $this->form_validation->set_rules('shname' , 'Short Name' , 'required');
      $this->form_validation->set_rules('regNo' , 'Registration No' , 'required');
      if($this->form_validation->run() == true)
      {
      // echo json_encode ("sdf"); die;
      //    print_r($_REQUEST);
      //     die;
      $this->company_model->update($id); 
      $this->session->set_flashdata ('success','Company updated Sucessfully');
      redirect('manager/company/index');}
      else{
         $data['company'] = $this->company_model->getById($id); 
         $this->session->set_flashdata ('Successmessages','Something Went Wrong, Please Fill Up All The Required Information');
          $this->load->view('admin/company/edit', $data);

      }
 
    }

    function delete($id)
    {
       $this->company_model->delete($id); 
       $this->session->set_flashdata ('success','Company Deleted Sucessfully');
       redirect('manager/company/index');

    }
}
