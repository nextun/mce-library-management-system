<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Class Registration extends SIM_Controller
{

	function Registration()
	{
		parent::SIM_Controller();

        $data['login_error'] = 0;
		$this->load->model('image_model');
        $this->load->model('home_model');

	}


    function option_last_reg_step($option = 0)
    {
        $this->load->model('home_model');

        $data['timezone'] = $this->input->post('timezone') ? $this->input->post('timezone'):'';
		$data['email_time'] = $this->input->post('email_time') ? $this->input->post('email_time'):'' ;
		$data['email_freq'] = $this->input->post('email_freq') ? $this->input->post('email_freq'):'' ;
        $data['email_format'] = $this->input->post('email_format') ? $this->input->post('email_format'):'' ;

        $data['sim_friend_id'] = $_SESSION['sim_friend_id'];
		$data['player_id'] = $_SESSION['player_id'];

        $_SESSION['ses_email_freq'] = $data['email_freq'];
        $_SESSION['ses_email_time'] = $data['email_time'];

        //for the first time login
        //if(isset($this->input->post('first_time_login')))

            if($this->input->post('first_time_login') == '')   // This is for Option save page
            {
                $user_settings = $this->Home_model->get_user_setting($_SESSION['player_id']);
                $status['email_freq_chk'] = $user_settings->email_freq;
            }
            else                                               // This is for Last_registration page
            {
                 $status['email_freq_chk'] = 0;
            }
        
        $this->Home_model->update_user_settings($data);
        $data['email_response_time'] = $this->Home_model->email_response_time($data);
		// insert into sim_friend_change table to take effect
        $this->Home_model->edit_sim_friend($data);
		//$this->Home_model->edit_user_status($data);

        if($option == 1)   // Request Come from Option page
        {
            redirect('home/my_status/1/0/');
        }
        else               // Request Come from Last_registration_step page
        {
            redirect('home/my_status/0/1/');
        }


    }



}



?>
