<?php $this->load->model('Home_model'); ?>
<?php echo css_link("jquery.alerts.css");?>
<h2 class="title png"><?php echo lang('select_friend_message_1');?></h2>
<a href="<?php echo url_link('start');?>" class="already_registered"><?php echo lang('select_friend_query1');?></a>
<div class="clr"></div>
<!-- text start -->
<form action="<?php echo url_link('home/sim_register');?>" method="POST" onsubmit="return check_sim_selected()" >
<div id="slider" class="slider_wrapper">
  <div class="in">
   <div style="width:60px; float:right;">
        <img class="scrollButtons left" src="<?php echo image_link('select_prev2.png');?>"/>

	<img class="scrollButtons right" src="<?php echo image_link('select_next2.png');?>"/>
    </div>
   <ul id="navigation1" class="navigation">
      <?php
					$count = ceil(count($sim_friend)/3);
					for($i = 1; $i <= $count; $i++)
					{
						if($i==1)
						{
				?>
      <li><a  class="slected" href="#asdf<?php echo $i;?>"> </a></li>
      <?php
						}
						else
						{
				?>
      <li><a  class="un_slected" href="#asdf<?php echo $i;?>"> </a></li>
      <?php
						}
					}

					?>
    </ul>


    <div class="slidertitle">Choose your friend. <br />
      Pick carefully - they're going to be counting on you!</div>
    <div class="scroll">
      <div id="slider_parent" class="scrollContainer char_wide">
        <?php  $j=0;
                   
                    for($i =0; $i < count($sim_friend); $i++)
                    {
                        if($i%3 == 0)
                        {
                            $j++;

            ?>
        <div class="panel" id="asdf<?php echo $j;?>" style="float: left; position: relative;">
          <?php }?>
          <div class="simprofile png" id="class<?php echo $i;?>"> <img src="<?php echo $path;?><?php echo $sim_friend[$i]->PICTURE_SET_ID;?>.jpg" alt="" width="129" height="165" class="avatar" />
            <ul>
              <li class="twolines">
                <label>Name:</label>
                <span><?php echo $sim_name[$i]['sim_fname'].'&nbsp;'.$sim_name[$i]['sim_lname'];?></span></li>
              <li class="twolines">
                <label><?php echo lang('select_friend_traits');?>:</label>
                <span> <?php echo $this->Home_model->get_traits($sim_friend[$i]->ID);?></span></li>
              <li class="twolines">
                <label><?php echo lang('select_friend_skills');?>:</label>
                <span> <?php echo $this->Home_model->get_skills($sim_friend[$i]->ID);?></span></li>
            </ul>
            <div class="clr"></div>
            <input type="button" class="btn green" value="<?php echo lang('select_friend_select');?> " id="button<?php echo $i;?>" onclick="setText(<?php echo $i;?>, <?php echo count($sim_friend);?>,<?php echo $sim_friend[$i]->ID;?>)" >
            </input>
          </div>
          <?php  if($i%3 == 2 || $i == count($sim_friend)-1)
                       {
                    ?>
        </div>
        <?php  } } ?>
      </div>
    </div>
  </div>
</div>
<div class="alignright simprof fix">
  <input type="button" onclick="window.location='<?php echo base_app_url(); ?>start/check_login_step/1'" class="btn tall_small png" style=" margin-bottom:9px; " value="<?php echo lang('select_friend_prev');?>" />
  &nbsp;
  <input type="submit" class="widenext png" value="<?php echo lang('select_friend_next');?>" />
 
  <input type="hidden" name="hidden_sim_friend" id="hidden_sim_friend" value="0" />
  <input type="hidden" id="counter" value="<?php echo $count;?>" />
  </form>
</div>
 <div class="hr" style="margin-left:15px;"></div>
<!-- text end -->
<?php echo js_link('jquery.scrollTo.js');?>
<?php echo js_link('jquery.serialScroll.js');?>
<?php echo js_link('jquery.localscroll.js');?>
<?php echo js_link('coda-slider.js');?>
<?php echo js_link("jquery.alerts.js");?>