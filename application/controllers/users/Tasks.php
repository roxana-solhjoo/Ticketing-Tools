<?php
class Tasks extends CI_controller
{  
    function __construct()
    {
        parent::__construct();
          if(!$this->session->userdata('front_user'))
          redirect('admin');

        $this->load->model('users/task_model');
 
    }

     function index() 
     
    { 
        //    print_r($_REQUEST);
        // die;
      $user_id = $this->session->userdata('front_user');

      $data['tasks'] = $this->task_model->getTaskByUserID($user_id); 

      $data['inProgressTasks']= $this->task_model->getInProgressTasksNumber($user_id);
      $data['completedTasks'] = $this->task_model->getcompletedTasksNumber($user_id);
      $data['openTasks'] = $this->task_model->getOpenTasksNumber($user_id);
      $data['onHoldTasks'] = $this->task_model->getOnHoldTasksNumber($user_id);
      $data['totalTasks'] = $this->task_model->getAllTasksNumber($user_id);

        $this->load->view('users/tasks/index',$data);
    }


    function add()
    {
      $existing_count = $this->task_model->get_task_count();
      $data['T_id']  = 'T'.sprintf("%'.03d\n",$existing_count+1);
      $data['clients'] = $this->task_model->getAllClients();

      $this->form_validation->set_rules('T_id', 'Tasks Id', 'required');
      $this->form_validation->set_rules('Tname', 'Tasks Name' , 'required');
      $this->form_validation->set_rules('Cname', 'Company Name ', 'required');
      $this->form_validation->set_rules('Pname', 'Project Name' , 'required');
      $this->form_validation->set_rules('Pversion', 'Project Version', 'required');
      $this->form_validation->set_rules('Rform', 'Report From ', 'required');
      $this->form_validation->set_rules('Internal', 'Received from ', 'required');
      $this->form_validation->set_rules('Assignto', 'Assign To' , 'required');
      $this->form_validation->set_rules('Sdate', 'Start Date', 'required');
      $this->form_validation->set_rules('Edate', 'End Date' , 'required');
      $this->form_validation->set_rules('Status', 'Status ', 'required');
      $this->form_validation->set_rules('Priority', 'Priority' , 'required');
      $this->form_validation->set_rules('Description', 'Description' , 'required');
      
      $data['tasks'] = $this->task_model->getTasksDetails(); 
      $data['T_id'] = $this->task_model->get_task_count();
      $data['company_name'] = $this->task_model->getAllCompanyName();

      if ($this->form_validation->run() ==true)
      {
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
      $config['overwrite'] = TRUE;
      $config['file_name']          = $new_name; 

       $this->load->library('upload', $config);
       $this->upload->initialize($config);

      if ( ! $this->upload->do_upload('filename'))
      {
              $error = array('error' => $this->upload->display_errors());

              print_r($error);die;
              $this->load->view('users/tasks/add', $error);
      }
      else
      {
            $image_data = $this->upload->data();
						$image_name  =   $image_data['file_name'];
						 $data =array(
						  'file' => $new_name
            );

            //print_r($data);die;
               $data['file'] = $this->task_model->add($image_name);

        }
   }
    $this->session->set_flashdata ('success','Task Added Sucessfully');
    redirect('users/tasks/index' ,$data);
  }
  else{
    $this->load->view('users/tasks/add', $data);
  }
}
    function edit($id)
      {  
      $data['tasks'] = $this->task_model->getById($id); 
      $data['tasks_history'] = $this->task_model->getById_history($id);
      $data['company_name'] = $this->task_model->getAllCompanyName();
       $data['clients'] = $this->task_model->getAllClients();
       $this->load->view('users/tasks/edit',$data);

    }

    function update($id)
    {
       $this->form_validation->set_rules('T_id', 'Tasks Id', 'required');
      $this->form_validation->set_rules('Tname', 'Tasks Name' , 'required');
      $this->form_validation->set_rules('Cname', 'Company Name ', 'required');
      $this->form_validation->set_rules('Pname', 'Project Name' , 'required');
      $this->form_validation->set_rules('Pversion', 'Project Version', 'required');
      $this->form_validation->set_rules('Rform', 'Report From ', 'required');
      $this->form_validation->set_rules('Internal', 'Received from ', 'required');
      $this->form_validation->set_rules('Assignto', 'Assign To' , 'required');
      $this->form_validation->set_rules('Sdate', 'Start Date', 'required');
      $this->form_validation->set_rules('Edate', 'End Date' , 'required');
      $this->form_validation->set_rules('Status', 'Status ', 'required');
      $this->form_validation->set_rules('Priority', 'Priority' , 'required');
      $this->form_validation->set_rules('Description', 'Description' , 'required');

       if ($this->form_validation->run() ==true)
      {
      $image_name = "";
      if (isset($_FILES['filename']))
     { 
    
    
      $file_name = time().'_'.trim($_FILES['filename']['name']);
      $config['upload_path']          = './uploads/';
      $config['allowed_types']        = '*';
      $config['max_size']             = 100;
      $config['max_width']            = 1024;
      $config['max_height']           = 768;
      $config['overwrite'] = TRUE;
      $config['file_name']          = $file_name; 
      // print_r($config); 
      //   die;
      $this->load->library('upload', $config);

      $this->upload->initialize($config);

      if ( ! $this->upload->do_upload('filename'))
      {
              $error = array('error' => $this->upload->display_errors());
              $this->load->view('users/tasks/edit', $error);
      }
      else
      {
            $image_data = $this->upload->data();
            // print_r($image_data); 
            //    die;
						$image_name  =  $image_data['file_name'];
						 $data =array(
						  'file' => $image_data['file_name']
            );
               // $data['file'] = $this->incidents_model->update($image_name);

        }
   }


     $this->task_model->update($id,$image_name); 
      $this->session->set_flashdata ('success','Task updated Sucessfully');
      redirect('users/tasks/index');
      }else{
        $user_id =  $this->session->userdata('manager');
        $data['tasks'] = $this->task_model->getById($id); 
        $data['company_name'] = $this->task_model->getAllCompanyName($user_id);
        $data['tasks_history'] = $this->task_model->getById_history($id);

         $this->session->set_flashdata ('Successmessages','Something Went Wrong, Please Fill Up All The Required Information ');
         $this->load->view('users/tasks/edit', $data);

      }
    }
    function delete($id)
    {
       $this->task_model->delete($id); 
       $this->session->set_flashdata ('success','Task Deleted Sucessfully');
       redirect('users/tasks/index');

    }
    function getAllProject()
    {
      if($this->input->post('company_name'))
      {
         $data = $this->task_model->getAllProject($this->input->post('company_name'));
         echo json_encode ($data); die;
      }
    }

    function getAllStaff()
    {
     if($this->input->post('project_name')) 
     {
        $data = $this->task_model->getAllStaff($this->input->post('project_name'));
       echo json_encode ($data); die;

     } 
   }

    function taskView($id )
    {
        
      //= ''
    //print_r($_REQUEST);
       //  die;
     //echo "<pre>";
     //if(){

     //}
       $data['tasks'] = $this->task_model->getById($id); 
       $data['tasks_history'] = $this->task_model->getById_history($id); 
       $data['company_name'] = $this->task_model->getAllCompanyName();
        // echo "<pre>";
        //  print_r($data);
        // die;
       $this->load->view('users/tasks/taskView', $data);
    }
    function OnHoldTasks()
     {
      $user_id = $this->session->userdata('front_user');

      $tasks = $this->task_model->OnHoldTasks( $user_id);
      // print_r($_REQUEST);
      //    die;
      //  print_r($data);die;
      $html = "";
      foreach($tasks as $n)
      { 
        $html.=    "<tr><td><a href='".site_url ('front_taskView/' .$n->id)."'>aaaa_IN ".str_pad($n->tasks_id, '4', '0', STR_PAD_LEFT)."</a></td>
        <td>".$n->task_name."</td>
        <td>".$n->start_date."</td>
        <td>".date('Y-m-d',strtotime($n->end_date))."</td>
        <td>".date('H:m',strtotime($n->estimitate_hours))."</td>
        <td><a class='pro-circle'><img class='img-sm' src='".site_url('assets/image/man.png')."' data-original-title='Click to deactivate the user' title=".$n->first_name."></a></td>
        <td><span class='badge badge-danger'>".$n->priority."</span></td>
        <td>".$n->status."</td>
        <td><a class='edit' href='".site_url('front_tasks_edit/'.$n->id)."'><i class='fa fa-pencil-square-o'></i></a>&nbsp
                             <a class='delete' href='". site_url ('front_tasks_delete/'.$n->id)."' onclick='return confirm('Are you sure want to Delete this Record?')'><i class='fa fa-trash-o'></i></a>&nbsp</td>
        </tr>";
      }
      // print_r($html);die;
      echo json_encode ($html); die;

    }


    function CompletedTasks() 
     {
       $user_id = $this->session->userdata('front_user');
       $tasks = $this->task_model->CompletedTasks( $user_id);
      //  print_r($data);die;
      $html = "";
      foreach($tasks as $n)
      {
        $html.=    "<tr><td><a href='".site_url ('front_taskView/'.$n->id)."'>aaaa_IN ".str_pad($n->tasks_id, '4', '0', STR_PAD_LEFT)."</a></td>
        <td>".$n->task_name."</td>
        <td>".$n->start_date."</td>
        <td>".date('Y-m-d',strtotime($n->end_date))."</td>
        <td>".date('H:m',strtotime($n->estimitate_hours))."</td>
        <td><a class='pro-circle'><img class='img-sm' src='".site_url('assets/image/man.png')."' data-original-title='Click to deactivate the user' title=".$n->first_name."></a></td>
        <td><span class='badge badge-danger'>".$n->priority."</span></td>
        <td>".$n->status."</td>
        <td><a class='edit' href='".site_url('front_tasks_edit/'.$n->id)."'><i class='fa fa-pencil-square-o'></i></a>&nbsp
                             <a class='delete' href='". site_url ('front_tasks_delete/'.$n->id)."' onclick='return confirm('Are you sure want to Delete this Record?')'><i class='fa fa-trash-o'></i></a>&nbsp</td>
        </tr>";
      }
      // print_r($html);die;
      echo json_encode ($html); die;

    }


    function OpenTasks()
     {
       $user_id = $this->session->userdata('front_user');
      $tasks = $this->task_model->OpenTasks( $user_id);
      //  print_r($data);die;
      $html = "";
      foreach($tasks as $n)
      {
        $html.=    "<tr><td><a href='".site_url ('front_taskView/'.$n->id)."'>aaaa_IN ".str_pad($n->tasks_id, '4', '0', STR_PAD_LEFT)."</a></td>
        <td>".$n->task_name."</td>
        <td>".$n->start_date."</td>
        <td>".date('Y-m-d',strtotime($n->end_date))."</td>
        <td>".date('H:m',strtotime($n->estimitate_hours))."</td>
        <td><a class='pro-circle'><img class='img-sm' src='".site_url('assets/image/man.png')."' data-original-title='Click to deactivate the user'title=".$n->first_name." ></a></td>
        <td><span class='badge badge-danger'>".$n->priority."</span></td>
        <td>".$n->status."</td>
        <td><a class='edit' href='".site_url('front_tasks_edit/'.$n->id)."'><i class='fa fa-pencil-square-o'></i></a>&nbsp
                             <a class='delete' href='". site_url ('front_tasks_delete/'.$n->id)."' onclick='return confirm('Are you sure want to Delete this Record?')'><i class='fa fa-trash-o'></i></a>&nbsp</td>
        </tr>";
      }
      // print_r($html);die;
      echo json_encode ($html); die;

    }

    function TotalTasks()
     {
       $user_id = $this->session->userdata('front_user');
      $tasks = $this->task_model->TotalTasks( $user_id);
      //  print_r($data);die;
      $html = "";
     foreach($tasks as $n)
      {
        $html.=    "<tr><td><a href='".site_url ('front_taskView/' .$n->id)."'>aaaa_IN ".str_pad($n->tasks_id, '4', '0', STR_PAD_LEFT)."</a></td>
        <td>".$n->task_name."</td>
        <td>".$n->start_date."</td>
        <td>".date('Y-m-d',strtotime($n->end_date))."</td>
        <td>".date('H:m',strtotime($n->estimitate_hours))."</td>
       <td><a class='pro-circle'><img class='img-sm' src='".site_url('assets/image/man.png')."' data-original-title='Click to deactivate the user' title=".$n->first_name."></a></td>
        <td><span class='badge badge-danger'>".$n->priority."</span></td>
        <td>".$n->status."</td>
        <td><a class='edit' href='".site_url('front_tasks_edit/'.$n->id)."'><i class='fa fa-pencil-square-o'></i></a>&nbsp
                             <a class='delete' href='". site_url ('front_tasks_delete/'.$n->id)."' onclick='return confirm('Are you sure want to Delete this Record?')'><i class='fa fa-trash-o'></i></a>&nbsp</td>
        </tr>";
      }
      // print_r($html);die;
      echo json_encode ($html); die;

    }

    function InProgressTasks()
     {
       $user_id = $this->session->userdata('front_user');
      $tasks = $this->task_model->InProgressTasks( $user_id);
        //print_r($data);die;
      $html = "";
     foreach($tasks as $n)
      {
        $html.=    "<tr><td><a href='".site_url ('front_taskView/'.$n->id)."'>aaaa_IN ".str_pad($n->tasks_id, '4', '0', STR_PAD_LEFT)."</a></td>
        <td>".$n->task_name."</td>
        <td>".$n->start_date."</td>
        <td>".date('Y-m-d',strtotime($n->end_date))."</td>
        <td>".date('H:m',strtotime($n->estimitate_hours))."</td>
        <td><a class='pro-circle'><img class='img-sm' src='".site_url('assets/image/man.png')."' data-original-title='Click to deactivate the user' title=".$n->first_name."></a></td>
        <td><span class='badge badge-danger'>".$n->priority."</span></td>
        <td>".$n->status."</td>
        <td><a class='edit' href='".site_url('front_tasks_edit/'.$n->id)."'><i class='fa fa-pencil-square-o'></i></a>&nbsp
                             <a class='delete' href='". site_url ('front_tasks_delete/'.$n->id)."' onclick='return confirm('Are you sure want to Delete this Record?')'><i class='fa fa-trash-o'></i></a>&nbsp</td>
        </tr>";
      }
      // print_r($html);die;
      echo json_encode ($html); die;

    }
    function get_pdf_test($id)
    {
       $data['tasks'] = $this->task_model->getByIdPdf($id); 
       $data['tasks_history'] = $this->task_model->getById_history_pdf($id);
    
    
       require_once (APPPATH. 'vendor/autoload.php');
       $path = '/tmp/mpdf'; 
        if (!file_exists($path)) {
       mkdir($path, 0777, true);
       }

      $mpdf = new \Mpdf\Mpdf(['tempDir' => $path]);
      $mpdf->SetHTMLHeader((('<img src="./assets/image/logo.png">')));
      
      $html = $this->load->view('users/tasks/tasksPdf', $data,true);
      
       $mpdf->WriteHTML($html);
       $mpdf->setFooter('  ');
       $mpdf->Output(); 
       $mpdf->Output('tasksPdf.pdf','D'); 
     }
    
     public function downloadFile($tasks_id)
    {
         
      $file = $this->task_model->getfile($tasks_id);
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
  
  
  


 
