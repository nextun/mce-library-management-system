<?php
Class Home_model extends Model
{
	
	function Home_model()
	{
		parent::Model();
        if(!isset($_SESSION))
			session_start();
		
		$CI = & get_instance();
		$this->db1 = $CI->db1;
		$this->db2 = $CI->db2;
		
		/*
		$this->db1 = $this->load->database('default', true);
		$this->db2 = $this->load->database('web', true);
		*/
		
		$this->load->helper('sim_link_helper');
        $this->load->model('Web_model');
	}

	function initialize($data, $email)
	{
		
		// insert into web interface

        
            //$query_web = 'UPDATE user_info set FIRST_NAME="'.$data['first_name'].'",  LAST_NAME = "'.$data['last_name'].'" , date_of_birth = CAST("'.$data['date_of_birth'].'" AS DATE), gender = '.$data['gender'].' , created = NOW(), registration_step= '. $data['registration_step'].' where email="'.$email.'"';

            $query_web = 'UPDATE user_info set FIRST_NAME= ? ,  LAST_NAME = ? , date_of_birth = CAST("'.$data['date_of_birth'].'" AS DATE), gender = ?  , created = NOW(), registration_step= ?  where email= ? ';
            $this->db2->query($query_web, array($data['first_name'], $data['last_name'], $data['gender'] , $data['registration_step'] , $email  ));
         
            //$query = "SELECT id FROM user_info WHERE email = '".trim($email)."'";

            $query = "SELECT id FROM user_info WHERE email = ? ";
            $result12 = $this->db2->query($query, array(trim($email)));
            $result = $result12->row();
         
            $player_id = $result->id;
            
        
		
		
		
        //echo "Player id from user_info: ". $player_id;
		
		//$this->db1 = $this->load->database('default', true);
		// insert into backend
        //$query_back_end = 'INSERT INTO USER_CHANGE (PLAYER_ID, FIRST_NAME, LAST_NAME, EMAIL,  GENDER,  CREATED, LANGUAGE_ID, ACTIVE, START_TIME, STOP_TIME, USE_HTML_EMAIL) VALUES('.$player_id.' , "'.$data['first_name'].'" , "'.$data['last_name'].'" , "'.$data['email'].'" ,  '.$data['gender'].' , NOW(), 1 , 1, "00:00:00", "23:59:59", 1 )';
        $query_back_end = 'INSERT INTO USER_CHANGE (PLAYER_ID, FIRST_NAME, LAST_NAME, EMAIL,  GENDER,  CREATED, LANGUAGE_ID, ACTIVE, START_TIME, STOP_TIME, USE_HTML_EMAIL) VALUES( ? , ? , ? , ? , ? , NOW(), 1 , 1, "00:00:00", "23:59:59", 1 )';
		$this->db1->query($query_back_end, array($player_id, $data['first_name'], $data['last_name'], $data['email'], $data['gender'] ));
		//$temp_player_id = mysql_insert_id();
        //echo "Player id after into USER_CHANGE: ". $temp_player_id;
        return  $player_id;
		
	}

    
    function registration_step_chng($id)
    {
        //$this->db2 = $this->load->database('web', true);
        $query_web = 'UPDATE user_info set registration_step= 1 where id= ? ' ;
        $this->db2->query($query_web, array($id));

    }



	function checkEmailAvailable($email)
	{
		//$query = 'SELECT id FROM user_info WHERE email = "'.trim($email).'"';
        $query = 'SELECT id FROM user_info WHERE email = ? ';
		$result = $this->db2->query($query, array(trim($email)));
		
		if($result->num_rows() > 0)
			return 1;
		else 
			return 0;
	}
	
	function start_time($email_time)
	{
		// email time adjust
		$start_stop_find = explode('-', $email_time);
		//start time
		if(strpos($start_stop_find[0],'am'))
		{
			$start_time_find = explode('am', $start_stop_find[0]);
			$start_time = $start_time_find[0];
		}
		else 
		{
			$start_time_find = explode('am', $start_stop_find[0]);
			$start_time = ($start_time_find[0]+12);
		}
		
		return $start_time;
	}
	
	function stop_time($email_time)
	{
      
		// email time adjust
		$start_stop_find = explode('-', $email_time);
		
		// stop time
		if(strpos($start_stop_find[1],'am'))
		{
			$stop_time_find = explode('am', $start_stop_find[1]);
			$stop_time = $stop_time_find[0];
		}
		else 
		{
			$stop_time_find = explode('am', $start_stop_find[1]);
			$stop_time = ($stop_time_find[0]+12);
		}
		
		return $stop_time;
	}	
	
	// email response time
	
	function email_response_time($data)
	{
        $this->load->config('sim/email_freq');
        $email_response =$this->config->item('email_freq');
        $email_response_time = 0;
        
        if($data['email_freq'] == 2 || $data['email_freq'] == 4 || $data['email_freq'] == 5)
        {

            $email_response_time = $email_response[$data['email_freq']][$data['email_time']];
        }
        
		return $email_response_time;
		
	}
	
	/*
     * Not used anymore
     */

    function check_sim_ready($player_id)
	{
            //echo "Into Model check_sim_ready";
            //$this->db1 = $this->load->database('default', true);
			//$query = 'SELECT SIM_FRIEND_LIST_READY AS sim_friend_list_ready FROM USER u WHERE u.PLAYER_ID = '.$player_id;
            $query = 'SELECT SIM_FRIEND_LIST_READY AS sim_friend_list_ready FROM USER u WHERE u.PLAYER_ID = ? ';
			$result = $this->db1->query($query, array($player_id));
			
			// check for sim_friend_list_readyness...
            //var_dump($result);
            //exit();
			if($result->num_rows > 0)
			{
                $result = $result->row();
				if($result->sim_friend_list_ready == 1)
				{
						//echo "Got sim_friend_list_ready == 1";
                        $query = 'SELECT * FROM USER u, SIM_FRIEND sf WHERE u.PLAYER_ID = ?  AND sf.USER_ID = u.ID AND sf.STATUS = 0';
						$result_sim = $this->db1->query($query, array($player_id));
				
						// check sim friend table for sim friends
						if($result_sim->num_rows > 0)	
							return 1;
						else {
                            return 0;
                        }
				}
				else {
                    //echo "Got sim_friend_list_ready != 1";
					return 0;
                }
			}
			else {
                //echo "result < 0";
				return 0;
            }
	
	}
	
	/*
     * Not used anymore
     */
    function getSimFriendOld($player_id)
	{

      
		// check whether simfriend is created
		while (1)
		{
			//$this->db1 = $this->load->database('default', true);
            $query = 'SELECT SIM_FRIEND_LIST_READY AS sim_friend_list_ready FROM USER u WHERE u.ID = '.$player_id;
			$result = $this->db1->query($query);
			
			// check for sim_friend_list_readyness...
			if($result->num_rows > 0)
			{
				$result = $result->row();
				if($result->sim_friend_list_ready == 1)
					break;
			}
		}
		
		
		if($result->sim_friend_list_ready == 1)
		{
			while (1)
			{
				$query = 'SELECT * FROM SIM_FRIEND AS sf WHERE sf.USER_ID = '.$player_id.'  AND sf.STATUS = 0';
				$result_sim = $this->db1->query($query);
				
				// check sim friend table for sim friends
				if($result_sim->num_rows > 0)	
					break;
			}
			
			$result_sim = $result_sim->result();
			return $result_sim; 
		}
	}

    function getSimFriend($player_id, $just_check = false)
    {
        $simfriend_list = false;
        for($delay = 0;$delay <= 6; $delay++)
        {
            if($delay)
                sleep($delay);
            if($this->check_simfriend_ready($player_id))
            {
                if($just_check)
                {
                    $simfriend_list = true;
                    break;
                }
				$user_id = $this->get_sim_user_id($player_id);
                $simfriend_list_temp = $this->get_simfriend_list($user_id);
                if($simfriend_list_temp)
                {
                    $simfriend_list = $simfriend_list_temp;
                    break;
                }
            }
        }
        return $simfriend_list;
    }

    function check_simfriend_ready($player_id)
    {
        //$this->db1 = $this->load->database('default', true);
        //$query = 'SELECT SIM_FRIEND_LIST_READY AS sim_friend_list_ready FROM USER u WHERE u.PLAYER_ID = '.$player_id;
        $query = 'SELECT SIM_FRIEND_LIST_READY AS sim_friend_list_ready FROM USER u WHERE u.PLAYER_ID = ? ';
		$result = $this->db1->query($query, array($player_id));
        $ready = false;
        if($result->num_rows > 0)
		{
			$result = $result->row();
			if($result->sim_friend_list_ready == 1)
                $ready = true;
        }
        return $ready;
    }

    function get_simfriend_list($player_id)
    {
        //$query = 'SELECT * FROM SIM_FRIEND AS sf WHERE sf.USER_ID = '.$player_id.'  AND sf.STATUS = 0';
        $query = 'SELECT * FROM SIM_FRIEND AS sf WHERE sf.USER_ID = ?  AND sf.STATUS = 0';
		$result_sim = $this->db1->query($query, array($player_id));
		$simfriend_list = false;
        if($result_sim->num_rows > 0)
        {
			$simfriend_list = $result_sim->result();

		}
		return $simfriend_list;
    }


    function edit_sim_friend2($data)
	{
        //$this->db1 = $this->load->database('default', true);
        //$query = 'INSERT INTO SIM_FRIEND_CHANGE (PLAYER_ID, SIM_FRIEND_ID, STATUS ) VALUES('.$data['player_id'].' , '.$data['sim_friend_id'].' , '.$data['status'].')';
        $query = 'INSERT INTO SIM_FRIEND_CHANGE (PLAYER_ID, SIM_FRIEND_ID, STATUS ) VALUES( ? , ? , ? )';
		$result = $this->db1->query($query, array($data['player_id'],$data['sim_friend_id'], $data['status'] ));
	}

    function edit_sim_friend_option($data)
	{
        //$this->db1 = $this->load->database('default', true);
        //$query = 'INSERT INTO SIM_FRIEND_CHANGE (PLAYER_ID, SIM_FRIEND_ID, STATUS) VALUES('.$data['player_id'].' , '.$data['sim_friend_id'].' , '.$data['status'].')';
        $query = 'INSERT INTO SIM_FRIEND_CHANGE (PLAYER_ID, SIM_FRIEND_ID, STATUS) VALUES(? , ? , ? )';
		$result = $this->db1->query($query, array($data['player_id'], $data['sim_friend_id'] , $data['status'] ));
	}

    function get_email_response($data)
    {
        //$this->db1 = $this->load->database('default', true);
        //$query = 'SELECT EMAIL_RESPONSE_TIME as time FROM SIM_FRIEND WHERE ID= '. $data['sim_friend_id'];
        $query = 'SELECT EMAIL_RESPONSE_TIME as time FROM SIM_FRIEND WHERE ID= ? ';
        $result12 = $this->db1->query($query, array($data['sim_friend_id']));
        $result = $result12->row();
        return $result->time;
    }

    function edit_sim_friend_final($data)
    {
        
        //$this->db1 = $this->load->database('default', true);
        //$query = 'INSERT INTO SIM_FRIEND_CHANGE (PLAYER_ID, SIM_FRIEND_ID, STATUS, EMAIL_RESPONSE_TIME ) VALUES('.$data['player_id'].' , '.$data['sim_friend_id'].' , '.$data['status'].' , "'.  $data['time']  .'" )';
        $query = 'INSERT INTO SIM_FRIEND_CHANGE (PLAYER_ID, SIM_FRIEND_ID, STATUS, EMAIL_RESPONSE_TIME ) VALUES( ? , ? , ? , ? )';

        $result = $this->db1->query($query, array($data['player_id'], $data['sim_friend_id'], $data['status'], $data['time'] ));
    }
    
	// after final registration (after step-3)
	function edit_sim_friend($data)
	{
        $user_created_time = $this->get_create_time($data['player_id']);
        
        if($data['email_format'] == 1)
        {
            $html_email = 1;
        }
        else
        {
            $html_email = 0;
        }
        
		//$this->db1 = $this->load->database('default', true);
        if($data['email_freq'] == 3)
        {
          //$query1 = 'INSERT INTO USER_CHANGE (PLAYER_ID, CREATED , USER_STATUS) VALUES('.$data['player_id'].' , "'.$user_created_time.'" , 0 )';
          
          $query1 = 'INSERT INTO USER_CHANGE (PLAYER_ID, CREATED , USER_STATUS) VALUES( ?  , ? , 0 )';
          $result = $this->db1->query($query1, array($data['player_id'],$user_created_time));

          //$query = 'INSERT INTO SIM_FRIEND_CHANGE (PLAYER_ID, SIM_FRIEND_ID, EMAIL_RESPONSE_TIME ) VALUES('.$data['player_id'].' , '.$data['sim_friend_id'].' , CAST("00:01:00" AS TIME) )';
          $query = 'INSERT INTO SIM_FRIEND_CHANGE (PLAYER_ID, SIM_FRIEND_ID, EMAIL_RESPONSE_TIME ) VALUES( ?  , ? , CAST("00:01:00" AS TIME) )';
          $result = $this->db1->query($query, array($data['player_id'], $data['sim_friend_id'] ));
         
        }
        elseif($data['email_freq'] < 0 )
        {
          //$query = 'INSERT INTO USER_CHANGE (PLAYER_ID, CREATED , USER_STATUS) VALUES('.$data['player_id'].' , "'.$user_created_time.'" , 1 )';
          $query = 'INSERT INTO USER_CHANGE (PLAYER_ID, CREATED , USER_STATUS) VALUES( ? , ? , 1 )';
          $result = $this->db1->query($query, array($data['player_id'], $user_created_time ));
        }
        else
        {
            //$query1 = 'INSERT INTO USER_CHANGE (PLAYER_ID, CREATED , USER_STATUS) VALUES('.$data['player_id'].' , "'.$user_created_time.'" , 0 )';
            $query1 = 'INSERT INTO USER_CHANGE (PLAYER_ID, CREATED , USER_STATUS) VALUES( ?  , ? , 0 )';
            $result = $this->db1->query($query1, array($data['player_id'], $user_created_time ));
            //$query = 'INSERT INTO SIM_FRIEND_CHANGE (PLAYER_ID, SIM_FRIEND_ID, EMAIL_RESPONSE_TIME ) VALUES('.$data['player_id'].' , '.$data['sim_friend_id'].' , CAST("'.$data['email_response_time'].'" AS TIME))';
            $query = 'INSERT INTO SIM_FRIEND_CHANGE (PLAYER_ID, SIM_FRIEND_ID, EMAIL_RESPONSE_TIME ) VALUES( ?  , ? , CAST("'.$data['email_response_time'].'" AS TIME))';
            $result = $this->db1->query($query, array($data['player_id'],$data['sim_friend_id'] ) );
        }
        
        
        /*echo date('M d Y H:i:s') . '<br>';
        echo gmdate('M d Y H:i:s') . '<br>';
        echo date('e').'<br>';
        echo date('T');
         * echo $gmt_diff;
        exit;*/
         
        $gmt_diff = date('P');   // Server
        $hr_diff = explode(':', $gmt_diff);   // Server

        
        
        $hr_diff = $hr_diff[0]*60 + $hr_diff[1];

        if($data['email_time'] == 4)    // For all day email send
        {
            $start_hr = 0;
            $stop_hr = 23;
            $start_time =   'SELECT MAKETIME('.$start_hr.' , 00 , 00) AS start_time';
            $stop_time =   'SELECT MAKETIME('.$stop_hr.' , 59 , 59) AS stop_time';
            $result_start = $this->db1->query($start_time);
            $result_stop = $this->db1->query($stop_time);

            $result1 = $result_start->row();
            $result2 = $result_stop->row();
        }
        else
        {
            if($data['email_time'] == 1)
            {
                $email_start_time = 8*60;
                $email_stop_time = 12*60;
                
            }
            else if($data['email_time'] == 2)
            {
                $email_start_time = 12*60;
                $email_stop_time = 17*60;
            }
            else if($data['email_time'] == 3)
            {
                $email_start_time = 17*60;
                $email_stop_time = 22*60;
            }
            else if($data['email_time'] == 5)
            {
                $email_start_time = 8*60;
                $email_stop_time = 18*60;
            }

            $sep_time_id = explode(',', $data['timezone']);

            $data_min = ($sep_time_id[0]) * 60 ;

            if(($hr_diff >= $data_min ) )   // Server > user
            {
                $flag = 1;
                $added_time_diff = $hr_diff - $data_min;

            }
            else                                   // Server< user
            {
                $flag = 0;
                $added_time_diff = $data_min - $hr_diff;
            }

            if($flag == 1)
            {
                $start_init_hr = (int)(($added_time_diff + $email_start_time)/60);
                $start_hr = $start_init_hr % 24;
                $start_min = ($added_time_diff + $email_start_time) - ($start_init_hr*60);
                $stop_init_hr = (int)(($added_time_diff +$email_stop_time)/60);
                $stop_hr = $stop_init_hr % 24;
                $stop_min = ($added_time_diff + $email_stop_time) - ($stop_init_hr*60);
            }
            else
            {
                $start_min_hr = ( $email_start_time - $added_time_diff );
                if($start_min_hr < 0)
                {
                    $start_init_hr = ($start_min_hr+24*60);
                    $start_hr = (int)($start_init_hr/60);
                    $start_min = ($start_init_hr - $start_hr*60);
                }
                else
                {
                    $start_hr = (int)($start_min_hr/60);
                    $start_min = ($start_min_hr - $start_hr*60);
                }

                $stop_min_hr = ( $email_stop_time - $added_time_diff );
                if($stop_min_hr < 0)
                {
                    $stop_init_hr = ($stop_min_hr+24*60);
                    $stop_hr = (int)($stop_init_hr/60);
                    $stop_min = ($stop_init_hr - $stop_hr*60);
                }
                else
                {
                    $stop_hr = (int)($stop_min_hr/60);
                    $stop_min = ($stop_min_hr - $stop_hr*60);
                }
            }

            $start_time =   'SELECT MAKETIME('.$start_hr.' , '. $start_min .' , 00) AS start_time';
            $stop_time =   'SELECT MAKETIME('.$stop_hr.' , ' . $stop_min . ' , 00) AS stop_time';
            $result_start = $this->db1->query($start_time);
            $result_stop = $this->db1->query($stop_time);

            $result1 = $result_start->row();
            $result2 = $result_stop->row();
       }

        //create time is also needed to be passed to fix the date bug
        $user_created_time = $this->get_create_time($data['player_id']);

        if($data['email_freq'] == 3)
        {
            $start_time =   'SELECT MAKETIME(00,00,00) AS start_time';
            $stop_time =   'SELECT MAKETIME(23,59,59) AS stop_time';
            $result_start = $this->db1->query($start_time);
            $result_stop = $this->db1->query($stop_time);
            $result1 = $result_start->row();
            $result2 = $result_stop->row();
            //$query_back_end = 'INSERT INTO USER_CHANGE (PLAYER_ID, CREATED, START_TIME, STOP_TIME, USE_HTML_EMAIL ) VALUES('.$data['player_id'].', "'.$user_created_time.'","'.$result1->start_time.'","'.$result2->stop_time.'", ' .$html_email.'     )';
            $query_back_end = 'INSERT INTO USER_CHANGE (PLAYER_ID, CREATED, START_TIME, STOP_TIME, USE_HTML_EMAIL ) VALUES( ? , ? ,"'.$result1->start_time.'","'.$result2->stop_time.'", ?  )';
            $this->db1->query($query_back_end, array($data['player_id'], $user_created_time,$html_email));
        }
        else
        {
            
            $query_back_end = 'INSERT INTO USER_CHANGE (PLAYER_ID, CREATED, START_TIME, STOP_TIME, USE_HTML_EMAIL ) VALUES( ? ,? , "'.$result1->start_time.'","'.$result2->stop_time.'", ? )';
            $this->db1->query($query_back_end, array($data['player_id'], $user_created_time, $html_email ));
        }
		

		
	}

    function get_create_time($player_id)
    {
       //$this->db1 = $this->load->database('default', true);
       $query = 'SELECT CREATED FROM USER WHERE PLAYER_ID= ? ';
       $result = $this->db1->query($query, array($player_id));
       $result_created = $result->row();

       return $result_created->CREATED;
    }
	
	function edit_user_status($data)
	{
		//$this->db1 = $this->load->database('default', true);
        //$query = 'INSERT INTO USER_CHANGE (PLAYER_ID, LANGUAGE_ID, ACTIVE) VALUES('.$data['player_id'].' , '.$data['language_id'].' , '.$data['active'].')';
        $query = 'INSERT INTO USER_CHANGE (PLAYER_ID, LANGUAGE_ID, ACTIVE) VALUES('.$data['player_id'].' , '.$data['language_id'].' , '.$data['active'].')';
		$result = $this->db1->query($query);
	}
	
	function get_language_id($player_id)
	{
		//$this->db1 = $this->load->database('default', true);
        $query = 'SELECT LANGUAGE_ID as language_id  FROM USER WHERE PLAYER_ID = ? ';
		$result = $this->db1->query($query, array($player_id));
		$result = $result->row();
		
		return  $result->language_id;
	}
	
	function resend_last_email($data)
	{
		//$this->db1 = $this->load->database('default', true);
        //$query = 'INSERT INTO SIM_FRIEND_CHANGE (PLAYER_ID, SIM_FRIEND_ID, RESEND_LAST_EMAIL) VALUES ('.$data['player_id'].' , '.$data['sim_friend_id'].', 1)';
        $query = 'INSERT INTO SIM_FRIEND_CHANGE (PLAYER_ID, SIM_FRIEND_ID, RESEND_LAST_EMAIL) VALUES ( ?  , ? , 1)';
		$this->db1->query($query, array($data['player_id'], $data['sim_friend_id']));
	}
	
	function life_time_happiness_point($player_id, $sim_friend_id)
	{
		return 1000;
	}
	
	function achievement_point($player_id, $sim_friend_id)
	{
		$user_id = $this->get_user_id($player_id);
		//$this->db1 = $this->load->database('default', true);
        $query = 'SELECT COUNT(*) AS  NumberOfAchievements FROM USER_ACHIEVEMENTS ua  WHERE ua.USER_ID = ? ';
		$result = $this->db1->query($query, array($user_id));
		$result = $result->row();
		
		return $result->NumberOfAchievements;
	}
	
	function get_user_id($player_id)
	{
		//$this->db1 = $this->load->database('default', true);
        $query = 'SELECT ID FROM USER WHERE PLAYER_ID = ? ';
		$result = $this->db1->query($query, array($player_id));
		$result = $result->row();
		
		return $result->ID;
	}
	
	function skill_point($sim_friend_id, $language_id)
	{
		//$this->db1 = $this->load->database('default', true);
        $query = 'SELECT lt.TEXT AS SkillName, sfs.VALUE AS SkillValue FROM SIM_FRIEND_SKILLS sfs, LIST_VALUE lv, LOCALIZED_TEXT lt WHERE sfs.SIM_FRIEND_ID = ?  AND lv.ID = sfs.SKILL_ID  AND lt.TEXT_ENTRY_ID = lv.TEXT_ENTRY_ID AND lt.LANGUAGE_ID = ? ';
		$result = $this->db1->query($query, array($sim_friend_id, $language_id));
		
		if($result->num_rows > 0)
		{
			$result = $result->row();
			return $result->SkillValue;
		}
		else 
			return 0;
	}
	
	function get_career($player_id, $simfriend_id)
	{
		//$this->db1 = $this->load->database('default', true);
		//$query = 'SELECT LT.TEXT, LV.LEVEL FROM LOCALIZED_TEXT AS LT, LIST_VALUE AS LV, SIM_FRIEND AS SF WHERE LT.TEXT_ENTRY_ID = LV.TEXT_ENTRY_ID AND LT.LANGUAGE_ID = 1 AND (LV.ID = SF.CAREER_ID OR LV.ID = SF.CAREER_TITLE_ID) AND SF.ID = '.$simfriend_id;
        $query = 'SELECT LT.TEXT, LV.LEVEL FROM LOCALIZED_TEXT AS LT, LIST_VALUE AS LV, SIM_FRIEND AS SF WHERE LT.TEXT_ENTRY_ID = LV.TEXT_ENTRY_ID AND LT.LANGUAGE_ID = 1 AND (LV.ID = SF.CAREER_ID OR LV.ID = SF.CAREER_TITLE_ID) AND SF.ID = ? ';
		$result_careers = $this->db1->query($query, array($simfriend_id));
		$result_careers = $result_careers->result();
		$career = array();
		$career['career_path'] = $result_careers[0]->TEXT;
		if(isset($result_careers[1]->TEXT))
        {
			$career['career_title'] = $result_careers[1]->TEXT;
			$career['career_level'] = $result_careers[1]->LEVEL;
        }
		return $career;
	}
	
	function get_raw_skills($simfriend_id, $language_id = 1)
	{
		//$this->db1 = $this->load->database('default', true);
		//$query = 'SELECT LT.TEXT, SFS.VALUE FROM LOCALIZED_TEXT AS LT, LIST_VALUE AS LV, SIM_FRIEND_SKILLS AS SFS WHERE LT.TEXT_ENTRY_ID = LV.TEXT_ENTRY_ID AND LT.LANGUAGE_ID = '.$language_id.' AND LV.ID = SFS.SKILL_ID AND SFS.SIM_FRIEND_ID = '.$simfriend_id;
        $query = 'SELECT LT.TEXT, SFS.VALUE FROM LOCALIZED_TEXT AS LT, LIST_VALUE AS LV, SIM_FRIEND_SKILLS AS SFS WHERE LT.TEXT_ENTRY_ID = LV.TEXT_ENTRY_ID AND LT.LANGUAGE_ID = ?  AND LV.ID = SFS.SKILL_ID AND SFS.SIM_FRIEND_ID = ? ';
		$result_skills = $this->db1->query($query, array($language_id,$simfriend_id ));
		$result_skills = $result_skills->result();
		$skills = array();
		foreach($result_skills as $skill)
		{
			$skills[$skill->TEXT] = $skill->VALUE;
		}
		return $skills;
	}
	
	function get_trust($simfriend_id)
	{
		//$this->db1 = $this->load->database('default', true);
        $query = 'SELECT TRUST FROM SIM_FRIEND WHERE ID = ? ';
		$result = $this->db1->query($query, array($simfriend_id));
		$result = $result->row();
		
		return $result->TRUST;
	}
	
	function simoleons($sim_friend_id)
	{
		//$this->db1 = $this->load->database('default', true);
        $query = 'SELECT sf.SIMOLEONS AS simoleons FROM SIM_FRIEND sf WHERE sf.ID = ? ';
		$result = $this->db1->query($query, array($sim_friend_id));
		
		if($result->num_rows > 0)
		{
			$result = $result->row();
			return  $result->simoleons;
		}
		else 
			return 0;
	}
	
	function sim_name($sim_id)
	{

       
        //$this->db1 = $this->load->database('default', true);

        $query = ' SELECT FIRST_NAME_ID, LAST_NAME_ID FROM SIM_FRIEND WHERE ID= ? ' ;
        
        $result = $this->db1->query($query, array($sim_id));
        
        $result_name_id = $result->row();

        return $this->get_fsim_name($result_name_id->FIRST_NAME_ID).' '.$this->get_lsim_name($result_name_id->LAST_NAME_ID);

	}
	
	function sim_first_name($sim_friend_id)
	{
		//$query = 'SELECT sn.NAME AS FirstName FROM SIM_FRIEND sf, SIM_NAME sn  WHERE sf.ID = '.$sim_friend_id .' AND sn.ID = sf.FIRST_NAME_ID';
        $query = 'SELECT sn.NAME AS FirstName FROM SIM_FRIEND sf, SIM_NAME sn  WHERE sf.ID = ? AND sn.ID = sf.FIRST_NAME_ID';
		$result = $this->db1->query($query, array($sim_friend_id));
		
		if($result->num_rows > 0)
		{
			$result = $result->row();
			return $result->FirstName;
		}
		else 
			return 'FirstName';
	}
	
	function sim_last_name($sim_friend_id)
	{
		$query = 'SELECT sn.NAME as LastName FROM SIM_FRIEND sf, SIM_NAME sn  WHERE sf.ID = ? AND sn.ID = sf.LAST_NAME_ID';
		$result = $this->db1->query($query, array($sim_friend_id));
		
		if($result->num_rows > 0)
		{
			$result = $result->row();
			return $result->LastName;
		}
		else 
			return 'LastName';
	}
	
	/*
	To get the Traits:
    * Go to SIM_FRIEND_TRAITS (1,*)
    * With this TRAIT_ID then go to the LIST_VALUE Table
    * And look up the TEXT_ENTRY_ID
    * With the TEXT_ENTRY_ID go to LOCALIZED_TEXT and get the entry
	*/
	function get_traits($simfriend_id)
	{
		//$this->db1 = $this->load->database('default', true);
		$query = 'SELECT LT.TEXT FROM LOCALIZED_TEXT AS LT, LIST_VALUE AS LV, SIM_FRIEND_TRAITS AS SFT WHERE LT.TEXT_ENTRY_ID = LV.TEXT_ENTRY_ID AND LT.LANGUAGE_ID = 1 AND LV.ID = SFT.TRAIT_ID AND SFT.SIM_FRIEND_ID = ? ';
		$result_traits = $this->db1->query($query, array($simfriend_id));
		$result_traits = $result_traits->result();
		$traits = array();
		foreach($result_traits as $trait)
			$traits[] = $trait->TEXT;
		return implode(", ", $traits);
	}
	
	/*
	To get the Skills:
    * Go to SIM_FRIEND_SKILLS (1,*)
    * With this SKILL_ID then go to the LIST_VALUE Table
    * And look up the TEXT_ENTRY_ID
    * With the TEXT_ENTRY_ID go to LOCALIZED_TEXT and get the entry
	*/
	function get_skills($simfriend_id, $with_level = false, $language_id = 1)
	{
		//$this->db1 = $this->load->database('default', true);
		$query = 'SELECT LT.TEXT, SFS.VALUE FROM LOCALIZED_TEXT AS LT, LIST_VALUE AS LV, SIM_FRIEND_SKILLS AS SFS WHERE LT.TEXT_ENTRY_ID = LV.TEXT_ENTRY_ID AND LT.LANGUAGE_ID = '.$language_id.' AND LV.ID = SFS.SKILL_ID AND SFS.SIM_FRIEND_ID = '.$simfriend_id;
		$result_skills = $this->db1->query($query);
		$result_skills = $result_skills->result();
		$skills = array();
		foreach($result_skills as $skill)
		{
			if($with_level)
				$skills[] = $skill->TEXT . " (level = " . $skill->VALUE .")";
			else
				$skills[] = $skill->TEXT;
		}
		return implode(", ", $skills);
	}
	
	function personality($sim_friend_id)
	{
		return 'a quam id, metus egestas, sagittis., arius vitae, vehicula et, lorem.';
	}
	
	function favorite_activity($sim_friend_id)
	{
		return 'Suspendisse elementum turpis quis nibh. Integer. ';
	}
	
	function aspiration($sim_friend_id)
	{
		return 'Aenean nibh eros.';
	}
	
	function sim_image($sim_friend_id, $mood_id = 2660)
	{
		/*
		//for local testing, as the portrait mood in not present locally at the moment
		if($GLOBALS['application_state'] == "localhost")
			$mood_id = 1595;
		*/
		
		return image_link('char_image.png');
		if(file_exists(image_link($sim_friend_id.'_'.$mood_id.'.png')))
		{
			return image_link($sim_friend_id.'_'.$mood_id.'.png');
		}
		
		$query = 'SELECT pic.RAW_IMAGE_DATA AS image FROM SIM_FRIEND sf, PICTURE pic WHERE sf.ID = '.$sim_friend_id.' AND pic.PICTURE_SET_ID = sf.PICTURE_SET_ID AND pic.MOOD_ID = '.$mood_id;
		$result = $this->db1->query($query);
		$result = $result->row();
		$image = base64_encode($result->image);
		//header('Content-Length: '.strlen($data));
        //header("Content-type: image/png");
		if ($image !== false) 
		{
 			header('Content-Type: image/png');
    		imagepng($image,image_link($sim_friend_id.'_'.$mood_id.'.png'));
    		imagedestroy($image);
    		return image_link($sim_friend_id.'_'.$mood_id.'.png');
		}
		else 
		{
    		return image_link('char_image.png');
		}
		
	}
	
	function get_achievement($player_id, $language_id)
	{
        $user_id = $this->get_user_id($player_id);
		//$this->db1 = $this->load->database('default', true);
        $query = 'SELECT lt.TEXT AS AchievementText, (NOT ua.ID IS NULL ) AS Achieved FROM ACHIEVEMENTS ach LEFT JOIN USER_ACHIEVEMENTS ua ON ua.USER_ID = '.$user_id.' AND ua.ACHIEVEMENT_ID = ach.ID, LOCALIZED_TEXT lt WHERE lt.TEXT_ENTRY_ID = ach.EMAIL_TEXT_ID AND lt.LANGUAGE_ID = '.$language_id.' AND ach.INACTIVE = 0  ORDER BY ach.ACHIEVEMENT_TYPE, ach.VALUE_NEEDED, ach.ID';
	
		$result = $this->db1->query($query);
		
		if($result->num_rows > 0)
		{
			$result = $result->result();
			return $result;
		}
		else 
			return '';
	}
	
	function get_achievement_counter($data)
	{
		$counter = 0;
		for($i = 0; $i < count($data); $i++)
		{
			if($data[$i]->Achieved != 0)
				$counter++;
		}
		return $counter;
	}
	
	function get_sim_friend($player_id)
	{
		//$this->db1 = $this->load->database('default', true);
        $query = 'SELECT * FROM USER u, SIM_FRIEND sf WHERE u.PLAYER_ID = ? AND sf.USER_ID = u.ID AND (sf.STATUS = 0 OR sf.STATUS = 1)';
		$result = $this->db1->query($query, array($player_id));
		$result = $result->result();
		return $result;
	}
	
	function change_email($player_id, $new_email)
	{
		// update into web interface
		/*$query = 'UPDATE USER_info SET email = "'.$new_email.'" WHERE id = '.$player_id;
		$this->db2->query($query);*/
		
		// update in back end
		//$this->db1 = $this->load->database('default', true);
        $query = 'INSERT INTO USER_CHANGE (PLAYER_ID, EMAIL) VALUES ('.$player_id.' , "'.$new_email.'")';
		$this->db1->query($query);
	}
	
	function get_sim_friend_id($player_id)
	{
		$this->db1 = $this->load->database('default', true);
        $query = 'SELECT sf.ID as ID FROM SIM_FRIEND sf, USER u WHERE u.PLAYER_ID = ? AND sf.USER_ID = u.ID AND (STATUS = 1 or STATUS=99)';
		$result = $this->db1->query($query, array($player_id));
		$result = $result->row();
		return $result->ID;

	}
    
    function get_sim_user_id($user_id)
    {

        //$this->db1 = $this->load->database('default', true);
        $query = 'SELECT ID as id FROM USER WHERE PLAYER_ID = ? ';
        
		$result = $this->db1->query($query, array($user_id));
        $row_info = $result->row();
        
        return $row_info->id;

    }

	function get_fsim_name($id)
    {
       //$this->db1 = $this->load->database('default', true);
        //$query = ' SELECT NAME AS first_name FROM SIM_NAME WHERE ID='.$id;
        $query = ' SELECT NAME AS first_name FROM SIM_NAME WHERE ID= ? ';
        $result = $this->db1->query($query , array($id));
        $result_last_name = $result->row();

        return $result_last_name->first_name;

    }

    function get_lsim_name($id)
    {
       //$this->db1 = $this->load->database('default', true);
       $query = ' SELECT NAME AS last_name FROM SIM_NAME WHERE ID= ? ';
        $result = $this->db1->query($query, array($id));
        $result_last_name = $result->row();
        
        return $result_last_name->last_name;

    }
    
    function get_user_setting($player_id)
    {
       //$this->db2 = $this->load->database('web', true);
       $query = "SELECT email_format, time_zone, email_time, email_freq  FROM user_info WHERE id =  ? ";
       $result12 = $this->db2->query($query, array($player_id));
       $result = $result12->row();

       return $result;
    }

    function update_user_settings($data)
    {
       //$this->db2 = $this->load->database('web', true);
       $sep_tim_id = explode(',', $data['timezone']);
       //$query = "Update user_info set email_format = ". $data['email_format'].", time_zone = " . $sep_tim_id[1] . " , email_time = "  . $data['email_time'] . ", email_freq = " . $data['email_freq']. "  WHERE id = '".$data['player_id']."'";
       $query = "Update user_info set email_format = ? , time_zone = ?  , email_time = ? , email_freq = ?   WHERE id = ? ";
       $this->db2->query($query, array($data['email_format'], $sep_tim_id[1], $data['email_time'], $data['email_freq'],  $data['player_id'] ));
       
    }


    // For stop button in My_status

    /*function stop_email($data)
    {
       $query = 'INSERT INTO USER_CHANGE (PLAYER_ID, USER_STATUS) VALUES ('.$data['player_id'].', 1)';
       $this->db1->query($query);

       $query = 'Update user_info set email_freq = -1 where id = '. $data['player_id'] ;
       $this->db2->query($query);

    }*/

     function stop_email($data)
    {
       //$this->db = $this->load->database('default', true);
       $user_created_time = $this->get_create_time($data['player_id']);
       $query = 'INSERT INTO USER_CHANGE (PLAYER_ID, CREATED, USER_STATUS) VALUES ( ?  , ? , 1)';
       $this->db1->query($query, array($data['player_id'], $user_created_time ));

       //$this->db1 = $this->load->database('web', true);
       $query = 'Update user_info set email_freq = -1 where id = '. $data['player_id'] ;
       $this->db2->query($query);


    }



    function get_single_pic($sim_id)
    {

        //$this->db1 = $this->load->database('default', true);
        $query = ' SELECT PICTURE_SET_ID FROM SIM_FRIEND WHERE ID= ? ' ;
        $result = $this->db1->query($query, array($sim_id));
        $sim_pic_id = $result->row();
        return $sim_pic_id->PICTURE_SET_ID;
    }


}
?>

