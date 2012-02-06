<?php
Class Home extends SIM_Controller
{
	
	function Home()
	{
		parent::SIM_Controller();

        $data['login_error'] = 0;
		$this->load->model('image_model');
        
	}
    
	function index()
	{
		$data['email_error'] = 0;
        $data['login_error'] = 0;
		$data['onload'] = '0_register';
        $this->load->view('0_register.php', $data);
	}
	
	
	function registration()
	{
        $data['email'] = $_SESSION['user_email'];
		$data['first_name'] = $this->input->post('first_name');
		$data['last_name'] = $this->input->post('last_name');
		$data['gender'] = $this->input->post('gender');

        $data['date_of_birth'] = $this->input->post('from_year').'-'.$this->input->post('from_month').'-'.$this->input->post('from_day');
        $data_error = false;
        $data_error = $this->check_age_validation($this->input->post('from_year'), $this->input->post('from_month'), $this->input->post('from_day'));


        $pattern = "/[a-zA-Z \-]/";
        if($data['first_name'] == null || $data['first_name'] == '' || $data['first_name'] == ' ' || $data['last_name'] == null || $data['last_name'] == '' || $data['last_name'] == ' ' )
            $data_error = true;
        if(count($data['first_name']) >45 || count($data['last_name']) >45)
            $data_error = true;
        if(!(preg_match ($pattern, $data['first_name'])) || !(preg_match ($pattern, $data['last_name'])))
            $data_error = true;
        $space_count = 0;
        for($i = 0; $i<strlen($data['first_name']); $i++)
        {
            $ch = substr($data['first_name'], $i, 1);
			if(ord($ch) == 32)
                $space_count++;
        }
        if($space_count > 1)
		{
            $data_error = true;
	     }
        $space_count = 0;
        for($i = 0; $i<strlen($data['last_name']); $i++)
        {
            $ch = substr($data['last_name'], $i, 1);
			if(ord($ch) == 32)
                $space_count++;
        }
        if($space_count > 1)
		{
            $data_error = true;
	     }
        if(!$data_error)
        {
            $email = $_SESSION['user_email'];

            $data['registration_step'] = 0;

            $player_id = $this->Home_model->initialize($data,$email);
            $data['player_id'] = $player_id;
            $_SESSION['player_id'] = $player_id;

			echo $player_id;
            exit();
        }
        else
        {
            redirect('start/check_login_step');
            exit();
        }
		
	}

    function check_age_validation($year, $month, $day)
    {
     $day_flag =0;
     $month_flag =0;

     $day_diff = 0;
     $mon_diff = 0;
     $year_diff = 0;

     $mon = $month;
     $day = $day;
     $year =$year;
    
     
     $to_date = Date('j');
     $to_month = Date('n');
     $to_year = Date('Y');

     
     
    // For Day difference
     if($year == 0)
     {
         return true;
     }
     else
     {
         if( $to_date < $day )
         {
             $mon = $mon + 1;
             $day_diff = ($to_date+30) - $day;
         }
         else
         {
              $day_diff = $to_date - $day;
         }

         // For Mon difference

         if( $to_month< $mon )
         {
             $year = $year + 1;
             $mon_diff = ($to_month+12) - $mon;
         }
         else
         {
              $mon_diff =  $to_month - $mon;
         }

        // For Year Difference

         $year_diff = $to_year - $year;

         if($year_diff < 13)
         {
             return true;
         }
         else
            return false;
        }

    }




	function check_sim_ready()
	{
		$player_id = $_SESSION['player_id'];
        //$ready = $this->Home_model->check_sim_ready($player_id);
        $simfriend_ready = $this->Home_model->getSimFriend($player_id, true);
        $ready = 0;
        if($simfriend_ready)
            $ready = 1;
		echo $ready;
		exit();
	}
	
	function reg_error()
	{
		$data['email_error'] = 1;
		$data['onload'] = '1_register';
        $this->load->view('1_register.php',$data);
	}
	
	function register_next()
	{
		$player_id = $_SESSION['player_id'];
		$sim_id = $this->Home_model->get_sim_user_id($player_id);

        /*  Code By Sohel   */

        $this->load->config('config');
        $base_path = $this->config->item('base_url');
        $this->load->config('sim/image_path');
        $ext_path =$this->config->item('path');
        $app_folder =$this->config->item('app_folder');
        $this->image_path = $base_path.$ext_path;
       


        $all_sim_info = $this->Home_model->getSimFriend($player_id);
        if(!$all_sim_info)
        {
            redirect('start/check_login_step/1');
            exit();
        }
        $data['sim_friend'] = $all_sim_info;

        $sim_name = $this->get_sim_name($all_sim_info);
        $data['sim_name'] = $sim_name;
        $get_image = 0;
        $data['path'] = $this->image_path;
        echo js_link('jquery.js');
      
            /*  Code By Sohel   */


		$data['onload'] = '3_select_friend';
        $this->Home_model->registration_step_chng($player_id);
        $this->load->view('3_select_friend.php', $data);
	}
	
	
	function sim_register()
	{
        $this->load->config('config');
        $base_path = $this->config->item('base_url');
        $this->load->config('sim/image_path');
        $ext_path =$this->config->item('path');
        $app_folder =$this->config->item('app_folder');
        $this->image_path = $base_path.$ext_path;
        
        $data['sim_friend_id'] = $this->input->post('hidden_sim_friend');
		$data['player_id'] = $_SESSION['player_id'];
		$_SESSION['sim_friend_id'] = $data['sim_friend_id'];
		$data['status'] = 1;
		// update registration step in user_info in web interface
		$data['registration_step'] = 2;
		$this->Web_model->update_registration_step($data['player_id'] ,$data['registration_step']);
        echo js_link('jquery.js');
        
		// update sim friend, set this friend active
		$this->Home_model->edit_sim_friend2($data);
		$data['onload'] = '2_register';
		$this->load->view('2_register.php', $data);
	}
	
	function my_status($option=0, $first_login=0)
	{

        $this->load->config('config');
        $base_path = $this->config->item('base_url');
        $this->load->config('sim/image_path');
        $ext_path =$this->config->item('path_active');
        $this->image_path = $base_path.$ext_path;
        
        $status['path'] = $this->image_path;
        $_SESSION['registered'] = 2;
		
        //for the first time login
        //if(isset($this->input->post('first_time_login')))
        
        $status['first_time_login'] = $first_login;
        if(isset($_SESSION['ses_email_freq']))
        {
            $status['email_freq_chk'] = $_SESSION['ses_email_freq'];
        }
        else
        {
            $email_freq = $this->Home_model->get_user_setting($_SESSION['player_id']);
            $status['email_freq_chk'] =$email_freq->email_freq;
        }
        
		$data['sim_friend_id'] = $_SESSION['sim_friend_id'];
		$data['player_id'] = $_SESSION['player_id'];
        $status['sim_pic_info'] = $this->Home_model->get_single_pic($data['sim_friend_id']);
        
		$data['status'] = 1; // when user choose one sim friend, it's status will be 1
		$data['active'] =1; // email activation for user
		$data['language_id'] = $this->Home_model->get_language_id($data['player_id']);// get user's language id

		$_SESSION['language_id'] = $data['language_id'];

		// for demo only start time is inserted as email response time
        if($option == 1)   // For Option page change
        {
            $this->option(0,$option);
        }
        else    // For initial registration page
        {
		// retrieve data for my status
		$status['player_id'] = $data['player_id'];
		$status['sim_friend_id'] = $data['sim_friend_id'];
		
		//may need to change--status data
		//$status['life_time_happiness_point'] = $this->Home_model->life_time_happiness_point($data['player_id'],$data['sim_friend_id'] );
		$status['achievement_point'] = $this->Home_model->achievement_point($data['player_id'], $data['sim_friend_id']);
		$status['sim_skill_list'] = array(
			array("Charisma", '0'),
			array("Athletic", '0'),
			array("Fishing", '0'),
			array("Cooking", '0'),
			array("Guitar", '0'),
			array("Gardening", '0'),
			array("Logic", '0'),
			array("Handiness", '0'),
			array("Photography", '0'),
			array("Painting", '0'),
			array("Writing", '0')
		);
		$skill_points = $this->Home_model->get_raw_skills($data['sim_friend_id'], $data['language_id']);
		for($i=0; $i < count($status['sim_skill_list']); $i++)
			if(isset($skill_points[$status['sim_skill_list'][$i][0]]))
				$status['sim_skill_list'][$i][1] = $skill_points[$status['sim_skill_list'][$i][0]];
		
		//add trust to sim_skill_list
		$trust = $this->Home_model->get_trust($data['sim_friend_id']);
		$status['sim_skill_list'][] = array("Trust", $trust);
		
		$status['career'] = $this->Home_model->get_career($data['player_id'], $data['sim_friend_id']);
		$status['simoleons'] = $this->Home_model->simoleons($data['sim_friend_id']);
		
		// status page--sim's data

        //$sim_id = $this->Home_model->get_sim_user_id($data['sim_friend_id']);

		$status['name'] = $this->Home_model->sim_name($data['sim_friend_id']);

		$status['personality'] = $this->Home_model->personality($data['sim_friend_id']);
		$status['favorite_activity'] = $this->Home_model->favorite_activity($data['sim_friend_id']);
		$status['aspiration'] = $this->Home_model->aspiration($data['sim_friend_id']);
        echo js_link('jquery.js');
    
         $this->load->view('my_status.php',$status);
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



	function achievement()
	{
		$player_id = $_SESSION['player_id'];
		$sim_friend_id = $_SESSION['sim_friend_id'];
		$language_id = $_SESSION['language_id'];
		
		$data['achievement'] = $this->Home_model->get_achievement($player_id, $language_id);
		$data['counter'] = $this->Home_model->achievement_point($player_id, $sim_friend_id);
		
		$this->load->view('achievement.php',$data);
	}
	
	function change_avatar()
	{

			// change the status of previous sim friend -- setting inactive
            $chosen_sim = $this->input->post('sim_friend_id');
            if($chosen_sim != $_SESSION['sim_friend_id'] )
            {
                $data['player_id'] = $_SESSION['player_id'];
                $data['sim_friend_id'] = $_SESSION['sim_friend_id'];
                $data['status'] = 2;
                $this->Home_model->edit_sim_friend_option($data);
                $time = $this->Home_model->get_email_response($data);
                $data['time'] = $time;
                $_SESSION['sim_friend_id'] = $this->input->post('sim_friend_id');
                $data['sim_friend_id'] = $_SESSION['sim_friend_id'];
                $data['status'] = 1;
                $this->Home_model->edit_sim_friend_final($data);
            }
			return true;
	}

    
	
	function option($password_error =0,$save=0)
	{
		$this->load->config('config');
        $base_path = $this->config->item('base_url');
        $this->load->config('sim/image_path');
        $ext_path =$this->config->item('path_active');
        $this->image_path = $base_path.$ext_path;
        
        $data['path'] = $this->image_path;
        
        $data['sim_friend_id'] = $_SESSION['sim_friend_id'];
		//$sim_id = $this->Home_model->get_sim_user_id($data['sim_friend_id']);
		$data['name'] = $this->Home_model->sim_name($data['sim_friend_id']);

        $data['sim_pic_info'] = $this->Home_model->get_single_pic($data['sim_friend_id']);
        
		$data['personality'] = $this->Home_model->personality($data['sim_friend_id']);
		$data['favorite_activity'] = $this->Home_model->favorite_activity($data['sim_friend_id']);
		$data['aspiration'] = $this->Home_model->aspiration($data['sim_friend_id']);
		$data['sim_image'] = $this->Home_model->sim_image($data['sim_friend_id']);
		
		// email & password for user
		$data['user_email_password'] = $this->Web_model->get_user_email_password($_SESSION['player_id']);
        $user_settings = $this->Home_model->get_user_setting($_SESSION['player_id']);

		$data['password_error'] = $password_error;
        $data['save'] = $save;
        $data['email_format'] = $user_settings->email_format;
        $data['time_zone'] = $user_settings->time_zone;
        $data['email_time'] = $user_settings->email_time;
        $data['email_freq'] = $user_settings->email_freq;
        echo js_link('jquery.js');
     
        
		$data["onload"] = 'option';
        $this->load->view('option.php', $data);
	}

	
	function faq()
	{
		$this->load->view('faq.php');
	}
	
	function option_avatar()
	{
        $this->load->config('config');
        $base_path = $this->config->item('base_url');
        $this->load->config('sim/image_path');
        $ext_path =$this->config->item('path');
        $this->image_path = $base_path.$ext_path;
        
        $data['player_id'] = $_SESSION['player_id'];
        $all_sim_info = $this->Home_model->get_sim_friend($data['player_id']);
        $data['sim_friend'] = $all_sim_info;
		$sim_name = $this->get_sim_name($all_sim_info);
        $data['sim_name'] = $sim_name;
        $get_image = 0;
        $data['path'] = $this->image_path;
        echo js_link('jquery.js');
        //$this->sim_image($all_sim_info);
  

        $data['onload'] = 'option_avatar';
        $this->load->view('option_avatar',$data);
	}

    function sim_image()
    {

         $this->load->config('sim/image_path');
         $app_folder =$this->config->item('app_folder');
         $image_path = $_SERVER['DOCUMENT_ROOT'].$app_folder.ADD.basename(APPPATH) .'/assets/images/sim_image/';
         
        
         $player_id = $this->input->post('player_id');
         $all_sim_info = $this->Home_model->get_sim_friend($player_id);

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

	function change_email()
	{

        $this->load->config('config');
        $base_path = $this->config->item('base_url');
        $this->load->config('sim/image_path');
        $ext_path =$this->config->item('path');
        $this->image_path = $base_path.$ext_path;

        $data['path'] = $this->image_path;
        
        $new_email = $this->input->post('new_email');
		$player_id = $_SESSION['player_id'];
		
		$this->Home_model->change_email($player_id,$new_email);
		
		// now loading options page again
		$data['sim_friend_id'] = $_SESSION['sim_friend_id'];
        //$sim_id = $this->Home_model->get_sim_user_id($data['sim_friend_id']);
		$data['name'] = $this->Home_model->sim_name($data['sim_friend_id']);
        
		$data['personality'] = $this->Home_model->personality($data['sim_friend_id']);
		$data['favorite_activity'] = $this->Home_model->favorite_activity($data['sim_friend_id']);
		$data['aspiration'] = $this->Home_model->aspiration($data['sim_friend_id']);
		$data['sim_image'] = $this->Home_model->sim_image($data['sim_friend_id']);
		
		// email & password for user
		$data['user_email_password'] = $this->Web_model->get_user_email_password($_SESSION['player_id']);
		$data['password_error'] = 0;
		
		$data["onload"] = 'option';
        $this->load->view('option.php',$data);
	}
	
	function change_password()
	{
		$player_id = $_SESSION['player_id'];
		
		//check the old password:
		$old_password = $this->input->post('old_password');
		$check_old_password = $this->Web_model->check_old_password($player_id, $old_password);
		
		// insert into 
		if($check_old_password)
		{
			$password = $this->input->post('new_password');
			$this->Web_model->change_password($player_id, $password);
			
			// now loading options page again
			$data['sim_friend_id'] = $_SESSION['sim_friend_id'];
            //$sim_id = $this->Home_model->get_sim_user_id($data['sim_friend_id']);
            $data['name'] = $this->Home_model->sim_name($data['sim_friend_id']);

			$data['personality'] = $this->Home_model->personality($data['sim_friend_id']);
			$data['favorite_activity'] = $this->Home_model->favorite_activity($data['sim_friend_id']);
			$data['aspiration'] = $this->Home_model->aspiration($data['sim_friend_id']);
			$data['sim_image'] = $this->Home_model->sim_image($data['sim_friend_id']);
			
			// email & password for user
			$data['user_email_password'] = $this->Web_model->get_user_email_password($_SESSION['player_id']);
			$data['password_error'] = 0;
			
			$data["onload"] = 'option';
            $this->load->view('option.php',$data);
		}
		else 
		{
			$data['sim_friend_id'] = $_SESSION['sim_friend_id'];
            //$sim_id = $this->Home_model->get_sim_user_id($data['sim_friend_id']);
            $data['name'] = $this->Home_model->sim_name($data['sim_friend_id']);

			$data['personality'] = $this->Home_model->personality($data['sim_friend_id']);
			$data['favorite_activity'] = $this->Home_model->favorite_activity($data['sim_friend_id']);
			$data['aspiration'] = $this->Home_model->aspiration($data['sim_friend_id']);
			$data['sim_image'] = $this->Home_model->sim_image($data['sim_friend_id']);
			
			// email & password for user
			$data['user_email_password'] = $this->Web_model->get_user_email_password($_SESSION['player_id']);
			
			// set old password is wrong			
			$data['password_error'] = 1;
			
			$data["onload"] = 'option';
            $this->load->view('option.php',$data);
		}
	
	}
	
	function email_options($send = 1)
	{
        $this->load->config('config');
        $base_path = $this->config->item('base_url');
        $this->load->config('sim/image_path');
        $ext_path =$this->config->item('path_active');
        $this->image_path = $base_path.$ext_path;

        $status['path'] = $this->image_path;

        $data['player_id'] = $_SESSION['player_id'];
		$data['sim_friend_id'] = $_SESSION['sim_friend_id'];
		$data['language_id'] = $_SESSION['language_id'];

        if($send == 0)
        {
            $this->Home_model->stop_email($data);
            $_SESSION['ses_email_freq'] = -1;
        }
        else
        {
            $this->Home_model->resend_last_email($data);
        }

		redirect('home/my_status');
		exit();
		
		// retrieve data for my status
		$status['player_id'] = $data['player_id'];
		$status['sim_friend_id'] = $data['sim_friend_id'];
		
		//may need to change--status data
		//$status['life_time_happiness_point'] = $this->Home_model->life_time_happiness_point($data['player_id'],$data['sim_friend_id'] );
		$status['achievement_point'] = $this->Home_model->achievement_point($data['player_id'], $data['sim_friend_id']);
		$status['skill_point'] = $this->Home_model->get_skills($data['sim_friend_id'], TRUE, $data['language_id']);
		$status['career'] = $this->Home_model->get_career($data['player_id'], $data['sim_friend_id']);
		$status['simoleons'] = $this->Home_model->simoleons($data['sim_friend_id']);
		
		// status page--sim's data
        //$sim_id = $this->Home_model->get_sim_user_id($data['sim_friend_id']);
		$status['name'] = $this->Home_model->sim_name($data['sim_friend_id']);
		
		$status['personality'] = $this->Home_model->personality($data['sim_friend_id']);
		$status['favorite_activity'] = $this->Home_model->favorite_activity($data['sim_friend_id']);
		$status['aspiration'] = $this->Home_model->aspiration($data['sim_friend_id']);
		$status['sim_image'] = $this->Home_model->sim_image($data['sim_friend_id']);
		
		$this->load->view('my_status.php',$status);
	}


    function get_sim_name($all_sim_info)
    {
         $sim_name = array();

        for($i=0;$i<count($all_sim_info); $i++)
        {
            $sim_name[$i]['sim_fname'] = $this->Home_model->get_fsim_name($all_sim_info[$i]->FIRST_NAME_ID);
            $sim_name[$i]['sim_lname'] = $this->Home_model->get_lsim_name($all_sim_info[$i]->LAST_NAME_ID);
        }

        return $sim_name;

    }

    function sim_image1($sim_friend_id)
    {

                $data = $this->image_model->sim_image($all_sim_info[$i]->id);
               
    }

        


 }
?>

