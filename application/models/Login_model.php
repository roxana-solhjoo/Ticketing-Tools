 <?php
class Login_model extends CI_Model
{
	function can_login($username,$password)
	{
		// if(is_int($username)){
		$this->db->select(
		  'id,
 		   user_id,
		   employee_id,
 		   username,
		   email, 
		   status,
 		   password,role
		    ')
		    ->from('user_login')
		    ->where("(email = '$username' OR username = '$username' OR  employee_id ='$username')")
		    ->where('status' ,'1');

		// }else{ 
		// 	$this->db->select('
 		//    user_id,
		//    employee_id,
 		//    username,
		//    email,
		//    status,
 		//    password,role
		//     ')
		//     ->from('user_login')
		//     ->where("(email = '$username' OR username = '$username')")
		//     ->where('status' ,'Active');
		// }  
			$query = $this->db->get();
			//  print_r($this->db->last_query());
			//  die;
			if($query->num_rows() == 1){
			  $result = $query->row();
			  $stored_password = $result->password;
	     	  return $return = array('stored_password'=> $stored_password , 'row' => $result);
			  
           }else{
               return false;

      }
   } 
	function get_password($user_id){
		$this->db->where('id', $user_id);
		$query = $this->db->get('user_login');
		if($query->num_rows() > 0)
		{
			$result = $query->row();
			$stored_password = $result->password;
			return  $stored_password;
		}
		else
		{
			return FALSE;

		}
	}
	function updatePassword($user_id,$password){
		$arr['password'] = password_hash($password,PASSWORD_DEFAULT);
		//$arr['flag'] = 1;
        $this->db->where(array('id'=>$user_id));
        $this->db->update('user_login',$arr);
	}

	function get_password_user($user_id){
	 $user_id = $this->session->userdata('front_user');
		$this->db->where('id', $user_id);
		$query = $this->db->get('user_login');
		if($query->num_rows() > 0)
		{
			$result = $query->row();
			$stored_password = $result->password;
			return  $stored_password;
		}
		else
		{
			return FALSE;

		}
	}
	
	function updatePassword_user($user_id,$password){
	 $user_id = $this->session->userdata('front_user');
		$arr['password'] = password_hash($password,PASSWORD_DEFAULT);
		$arr['flag'] = 2;
        $this->db->where(array('id'=>$user_id));
        $this->db->update('user_login',$arr);
	}

	function get_password_manager($user_id){
	 $user_id = $this->session->userdata('manager');
		$this->db->where('id', $user_id);
		$query = $this->db->get('user_login');
		if($query->num_rows() > 0)
		{
			$result = $query->row();
			$stored_password = $result->password;
			return  $stored_password;
		}
		else
		{
			return FALSE;

		}
	}

	function updatePassword_manager($user_id,$password){
	 $user_id = $this->session->userdata('manager');
		$arr['password'] = password_hash($password,PASSWORD_DEFAULT);
		$arr['flag'] = 3;
        $this->db->where(array('id'=>$user_id));
        $this->db->update('user_login',$arr);
	}

	function get_password_management($user_id){
	 $user_id = $this->session->userdata('management');
		$this->db->where('id', $user_id);
		$query = $this->db->get('user_login');
		if($query->num_rows() > 0)
		{
			$result = $query->row();
			$stored_password = $result->password;
			return  $stored_password;
		}
		else
		{
			return FALSE;

		}
	}

	function updatePassword_management($user_id,$password){
	 $user_id = $this->session->userdata('management');
		$arr['password'] = password_hash($password,PASSWORD_DEFAULT);
		$arr['flag'] = 3;
        $this->db->where(array('id'=>$user_id));
        $this->db->update('user_login',$arr);
	}

}
	
	

	