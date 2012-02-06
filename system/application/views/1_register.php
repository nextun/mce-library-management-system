<?php echo css_link("jquery.alerts.css");?>
            <h2 class="title png"><?php echo lang('1_register_general_message_1');?></h2>
				<a href="<?php echo url_link('start');?>" class="already_registered"><?php echo lang('1_register_query_1');?></a>
				<div class="regcontent">
                    <div class="clr"></div>
                    <div class="shrinked">
                        <form name="first_register" action="<?php echo url_link('home/registration');?>" method="POST" onsubmit="checkForm('<?php echo image_link('loading.gif');?>'); return false;" >
                            <div class="newreg">
								<div class="caption">
									<?php echo lang('1_register_general_message_2');?>
									<p><?php echo lang('1_register_general_message_3');?></p>
								</div>
                                <div class="head png"></div>
                                <div class="newregtile png" id="content">
                                    <div class="part">
                                        <div class="clr relative">
											<label><?php echo lang('1_register_email');?></label>
											<span class="confirmed_email">
												<?php echo $_SESSION['user_email'] ?>												
											</span>
											<div class="small_info"><?php echo lang('1_register_email_desc');?></div>											
                                        </div>
                                        <div class="clr"><label><?php echo lang('1_register_fn');?></label><input type="text" name="first_name" autocomplete="off" id="first_name" tabindex="5" value = "<?php if(isset($first_name)) { echo $first_name ;  }  ?>"/></div>
                                        <div class="clr shiftup"><label><?php echo lang('1_register_gender');?></label>
                                            <div class="radios">
                                                <div class="radio"><input type="radio" class="autowidth" value="0" name="gender"    <?php if(isset($gender)&& $gender == 0 ) { ?> checked <?php  }   ?>   checked="checked"  tabindex="7"/> <?php echo lang('1_register_male');?></div>
                                                <div class="radio"><input type="radio" class="autowidth" name="gender" value="1"  <?php if(isset($gender)&& $gender == 1 ) { ?> checked <?php  }   ?>  tabindex="8"/> <?php echo lang('1_register_female');?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="part">
                                        <div class="clr shiftdown"><label><?php echo lang('1_register_dob');?></label>
                                            <select id="from_month" onchange="showFromTime()" name="from_month" tabindex="2">
                                                <option>Month</option>
                                            </select>
                                            <select id="from_day" onchange="showFromTime()" name="from_day" tabindex="3">
                                                <option>Day</option>
                                            </select>
                                            <select id="from_year" onchange="showFromTime()" name="from_year" tabindex="4">
                                                <option>Year</option>
                                            </select>
                                        </div>
                                        <div class="clr"><label><?php echo lang('1_register_ln');?></label><input type="text" name="last_name" id="last_name" tabindex="6"  value = "<?php if(isset($last_name)) { echo $last_name ;  }  ?>" /></div>
                                    </div>
                                    <div class="clr"></div>
                                </div>
                                <div class="foot png"></div>
                            </div><!-- newreg -->
                            <p id="reg_next" class="alignright nomargin" style="display : block; margin-right: 20px;">
                                <input type="submit" tabindex="9" class="widenext newregnext png" value="<?php echo lang('1_register_next');?>" />
                            </p>
                            <div class="hr"></div>
                        </form>
                    </div>
                </div>
				<?php echo js_link("jquery.alerts.js");?>