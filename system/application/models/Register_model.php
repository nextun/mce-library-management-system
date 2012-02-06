<?php

Class Register_model extends Model
{
	function Register_model()
	{
		parent::Model();
        if(!isset($_SESSION))
			session_start();
		
		$CI = & get_instance();
		$this->db1 = $this->load->database('default', true);
		$this->load->helper('lib_link_helper');
	}

	function doRegistration($data)
	{	                                			
		$query = "INSERT INTO User (User_code, Password, Address, User_First_name, User_Last_name, Email, Phone) VALUES ( ?, ?, ?, ?, ?, ?, ? )";
		$this->db1->query($query, $data['ucode'],md5($data['pass']), $data['address'], $data['first_name'], $data['last_name'], $data['email'], $data['phone']);				
	}
		
	function readUser($usercode){		
		$query= "SELECT * FROM User WHERE User.User_code= ? ";
		$result = $this->db1->query($query, $usercode);
		return $result;		
	}
		
	function updateUser($field, $update_val, $usercode){
		mysql_query("UPDATE User SET User.".$field."='".$update_val."' WHERE User.User_code='".$usercode."'");			
	}
		
	function deleteUser($usercode){
		$query= "DELETE FROM User WHERE User.User_code= ? ";
		$this->db1->query($query, $usercode);
	}
	
	function checkEmailAvailable($email)
	{
        $query = 'SELECT id FROM user_info WHERE email = ? ';
		$result = $this->db1->query($query, array(trim($email)));
		
		if($result->num_rows() > 0)
			return 1;
		else 
			return 0;
	}
}

?>

