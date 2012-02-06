<?php
	class Image_model extends Model
	{
		function Image_model()
		{
			parent::Model();
			$CI = &get_instance();
			$this->image_path = $CI->config->item('base_url') .ADD.basename(APPPATH) .'/assets/images/';
			
		}
		
		function sim_image($sim_info_id, $mood_id = 2662)
		{
            /*
			//for local testing, as the portrait mood in not present locally at the moment
			if($GLOBALS['application_state'] == "localhost")
				$mood_id = 1595;
			*/
			
			$query = 'SELECT pic.RAW_IMAGE_DATA AS image FROM SIM_FRIEND sf, PICTURE pic WHERE sf.ID = '.$sim_info_id.' AND pic.PICTURE_SET_ID = sf.PICTURE_SET_ID AND pic.MOOD_ID = '.$mood_id;
            $result = $this->db->query($query);
            $result = $result->row();
            return $result->image;
		}


        function get_pic_data($pic_info_id, $mood_id)
		{
            /*
			//for local testing, as the portrait mood in not present locally at the moment
			if($GLOBALS['application_state'] == "localhost")
				$mood_id = 1595;
			*/
            $this->db = $this->load->database('default', true);
			$query = 'SELECT RAW_IMAGE_DATA AS image FROM PICTURE pic WHERE PICTURE_SET_ID = '.$pic_info_id.' AND MOOD_ID = '.$mood_id;
            $result = $this->db->query($query);
            $result = $result->row();
            return $result->image;
		}


        function get_image_id($mod_id)
        {
            $this->db = $this->load->database('default', true);
            $query = 'SELECT PICTURE_SET_ID as pic_id from PICTURE where MOOD_ID = '.$mod_id;
            $result1 = $this->db->query($query);
            $result = $result1->result();
            return $result;
            
        }



	}
?>