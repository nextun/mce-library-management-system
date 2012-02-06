<?php
	class Test_model extends Model
	{
		function Test_model()
		{
			parent::Model();
			$CI = &get_instance();
			$this->image_path = $CI->config->item('base_url') .ADD.basename(APPPATH) .'/assets/images/';
			
		}
		
		function sim_image($sim_friend_id, $mood_id = 2660)
		{
			/*
			//for local testing, as the portrait mood in not present locally at the moment
			if($GLOBALS['application_state'] == "localhost")
				$mood_id = 1595;
			*/
			
			$query = 'SELECT pic.raw_image_data AS image FROM sim_friend sf, picture pic WHERE sf.id = '.$sim_friend_id.' AND pic.PICTURE_SET_ID = sf.PICTURE_SET_ID AND pic.MOOD_ID = '.$mood_id;
			$result = $this->db->query($query);
			$result = $result->row();
			
			$image = base64_encode($result->image);
			$image = base64_decode($image);
			$image = imagecreatefromstring($image);
			
			if ($image !== false) 
			{
	    		imagepng($image,$this->image_path.$sim_friend_id.'_'.$mood_id.'.png');
				return $this->image_path.$sim_friend_id.'_'.$mood_id.'.png';
			}
			else 
			{
	    		return image_link('char_image.png');
			}
		
		}
	}

?>