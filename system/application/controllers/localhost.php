<?php if($GLOBALS['application_state'] == "production") exit();

	class Localhost extends Controller
	{
		function Localhost()
		{
			parent::Controller();
		}

		function index($email)
		{
            $this->db1 = $this->load->database('default', true);
            $this->db2 = $this->load->database('web', true);
            $id = $this->get_user_id($email);
            
            if($id >= 0)
            {
                $response = $response = '<?xml version="1.0" encoding="UTF-8" ?>  <users><userUri>/users/'.$id.'/</userUri></users>';
            }
            else
            {
                $id = $this->get_max_id();
                $response = '<?xml version="1.0" encoding="UTF-8" ?>  <users><userUri>/users/'.$id.'/</userUri></users>';
            }
            echo $response;
            exit();

		}

		function get_user_id($email)
        {

            $query = "SELECT id FROM user_info WHERE email = '".$email."'" ;
            $result = $this->db2->query($query);
            $result_obj = $result->row();
            
            if($result->num_rows > 0)
                return $result_obj->id;
            else
                return -1;

        }

        function get_max_id()
        {

            $query = "SELECT max(id) as lar_id FROM user_info " ;
            $result = $this->db2->query($query);
            $result_obj = $result->row();

            if($result->num_rows > 0)
                return ($result_obj->lar_id +1);
            else
                return 1;

        }

	}
?>