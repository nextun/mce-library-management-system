<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SimFriend</title>
<?php echo css_link('reset.css');?>
<?php echo css_link('text.css');?>
<?php echo css_link('style.css');?>
<!--[if lte IE 8]>
<?php echo css_link('ie7.css');?>
<![endif]-->
<!--[if lte IE 6]>
<?php echo css_link('ie6.css');?>
<![endif]-->
<?php echo js_link('iepngfix_tilebg.js');?>
<?php echo js_link('datetime.js');?>
<?php echo js_link('jquery.js');?>
<?php echo js_link('timezone.js');?>
<link rel="shortcut icon" href="<?php echo image_link('favicon.ico');?>" />
<script language="javascript">
    var base_server_url = '<?php echo base_app_url();?>';
</script>
</head>
<body <?php if(isset($onload)){?>
                onload="<?php
                    {
                        if($onload == '1_register')
                        {
                            if(isset($back) && $back == 1)
                            {
                                echo "init(".$day.",".$month.",". $year.")";
                            }
                            else
                            {
                                $day = -1;
                                $month = -1;
                                $year = -1;
                                echo "init(".$day.",".$month.",". $year.")";
                            }
                        }
                        elseif($onload == '3_select_friend' || $onload == 'option_avatar')
                            echo "set_char_width(".count($sim_friend).")";
                        elseif($onload == '2_register')
                        {
                            echo "country_init()";
                        }
                        elseif($onload == 'option')
                        {
                            if($password_error)
                                echo "show_password_error('".$user_email_password->email."', '".url_link('home/change_password')."' )";
                            else
                            {  
                                if($time_zone == '')
                                  $time_zone = 6;
                                    echo "init_timezone(". $time_zone . "); ";
                                if($save == 1)
                                    echo "invisible_save();";
                                
                            }
                        }
                     }
                    ?>"
         <?php }?>
     >
    <div id="page">
        <div class="main_navi png">
            <div class="change_country">
            <?php /*if(isset($_SESSION['language']) && $_SESSION['language'] == 'french') :?>
                <a href="#english" onclick="language_chng('en');">English</a> <span>French</span>
            <?php else:?>
                <span>English</span> <a href="#french" onclick="language_chng('fr');">French</a>
            <?php endif; */?>
            </div>
        </div>
        <div class="main_content">
            <div class="bg">
                <div id="mid_content" class="midchome">
                    <div class="head png"></div>
                    <div class="tile png">
                        <?php echo  $main_layout_content ?>
                    </div><!-- tile -->
                    <div class="foot png"></div>
                </div><!-- mid content -->
                <?php echo  $this->load->view('elements/side_navigation') ?>
                <div class="clr"></div>
            </div><!-- bg -->
        </div><!-- main content -->
	<div class="main_footer png clr"></div>
	<div id="footer">
		<p>
			<a href="http://www.mysims.com/?sourceid=SimFriend"><img src="<?php echo image_link('footerlogo_mysims.png');?>" alt="MySims" /></a>
			<a href="http://www.simcity.com/?sourceid=SimFriend"><img src="<?php echo image_link('footerlogo_scs.png');?>" alt="SIMCITY" /></a>
			<a href="http://www.simanimals.com/us/?sourceid=SimFriend"><img src="<?php echo image_link('footerlogo_simanimals.png');?>" alt="SIMANIMALS" /></a>
			<a href="http://www.thesims2.com/?sourceid=SimFriend"><img src="<?php echo image_link('footerlogo_sims2.png');?>" alt="THE SIMS 2" /></a>
			<a href="http://www.simscarnival.com/?sourceid=SimFriend"><img src="<?php echo image_link('footerlogo_carnival.png');?>" alt="SIMS CARNIVAL" /></a>
		</p>
		<p>This site requires Flash 7   ©2009 Electronic Arts Inc. All rights reserved<br />
			<a href="http://www.ea.com/custom/legal-notices" target="_BLANK">Legal Notices</a> | <a href="http://legal.ea.com/legal/legal.jsp?language=en#" target="_BLANK">Terms of Service</a> | <a href="http://www.ea.com/custom/privacy-policy" target="_BLANK">Privacy Policy</a> | <a href="http://www.ea.com/custom/piracy-pop" target="_BLANK">Piracy</a> | <a href="http://help.thesims.com" target="_BLANK">FAQ</a>
		</p>
	</div>
    <a href="http://thesims3.ea.com/" target="_BLANK"><h1 class="png">The Sims 3</h1></a>
    </div>
</body>
</html>