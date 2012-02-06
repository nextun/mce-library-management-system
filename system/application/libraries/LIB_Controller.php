<?php
class LIB_Controller extends Controller {

	public $layout;
	public $data;
	
	function LIB_Controller()
    {
        parent::Controller();

        if(!isset($_SESSION))
			session_start();
			
		$this->db1 = $this->load->database('default', true);	
        //$this->load->Model('Home_model');
		//$this->load->Model('Web_model');
        $this->load->helper('url');
		
        if($GLOBALS['method'] != 'logout' && $GLOBALS['method'] != 'index' && $GLOBALS['method'] != 'login' && $GLOBALS['method'] != 'set_lang')
        {
            if(!isset($_SESSION['user_email']))
			{
                redirect('/start/logout/');
				exit();
			}
            else if($this->Web_model->is_exist_user($_SESSION['user_email']) == 0)
			{
                redirect('/start/logout/');
				exit();
			}
        }

        //for laoding default lanugage pack
        if(!isset($_SESSION['language']))
            $_SESSION['language'] = 'english';
        if(($GLOBALS['method'] != 'logout') || ($GLOBALS['method'] != 'set_lang'))
            $this->lang->load('default',$_SESSION['language']);

        $this->layout = 'default';
        $this->load->helper('lib_link_helper');
        $this->load->helper('language');
    }

}

?>

