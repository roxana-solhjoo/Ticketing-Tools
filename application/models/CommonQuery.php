<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommonQuery extends CI_Model {

	function __construct()
    {
    	parent::__construct(); // construct the Model class
    	$this->load->database();
    }

	/* Comments
		To Send Email
		$table = To select the table
		$selectedValue  = select the perticular column (string)
		$where - Associative array data
		$orderby - Associative array data
		$limit - Numeric value
		
		It returns table data's
	*/

	public function getTableData($table,$selectedValue,$where,$orderby,$limit,$or_where){
		if($selectedValue != ''){
			$this->db->select($selectedValue);
		}

		if(isset($where) && !empty($where)){
			$this->db->where($where);
		}
		if(isset($or_where) && !empty($or_where)){
			$this->db->or_where($or_where);
		}

		// print_r($orderby);
		if(isset($orderby) && !empty($orderby)){
			$this->db->order_by($orderby[0],$orderby[1]);
		}
		if(!empty($limit)){
			$this->db->limit($limit);
		}
		$this->db->from($table);
		return $query = $this->db->get();
		 $result = $query->result();
	}
	public function CustomQuery($sql,$varriables = ""){
		return $this->db->query($sql, $varriables);
	}
	/* Comments
		To Insert Table Data
		$table = Table Name
		$data  = Associative data
			
		if successfully updated return TRUE orherwise FALSE

	*/
	public function InsertTableData($table,$data){
		return ($this->db->insert($table, $data))  ?   $this->db->insert_id()  :   false;
	}

	public function DeleteTableData($table,$where){
		if(isset($where) && !empty($where)){
			$this->db->where($where);
		}
		$this->db->delete($table);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE; 
	}
	/* Comments
		To Update Table Data
		$table = Table Name
		$data  = Associative data
		$where  = Associative data
		
		if successfully updated return TRUE orherwise FALSE

	*/	
	public function UpdateTableData($table,$data,$where){
		if(isset($where) && !empty($where)){
				$this->db->where($where);
		}
		$this->db->update($table, $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE; 
	}

	public function send_mail($to,$template,$message,$subject){
		
		$msg = file_get_contents(APPPATH.'language/Template/'.$template.'.html');
		
		
		$text = strtr($msg, $message);
		// print_r($text);
		// die;
		$smtp_host = "mail.aaaa.com.my";
		$smtp_port = 587;
		$smtp_username = "ticket@aaaa.com.my";
		$smtp_password = "aaaa@1234";

		// $smtp_host = "mail.mynutp.org.my";
		// $smtp_port = 25;
		// $smtp_username = "registration@mynutp.org.my";
		// $smtp_password = "Mynutp@aaaa123";

		// $smtp_host = "ssl://smtp.gmail.com";
		// $smtp_port = 465;
		// $smtp_username = "aimsolutionsgroupberhad@gmail.com";
		// $smtp_password = "P@ssword@123";

		// $smtp_host = "ssl://smtp.gmail.com";
		// $smtp_port = 465;
		// $smtp_username = "donotreplymynutporg@gmail.com";
		// $smtp_password = "mynutp@12345";

		$this->load->library('email');
		$config = array( 
		  'protocol' => 'smtp', 
		  'smtp_host' => $smtp_host,
		  'smtp_port' => $smtp_port,
		  'smtp_user' => $smtp_username,
		  'smtp_pass' => $smtp_password,
		  // 'smtp_crypto' => 'tls',
		  'priority' => 1,
		  'mailtype'  => 'html', 
    	  'charset'   => 'iso-8859-1'
		); 
		$config['smtp_timeout']='30';
		$config['newline']    = "\r\n";
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
        $this->email->from($smtp_username, 'aaaa');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($text);
        //Send mail
        // echo "<pre>";
        // print_r($this->email);
        // die;
        if($this->email->send())
        	//echo "Email Send Successfully.";
            // $this->session->set_flashdata("email_sent","");
            return TRUE;
        else
        	print_r($this->email->print_debugger());die;
        	// echo "You have encountered an error";
        	return FALSE;
            // $this->session->set_flashdata("email_sent",);
		die;
	}
}
