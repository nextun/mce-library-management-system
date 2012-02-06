<?php if($GLOBALS['application_state'] == "production") exit();
	class Setup extends Controller
	{
		function Setup()
		{
			parent::Controller();
		}
		
		function index()
		{
		}
		
		function generate_simfriend_image()
		{
			$this->load->model('image_model');
			$this->load->config('sim/image_path');
        
			$image_path = APPPATH .'/assets/images/sim_image/';

         $this->db1 = $this->load->database('default', true);
         $mod_id = array(2662, 2660);
         for($j=0; $j<count($mod_id); $j++)
         {
            $all_image_info = $this->image_model->get_image_id($mod_id[$j]);

                for($i=0;$i<count($all_image_info); $i++)
                {
                    $File = $image_path."sim_".$mod_id[$j].'_'.$all_image_info[$i]->pic_id.".jpg";
                    if(!file_exists($File))
                    {

                        $data12 = $this->image_model->get_pic_data($all_image_info[$i]->pic_id, $mod_id[$j] );
                        header('Content-Length: '.strlen($data12));
                        header('Content-type: image/jpg') ;
                        $Handle = fopen($File, 'w+');
                        fwrite($Handle, $data12);
                        fclose($Handle);
                    }
                }
         }
          //$this->load->view('3_select_friend.php',$data);

           exit();
		}
		
		function generate_css_cache()
		{
			echo "Generating CSS Cache<br />";
			
			//get static content version
			$CI = & get_instance();
			$config = $CI->config->load('config');
			$static_content_version = $CI->config->item('static_version');
			echo "Generating CSS for version: $static_content_version<br />";
			
			//delete all cached css files
			$cache_dir = APPPATH . 'assets/css/cache/';
			echo "Cached CSS files directory: $cache_dir<br />";
			if (is_dir($cache_dir)) 
			{
				if ($cache_dir_handle = opendir($cache_dir)) 
				{
					while (($file = readdir($cache_dir_handle)) !== false) 
					{
						$full_file_path = $cache_dir . $file;
						if(is_file($full_file_path))
						{
							unlink($full_file_path);
							echo "Deleted old cached css file: $file<br />";
						}
					}
					closedir($cache_dir_handle);
				}
			}
			//if cache directory doesn't exist, then create it
			else 
			{
				echo "Cache directory: $cache_dir not found.<br />";
				mkdir($cache_dir);
				echo "Created cache directory: $cache_dir<br />";
			}
			
			//get all css files and loop through each
			$css_dir = APPPATH . 'assets/css/';
			echo "CSS directory: $css_dir<br />";
			if (is_dir($css_dir)) 
			{
				if ($css_dir_handle = opendir($css_dir)) 
				{
					while (($file = readdir($css_dir_handle)) !== false) 
					{
						$full_file_path = $css_dir . $file;
						if(is_file($full_file_path))
						{
							//get the contents of original css file
							$css = file_get_contents($full_file_path);
							//place absolute path to images
							$css = str_replace('../images/', $CI->config->item('base_url') . ADD . basename(APPPATH) . "/assets/images/", $css);
							//add the versioning number to end of images path
							$css = str_replace(".png)", ".png?v=$static_content_version)", $css);
							$css = str_replace(".jpg)", ".jpg?v=$static_content_version)", $css);
							//write the modified content to cached file
							$cached_filename = "v" . $static_content_version . "_" . $file;
							file_put_contents($cache_dir.$cached_filename, $css);
							echo "Generated cache for ". $cache_dir . $cached_filename . ":<br />";
						}
					}
					closedir($css_dir_handle);
				}
			}
			exit();
		}
		
	}
?>