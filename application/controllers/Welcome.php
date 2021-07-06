<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
    {
        parent::__construct();
        $this->load->model('commonQuery');
    } 

	public function index()
	{
		$this->load->view('login');
	}
	public function forgotPassword()
	{
		$this->load->view('forgotpwd');
	}

	public	function forgotPasswordPost(){
		if($this->input->post()){

			$email = $this->input->post('email');

			$get = $this->commonQuery->getTableData('user_login','',array('email'=>$email),'','','')->row();

			$id = isset($get->id)?($get->id):"";

			if(!empty($id)){
				$id = base64_encode($id);
				$email = $get->email;

				$subject = "Forgot Password";
				$message  = array(
					'###USERNAME###' => $get->username,
					'###LINK###' => base_url('/resetPassword/'.$id),
				);
				$send = $this->commonQuery->send_mail($email,'forgotPassword',$message,$subject);

				if($send){
					$this->session->set_flashdata ('success','Kindly check your email');
					redirect('forgotPassword');
				}else{
					$this->session->set_flashdata ('fail','Something went to wrong');
					redirect('forgotPassword');
				}
			}
			$this->session->set_flashdata ('success','Kindly check your email');
			redirect('forgotPassword');
		}
	}

	public function resetPassword($id){
		if(!empty($id)){
			$id = base64_decode($id);
			$get = $this->commonQuery->getTableData('user_login','',array('id'=>$id),'','','')->num_rows();

			if($get == 1){
				$this->load->view('Resetpwd');
			}else{
				$this->session->set_flashdata ('fail','Something went to wrong');
				redirect('/');
			}
			// $this->load->view('Resetpwd');
		}else{
			$this->session->set_flashdata ('fail','Something went to wrong');
			redirect('/');
		}
		
	}

	public function resetPasswordPost(){
		if($this->input->post()){
			$id = base64_decode($this->input->post('id'));
			$get = $this->commonQuery->getTableData('user_login','',array('id'=>$id),'','','')->num_rows();
			if($get == 1){
				$password 			= $this->input->post('password');
				$confirmPassword 	= $this->input->post('confirmPassword');

				if($password !== $confirmPassword){
					$this->session->set_flashdata ('fail','word and confirm password should be same');
					redirect('resetPassword/'.$this->input->post('id'));
				}
				$updateData  = array(
					'password' => password_hash( $password, PASSWORD_DEFAULT),
				);
				$where  = array('id' => $id);
				$update = $this->commonQuery->UpdateTableData('user_login',$updateData,$where);
				$this->session->set_flashdata ('success','Password updated successfully.');
				redirect('/');
			}else{
				$this->session->set_flashdata ('fail','Something went to wrong');
				redirect('/');
			}
		}else{
			$this->session->set_flashdata ('fail','Something went to wrong');
			redirect('/');
		}
	}
}




