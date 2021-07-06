<?php
class Settings extends CI_controller
{
    function __construct()
    {
        parent::__construct();
         if(!$this->session->userdata('admin'))
         redirect('admin');
        $this->load->model('settings_model');
    }

     function index ()
    {
      $data['role'] = $this->settings_model->getRoleDetails();
      $data ['department'] = $this->settings_model->getDepartmentDetails();
      $data['team'] = $this->settings_model->getTeamDetails();
      $data['clients'] = $this->settings_model->getClientsDetails();
      // echo "<pre>"; print_r($data);die;
      $this->load->view('admin/settings/index', $data);

    }
    
    function create()
    {
      $this->settings_model->create();
      $this->session->set_flashdata ('success','Email Added Sucessfully');
      redirect('admin/settings/index');
    } 

    function addRole()
    {
      $this->settings_model->addRole();
      $this->session->set_flashdata ('success','Role Added Sucessfully');
      redirect('admin/settings/index');
    }

    function addDepartment()
    {
      $this->settings_model->addDepartment();
      $this->session->set_flashdata ('success','Department Added Sucessfully');
      redirect('admin/settings/index');

    }

    function addTeam()
    {
      $this->settings_model->addTeam();
      $this->session->set_flashdata ('success','Team Added Sucessfully');
      redirect('admin/settings/index');
    }

    function addClient()
    {
      $this->settings_model->addClient();
      $this->session->set_flashdata ('success','Client Added Sucessfully');
      redirect('admin/settings/index');
    }

     function edit()
    {
      $id = $_REQUEST['id'];
      $data = $this->settings_model->getById($id);
      echo json_encode($data);
      die;
    }


    function edit_department(){
      $id = $_REQUEST['id'];
      $data = $this->settings_model->getByIdDepartment($id);
      echo json_encode($data);
      die;
    } 

    function edit_team(){
      $id = $_REQUEST['id'];
      $data = $this->settings_model->getByIdTeam($id);
      echo json_encode($data);
      die;
    } 

    function edit_clients(){
      $id = $_REQUEST['id'];
      $data = $this->settings_model->getByIdClient($id);
      echo json_encode($data);
      die;
    } 
    
    function update_role()
    {
      $id = $_REQUEST['Edit_row'];
      $this->settings_model->update_role($id); 
      $this->session->set_flashdata ('success','Information updated Sucessfully');
      redirect('admin/settings/index');

    }

    function update_Department()
    {
      $id = $_REQUEST['DEdit_row'];
      $this->settings_model->update_Department($id); 
      $this->session->set_flashdata ('success','Information updated Sucessfully');
      redirect('admin/settings/index');

    }

    function update_team()
    {
      $id = $_REQUEST['TEdit_row'];
      $this->settings_model->update_team($id); 
      //  print_r($_REQUEST);
      //     die;
      $this->session->set_flashdata ('success','Information updated Sucessfully');
      redirect('admin/settings/index');
    }

    function update_client()
    {
      $id = $_REQUEST['CEditRow'];
      $this->settings_model->update_client($id); 
      //  print_r($_REQUEST);
      //     die;
      $this->session->set_flashdata ('success','Client updated Sucessfully');
      redirect('admin/settings/index');
    }


    function Delete($id)
    {
       $this->settings_model->delete($id); 
       $this->session->set_flashdata ('success','Information Deleted Sucessfully');
       redirect('admin/settings/index');

       $this->settings_model->delete($id); 
       $this->session->set_flashdata ('success','Information Deleted Sucessfully');
       redirect('admin/settings/index');

       $this->settings_model->delete($id); 
       $this->session->set_flashdata ('success','Information Deleted Sucessfully');
       redirect('admin/settings/index');
    }


    function DeleteClient($id)
    {
       $this->settings_model->DeleteClient($id); 
       $this->session->set_flashdata('success','Client Deleted Sucessfully');
       redirect('admin/settings/index');
    }

}