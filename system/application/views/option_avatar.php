<?php  $this->load->model('Home_model'); ?>
<h2 class="title png">&nbsp;</h2>

<a href="<?php echo url_link('start/logout');?>" class="already_registered"><?php echo lang('logged_logout');?></a>

<div class="clr"></div>

<!-- text start -->

<div class="hr short shiftright"></div>

<div class="mystatus slider clr">

  <div class="head png"></div>

  <div class="tile_mystatus autoheight png">

    <ul class="status_nav">

      <li><a name="status" href="<?php echo url_link('home/my_status');?>#status"><span><?php echo lang('logged_my_status');?></span></a></li>

      <li><a name="achievement" href="<?php echo url_link('home/achievement');?>#achievement"><span><?php echo lang('logged_achievement');?></span></a></li>

      <li class="active"><a name="options" href="<?php echo url_link('home/option');?>#options"><span><?php echo lang('logged_option');?></span></a></li>

      <li><a name="faq" href="<?php echo url_link('home/faq');?>#faq"><span><?php echo lang('logged_faq');?></span></a></li>

    </ul>

    <div class="subcap"><?php echo lang('option_change_sim_1');?></div>

  </div>

</div>

<form action="<?php echo url_link('home/option');?>" method="POST" onsubmit="return false;">

<div id="slider" class="cutoff slider_wrapper">

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

			<div class="simprofile png  <?php  if($sim_friend[$i]->STATUS == 1) { ?> selected <?php  } ?>" id="class<?php echo $i;?>">

				<img src="<?php echo $path;?><?php echo $sim_friend[$i]->PICTURE_SET_ID;?>.jpg" alt="" width="129" height="165" class="avatar" />

				<ul>

                        <li class="twolines">

                          <label>Name:</label>

                          <span><?php echo $sim_name[$i]['sim_fname'].'&nbsp;'.$sim_name[$i]['sim_lname'];?></span></li>

                        <li class="twolines">

                          <label><?php echo lang('select_friend_traits');?>: </label>

                          <span><?php echo $this->Home_model->get_traits($sim_friend[$i]->ID);?></span></li>

                        <li class="twolines">

                          <label><?php echo lang('select_friend_skills');?>:</label>

                          <span> <?php echo $this->Home_model->get_skills($sim_friend[$i]->ID);?></span></li>

               	</ul>

				<div class="clr"></div>

				<?php  if($sim_friend[$i]->STATUS == 1) { ?>

				<input type="button" class="btn green disabled" value="<?php echo lang('select_friend_select');?> " id="button<?php echo $i;?>" onclick="setText(<?php echo $i;?>, <?php echo count($sim_friend);?>,<?php echo $sim_friend[$i]->ID;?>)"  ></input>

				 <script>

                                  set_selected(<?php echo $i?>);

                                  function set_selected(id)

                                  {

                                      document.getElementById('button'+id).value = 'selected';

                                  }

                             </script>

                    <?php   } else {?>

					<input type="button" class="btn green" value="<?php echo lang('select_friend_select');?> " id="button<?php echo $i;?>" onclick="setText(<?php echo $i;?>, <?php echo count($sim_friend);?>,<?php echo $sim_friend[$i]->ID;?>)" ></input>

					<?php }?>

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

<input type="hidden" name="hidden_sim_friend" id="hidden_sim_friend" value="<?php echo $_SESSION['sim_friend_id'];?>" />

<input type="hidden" id="counter" value="<?php echo $count;?>" />

<input type="hidden" id="prev_sim_friend_id" value="<?php echo $_SESSION['sim_friend_id'];?>" />

<div class="mystatus slider bottom clr">

  <div class="tile_mystatus autoheight png">

    <div class="alignright simprof"> <a href="javascript:history.go(-1)" class="cancel"><?php echo lang('option_change_sim_cancel');?></a>

	  <input type="submit" class="widenext png goleft" style="vertical-align:middle; margin-top:10px;" value="<?php echo lang('option_change_sim_done');?>" id="confirm_button" />

    </div>

  </div>

</form>  

  <div class="foot png"></div>

</div>

<!-- my status -->

<div class="clr"></div>

<!-- text end -->
<?php echo js_link("jquery_ajax.js");?>
<?php echo js_link("jquery.ui.draggable.js");?>
<?php echo js_link("jquery.alerts.js");?>
<?php echo css_link("jquery.alerts.css");?>
<?php echo js_link('jquery.scrollTo.js');?>
<?php echo js_link('jquery.serialScroll.js');?>
<?php echo js_link('jquery.localscroll.js');?>
<?php echo js_link('coda-slider.js');?>
<?php echo js_link("datetime.js");?>

<script type="text/javascript">
	$(document).ready( function() {
		$("#confirm_button").click( function() {
			// check whether sim friend changed!!
			var prev_sim_friend = $('#prev_sim_friend_id').val();
			var selected_sim_friend = $('#hidden_sim_friend').val();
			if(prev_sim_friend != selected_sim_friend)
			{		
				jConfirmMod('<div id="popup" class="png"><div class="marginer"><h2>Are you sure you want to change your SimFriend?</h2><p>You will not be able to contact your current SimFriend once you change friends</p></div></div>', 'Confirmation Dialog', function(r) {

					// change upon confirmation
					if(r)
					{
						change_avatar();
					}
				}, "Confirm", "Cancel");
			}
            else
            {
                document.location = base_server_url+'home/option'	;
                
            }
		});
	});
</script>