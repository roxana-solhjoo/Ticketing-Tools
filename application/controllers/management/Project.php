<?php
class Project extends CI_controller
{ 
    function __construct()
    {
        parent::__construct();
         if(!$this->session->userdata('management'))
         redirect('admin');
          $this->load->helper('new_helper');
         $this->load->model('management/project_model');
    } 
    public function index ()
    {
        // print_r($_REQUEST);
        //   die;
      $data['company_name'] = $this->project_model->getAllCompanyName();
      $data['project'] = $this->project_model->getProjectDetails();
      $data['staff'] = $this->project_model->explodeStaff();
      
     // echo "<pre>";
      //print_r($data);die;
      $this->load->view('management/project/index',$data);
    }
    function add()
    {
      //echo "sdfsd";die;
      $this->form_validation->set_rules('Pname', 'Project Name', 'required');
      $this->form_validation->set_rules('Cname', 'Client Name' , 'required');
      $this->form_validation->set_rules('PassignTo', 'Company', 'required');
      $this->form_validation->set_rules('manager', 'Manager' , 'required');
      $this->form_validation->set_rules('staff[]', 'Support Staff', 'required');
      
      $data['company_name'] = $this->project_model->getAllCompanyName();
      $data['project'] = $this->project_model->getProjectDetails();
    
      if ($this->form_validation->run() ==true) 
      {
        
        $this->project_model->add(); 
        $this->session->set_flashdata ('success','Project Added Sucessfully');

          // print_r($_REQUEST);
        //  die;
        //   echo "<pre>";
        redirect('management/project/index',$data);
      }
      else{
        $this->load->view('management/project/add',$data);
      }

    }
    function edit($id)
    {
       $data['project'] = $this->project_model->getById($id); 
       $data['company_name'] = $this->project_model->getAllCompanyName();

       $this->load->view('management/project/edit', $data);

    }
    function update($id)
     {
        $this->form_validation->set_rules('Pname', 'Project Name', 'required');
        $this->form_validation->set_rules('Cname', 'Client Name' , 'required');
        $this->form_validation->set_rules('PassignTo', 'Company', 'required');
        $this->form_validation->set_rules('manager', 'Manager' , 'required');
        $this->form_validation->set_rules('staff[]', 'Support Staff', 'required');
       if ($this->form_validation->run() ==true)
       {

      $this->project_model->update($id); 
      $this->session->set_flashdata ('success','Project updated Sucessfully');
      redirect('management/project/index');
       }
       else{
         $data['project'] = $this->project_model->getById($id); 
        $data['company_name'] = $this->project_model->getAllCompanyName();
        $this->session->set_flashdata ('Successmessages','Something Went Wrong, Please Fill Up All The Required Information');

        $this->load->view('management/project/edit', $data);

       }
 
     }
    function delete($id)
    {
       $this->project_model->delete($id); 
       $this->session->set_flashdata ('success','Project Deleted Sucessfully');
       redirect('management_project');

    }
     public function getManager()
    {
      //echo json_encode ($_REQUEST); die;  
       //print_r($_REQUEST);
        //die;
      $company_name = $this->input->post('company_name');
      $getallmanager = $this->project_model->get_manager_query($company_name);
      $getallstaff = $this->project_model->get_all_staff($company_name);
      $all_the_mangers = '';
      $all_the_staffs = '';
      if(count($getallmanager)>0)
      {        
        foreach ($getallmanager as $manager){
          //if(role!=='manager')
          $all_the_mangers .='<option value="' .$manager->first_name.'">'.$manager->first_name.'</option>';
          
        }
          
      }
      if(count($getallstaff)>0)
      {        
        foreach ($getallstaff as $staff){
          $all_the_staffs .='<option value="' .$staff->first_name.'">'.$staff->first_name.'</option>';
        }
        
      }
      $result = array('manager'=>$all_the_mangers,'staffs'=>$all_the_staffs);
      echo json_encode($result);die;
      
    }
  
    function getMangerList()
    {
      //  echo json_encode ("sdf"); die;
      //   print_r($_REQUEST);
      //    die;
       $project_manager = $this->input->post('project_manager');
      if($this->input->post('company_name'))
      {
         $data = $this->project_model->getMangerList($this->input->post('company_name'),$project_manager);
         echo json_encode ($data); die;
      }
    }
    
    function getAllStaffsList()
    {
      $support_staff = $this->input->post('support_staff');
      if($this->input->post('company_name'))
      {
         $data = $this->project_model->getAllStaffsList($this->input->post('company_name'),$support_staff);
         echo json_encode ($data); die;
      }
    }

  
} 
 