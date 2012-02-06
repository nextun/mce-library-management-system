           <h2 class="title png"><?php echo lang('2_register_confirm');?></h2>
				<a href="<?php echo url_link('start');?>" class="already_registered"><?php echo lang('2_register_query1');?></a>
				<div class="clr"></div>
				<!-- text start -->
                <div class="marginer shrinked">
				<form action="<?php echo url_link('registration/option_last_reg_step');?>" method="POST">
				<div class="newreg full">
					<div class="caption">
						<?php echo lang('2_register_message_1');?>
					</div>
					<div class="head png"></div>
					<div class="newregtile png" style="width:750px">						
						<div class="clr"><label><?php echo lang('2_register_tz');?></label>
							<select name="timezone" id="timezone">
                                         <option value="-10,4" >(GMT -10:00 hours) Hawaii</option>
                                         <option value="-9,5" >(GMT -9:00 hours) Alaska</option>
                                         <option value="-8,6" selected="selected" >(GMT -8:00 hours) Pacific Time (US & Canada)</option>
                                         <option value="-7,7" >(GMT -7:00 hours) Mountain Time (US & Canada)</option>
                                         <option value="-6,8" >(GMT -6:00 hours) Central Time (US & Canada)</option>
                                         <option value="-5,10" >(GMT -5:00 hours) Eastern Time (US & Canada)</option>
                                    
                            </select>
                            
						</div>
						<div class="clr"><label><?php echo lang('2_register_te');?></label>
							<select class="autowidth" name="email_time">
                            
								<option value="1">Morning (8:00am - 12:00pm)</option>
                                <option value="2">Afternoon (12:00pm - 5:00pm)</option>
                                <option value="3">Evening (5:00pm - 10:00pm)</option>
                                <option value="5">Working Hours (08:00:am - 06:00pm)</option>
                                <option value="4"   selected >All Day (12:00am - 11:59pm)</option>
                                
							</select>
						</div>
						<div class="clr"><label><?php echo lang('2_register_ef');?></label>
							<div class="radiogroup">
								<div><input type="radio" class="autowidth autoheight" name="email_freq" value="2"/> <p><?php echo lang('2_register_ef_1');?></p></div>
								<div><input type="radio" class="autowidth autoheight" checked="checked" name="email_freq" value="4"/> <p><?php echo lang('2_register_ef_2');?></p></div>
								<div><input type="radio" class="autowidth autoheight" name="email_freq" value="5"/> <p><?php echo lang('2_register_ef_3');?></p></div>
                                <?php if($GLOBALS['application_state'] != "production"): ?>
                                <div><input type="radio" class="autowidth autoheight" name="email_freq" value="3"/> <p><?=lang('2_register_ef_4');?></p></div>
								<?php endif; ?>
                            </div>
						</div>
						<div class="clr">
							<label><?php echo lang('2_register_fe');?></label>
                       		<div class="radiogroup">										
                            <div><input type="radio" class="autowidth autoheight" name="email_format" value="1" checked="checked"   /><p><?php echo lang('2_register_fe_1');?></p></div>
                            <div><input type="radio" class="autowidth autoheight" name="email_format" value="2"   /> <p><?php echo lang('2_register_fe_2');?></p></div>

					    	</div>

                        </div>
						<div class="clr"></div>
					</div>
					<div class="foot png"></div>
				</div><!-- newreg -->
				<p class="alignright nomargin align_fix">
                    <input onclick="javascript:history.go(-1)" type="button"  class="btn tall_small png pushdown" value="<?php echo lang('2_register_prev');?>" />
                    &nbsp;
                    <input type="submit"  class="widenext newregnext png pushdown" value="<?php echo lang('2_register_next');?>" />
                </p>
                <input type="hidden" name="player_id" value="<?php echo $player_id;?>" />
                <input type="hidden" name="sim_friend_id" value="<?php echo $sim_friend_id;?>" />
                <input type="hidden" name="first_time_login" value="1" />
                </form>
			</div>
				<!-- text end -->