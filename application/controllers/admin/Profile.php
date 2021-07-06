<?php
class Profile extends CI_Controller
{
	 function __construct()
	 {
		 
		 parent::__construct();	 
		 if(!$this->session->userdata('admin'))
         redirect('admin');
		 
		 $this->load->model('profile_model');
		 $this->load->model('staff_model');
		 $this->load->model('task_model');
		 $this->load->model('incidents_model');
		 $this->load->model('login_model');
		  $this->load->model('project_model');

		 $this->load->helper(array('form', 'url'));
	 }
 
	function index()
	{
		 $user_id =  $this->session->userdata('admin'); 
		//  echo '<pre>';
			// print_r($user_id);
			// die;
	
        if(empty($user_id)){ 
             redirect('admin/login'); 
		 }
		 
	      //$data['userInfo'] = $this->profile_model->myProfile($user_id);
		
		 if($user_id == $this->session->userdata('admin')){ // admin
			 $data['project12'] = $getAllProjects = $this->profile_model->getAdminProjects();
				//$data['project']  = $this->profile_model->getAdminProjects();

			
			$data['userInfo'] = $this->profile_model->myProfile($user_id);
			

			// echo '<pre>';
			// print_r($data);
			// die;
			$new_array = array();
			foreach($getAllProjects as $key => $row) {
				$new_array[$key]['id'] = $row->id; 
				$new_array[$key]['delete_flag'] = $row->delete_flag; 
				$new_array[$key]['project_name'] = $row->project_name; 
				$new_array[$key]['client_name'] = $row->client_name; 
				$new_array[$key]['company'] = $row->company; 
				$new_array[$key]['project_manager'] = $row->project_manager; 
				
				$sec_array = explode(",",$row->support_staff);
				//  print_r($sec_array);die;

				if(is_array($sec_array) ){
					foreach($sec_array as $row1){
						$new_array[$key]['support_staff'][] = $this->profile_model->getUsernameByID($row1);

			// print_r($new_array);die;

					}  
				}
			}
			//print_r($sec_array);die;
			//$data['project'] = $new_array;
			// $data['project'] = $this->project_model->getProjectDetails();
			 //print_r($project);die;

			$data['project']  = $this->profile_model->getAdminProjects();
			$data['task_list'] = $this->task_model->getAllTasks();
			$data['incident_list'] = $this->incidents_model->getAllIncidents();
			$data['numberOfUserProjects'] = $this->profile_model->getAllProjectsNumber();
			$data['numberOfUserTasks'] = $this->profile_model->getAllTasksNumber();
			$data['numberOfUserIncidents'] = $this->profile_model->getAllIncidentsNumber();

			
		 }else{ 
			 //echo "sdfsd";die;
			 $data['project'] = $this->profile_model->getById_myProjects($user_id);
			 $data['task_list'] = $this->task_model->getTaskByUserID($user_id);
			 $data['incident_list'] = $this->incidents_model->getIncidentByUserID($user_id);
			 //echo $user_id;die;
			 $data['numberOfUserProjects']= $this->profile_model->getUserProjectsNumber($user_id);
			 $data['numberOfUserTasks'] = $this->profile_model->getUserTasksNumber($user_id);
			 $data['numberOfUserIncidents'] = $this->profile_model->getUserIncidentsNumber($user_id);
		 }
	    //echo "<pre>"; 
    	//print_r($data);
        //die;

	     $this->load->view('admin/profile/index',$data);
	} 

     function edit()
     {
		$user_id =  $this->session->userdata('admin');
		
        if(empty($user_id)){
             redirect('admin/login'); 
		 }
	   $data['userInfo'] = $this->profile_model->editMyProfile($user_id);
	//    print_r($data);
    //     die;
	   $data['role_name'] = $this->staff_model->getAllRole();
	   $data['company_name'] = $this->staff_model->getAllCompanyName();
        // print_r($data);
        // die;
       $this->load->view('admin/profile/edit', $data);
	}

	function update($user_id)
     {
	  $user_id =  $this->session->userdata('admin');
	  $this->form_validation->set_rules('Fname', 'First Name', 'required');
      $this->form_validation->set_rules('Lname', 'Last Name' , 'required');
      $this->form_validation->set_rules('Mobno', 'Mobile No', 'required');
      $this->form_validation->set_rules('Email', 'Email' , 'required');
      $this->form_validation->set_rules('role', 'Role', 'required');
      $this->form_validation->set_rules('Subcom', 'Sub Company' , 'required');
       if ($this->form_validation->run() ==true)
      {
	   $this->profile_model->update($user_id);
	    
       $this->session->set_flashdata ('success','Profile updated Sucessfully');
	   redirect('admin/profile/index');
	  }else{

		$user_id =  $this->session->userdata('admin');
        if(empty($user_id)){
             redirect('admin/login');
		 }
	   $data['userInfo'] = $this->profile_model->editMyProfile($user_id);
	   $data['role_name'] = $this->staff_model->getAllRole();
	   $data['company_name'] = $this->staff_model->getAllCompanyName();

	   $this->session->set_flashdata  ('Successmessages','Something Went Wrong, Please Fill Up All The Required Information');
       $this->load->view('admin/profile/edit', $data);
	

	   }
 	}
	

	function edit_password()
    {
	  $user_id = $this->session->userdata('admin');
      if($_POST)
       {
		if($this->input->post('OldPass')!='')
		{
            $this->form_validation->set_rules('OldPass','Old password', 'required|trim|addslashes|encode_php_tags');            
            $this->form_validation->set_rules('NewPass','New password', 'required|trim|addslashes|encode_php_tags|min_length[5]');
            $this->form_validation->set_rules('ConfPass', 'Confirm password', 'trim|required|addslashes|encode_php_tags|min_length[5]|matches[NewPass]');
    
            if($this->form_validation->run() == TRUE) 
            {    
				if ($this->input->post('OldPass')!= $this->input->post('NewPass')){
					$user_id = $this->session->userdata('admin');
					$stored_password = $this->login_model->get_password($user_id);

					if(password_verify($this->input->post('OldPass'),$stored_password))
					{
						//update
						$this->login_model->updatePassword($user_id,$this->input->post('NewPass'));
						$this->session->set_flashdata ('success','Passsword changed  Sucessfully');
						redirect('admin/login');
					
					}else{
						$this->session->set_flashdata ('Successmessages','Wrong Current Password, Please Try Again');
						redirect('myProfile');
					}  
			 	}                  
            }else{
				//$var =  explode('</p>',validation_errors());
				$this->session->set_flashdata('Successmessages',json_encode(validation_errors()));
				redirect('myProfile');
			}      
        }
       }      
    }
    function oldpass_check($oldpass)
     {  
      $user_id = $this->session->userdata('user_id');
      $result = $this->profile_model->check_oldpassword($oldpass,$user_id);       
        if($result ==0)
            {
                $this->form_validation->set_message('oldpass_check', "%s doesn't match.");
                return FALSE ;  
            }
         else
            {
                return TRUE ;
            }             
     }
		public function do_upload()
        {
			if(!empty($_FILES['filename']['name'])){ 
		// 		echo "<pre>";
        // print_r($_FILES);
        // die;

				$file_name = time().'_'.$_FILES['filename']['name'];
				$config['upload_path'] = './uploads/';
                $config['allowed_types']        = 'jpeg|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
				$config['max_height']           = 768;
				$config['overwrite'] 			= true;
				$config['file_name'] 			= $file_name; 
			// 	echo "<pre>";
            //  print_r($config);
            //   die;

				$this->load->library('upload', $config);
				 
				$this->upload->initialize($config);

                if ( ! $this->upload->do_upload('filename')) 
                {
				
					 $error = $this->upload->display_errors();
					
					$this->session->set_flashdata ('successmessages','Something went to wrong');
					redirect('myProfile');
				 
					}else{
					
					    $user_id = $this->session->userdata('admin');
						$image_data = $this->upload->data();
						$image_name  =  $image_data['file_name'];
						 $data =array(
						  'photo' => $image_data['file_name']
						);
						$data['photo'] = $this->profile_model->updateImageById($user_id,$image_name);
						
						$this->session->set_flashdata ('success','Uploaded Sucessfully');
					    redirect('myProfile');
				    }
			}else{
				if ($this->profile_Model->updateImage($data, $user_id) ==true) 
				{
				   $user_id = $this->session->userdata('admin');
                   $this->session->set_flashdata('success', 'sdfghjk');
				   $data = array('user_login' => $this->upload->data());

                   $this->load->view('admin/profile/index', $data);
			    }
		   }
		}

    }