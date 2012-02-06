<?php
class Web_model extends Model
{
	function Web_model()
	{
		parent::Model();
		
		$CI = & get_instance();
		$this->db1 = $CI->db1;
		$this->db2 = $CI->db2;
		
		/*
		$this->db1 = $this->load->database('default', true);
		$this->db2 = $this->load->database('web', true);
		*/
		
		
		$this->load->helper('sim_link_helper');
	}
	
	function login($data)
	{

            
            $username = trim($data['email']);
            $pwd = $data['password'];


            if($GLOBALS['application_state'] == "localhost")
            {
                if($username != '' && $pwd !== '')
                    $valid_login = 1;
                else
                  $valid_login = 0;
            }

           /* if(preg_match("/@test.test\z/", $username) && $pwd == '1234' )
            {
                $split_email = explode('@', $username);
               
                if(count($split_email)== 2 && trim($split_email[0]) != '')
                {
                    $valid_login = 1;
                }
                else
                {
                    $valid_login = 0;
                }
            }*/
  

         
            else
            {
            //error_reporting(E_ALL);
			
				$this->load->config('sim/config');
				$nucleus_url = $this->config->item('nucleus_url');
				$nucleus_reqid = $this->config->item('nucleus_requestorid');
			
                $ch = curl_init();

		$encoded_pwd = urlencode($pwd);

                curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Nucleus-RequestorId: ".$nucleus_reqid));
                curl_setopt($ch, CURLOPT_URL, $nucleus_url."/1/users?email={$username}&password={$encoded_pwd}");
                $nucleus_resp = curl_exec($ch);

                /*
                if (strpos($data,"NO_SUCH_USER")!==false)
                    $valid_login = 0;
                else if(strpos($data,"INVALID_PASSWORD"))
                   $valid_login = 0;
                else if (strpos($data,"userUri")===false)
                    $valid_login = 0;
                else
                {
                    $valid_login = 1;
                    //$player_id = $parts[2];    // EA account ID
                }*/

                
                $req_info = curl_getinfo($ch);
                if ($nucleus_resp === false || $req_info['http_code'] != 200)
                {
                    $valid_login = 0;
                }
                else
                {
                    if (strpos($nucleus_resp,"userUri"))
                        $valid_login = 1;
                    else
                        $valid_login = 0;
                }
            }

        if($valid_login == 1)
        {
            if(!$this->is_exist_user(trim($data['email'])))    // Very begining user, Not regestered yet.
            {
                $this->login_initialize(trim($data['email']));
                $valid_login = 3;
                
                $_SESSION['registered'] = 1;
                return $valid_login;
            }
            else
            {
               $result =  $this->get_user_info(trim($data['email']));
               return $result;
            }
        }
        else
        {
            $valid_login = 0;
            return $valid_login;
        }
	}
	
	function get_user_email_password($user_id)
	{
		
        //$this->db2 = $this->load->database('default', true);
        $query = 'SELECT EMAIL as email FROM USER WHERE  PLAYER_ID = ? ';
		$result = $this->db1->query($query, array($user_id));
		$result = $result->row();
		
		return  $result;
	}
	
	function change_password($player_id, $password)
	{
		$query = 'UPDATE user_info SET password = "'.md5($password).'" WHERE id = '.$player_id;
		$this->db2->query($query);
	}
	
	function check_old_password($player_id, $old_password)
	{
		$query = 'SELECT id FROM user_info WHERE id = '.$player_id.' AND password = "'.md5($old_password).'"';
		
		$result = $this->db2->query($query);
		
		if($result->num_rows > 0)
			return 1;
		else 
			return 0;
		
	}
	
	function update_registration_step($player_id ,$registration_step)
	{
		$query = 'UPDATE user_info SET registration_step = ?  WHERE id = ? ';
		$this->db2->query($query, array($registration_step,$player_id));
	}

    function is_exist_user($email)
    {
        $query = "SELECT id FROM user_info WHERE email = ? " ;

		$result = $this->db2->query($query, array(trim($email)));

		if($result->num_rows > 0)
			return 1;
		else
			return 0;

    }

    function login_initialize($email)
	{
		// insert into web interface
       
		$query_web = 'INSERT INTO user_info (email, registration_step) VALUES( ? , 0)';
		$this->db2->query($query_web, array($email));
		$player_id = mysql_insert_id();
        //echo "Player id from user_info: ". $player_id;
        $_SESSION['init_player_id']  = $player_id;
		
	}

    function get_user_info($email)
    {
        //$query = 'SELECT id, registration_step, LAST_NAME, FIRST_NAME, date_of_birth FROM user_info WHERE email = "'.trim($email).'"';

        $query = 'SELECT id, registration_step, LAST_NAME, FIRST_NAME, date_of_birth FROM user_info WHERE email = ? ';

        $result12 = $this->db2->query($query, array(trim($email)));
        $result_obj = $result12->row();

        $result['id'] = $result_obj->id;
        $result['registration_step'] = $result_obj->registration_step;
        $result['last_name'] = $result_obj->LAST_NAME;
        $result['first_name'] = $result_obj->FIRST_NAME;
        $result['date_of_birth'] = $result_obj->date_of_birth;

        return  $result;
    }

    function get_user_registration_info($player_id)
    {
        //$this->db2 = $this->load->database('web', true);
        //$query = 'SELECT  LAST_NAME, FIRST_NAME, date_of_birth, gender FROM user_info WHERE id = "'.$player_id.'"';

        $query = 'SELECT  LAST_NAME, FIRST_NAME, date_of_birth, gender FROM user_info WHERE id = ? ';

        $result12 = $this->db2->query($query, array($player_id));
        $result_obj = $result12->row();
        
        return $result_obj;

    }

}

?>

