				<h2 class="title png"><?php echo lang('option_title'); ?></h2>
				<a href="<?php echo url_link('start/logout');?>" class="already_registered"><?php echo lang('logged_logout');?></a>
				<div class="clr"></div>
				<!-- text start -->
				<div class="marginer charc"><div class="hr"></div></div>
				<div class="mystatus">
					<div class="head png"></div>
					<div class="tile_mystatus png">
						<ul class="status_nav">
							<li><a name="status" href="<?php echo url_link('home/my_status');?>#status"><span><?php echo lang('logged_my_status');?></span></a></li>
							<li><a name="achievement" href="<?php echo url_link('home/achievement');?>#achievement"><span><?php echo lang('logged_achievement');?></span></a></li>
							<li class="active"><a name="options" href="#options"><span><?php echo lang('logged_option');?></span></a></li>
							<li><a name="faq" href="<?php echo url_link('home/faq');?>#faq"><span><?php echo lang('logged_faq');?></span></a></li>
						</ul>
						<!-- char select -->
						<div class="character">
							<div class="head png"></div>
							<div class="chartile fix_height png">

								<p class="aligncenter"><img src="<?php echo $path;?><?php echo $sim_pic_info;?>.jpg" alt=""  width="170" class="png" /></p>
                                <ul style="margin-top: 15px;" class="stat_character" >
									<li><label>Name:</label><span><?php echo $name;?></span></li>
									<li><label><?php echo lang('select_friend_traits');?>:</label><span><?php echo $this->Home_model->get_traits($sim_friend_id);?></span></li>
									<li><label><?php echo lang('select_friend_skills');?>:</label><span><?php echo $this->Home_model->get_skills($sim_friend_id);?></span></li>									
								</ul>
								<center>
                                    <input onclick="document.location='<?php echo url_link('home/option_avatar');?>'" type="button" value="<?php echo lang('option_change');?>" class="btn change margne_top" />
                                </center>
							</div>
							<div class="foot png"></div>
						</div>
						<!-- char select -->
						<div class="status_txt">
							<div class="status_note edit_settings">
								<div class="head png"></div>
                                <form action="<?php echo url_link('registration/option_last_reg_step/1#save');?>" method="POST">
								<div class="status_note_tile option_pwd png">
									<h4 class="lead"><?php echo lang('option_es');?></h4>
									<div class="section newopt">
										
										<div class="clr">
											<label><?php echo lang('option_tz');?></label>
									    <select name="timezone" id="timezone">
                                         

                                        </select>
										</div>
										<div class="clr">
											<label><?php echo lang('option_te');?></label>
											<select name="email_time" style="margin-top:33px;" >
												<option value="1" <?php if( $email_time == 1 ) {?> selected <?php } ?> selected >Morning (8:00am - 12:00pm)</option>
                                                <option value="2" <?php if( $email_time == 2 ) {?> selected <?php } ?> >Afternoon (12:00pm - 5:00pm)</option>
                                                <option value="3" <?php if( $email_time == 3 ) {?> selected <?php } ?> >Evening (5:00pm - 10:00pm)</option>
                                                <option value="5" <?php if( $email_time == 5 ) {?> selected <?php } ?> >Working Hours (08:00:am - 06:00pm)</option>
                                                <option value="4" <?php if( $email_time == 4 ) {?> selected <?php } ?> >All Day (12:00am - 11:59pm)</option>
											</select>
										</div>
									</div>
									<div class="section">
										<h5 class="lead2"><?php echo lang('option_ef');?></h5>
										<div class="radio"><input type="radio" name="email_freq" value="2" <?php if($email_freq == 2 ) {?> checked <?php } ?> checked="checked"   /><label><?php echo lang('option_ef_1');?></label></div>
										<div class="radio"><input type="radio" name="email_freq" value="4" <?php if($email_freq == 4 ) {?> checked <?php } ?>   /><label><?php echo lang('option_ef_2');?></label></div>
										<div class="radio"><input type="radio" name="email_freq" value="5" <?php if($email_freq == 5 ) {?> checked <?php } ?>   /><label><?php echo lang('option_ef_3');?></label></div>
                                        <?php if($GLOBALS['application_state'] != "production"): ?>
											<div class="radio"><input type="radio" name="email_freq" value="3" <?php if($email_freq == 3 ) {?> checked <?php } ?>   /><label><?php echo lang('option_ef_6');?></label></div>
										<?php endif; ?>
										<div class="radio"><input type="radio" name="email_freq" value="-1" <?php if($email_freq == -1 ) {?> checked <?php } ?>  /><label><strong><?php echo lang('option_ef_5');?></strong></label></div>
									</div>

                                    <div class="section">
										<h5 class="lead2"><?php echo lang('option_fe');?></h5>
										<div class="radio"><input type="radio" name="email_format" value="1" <?php if($email_format == 1 ) {?> checked <?php } ?> checked="checked"   /><label><?php echo lang('option_fe_1');?></label></div>
										<div class="radio"><input type="radio" name="email_format" value="2" <?php if($email_format == 2 ) {?> checked <?php } ?>   /><label><?php echo lang('option_fe_2');?></label></div>
										
									</div>

                                    <div id="saved" style="text-align:right; padding-right:45px; display:<?php if($save == 1){?>block<?php } else {?>none<?php } ?>"><strong><font style="font-size:12px">Saved...</font></strong></div>
                                    <p style="float: right;">
                                        
										<input name="save" type="submit"  class="btn change newregnext png" value="<?php echo lang('option_save');?>" />
									</p>

                                    <br><br><br>
									<?php /*
                                    <div class="section">
										<h5 class="lead2 nomargin"><?php echo lang('option_email');?><span class="alignright" id="change_email12" > <a href="javascript:cancel_email('<?php echo $user_email_password->email;?>','<?php echo lang('option_query_1');?>');" id="cancel_email" style="display:none;" >cancel</a> <a href="javascript:change_email('<?php echo $user_email_password->email;?>','<?php echo url_link('home/change_email');?>')"  style="display:block;" id="change_email_link"  >change</a></span></h5>
										<p class="small" tag="change" id="change_email"><?php echo lang('option_query_1');?> <span class="alignright" id="email_pass" style="display:block" ><strong><?php echo $user_email_password->email;?></strong></span></p>
									</div>
                                     */ ?>
                                    
									<div class="section">
										<h5 class="lead2 nomargin">Modify your EA Account login info: <span class="alignright"><a href=" <?php echo login_url();?> ">Edit Account</a></span></h5>
                                        <p class="small"><?php echo lang('option_query_1');?> </p>
									</div>
									
								</div>
                                </form>
								<div class="foot png"></div>
							</div>
						</div><!-- status txt -->
						<div class="clr"></div>
					</div>
					<div class="foot png"></div>
				</div><!-- my status -->
				<div class="clr"></div>
				<!-- text end -->
<script language="javascript">

// for language change in change email & password
var option_query_1 = '<?php echo lang('option_query_1');?>';
var option_email = '<?php echo lang('option_email');?>';
var option_change_ne = '<?php echo lang('option_change_ne');?>';
var option_change_email = '<?php echo lang('option_change_email');?>';
var option_login = '<?php echo lang('option_login');?>';

var option_change_sim_po = '<?php echo lang('option_change_sim_po');?>';
var option_change_sim_pn = '<?php echo lang('option_change_sim_pn');?>';
var option_change_sim_cp = '<?php echo lang('option_change_sim_cp');?>';
var option_change_sim_change_password = '<?php echo lang('option_change_sim_change_password');?>';

</script>