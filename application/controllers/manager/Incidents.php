<?php
class Incidents extends CI_controller
{
    function __construct()
    {
         parent::__construct();
         if(!$this->session->userdata('manager'))
         redirect('admin');
         $this->load->model('manager/incidents_model');
         $this->load->model('manager/project_model');
          $this->load->model('manager/task_model'); 


         
    }

     function index($type='') 
    {
      $user_id =  $this->session->userdata('manager');
      $data['Type'] = (isset($type) && !(empty($type)))?($type):"";
      $project_manager = $this->task_model->getmanager($user_id);
      // print_r($project_manager);  
      //   die;
      $project_manager_projects = $this->task_model->getProjectDetails($project_manager);
      //  print_r($project_name); 
      // }
      $data['incidents'] = $this->incidents_model->getIncidentsDetails($project_manager_projects);
      // echo "<pre>";print_r($data);die;
    
 
      $data['inProgressIncidents']= $this->incidents_model->getInProgressIncidentsNumber($project_manager_projects);
      $data['completedIncidents'] = $this->incidents_model->getcompletedIncidentsNumber($project_manager_projects);
      $data['openIncidents'] = $this->incidents_model->getOpenIncidentsNumber($project_manager_projects);
      $data['onHoldIncidentsNumber'] = $this->incidents_model->getOnHoldIncidentsNumber($project_manager_projects);
      $data['totalIncidents'] = $this->incidents_model->getAllIncidentsNumber($project_manager_projects);
  
      $this->load->view('manager/incidents/index',$data);

    }
     

    function add()
  {  
    // echo "<pre>";
    //     print_r($REQUEST);
    //     die;
  $existing_count = $this->incidents_model->get_task_count();
  $data['T_id']  = 'T'.sprintf("%'.03d\n",$existing_count+1);
  
  $this->form_validation->set_rules('T_id', 'Tasks Id', 'required');
  $this->form_validation->set_rules('Tname', 'Tasks Name' , 'required');
  $this->form_validation->set_rules('Cname', 'Company Name ', 'required');
  $this->form_validation->set_rules('Pname', 'Project Name' , 'required');
  $this->form_validation->set_rules('Pversion', 'Project Version', 'required');
  $this->form_validation->set_rules('Rform', 'Report From ', 'required');
  $this->form_validation->set_rules('Internal', 'Internal ', 'required');
  $this->form_validation->set_rules('Assignto', 'Assign To' , 'required');
  $this->form_validation->set_rules('Sdate', 'Start Date', 'required');
  $this->form_validation->set_rules('Edate', 'End Date' , 'required');
  $this->form_validation->set_rules('Status', 'Status ', 'required');
  $this->form_validation->set_rules('Priority', 'Priority' , 'required');
  $this->form_validation->set_rules('Description', 'Description' , 'required');
  
  $user_id =  $this->session->userdata('manager'); 
  //$data['incidents'] = $this->incidents_model->getIncidentsDetails($project_manager_projects);
  $data['T_id'] = $this->incidents_model->get_task_count();
  $data['company_name'] = $this->incidents_model->getAllCompanyName($user_id);


if ($this->form_validation->run() ==true)
  {
    $image_name = "";
  if (isset($_FILES['filename']))
  { 
      $file_name = time().'_'.trim($_FILES['filename']['name']);
      $temp = explode(".", trim($_FILES["filename"]["name"]));
      $new_name = round(microtime(true)) . '.' . end($temp);

      $config['upload_path']          = './uploads/';
      $config['allowed_types']        = '*';
      $config['max_size']             = 0;
      $config['max_width']            = 0;
      $config['max_height']           = 0;
      // $config['encrypt_name'] = FALSE;
      $config['overwrite'] = TRUE;
      $config['file_name']          = $new_name; 

       $this->load->library('upload', $config);

       
      //print_r($config);die;
      $this->upload->initialize($config);

      if ( ! $this->upload->do_upload('filename'))
      {
       // echo "test";///die;
              $error = array('error' => $this->upload->display_errors());

              print_r($error);die;
              $this->load->view('manager/incidents/add', $error);
      }
      else
      {
            $image_data = $this->upload->data();
						$image_name  =   $image_data['file_name'];
						 $data =array(
						  'file' => $new_name
            );

            //print_r($data);die;
               

        }
   }
   $data['file'] = $this->incidents_model->add($image_name);
    //$this->incidents_model->add();
    $this->session->set_flashdata ('success','Incidents Added Sucessfully');
    redirect('manager/incidents/index' ,$data);
  }
  else{
    $this->load->view('manager/incidents/add', $data);
  }
}

    function edit($id)
     {
       $user_id = $this->session->userdata('manager');
       $data['incidents'] = $this->incidents_model->getById($id); 
       $data['incidents_history'] = $this->incidents_model->getById_history($id);
       $data['company_name'] = $this->incidents_model->getAllCompanyName($user_id);
      // $data['manager'] = $this->project_model->getmanager($user_id);

       $this->load->view('manager/incidents/edit', $data);
    }
    
    function update($id)
    {
     
      $this->form_validation->set_rules('T_id', 'Tasks Id', 'required');
      $this->form_validation->set_rules('Tname', 'Tasks Name' , 'required');
      $this->form_validation->set_rules('Cname', 'Company Name ', 'required');
      $this->form_validation->set_rules('Pname', 'Project Name' , 'required');
      $this->form_validation->set_rules('Pversion', 'Project Version', 'required');
      $this->form_validation->set_rules('Rform', 'Report From ', 'required');
      $this->form_validation->set_rules('Internal', 'Internal ', 'required');
      $this->form_validation->set_rules('Assignto', 'Assign To' , 'required');
      $this->form_validation->set_rules('Sdate', 'Start Date', 'required');
      $this->form_validation->set_rules('Edate', 'End Date' , 'required');
      $this->form_validation->set_rules('Status', 'Status ', 'required');
      $this->form_validation->set_rules('Priority', 'Priority' , 'required');
      $this->form_validation->set_rules('Description', 'Description' , 'required');
    
      $data['incidents'] = $this->incidents_model->getById($id); 
      $data['incidents_history'] = $this->incidents_model->getById_history($id);
      
      if ($this->form_validation->run() ==true)
      {
        $image_name = "";
        if (isset($_FILES['filename']))
  { 
    // echo "<pre>";
    //     print_r($_FILES); 
    //     die;
    
      $file_name = time().'_'.trim($_FILES['filename']['name']);
      $config['upload_path']          = './uploads/';
      $config['allowed_types']        = '*';
      $config['max_size']             = 100;
      $config['max_width']            = 1024; 
      $config['max_height']           = 768;
      $config['overwrite'] = TRUE;
      $config['file_name']          = $file_name; 
      
      $this->load->library('upload', $config);

      $this->upload->initialize($config);

      if ( ! $this->upload->do_upload('filename'))
      {
              $error = array('error' => $this->upload->display_errors());
              $this->load->view('manager/incidents/edit', $error);
      }
      else
      {
            $image_data = $this->upload->data();
						$image_name  =  $image_data['file_name'];
						 $data =array(
						  'file' => $image_data['file_name']
            );
               // $data['file'] = $this->incidents_model->update($image_name);

        }
   }
      $this->incidents_model->update($id,$image_name); 
      $this->session->set_flashdata ('success','Incidents updated Sucessfully');
      redirect('manager/incidents/index');
      }else{
        $user_id =  $this->session->userdata('manager'); 
        $data['incidents'] = $this->incidents_model->getById($id); 
        $data['company_name'] = $this->incidents_model->getAllCompanyName($user_id);

       
         $this->session->set_flashdata ('Successmessages','Something Went Wrong, Please Fill Up All The Required Information ');
         $this->load->view('manager/incidents/edit', $data);

      }
    }
    function delete($id)
    {
       $this->incidents_model->delete($id); 
       $this->session->set_flashdata ('success','Incidents Deleted Sucessfully');
       redirect('manager_incidents');


    }
    function getAllProject()
    {
      $user_id =  $this->session->userdata('manager');
      $manager = $this->project_model->getmanager($user_id);

      if($this->input->post('company_name'))
      {
          
         $data = $this->incidents_model->getAllProject($this->input->post('company_name'),$manager);
         echo json_encode ($data); die;
      }
    }
    
    function getProjectList()
    {
       $user_id =  $this->session->userdata('manager');
       $manager =  $this->project_model->getmanager($user_id);
       $project_name = $this->input->post('project_name');
      if($this->input->post('company_name'))
      {
        $user_id =  $this->session->userdata('manager');
      $manager =  $this->project_model->getmanager($user_id);
         $data = $this->incidents_model->getProjectList($this->input->post('company_name'),$project_name,$manager);
         echo json_encode ($data); die;
      } 
    }
 
   
    function getstaffsList()
    {
       $support_staff = $this->input->post('support_staff');
       if($this->input->post('project_name'))
      {
         $data = $this->incidents_model->getstaffsList($this->input->post('project_name'),$support_staff);
         echo json_encode ($data); die;
      }
    }

  function getAllStaff()
  {
   if($this->input->post('project_name'))
   {
    $data = $this->incidents_model->getAllStaff($this->input->post('project_name'));
     echo json_encode ($data); die;
   }
   }

    
   function incidentsView($id)
   {
     // $data['incidentss'] = $this->incidents_model->getIncidentsDetails();

      $user_id =  $this->session->userdata('manager');

      $data['incidents'] = $this->incidents_model->getById($id);
      $data['incidents_history'] = $this->incidents_model->getById_history($id); 
      $data['company_name'] = $this->incidents_model->getAllCompanyName($user_id);
      //  echo "<pre>";
      // print_r($data);die;
     $this->load->view('manager/incidents/incidentsView',$data); 
   }

   function OnHoldIncidents() 
   {
    $user_id =  $this->session->userdata('manager');
    $project_manager = $this->task_model->getmanager($user_id);
    $project_manager_projects = $this->task_model->getProjectDetails($project_manager);
    
    $incidents = $this->incidents_model->OnHoldIncidents($project_manager_projects);
      //  print_r($data);die;
      $html = "";
      foreach($incidents as $n)
      {
        $html.=    "<tr><td><a href='".site_url ('manager_incidentsView/' .$n->id)."'>aaaa_IN ".str_pad($n->incidents_id, '4', '0', STR_PAD_LEFT)."</a></td>
        <td>".$n->incident_name."</td>
        <td>".$n->start_date."</td>
        <td>".date('Y-m-d',strtotime($n->end_date))."</td>
        <td><a class='pro-circle'><img class='img-sm' src='".site_url('assets/image/man.png')."' data-original-title='Click to deactivate the user' title=".$n->first_name."></a></td>
        <td><span class='badge badge-danger'>".$n->priority."</span></td>
        <td>".$n->status."</td>
        <td><a class='edit' href='".site_url('manager_incidents_edit/'.$n->id)."'><i class='fa fa-pencil-square-o'></i></a>&nbsp
                             <a class='delete' href='". site_url ('manager_incidents_delete/'.$n->id)."' onclick='return confirm('Are you sure want to Delete this Record?')'><i class='fa fa-trash-o'></i></a>&nbsp</td>
        </tr>";
      }
      // print_r($html);die;
      echo json_encode ($html); die;
   }
   function InProgressIncidents()
   {
     $user_id =  $this->session->userdata('manager');
     $project_manager = $this->task_model->getmanager($user_id);
     $project_manager_projects = $this->task_model->getProjectDetails($project_manager);
     $incidents = $this->incidents_model->InProgressIncidents($project_manager_projects);
      //  print_r($data);die;
      $html = "";
      foreach($incidents as $n)
      {
        $html.=    "<tr><td><a href='".site_url ('manager_incidentsView/' .$n->id)."'>aaaa_IN ".str_pad($n->incidents_id, '4', '0', STR_PAD_LEFT)."</a></td>
        <td>".$n->incident_name."</td>
        <td>".$n->start_date."</td>
        <td>".date('Y-m-d',strtotime($n->end_date))."</td>
        <td><a class='pro-circle'><img class='img-sm' src='".site_url('assets/image/man.png')."' data-original-title='Click to deactivate the user' title=".$n->first_name."></a></td>
        <td><span class='badge badge-danger'>".$n->priority."</span></td>
        <td>".$n->status."</td>
        <td><a class='edit' href='".site_url('manager_incidents_edit/'.$n->id)."'><i class='fa fa-pencil-square-o'></i></a>&nbsp
                             <a class='delete' href='". site_url ('manager_incidents_delete/'.$n->id)."' onclick='return confirm('Are you sure want to Delete this Record?')'><i class='fa fa-trash-o'></i></a>&nbsp</td>
        </tr>";
      }
      // print_r($html);die;
      echo json_encode ($html); die;

   }
    function OpenIncidents()
   {
     $user_id =  $this->session->userdata('manager');
     $project_manager = $this->task_model->getmanager($user_id);
     $project_manager_projects = $this->task_model->getProjectDetails($project_manager);
      $incidents = $this->incidents_model->OpenIncidents( $project_manager_projects);
      //  print_r($data);die;
      $html = "";
      foreach($incidents as $n)
      {
        $html.=    "<tr><td><a href='".site_url ('manager_incidentsView/' .$n->id)."'>aaaa_IN ".str_pad($n->incidents_id, '4', '0', STR_PAD_LEFT)."</a></td>
        <td>".$n->incident_name."</td>
        <td>".$n->start_date."</td>
        <td>".date('Y-m-d',strtotime($n->end_date))."</td>
        <td><a class='pro-circle'><img class='img-sm' src='".site_url('assets/image/man.png')."' data-original-title='Click to deactivate the user' title=".$n->first_name."></a></td>
        <td><span class='badge badge-danger'>".$n->priority."</span></td>
        <td>".$n->status."</td>
        <td><a class='edit' href='".site_url('manager_incidents_edit/'.$n->id)."'><i class='fa fa-pencil-square-o'></i></a>&nbsp
                             <a class='delete' href='". site_url ('manager_incidents_delete/'.$n->id)."' onclick='return confirm('Are you sure want to Delete this Record?')'><i class='fa fa-trash-o'></i></a>&nbsp</td>
        </tr>";
      }
      // print_r($html);die; 
      echo json_encode ($html); die;

   }
     function CompletedIncidents()
     {
       $user_id =  $this->session->userdata('manager');
     $project_manager = $this->task_model->getmanager($user_id);
     $project_manager_projects = $this->task_model->getProjectDetails($project_manager);
      $incidents = $this->incidents_model->CompletedIncidents($project_manager_projects);
      //  print_r($data);die;
      $html = "";
      foreach($incidents as $n)
      {
        $html.=    "<tr><td><a href='".site_url ('manager_incidentsView/' .$n->id)."'>aaaa_IN ".str_pad($n->incidents_id, '4', '0', STR_PAD_LEFT)."</a></td>
        <td>".$n->incident_name."</td>
        <td>".$n->start_date."</td>
        <td>".date('Y-m-d',strtotime($n->end_date))."</td>
        <td><a class='pro-circle'><img class='img-sm' src='".site_url('assets/image/man.png')."' data-original-title='Click to deactivate the user' title=".$n->first_name."></a></td>
        <td><span class='badge badge-danger'>".$n->priority."</span></td>
        <td>".$n->status."</td>
        <td><a class='edit' href='".site_url('manager_incidents_edit/'.$n->id)."'><i class='fa fa-pencil-square-o'></i></a>&nbsp
                             <a class='delete' href='". site_url ('manager_incidents_delete/'.$n->id)."' onclick='return confirm('Are you sure want to Delete this Record?')'><i class='fa fa-trash-o'></i></a>&nbsp</td>
        </tr>";
      }
      // print_r($html);die;
      echo json_encode ($html); die;

    }

     function TotalIncidents()
   {
      $user_id =  $this->session->userdata('manager');
     $project_manager = $this->task_model->getmanager($user_id);
     $project_manager_projects = $this->task_model->getProjectDetails($project_manager);
      $incidents = $this->incidents_model->TotalIncidents( $project_manager_projects);
      //  print_r($data);die;
      $html = "";
      foreach($incidents as $n) 
      {
        $html.=    "<tr><td><a href='".site_url ('manager_incidentsView/' .$n->id)."'>aaaa_IN ".str_pad($n->incidents_id, '4', '0', STR_PAD_LEFT)."</a></td>
        <td>".$n->incident_name."</td>
        <td>".$n->start_date."</td> 
        <td>".date('Y-m-d',strtotime($n->end_date))."</td>
        <td><a class='pro-circle'><img class='img-sm' src='".site_url('assets/image/man.png')."' data-original-title='Click to deactivate the user' title=".$n->first_name."></a></td>
        <td><span class='badge badge-danger'>".$n->priority."</span></td>
        <td>".$n->status."</td>
        <td><a class='edit' href='".site_url('manager_incidents_edit/'.$n->id)."'><i class='fa fa-pencil-square-o'></i></a>&nbsp
                             <a class='delete' href='". site_url ('manager_incidents_delete/'.$n->id)."' onclick='return confirm('Are you sure want to Delete this Record?')'><i class='fa fa-trash-o'></i></a>&nbsp</td>
        </tr>";
      }
      // print_r($html);die;
      echo json_encode ($html); die;

   }
    function get_pdf_test($id)
    {
     $data['incidents'] = $this->incidents_model->getByIdPdf($id);
     $data['incidents_history'] = $this->incidents_model->getById_history_pdf($id); 
    
      require_once (APPPATH. 'vendor/autoload.php');
      $path = '/tmp/mpdf'; 
      if (!file_exists($path)) {
      mkdir($path, 0777, true);
      }

      $mpdf = new \Mpdf\Mpdf(['tempDir' => $path]);
      $mpdf->SetHTMLHeader((('<img src="./assets/image/logo.png">')));

      $html = $this->load->view('manager/incidents/incidentsPdf', $data,true);
      
      $mpdf->WriteHTML($html);
      $mpdf->setFooter('  ');
     
      $mpdf->Output(); 
      $mpdf->Output('incidentsPdf.pdf','D');

    }
     public function downloadFile($incidents_id)
       {
         
      $file = $this->incidents_model->getfile($incidents_id);
      //echo $file; die;
      $this->load->helper('download');

      $context = stream_context_create([
        "ssl" => [
          "verify_peer" => FALSE,
          "verify_peer_name" => FALSE,
        ],
        "http" => [
          "ignore_errors" => TRUE,
        ],
      ]);

      $path = file_get_contents(base_url()."uploads/".$file,NULL,$context);
      $name = $file; 
      // print_r($path);die;
      force_download($name, $path); 
      
       }
      



  }

