                <?php echo css_link("jquery.alerts.css");?>
                <h2 class="tagline pngfix png" style="text-transform:none;font-size:20px;padding-left:18px;padding-top:120px;"><?php echo lang('home_query_1');?></h2>
				<div class="loginbox">
					<div class="head png"></div>
					<div class="tile png autoheight">
						<h3><?php echo lang('home_query_2');?></h3>
						<form method="post" action="<?php echo url_link('start/login');?>" onsubmit="checkLogin('<?php echo sign_up_url(); ?>'); return false;"  >
							<div class="clr"><label><?php echo lang('home_email');?></label><input type="text" name="email" id="email" autocomplete="off"/></div>
							<div class="clr"><label><?php echo lang('home_password');?></label><input type="password" name="password" id="password" autocomplete="off"/></div>
							<a href="<?php echo forgot_password_url(); ?>" class="forgot_pwd"><?php echo lang('home_forgot_password');?></a>
							<input type="submit" value="<?php echo lang('home_login');?>" class="btn png" />
                            
							<div class="clr"></div>
						</form>
					</div>
					<div class="foot png"></div>
				</div><!-- loginbox -->
				<div class="clr"></div>
				<!-- text start -->
                <div class="marginer">
                <div id="insider">
                    <div class="insiderhead png"></div>
                    <div class="insidertile png">
                        <img src="<?php echo image_link('simfriend.png');?>" class="mainimage png" alt="SimFriend"  />
                        <div class="introtxt">
                            <input onclick="document.location='<?php echo url_link('home/index');?>'" type="button" class="btn wide start_playing png" value="<?php echo lang('home_start_playing');?>" />
                            <p><?php echo lang('home_general_message_1');?></p>
                            <p><?php echo lang('home_general_message_2');?></p>
                            <p><?php echo lang('home_general_message_3');?></p>
                        </div>
                        <div class="clr"></div>
                    </div><!-- insider tile -->
                    <div class="insiderfoot png"></div>
                </div><!-- insider -->
                </div><!-- marginer -->
                <!-- text end -->
				<?php echo js_link('jquery_ajax.js');?>
                <?php echo js_link("jquery.alerts.js");?>
				<?php echo js_link("datetime.js");?>
                 <?php  if($login_error == 1) { ?>
              <script>
                popup();
                function popup()
                {
                    jConfirm('<div id="popup" class="png"><div class="marginer"><h2>The information entered is not valid.</h2><p>Please try logging in again or create an account if you do not have one yet.</p></div></div>', 'Confirmation Dialog', function(r) {

					// change upon confirmation
					if(r)
					{
                          
						window.location = '<?php echo sign_up_url(); ?>';
					}
                    });
                }

               </script>
            <?php }?>

