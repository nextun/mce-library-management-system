<?php       

Class Register extends LIB_Controller
{
	function Register()
	{
		parent::LIB_Controller();
	}
	
	function index()
	{
        $this->load->view('register.php');
		$this->load->model('Register_model');
	}	
	function registration()
	{
		$data['first_name'] = $this->input->post('fname');
		$data['last_name'] = $this->input->post('lname');
		$data['email'] = $this->input->post('email');
		$data['phone'] = $this->input->post('phone');
		$data['pass'] = $this->input->post('pass');
		$data['ucode'] = $this->input->post('ucode');
		$data['address'] = $this->input->post('address');
		$this->Register_model->doRegistration($data);
		
		echo "Data has been inserted and user created";
		exit;
	}
}

?>


