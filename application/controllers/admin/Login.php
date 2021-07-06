 <?php
 class Login extends CI_controller {
	public function __construct()
	{
		parent::__construct();
		// if($this->session->userdata('admin'))
		//  {redirect('dashboard');}

		// if($this->session->userdata('front_user'))
		// {redirect('dashboardd');}

		$this->load->library('form_validation');
		$this->load->library('encrypt');
		$this->load->model('login_model');

	}

	function index() 
	{
		// echo "sdf";die;
		$this->load->view('login');

	}
	function validation()
	{
 
		if(!$this->input->post()){
			$this->session->set_flashdata ('fail','Something went wrong');
		}
		$this->form_validation->set_rules('username', 'Username', 'required|trim' );
		$this->form_validation->set_rules('password' , 'Password' , 'required');

		if ($this->form_validation->run())
		{

			$res = $this->login_model->can_login($this->input->post('username'), $this->input->post('password'));
			// print_r($res);
			// die;
			if(is_array($res)){ 
				$stored_password = $res['stored_password'];
				$row = $res['row'];
				
				if(password_verify($this->input->post('password'),$stored_password)){
					$userID = $row->id;
					$isAdmin = $row->role;

					 if($isAdmin == 'Admin'  ){
						//  || $isAdmin == 'Management Office'
						// print_r($isAdmin);
						//    die;
						$userID = $row->id;
						$this->session->set_userdata('admin',$userID);
						$this->session->set_flashdata ('success','Login Sucessfully');
						redirect('dashboard');


						// }elseif ($isAdmin == 'Management Office'){
						// $userID = $row->id;
						// $this->session->set_userdata('Management',$userID);
						// $this->session->set_flashdata ('success','Login Sucessfully');
						// //redirect('dashboard');
						//  redirect('managemnet/dashboard');
						// //redirect('manager/dashboard');


						}elseif ($isAdmin == 'Management Office'){
						$userID = $row->id;
						$this->session->set_userdata('management',$userID);
						$this->session->set_flashdata ('success','Login Sucessfully');
						//redirect('dashboard');
						redirect('management/dashboard');



					}elseif ($isAdmin == 'Manager'){
						$userID = $row->id;
						$this->session->set_userdata('manager',$userID);
						$this->session->set_flashdata ('success','Login Sucessfully');
						//redirect('dashboard');
						redirect('manager/dashboard');
					}
					else{
						$userID = $row->id;
						$this->session->set_userdata('front_user',$userID);
						$this->session->set_flashdata ('success','Login Sucessfully');
						//redirect('dashboard');
						redirect('users/dashboard');
						//echo "hello users";die;
					}
				}else{
					//$this->session->set_flashdata ('message','Invalid Credentils');
					$this->session->set_flashdata ('fail','Wrong Password, Please Try Again');
					// echo 'gfgg';
					redirect('admin/login');
				}
			}else{
				//  print_r($_REQUEST);
				//  die;
				$this->session->set_flashdata ('fail','Wrong Username, Please Try Again');
				redirect('admin/login');
			}
		}
		else
		{
			//$this->session->set_flashdata ('fail','Invalid Credentils');
			//redirect('admin/login');
			$this->index();
		}
	}
}

