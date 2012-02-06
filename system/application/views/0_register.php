<?php echo css_link("jquery.alerts.css");?>
            <h2 class="title png"><?php echo lang('0_register_general_message_1');?></h2>
			<div class="regcontent">
                <div class="clr"></div>
                <div class="shrinked">
                    <div class="newreg">
						<div class="caption"><?php echo lang('0_register_general_message_2');?></div>
                        <div class="head png"></div>
                        <div class="newregtile png nopadbtm">
                            <form action="<?php echo url_link('start/login/1');?>" method="POST" onsubmit="checkLogin('<?php echo sign_up_url(); ?>'); return false;" >
                                <div class="part bordered">
                                    <h4><?php echo lang('0_register_general_message_3');?></h4>
                                    <div class="clr"><label><?php echo lang('0_register_email');?></label><input type="text" name="email" id="email" autocomplete="off"/></div>
                                    <div class="clr"><label><?php echo lang('0_register_password');?></label><input type="password" name="password" id="password" autocomplete="off" id="password" /></div>
           							<div class="clr alignright forgotpwd">
                                        <a href="<?php echo forgot_password_url(); ?>" class="forgot_pwd"><?php echo lang('0_register_password_fp');?></a>
                                        <input type="submit" value="<?php echo lang('0_register_login');?>" class="btn png" />
                                    </div>
                                </div>
                            </form>
                            <div class="part">
                                <h4><?php echo lang('0_register_general_message_4');?></h4>
                                <p class="aligncenter"><strong><?php echo lang('0_register_click');?></strong></p>
                                <p class="aligncenter regbutton" style="margin-top: 60px;">
                                    <input onclick="window.location= '<?php echo sign_up_url(); ?>'" type="button" class="btn png" value="<?php echo lang('0_register_reg');?>" />
                                </p>
                            </div>
                            <div class="clr"></div>
                        </div>
                        <div class="foot png"></div>
                    </div><!-- newreg -->
                    <div class="clr"></div>
                </div>
            </div>
			<?php echo js_link("jquery.alerts.js");?>
            <?php   if($login_error == 1) { ?>

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



