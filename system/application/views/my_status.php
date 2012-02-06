                <h2 class="title png">
                <?php
                if(isset($first_time_login) && $first_time_login == 1){
                        echo lang('logged_greeting_1').$name.lang('logged_greeting_2');
                        }
                ?>&nbsp;
                </h2>
				<a href="<?php echo url_link('start/logout');?>" class="already_registered"><?php echo lang('logged_logout');?></a>
				<div class="clr"></div>
				<!-- text start -->
				<div class="marginer charc"><div class="hr"></div></div>
				<div class="mystatus">
					<div class="head png"></div>
					<div class="tile_mystatus png g_fix">
						<ul class="status_nav">
							<li class="active"><a name="status" href="#status"><span><?php echo lang('logged_my_status');?></span></a></li>
							<li><a name="achievement" href="<?php echo url_link('home/achievement');?>#achievement"><span><?php echo lang('logged_achievement');?></span></a></li>
							<li><a name="options" href="<?php echo url_link('home/option');?>#options"><span><?php echo lang('logged_option');?></span></a></li>
							<li><a name="faq" href="<?php echo url_link('home/faq');?>#faq"><span><?php echo lang('logged_faq');?></span></a></li>
						</ul>
						<!-- char select -->
						<div class="character">
							<div class="head png"></div>
							<div class="chartile fix_height png">

								<p class="aligncenter" style="padding-top: 10px;"><img src="<?php echo $path;?><?php echo $sim_pic_info;?>.jpg" alt=""  width="170" class="png" /></p>

								
								<ul style="margin-top: 15px;" class="stat_character" >
									<li><label>Name:</label><span><?php echo $name;?></span></li>
									<li><label><?php echo lang('select_friend_traits');?>:</label><span><?php echo $this->Home_model->get_traits($sim_friend_id);?></span></li>
									<li><label><?php echo lang('select_friend_skills');?>:</label><span><?php echo $this->Home_model->get_skills($sim_friend_id);?></span></li>									
								</ul>
							</div>
							<div class="foot png"></div>
						</div>
						<!-- char select -->
						<div class="status_txt ie_fix">
							<div class="status">
								<div class="title_txt"><?php echo lang('status_message_1');?> <em>See how your advice has helped your SimFriend.</em></div>
								<div class="status_box">
									<div class="stat_row">
										<div class="stat_top"></div>
										<div class="stat_middle">
											<div class="sm_txt stat_simuleons">
                                            	<label>Simoleons</label><span><?php echo $simoleons;?></span>
                                            	<em>See how your advice has helped your SimFriend.</em>
                                            </div>
											<div class="clr"></div>
										</div>
										<div class="stat_bottom"></div>
									</div>
								</div>
								<div class="status_box">
									<div class="stat_row">
										<div class="stat_top"></div>
										<div class="stat_middle">
                                        <div class="sm_txt stat_achievements">
											<label>Achievements</label><span><?php echo $achievement_point;?></span>
                                             <em>Click the Achievements tab to see what you and your SimFriend have accomplished together.</em>
                                            </div>
											<div class="clr"></div>
										</div>
										<div class="stat_bottom"></div>
									</div>
								</div>								
								<div class="status_box">
									<div class="stat_row">
										<div class="stat_top"></div>
										<div class="stat_middle">
                                        <div class="sm_txt stat_skillpoints">
											<label>Career</label><span><?php echo $career['career_path'];?></span>
                                            <em>Does your career advice help your SimFriend grab promotions?</em>
                                            </div>
											<?php if(isset($career['career_title'])): ?>
											<div class="stat_data_2"  style="width:407px; padding-left:10px; padding-top:5px;">
												<label style="line-height : 22px">Level (L<?php echo $career['career_level'];?>) : <?php echo $career['career_title'];?></label><span></span>
											</div>
											<?php endif; ?>
                                            
											<div class="clr"></div>
										</div>
										<div class="stat_bottom"></div>
									</div>
								</div>
								<div class="status_box">
									<div class="stat_row">
										<div class="stat_top"></div>
										<div class="stat_middle">
                                        <div class="sm_txt stat_joblevel">
											<label>Skill Points</label>
                                            <em>Has your SimFriend learned from you? The number of skill points tells you just how much.</em>
                                            </div>
										<table class="tbl_skill_points" border="0" style="clear:both;" cellspacing="0" cellpadding="0">
											<?php $skill_counter = 1; ?>
											<?php foreach($sim_skill_list as $from_skill_list): ?>
												<?php if($skill_counter % 2): ?><tr><?php endif; ?>
                                                <td width="150"><?php echo $from_skill_list[0]?></td>
                                                <td class="txt_dark" width="50"><?php echo $from_skill_list[1]?></td>
												<?php if(($skill_counter % 2) == 0): ?></tr><?php endif; ?>
												<?php $skill_counter++; ?>
                                            <?php endforeach; ?>
											<?php if(($skill_counter % 2) == 0): ?></tr><?php endif; ?>
										</table>
                                        <div class="clr"></div>
									</div>
									<div class="stat_bottom"></div>
								</div>
								</div>								
							</div><!-- status -->							
						</div><!-- status txt -->
						<div class="clr"></div>
						<div class="status_note small stat_ext_padd">
                            <div class="st_top png"></div>
                            <div class="status_note_tile stat autoheight">

                                 <?php   if($email_freq_chk <0 ) { ?>

                                <span class="float_left" >You have stopped all emails from your SimFriend. To receive emails again, go to Options tab and select a frequency of email.
                                </span>

                                <?php }  else { ?>
                                <div class="clr padd_bottom">
                                <span class="float_left"><?php echo lang('status_poke_1');?><?php echo $name;?><?php echo lang('status_poke_2');?></span>
                                <input name="poke" onclick="document.location='<?php echo url_link('home/email_options#poke');?>'" type="button" value="<?php echo lang('status_poke');?>" class="btn tall_small poke float_right" />
                                <div class="clr"></div>
                                </div>
                               

                                <div class="clr">
                                <span class="float_left" >Would you like to stop receiving emails from your<br />SimFriend?</span>
                                <input name="stop" onclick="document.location='<?php echo url_link('home/email_options/0#status');?>'" type="button" value="Stop" class="btn tall_small poke float_right" />
                                </div>
                                <?php  } ?>
                          </div>
                          <div class="st_foot"></div>
                        </div>
					</div>
					<div class="foot png"></div>
				</div><!-- my status -->
				<div class="clr"></div>
				<!-- text end -->