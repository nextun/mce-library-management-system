// JavaScript Document
function showFromTime()
{
	var from_year = parseInt(document.getElementById('from_year').value);
	var from_month = parseInt(document.getElementById('from_month').value);
	var from_day = parseInt(document.getElementById('from_day').value);
	var option = '';
	
	if(isLeapYear(from_year) && from_month==2)
	{
		for(var day=1; day<=29; day++)
		{
		 	if(from_day==day)
			{
	 			option =option+'<option value="'+day+'" selected>'+day+'</option>';
	 		
			}
			else
			{
		 		option =option+'<option value="'+day+'">'+day+'</option>';
		 		
			}
		}
		
        $('#from_day').html(option);
	}
	else if(!isLeapYear(from_year) && from_month==2)
	{
		for(var day=1; day<=28; day++)
		{
		 	if(from_day==day)
			{
	 			option =option+'<option value="'+day+'" selected>'+day+'</option>';
	 		
			}
			else
			{
		 		option =option+'<option value="'+day+'">'+day+'</option>';
		 		
			}
		}
		
        $('#from_day').html(option);
	}
	else
	{	
		if((from_month%2)==0 && from_month!=8)
		{
			for(var day=1; day<=30; day++)
			{
				if(from_day==day)
				{
		 			option =option+'<option value="'+day+'" selected>'+day+'</option>';
		 		
				}
				else
				{
			 		option =option+'<option value="'+day+'">'+day+'</option>';
			 		
				}
			}
			
            $('#from_day').html(option);
		}
		else
		{
			for(var day=1; day<=31; day++)
			{
				if(from_day==day)
				{
		 			option =option+'<option value="'+day+'" selected>'+day+'</option>';
		 		
				}
				else
				{
			 		option =option+'<option value="'+day+'">'+day+'</option>';
			 		
				}
			}
			
            $('#from_day').html(option);
		}
	
	}
}

function isLeapYear(year)
{
	
	datea = parseInt(year);

	if(datea%4 == 0)
	{
		if(datea%100 != 0)
		{
			return true;
		}
		else
		{
			if(datea%400 == 0)
				return true;
			else
				return false;
		}
	}
	return false;


}

function init(day_pre, month_pre, year_pre)
{
	// setting day:
    var currentTime = new Date();
    var year = currentTime.getFullYear()-7;
    
	var i =0;
    var month_name = Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep','Oct', 'Nov','Dec');
	var option = '<option value ="0">Day</option>';
	
	for (i=1; i<=31; i++)
	{
        if(parseInt(day_pre) < 0)
        {
            if(i == 1)
            {
                option =option+'<option value ="'+ i+'" selected >'+i+'</option>';
            }
            else
            {
                option =option+'<option value ="'+ i+'">'+i+'</option>';
            }
        }
        else
        {
            if(i == parseInt(day_pre))
            {
                option =option+'<option value ="'+ i+'" selected >'+i+'</option>';
            }
            else
            {
                option =option+'<option value ="'+ i+'">'+i+'</option>';
            }

        }
	}
    $('#from_day').html(option);
	
	
	
	// setting month
	option = '<option value ="0">Month</option>';
	for (i=1; i<=12; i++)
	{
        if(parseInt(month_pre) < 0)
        {
            if(i == 1)
            {
                option =option+'<option value ="'+ i+'" selected >'+month_name[i-1]+'</option>';
            }
            else
            {
                option =option+'<option value ="'+ i+'">'+month_name[i-1]+'</option>';
            }
        }
        else
        {

            if(i == parseInt(month_pre))
            {
                option =option+'<option value ="'+ i+'" selected >'+month_name[i-1]+'</option>';
            }
            else
            {
                option =option+'<option value ="'+ i+'">'+month_name[i-1]+'</option>';
            }

        }
	}
    $('#from_month').html(option);
   
	// setting year
	 option = '<option value ="0">Year</option>';
	for (i=parseInt(year); i>=1920; i--)
	{
        if(parseInt(year_pre) < 0)
        {
            if( i == 1996)
            {
                option =option+'<option value ="'+ i+'"  selected >'+i+'</option>';
            }
            else
            {
                option =option+'<option value ="'+ i+'">'+i+'</option>';
            }
        }
        else
        {
            if( i == parseInt(year_pre))
            {
                option =option+'<option value ="'+ i+'"  selected >'+i+'</option>';
            }
            else
            {
                option =option+'<option value ="'+ i+'">'+i+'</option>';
            }
        }
	}
    $('#from_year').html(option);
	
	
}

function setText(id, total, sim_id)
{
	document.getElementById('button'+id).value = 'selected';
	document.getElementById('button'+id).className = 'btn green disabled';//https://svn.devjavu.com/trippert/f8apps/simsfriends
    document.getElementById('class'+id).className = 'simprofile png selected';
	// set hidden field which sim is selected
	document.getElementById('hidden_sim_friend').value = sim_id;
	var i =0;
	for(i=0; i < total; i++)
	{
		if(i != id)
		{
		document.getElementById('button'+i).value = 'select';
        document.getElementById('class'+i).className = 'simprofile png';
		document.getElementById('button'+i).className = 'btn green';
		}
	}
	return false;
}

function check_email_validation(str)
{
	var at="@"
	var dot="."
	var lat=str.indexOf(at)
	var lstr=str.length
	var ldot=str.indexOf(dot)
	if (str.indexOf(at)==-1){
	   alert("Invalid E-mail ID")
	   return false
	}

	if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
	   alert("Invalid E-mail ID")
	   return false
	}

	if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		alert("Invalid E-mail ID")
		return false
	}

	 if (str.indexOf(at,(lat+1))!=-1){
		alert("Invalid E-mail ID")
		return false
	 }

	 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		alert("Invalid E-mail ID")
		return false
	 }

	 if (str.indexOf(dot,(lat+2))==-1){
		alert("Invalid E-mail ID")
		return false
	 }
	
	 if (str.indexOf(" ")!=-1){
		alert("Invalid E-mail ID")
		return false
	 }

	 return true					


}
// check form in registration step 1
function checkForm(image_link)
{
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var pattern = /[^a-zA-Z -]/;
     
     if(first_name == '' || last_name == '' || first_name == ' ' || last_name == ' ')
     {
        jAlertMod('<div id="popup" class="png" style="padding-top:28px"><div class="marginer"><h2>Information missing</h2><p>Please enter your First and Last name to continue</p></div></div>', 'Information Missing', function(r) {},"Okay");
        return false;
     }
     if(first_name.length > 45 || last_name.length > 45 )
     {
         jAlertMod('<div id="popup" class="png" style="padding-top:28px"><div class="marginer"><h2>Invalid input</h2><p>Your entered name is too long</p></div></div>', 'Information Missing', function(r) {},"Okay");
         return false;
     }
     if(pattern.test(first_name) || pattern.test(last_name))
     {
         jAlertMod('<div id="popup" class="png" style="padding-top:28px"><div class="marginer"><h2>Invalid input</h2><p>Name can only consist of the following characters : A-Z, a-z, - and a single-space</p></div></div>', 'Information Missing', function(r) {},"Okay");
         return false;
     }
     var space_counter = 0;
     for(var j=0; j<first_name.length; j++)
     {
        var characters = first_name.charAt(j);
		var key_code = characters.charCodeAt(0);
		if(key_code == 32)
            space_counter++;
     }
     if(space_counter > 1)
     {
         jAlertMod('<div id="popup" class="png" style="padding-top:28px"><div class="marginer"><h2>Invalid input</h2><p>You cannot use more than one space in your name</p></div></div>', 'Information Missing', function(r) {},"Okay");
         return false;
     }
     space_counter = 0;
     for(var k=0; k<last_name.length; k++)
     {
        var characterss = last_name.charAt(k);
		var key_codes = characterss.charCodeAt(0);
		if(key_codes == 32)
            space_counter++;
     }
     if(space_counter > 1)
     {
         jAlertMod('<div id="popup" class="png" style="padding-top:28px"><div class="marginer"><h2>Invalid input</h2><p>You cannot use more than one space in your name</p></div></div>', 'Information Missing', function(r) {},"Okay");
         return false;
     } 
	 if(check_age_validation()==true )
	 {
        


        // set initial data
		var first_name_form = $('#first_name').val();
		var last_name_form = document.getElementById('last_name').value;


        var from_month_form = parseInt($('#from_month').val());
        var from_day_form = parseInt($('#from_day').val());
        var from_year_form = parseInt($('#from_year').val());
    
        var gender_form = parseInt(get_gender_value());
		
		document.getElementById('reg_next').style.display = 'none';
        document.getElementById('content').innerHTML = '<div style="padding-top:64px; height:95px; text-align:center;"><img src="'+image_link+'" /></div>';
        $.post(base_server_url+"home/registration", { first_name:first_name_form, last_name:last_name_form, from_year:from_year_form, from_month:from_month_form, from_day:from_day_form, gender:gender_form},
			   function(data)
			   {																																																																																																																																		
                        if(data == 0)
						{
							document.location = base_server_url+'home/reg_error'	;
						}
						else
						{
							//setInterval('check_sim_ready()',1000);
                            //setTimeout('check_sim_ready()',1000);
                            check_sim_ready();
						}
			   
			   });
	 }
}


        function get_gender_value()
        {
            gender_form = -1;
            for (var i=0; i < document.first_register.gender.length; i++)
            {
                if (document.first_register.gender[i].checked)
                {
                    var gender_form = document.first_register.gender[i].value;
                }
            }

            return gender_form;
        }


function check_sim_ready(){
								
$.post(base_server_url+'home/check_sim_ready', function(data){
					if(data ==1)
					{
                        document.location = base_server_url+'home/register_next';
					}
                    else if(data ==0)
                    {
                        document.location = base_server_url+'start/check_login_step/1';
                    }
				  });	

}

function change_password(email, url)
{
	
	document.getElementById('change_password').innerHTML = '<form class="change_pwd" action="' + url +'" method="POST" onsubmit="return check_option_form_password()"><div class="clr"><label>'+option_change_sim_po+'</label> <input type="password" name="old_password"/></div><div class="clr"><label>'+option_change_sim_pn+'</label> <input type="password" name="new_password" id="new_password"/></div><div class="clr"><label>'+option_change_sim_cp+'</label> <input type="password" name="confirm_password" id="confirm_password"/></div><div class="clr"></div><div class="alignright_wraper"><button type="submit" class="btn wide change_password">'+option_change_sim_change_password+'</button></div></form>';
	document.getElementById('change_email').innerHTML = option_query_1+'<span class="alignright"><strong>'+ email+'</strong></span>';
	document.location = '#change_password';
}

// to check password in option page
function check_option_form_password()
{
	//new password
	pass = document.getElementById('new_password').value;
	re_pass = document.getElementById('confirm_password').value;
	
	if(pass != re_pass)
	{
		alert('Password Mismatch');
		document.getElementById('confirm_password').focus();
		return false;
	}
	return true;
}

function change_email(email, url)
{
    
    $('#cancel_email').css("display","block");
    $('#change_email_link').css("display","none");
	$('#change_email').html(option_query_1+' <form id="email_form" class="change_email" action="'+url+'" method="POST" onsubmit="return check_option_form_email()"><label> '+option_email+' </label><div class="radiogroup"><div><input type="radio" class="radio" name="email_radio" checked="checked" />'+ email+'</div><div><input type="radio" name="email_radio" class="radio" /><input type="text" value="'+option_change_ne+'" name="new_email" id="new_email" enabled="true" onclick="empty();"  /></div></div><div class="clr"></div><div class="alignright_wraper"><button type="submit" class="btn wide change_password">'+option_change_email+'</button></div></form>');
	window.location = '#change';
}

function cancel_email(email,lang)
{
    $('#change_email_link').css("display","block");
    $('#cancel_email').css("display","none");
    $('#change_email').html(lang+'<span class="alignright" id="email_pass" ><strong>'+email+'</strong></span>');
    $('#email_form').html('');
    
}

// to check new entered email
function check_option_form_email()
{
	// newly entered email
	email = document.getElementById('new_email').value;
	return check_email_validation(email);
}

function empty()
{
    document.getElementById('new_email').value = '';
}

// if old password is wrong
function show_password_error(email, url)
{
	alert('Old Password is wrong');
	
	document.getElementById('change_password').innerHTML = '<form class="change_pwd" action="'+ url +'" method="POST" onsubmit="return check_option_form_password()"><div class="clr"><label>'+option_change_sim_po +'</label> <input type="password" name="old_password"/></div><div class="clr"><label>'+option_change_sim_pn+'</label> <input type="password" name="new_password" id="new_password"/></div><div class="clr"><label>'+ option_change_sim_cp+'</label> <input type="password" name="confirm_password" id="confirm_password"/></div><div class="clr"></div><div class="alignright_wraper"><button type="submit" class="btn wide change_password">'+ option_change_sim_change_password+'</button></div></form>';
	document.getElementById('change_email').innerHTML = option_query_1+'<span class="alignright"><strong>'+ email+'</strong></span>';
	document.location = '#change_password';
}

function show_login_error()
{
	alert('Login Failed!!');
}

// set div width for avatar div
function set_char_width(sim_num)
{
	var width = 720* Math.ceil(parseInt(sim_num)/3);
    $('#slider_parent').css({'width' : width}); 
}

function check_sim_selected()
{
	var sim_id = document.getElementById('hidden_sim_friend').value;
	
	if(sim_id == 0)
	{
		jAlertMod('<div id="popup" class="png" style="padding-top:28px"><div class="marginer"><h2>No SimFriend Selected</h2><p>Please select a SimFriend to continue</p></div></div>', 'Information Missing', function(r) {},"Okay");
		return false;
	}
	else
		return true;
}

function change_sim_friend()
{
	var prev_sim_friend = $('#prev_sim_friend_id').val();
	var selected_sim_friend = $('#hidden_sim_friend').val();
	
	if(prev_sim_friend != selected_sim_friend)
		alert('changed');
	
}

function change_avatar()
{
	var sim_friend_id = $('#hidden_sim_friend').val();
	
	$.post(base_server_url+"home/change_avatar", {'sim_friend_id':sim_friend_id}, 
			   function(data)
			   {																																																																																																																																		
			   			if(data)
						{
							document.location = base_server_url+'home/option'	;
						}
						else
						{
							alert('error');
							document.location = base_server_url+'home/option'	;
						}
			   
			   });
	
}
function language_chng(set_lan)
{
   
    $.post(base_server_url+"start/set_lang",{'setlang':set_lan}, function(data){

        
        window.location.reload();
    });
}

function checkLogin(sign_url)
{
    var email = $('#email').val();
	var password = $('#password').val();
    $.post(base_server_url+"start/login",{'email':email, 'pass':password }, function(data){

         if(data == 0)
         {
            
                 jConfirm('<div id="popup" class="png"><div class="marginer"><h2>The information entered is not valid.</h2><p>Please try logging in again or create an account if you do not have one yet.</p></div></div>', 'Confirmation Dialog', function(r) {

                            // change upon confirmation
                            if(r)
                            {  
                                window.location = sign_url;
                            }
                            });
        }

        else
        {
           
            document.location = base_server_url+'start/check_login_step/';
        }

    });
}

function check_age_validation()
{
     var day_flag =0;
     var month_flag =0;
     
     var day_diff = 0;
     var mon_diff = 0;
     var year_diff = 0;
     
     var mon = parseInt($('#from_month').val());
     var day = parseInt($('#from_day').val());
     var year = parseInt($('#from_year').val());

     var curr_date = new Date();
     var to_date = parseInt(curr_date.getDate());
     var to_month = parseInt(curr_date.getMonth()+1);
     var to_year = parseInt(curr_date.getFullYear());


    // For Day difference
     if(year == 0)
     {
         jAlertMod('<div id="popup" class="png" style="padding-top:60px; margin-bottom:15px;"><div class="marginer"><p><strong>Your information does not meet the criteria required to play this game.</strong></p></div></div>', 'Information Missing', function(r) {},"Okay");
         return false;
     }
     else
     {
         if( to_date < day )
         {
             mon = mon + 1;
             day_diff = (to_date+30) - day;
         }
         else
         {
              day_diff = to_date - day;
         }

         // For Mon difference

         if( to_month< mon )
         {
             year = year + 1;
             mon_diff = (to_month+12) - mon;
         }
         else
         {
              mon_diff =  to_month - mon;
         }

        // For Year Difference

         year_diff = to_year - year;

         if(parseInt(year_diff) < 13)
         {
             jAlertMod('<div id="popup" class="png" style="padding-top:60px ; margin-bottom:15px;"><div class="marginer"><p><strong>Your information does not meet the criteria required to play this game.</strong></p></div></div>', 'Information Missing', function(r) {},"Okay");
             return false;
         }
         else
            return true;
     }
    
}

    function invisible_save()
     {
         setTimeout("eliminate_save()", 2000);
     }

     function eliminate_save()
     {
         $('#saved').css("display","none");
     }


