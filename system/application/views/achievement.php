				<h2 class="title png"><?php echo lang('achievement_title'); ?></h2>
                <a href="<?php echo url_link('start/logout');?>" class="already_registered"><?php echo lang('logged_logout');?></a>
				<div class="clr"></div>
				<div class="marginer charc"><div class="hr"></div></div>
				<div class="mystatus clr">
					<div class="head png"></div>
					<div class="tile_mystatus autoheight png">
						<ul class="status_nav">
							<li><a name="status" href="<?php echo url_link('home/my_status');?>#status"><span><?php echo lang('logged_my_status');?></span></a></li>
							<li class="active"><a name="achievement" href="#achievement"><span><?php echo lang('logged_achievement');?></span></a></li>
							<li><a name="options" href="<?php echo url_link('home/option');?>#options"><span><?php echo lang('logged_option');?></span></a></li>
							<li><a name="faq" href="<?php echo url_link('home/faq');?>#faq"><span><?php echo lang('logged_faq');?></span></a></li>
						</ul>
						<div class="pad">
						<div class="status achievements">
							<div class="title_txt"><strong><?php echo lang('logged_achievement');?>:</strong> <?php echo lang('achievement_message_1');?> <?php echo $counter;?> <?php echo lang('achievement_message_2');?></div>
							<ul>
							<?php for($i=0; $i< count($achievement); $i++):
                                $title_detail = explode('-',$achievement[$i]->AchievementText);
                                $title = $title_detail[0];
                                $detail = $title_detail[1]; ?>
								<li <?php  if($achievement[$i]->Achieved !=0) echo 'class="selected"';?>><label><strong><?php echo $title;?></strong></label><small style="font-size:13px;"><?php echo $detail;?></small></li>
							<?php endfor;?>
							</ul>
						</div><!-- status -->
						</div>
						<div class="clr"></div>
					</div>
					<div class="foot png"></div>
				</div><!-- my status -->
				<div class="clr"></div>
				<!-- text end -->