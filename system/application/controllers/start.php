<?php

Class Start extends LIB_Controller
{
	function Start()
	{
		parent::LIB_Controller();
	}
	
	function index()
	{
        //$data['login'] = 0;
		$this->load->helper('lib_link_helper');
        $this->load->view('home.php');
	}	
}
?>

