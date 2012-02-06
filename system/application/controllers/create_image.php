<?php
	class create_image extends Controller
	{
		function create_image()
		{
			parent::Controller();

          $this->load->model('image_model');
         // $data['login_error'] = 0;

		}

		function index()
		{
			$original = "{background: url(../images/mid_content_top-trans.png) top left;height: 20px}";
			$changed = preg_replace("/(url\(\.\.\/images\/)(\w+)\)/e", "'?ver=4'", $original);
			//$changed = preg_replace("/(url\(\.\.\/images\/)(\w+)\.(\w+)(\))/e", "'\\1' . '\\2' . '.' . '\\3' . '\?version=4)'", $original);
			echo $original . '<br />';
			echo $changed;
			exit();
		}

        function sim_image_all()
    {

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


	}
?>