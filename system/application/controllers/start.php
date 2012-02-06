<?php

Class Start extends LIB_Controller
{
	function Start()
	{
		parent::LIB_Controller();
        $this->load->model('image_model');
        $data['login_error'] = 0;
	}
	
	function index()
	{
        $data['login_error'] = 0;

        if(isset($_SESSION['registered']) && $_SESSION['registered'] == 2  )
        {
           redirect('home/my_status');
        }
        $this->load->view('home.php',$data);
	}
	
	function login($page_num = 0)
	{
        if(!isset($_SESSION['language']))
        {
            $item = $this->config->item('languages');
            $_SESSION['language'] = $item['en']['language'];
        }
		if(!isset($_SESSION['registered']) || $_SESSION['registered'] != 2)
        {
            $data['email'] = $this->input->post('email');
    		$data['password'] = $this->input->post('pass');
            $_SESSION['user_email'] = trim($this->input->post('email'));
    		$result = $this->Web_model->login($data);
            $_SESSION['reg_result'] = $result;
        }
        else
        {
            $result = $_SESSION['reg_result'];
        }
        print_r($result);
        exit();
    }

    function  check_login_step($back = 0)
    {
        $email = $_SESSION['user_email'];
        $result = $this->Web_model->get_user_info($email);
        
        if($back == 1)
        {
            
            
            $_SESSION['registered'] = 1;
            $_SESSION['reg_step'] = 0;
            $user_reg = $this->Web_model->get_user_registration_info($_SESSION['player_id']);
            
            $data['last_name'] = $user_reg->LAST_NAME;
            $data['first_name'] = $user_reg->FIRST_NAME;
            $data['gender'] = $user_reg->gender;
            $user_date = explode('-', $user_reg->date_of_birth );
           
            $data['day'] = $user_date[2];
            $data['month'] = $user_date[1];
            $data['year'] = $user_date[0];
            $data['back'] = 1;
            $data['onload'] = '1_register';
            $this->load->view('1_register.php',$data);

        }
        else
        {
        if(!is_array($result))
        {
            if($result == 3)
            {
                $data['onload'] = '1_register';
                $_SESSION['registered'] = 1;
                $_SESSION['reg_step'] = 0;
                $this->load->view('1_register.php',$data);
            }
        }
		else 
		{
			
            $_SESSION['reg_result'] = $result;
            $_SESSION['player_id'] = $result['id'];
			$status['player_id'] = $_SESSION['player_id'];
            
			if($result['registration_step'] == 0)
            {
                $_SESSION['registered'] = 1;
                $data['onload'] = '1_register';
                
                $this->load->view('1_register.php',$data);
               
            }
			else if($result['registration_step'] == 2)
			{
				$this->load->config('config');
                $base_path = $this->config->item('base_url');
                $this->load->config('sim/image_path');
                $ext_path =$this->config->item('path_active');
                $this->image_path = $base_path.$ext_path;
        
                $status['path'] = $this->image_path;

                // get data for user's sim friend
				$_SESSION['registered'] = 2;
                $sim_friend_id = $this->Home_model->get_sim_friend_id($status['player_id']);
				if ($sim_friend_id == 0)
				{                       
				$this->logout();
				}
				$_SESSION['sim_friend_id'] = $sim_friend_id;
				$data['player_id'] = $status['player_id'];
				$data['sim_friend_id'] = $sim_friend_id;
				
				$data['language_id'] = $this->Home_model->get_language_id($data['player_id']);// get user's language id
				$_SESSION['language_id'] = $data['language_id'];
				$status['sim_friend_id'] = $data['sim_friend_id'];
				
				redirect('home/my_status');
                echo js_link('jquery.js');
				
				/*

				//may need to change--status data
				//$status['life_time_happiness_point'] = $this->Home_model->life_time_happiness_point($data['player_id'],$data['sim_friend_id'] );
				$status['achievement_point'] = $this->Home_model->achievement_point($data['player_id'], $data['sim_friend_id']);
				$status['skill_point'] = $this->Home_model->get_skills($data['sim_friend_id'], TRUE, $data['language_id']);
				$status['career'] = $this->Home_model->get_career($data['player_id'], $data['sim_friend_id']);
				$status['simoleons'] = $this->Home_model->simoleons($data['sim_friend_id']);
				
				// status page--sim's data
				$status['name'] = $this->Home_model->sim_name($data['sim_friend_id']);
				$status['personality'] = $this->Home_model->personality($data['sim_friend_id']);
				$status['favorite_activity'] = $this->Home_model->favorite_activity($data['sim_friend_id']);
				$status['aspiration'] = $this->Home_model->aspiration($data['sim_friend_id']);   
                $this->load->view('my_status.php', $status);
				*/
			}
			else if ($result['registration_step'] == 1 )
			{
                
                $this->load->config('config');
                $base_path = $this->config->item('base_url');
                $this->load->config('sim/image_path');
                $ext_path =$this->config->item('path');
                $app_folder =$this->config->item('app_folder');
                $this->image_path = $base_path.$ext_path;
               
				// user only completes step 1, load sim friend
                
				$all_sim_info = $this->Home_model->getSimFriend($status['player_id']);
                if(!$all_sim_info)
                {
                    redirect('start/check_login_step/1');
                    exit();
                }
                $sim_name = array();

                for($i=0;$i<count($all_sim_info); $i++)
                {
                    $sim_name[$i]['sim_fname'] = $this->Home_model->get_fsim_name($all_sim_info[$i]->FIRST_NAME_ID);
                    $sim_name[$i]['sim_lname'] = $this->Home_model->get_lsim_name($all_sim_info[$i]->LAST_NAME_ID);
                }
                $data['sim_friend'] = $all_sim_info;
                $data['sim_name'] = $sim_name;
                $data['path'] = $this->image_path;
                echo js_link('jquery.js');
               
                 $data['onload'] = '3_select_friend';
                 
                 $this->load->view('3_select_friend.php',$data);
                
			}
		}
      }
	}

    function sim_single_image()
    {
         $this->load->config('sim/image_path');
         $app_folder =$this->config->item('app_folder');
         $image_path = $_SERVER['DOCUMENT_ROOT'].$app_folder.ADD.basename(APPPATH) .'/assets/images/sim_image/';
         $sim_id = $this->input->post('sim_id');
         
         $mood_type = 2660;
         

                    $File = $image_path."sim_active_".$sim_id.".jpeg";
                    if(!file_exists($File))
                    {

                        $data12 = $this->image_model->sim_image($sim_id, $mood_type);
                        header('Content-Length: '.strlen($data12));
                        header('Content-type: image/jpeg') ;
                        $Handle = fopen($File, 'w+');
                        fwrite($Handle, $data12);
                        fclose($Handle);
                    }


          //$this->load->view('3_select_friend.php',$data);

           exit();
    }



    function sim_image()
    {

         $this->load->config('sim/image_path');
         $app_folder =$this->config->item('app_folder');
         $image_path = $_SERVER['DOCUMENT_ROOT'].$app_folder .ADD.basename(APPPATH) .'/assets/images/sim_image/';
        
         $sim_id = $this->input->post('sim_id');
         $all_sim_info = $this->Home_model->getSimFriend($sim_id);
         
                for($i=0;$i<count($all_sim_info); $i++)
                {
                    $File = $image_path."sim_".$all_sim_info[$i]->ID.".jpeg";
                    if(!file_exists($File))
                    {
                        
                        $data12 = $this->image_model->sim_image($all_sim_info[$i]->ID);
                        header('Content-Length: '.strlen($data12));
                        header('Content-type: image/jpeg') ;
                        $Handle = fopen($File, 'w+');
                        fwrite($Handle, $data12);
                        fclose($Handle);
                    }
                }

          //$this->load->view('3_select_friend.php',$data);

           exit();
    }


	function logout()
	{
		$data['login_error'] = 0;
        session_unset();
        session_destroy();
        
        $this->load->helper('url');
        redirect('start/');
	}
    function set_lang()
    {
		$lang = $this->input->post('setlang');
        $item = $this->config->item('languages');
		$_SESSION['language'] = $item[$lang]['language'];
        exit();
    }
}
?>

