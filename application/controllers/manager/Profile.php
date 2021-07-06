<?php
class Profile extends CI_Controller
{
	 function __construct()
	 {
		 parent::__construct();	 
		  if(!$this->session->userdata('manager'))
          redirect('admin');
		 
		  $this->load->model('manager/profile_model');
		  $this->load->model('manager/staff_model');
		  $this->load->model('manager/project_model');
	      $this->load->model('manager/task_model');
		  $this->load->model('manager/incidents_model');
		 $this->load->model('login_model');

		 $this->load->helper(array('form', 'url'));
	 }  

	function index()
	{
		 $user_id =  $this->session->userdata('manager'); 
		
        if(empty($user_id)){
             redirect('admin/login');
		 }
		
	     $data['userInfo'] = $this->profile_model->myProfile($user_id);
		
		 if($user_id == 3){ // admin
			$data['project12'] = $getAllProjects = $this->profile_model->getAdminProjects();
			$data['userInfo'] = $this->profile_model->myProfile(48);

			//echo '<pre>'; 
			//print_r($getAllProjects);
			//die;
			$new_array = array();
			foreach($getAllProjects as $key => $row) {
				$new_array[$key]['id'] = $row->id; 
				$new_array[$key]['delete_flag'] = $row->delete_flag; 
				$new_array[$key]['project_name'] = $row->project_name; 
				$new_array[$key]['client_name'] = $row->client_name; 
				$new_array[$key]['company'] = $row->company; 
				$new_array[$key]['project_manager'] = $row->project_manager; 
				$sec_array = explode(",",$row->support_staff);
				if(is_array($sec_array) ){
					foreach($sec_array as $row1){
						$new_array[$key]['support_staff'][] = $this->profile_model->getUsernameByID($row1);

					}  
				}
			}
			//print_r($new_array);die;
			$data['project'] = $new_array;
			$data['task_list'] = $this->task_model->getAllTasks();
			$data['incident_list'] = $this->incidents_model->getAllIncidents();
			$data['numberOfUserProjects'] = $this->profile_model->getAllProjectsNumber();
			$data['numberOfUserTasks'] = $this->profile_model->getAllTasksNumber();
			$data['numberOfUserIncidents'] = $this->profile_model->getAllIncidentsNumber();

			
		 }else{ 
			 //echo "sdfsd";die;
			 $project_manager = $this->project_model->getmanager($user_id);
			 $project_manager_projects = $this->task_model->getProjectDetails($project_manager); 

			 $data['project'] = $this->profile_model->getById_myProjects($project_manager);
			 $data['task_list'] = $this->task_model->getTasksDetails($project_manager_projects);
			 $data['incident_list'] = $this->incidents_model->getIncidentsDetails($project_manager_projects);
			  
			 //echo $user_id;die;
			 $data['numberOfUserProjects']= $this->profile_model->getUserProjectsNumber($project_manager);
			 $data['numberOfUserTasks'] = $this->profile_model->getUserTasksNumber($project_manager_projects);
			 $data['numberOfUserIncidents'] = $this->profile_model->getUserIncidentsNumber($project_manager_projects);

			 //$data['image'] = $this->profile_model->getImageByUserId($user_id);

		 }
	    // echo "<pre>";
    	// print_r($data);
        // die;
	     $this->load->view('manager/profile/index',$data);
	}

     function edit()
     {
	    $user_id =  $this->session->userdata('manager');
        if(empty($user_id)){
             redirect('admin/login');
		 }
	   $data['userInfo'] = $this->profile_model->editMyProfile($user_id);
	   
	   $data['role_name'] = $this->staff_model->getAllRole();
	   $data['company_name'] = $this->staff_model->getAllCompanyName($user_id);
        // print_r($_REQUEST);
        // die;
       $this->load->view('manager/profile/edit', $data);
	 }

	function update($user_id)
    {
	  $user_id =  $this->session->userdata('manager');
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
	   redirect('manager/profile/index');
	  }else{

		$user_id =  $this->session->userdata('manager');
        if(empty($user_id)){
             redirect('admin/login');
		 }
	   $data['userInfo'] = $this->profile_model->editMyProfile($user_id);
	   $data['role_name'] = $this->staff_model->getAllRole(); 
	   $data['company_name'] = $this->staff_model->getAllCompanyName($user_id);

	   $this->session->set_flashdata  ('Successmessages','Something Went Wrong, Please Fill Up All The Required Information');
       $this->load->view('manager/profile/edit', $data);

	   }
 	}
	

	function edit_password()
    {
	   $user_id = $this->session->userdata('manager');
	   // echo $user_id;die;
    // update data

      if($_POST)
       {
		if($this->input->post('OldPass')!='')
		{
            $this->form_validation->set_rules('OldPass','Old password', 'required|trim|addslashes|encode_php_tags');            
            $this->form_validation->set_rules('NewPass','New password', 'required|trim|addslashes|encode_php_tags|min_length[5]');
            $this->form_validation->set_rules('ConfPass', 'Confirm password', 'trim|required|addslashes|encode_php_tags|min_length[5]|matches[NewPass]');
               //new pass === confirm
             //old != new pass
             //old pass = stored pass
             //update 
            if($this->form_validation->run() == TRUE) 
            {    
				if ($this->input->post('OldPass')!= $this->input->post('NewPass')){
					$user_id = $this->session->userdata('manager');
					//$stored_password = $this->login_model->get_password($user_id);
					$stored_password = $this->login_model->get_password_manager($user_id);
 
					if(password_verify($this->input->post('OldPass'),$stored_password))
					{
						//update
					   $user_id = $this->session->userdata('manager'); 

						//$this->login_model->updatePassword($user_id,$this->input->post('NewPass'));
						$this->login_model->updatePassword_manager($user_id,$this->input->post('NewPass'));

						$this->session->set_flashdata ('success','Passsword Changed  Sucessfully');
						//echo "hjd";
						redirect('admin');
					
					}else{
						$this->session->set_flashdata ('Successmessages','Wrong Current Password, Please Try Again');
						redirect('manager_myProfile');
					}  
			 	}                  
            }else{
				//$var =  explode('</p>',validation_errors());
				$this->session->set_flashdata('Successmessages',json_encode(validation_errors()));
				redirect('manager_myProfile');
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
			// echo "<pre>";
			// print_r($_FILES);
			// die;
			if(!empty($_FILES['filename']['name'])){ 
				//$config['upload_path']          = FCPATH.'application/';

				$file_name = time().'_'.$_FILES['filename']['name'];
				$config['upload_path'] = './uploads/';
                $config['allowed_types']        = 'jpeg|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
				$config['max_height']           = 768;
				$config['overwrite'] 			= true;
				$config['file_name'] 			= $file_name;

				//print_r($config);

				//die;
				$this->load->library('upload', $config);
				
				$this->upload->initialize($config);

                if ( ! $this->upload->do_upload('filename')) 
                {
					//echo "sdfs";
					//print_r($this->upload->display_errors());
					//die;
					 $error = $this->upload->display_errors();
					 //echo '<pre>'; 
					//print_r($error);
					//	die;
					//$this->session->set_flashdata ('success',json_encode($error));
					$this->session->set_flashdata ('Successmessages','Something went to wrong');
					redirect('manager_myProfile');
                     //   $this->load->view('admin/profile/index', $error);
				
					}else{
					// echo "xcvcx";
					// die;
					    $user_id = $this->session->userdata('manager');
						$image_data = $this->upload->data();
						//echo '<pre>'; 
						$image_name  =  $image_data['file_name'];

						 $data =array(
						  'photo' => $image_data['file_name']
						);
						 //$id=$this->input->get('id');
					   $user_id = $this->session->userdata('manager');

					   //$this->db->WHERE('id',$id)->update('user_login',$data);
						$data['photo'] = $this->profile_model->updateImageById($user_id,$image_name);
						 
						//$insert = $this->db->query("INSERT into user_login (photo) VALUES ('".$image_name."' ) 	 ");
							// $userInfo = $this->db->where('id',$id)->update('user_login',array('photo'=>$image_name));
						//die;
						$this->session->set_flashdata ('success','Uploaded Sucessfully');
					    redirect('manager_myProfile');
						
				    }
			}else{
				if ($this->profile_Model->updateImage($data, $user_id) ==true) 
				{ $user_id = $this->session->userdata('front_user');
                    $this->session->set_flashdata('success', 'sdfghjk');
              
				//echo "dfgfd";
				$data = array('user_login' => $this->upload->data());

                $this->load->view('manager/profile/index', $data);
			    }
		   }
		}

    }