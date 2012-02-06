				<h2 class="title png">&nbsp;</h2>
                <a href="<?php echo url_link('start/logout');?>" class="already_registered"><?php echo lang('logged_logout');?></a>
				<div class="clr"></div>
				<div class="marginer charc"><div class="hr"></div></div>
				<div class="mystatus">
					<div class="head png"></div>
					<div class="tile_mystatus autoheight png">
						<ul class="status_nav">
							<li><a name="status" href="<?php echo url_link('home/my_status');?>#status"><span><?php echo lang('logged_my_status');?></span></a></li>
							<li><a name="achievement" href="<?php echo url_link('home/achievement');?>#achievement"><span><?php echo lang('logged_achievement');?></span></a></li>
							<li><a name="options" href="<?php echo url_link('home/option');?>#options"><span><?php echo lang('logged_option');?></span></a></li>
							<li class="active"><a name="faq" href="#faq"><span><?php echo lang('logged_faq');?></span></a></li>
						</ul>
						<div class="pad">
						<div class="status faqlist">
							<div class="title_txt"><?php echo lang('faq_message_1');?></div>
							<ul class="faq">
								<?php for($i = 1; $i<= 22; $i++):?>
                                <li><div class="q"><?php echo lang('faq_query_'.$i);?></div>
									<?php echo lang('faq_ans_'.$i);?>
								</li>
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