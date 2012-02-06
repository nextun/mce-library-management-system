<html>
<head>
<title>:: MCE LIBRARY ::</title>
</head>
<body style="background-color:#FFA500;">

<script type="text/javascript">

function check_data()
{
	
	ucode = document.getElementById("ucode").value;
	fname = document.getElementById("fname").value;
	lname = document.getElementById("lname").value;
	email = document.getElementById("email").value;
	pass = document.getElementById("pass").value;
	repass = document.getElementById("re_pass").value;
	res = validate_email(email);
	if(ucode == '' || fname == '' || lname == '' || email == '' || pass == '') 
	{
	    alert("You did not enter information in one or multiple fields during registration");
	}   
	else if(res ==  false)   
		alert("You have entered invalid email address");
	else if(pass != repass)
		alert("Password and Confirm password must be same");
	else if(isNumeric(phone))
		alert("Phone number must be a numeric value");	
	else
		document.forms["form1"].submit();	
}

function validate_email(email) {
 
   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   //var address = document.forms[form_id].elements[email].value;
   if(reg.test(email) == false) {
      return false;
   }
   else
	return true;
}
</script>

<h1><i>Muslim Community Edmonton Library Homepage</i></h1>
<table>
<tr><td></td>
<td>
<table width="500" height="600" border="0" style="background-color:#FFFFA5;">
<tr><td colspan="2">
<h2><i>Libray User Registration Page</i></h2>
</td></tr>
<form method="post" action="<?php echo url_link('Register/registration');?>" id="form1" >
<tr><td>User Code <font color = "red" >*</font> &nbsp; </td><td><input type="text" size="20" name="usercode" id="ucode"></td></tr>
<tr><td>First Name<font color = "red" >*</font> &nbsp; </td><td><input type="text" size="40" name="fname" id="fname"></td></tr>
<tr><td>Last Name<font color = "red" >*</font> &nbsp; </td><td><input type="text" size="40" name="lname" id="lname"></td></tr>
<tr><td>Address Line 1 </td><td><input type="text" size="50" name="address" id="address"></td></tr>
<tr><td>Email <font color = "red" >*</font>&nbsp;</td><td><input type="text" size="30" name="email" id="email"></td></tr>
<tr><td>Phone </td><td><input type="text" size="30" name="phone" id="phone"></td></tr>
<tr><td>Password<font color = "red" >*</font> &nbsp;</td><td><input type="password" size="30" name="password" id="pass"></td></tr>
<tr><td>Reconfirm Password <font color = "red" >*</font> &nbsp;</td><td><input type="password" size="30" name="re_password" id="re_pass"></td></tr>
<tr><td colspan="2"><font color = "red" >*</font> &nbsp;Password must contain at least eight alpha-numeric characters</td></tr>
<tr><td colspan="2" style="text-align:center"><input type="submit" value="Register" name="registeruser" id="user_registration" onclick=check_data();  ></td></tr>

<?php
       /* if($_REQUEST['registeruser'] != ""){
			// checking whether required field is empty 
			$tempusers = new users();	
			$tempusers->createUser( $_REQUEST['usercode'], $_REQUEST['password'], $_REQUEST['address'], $_REQUEST['fname'], $_REQUEST['lname'], $_REQUEST['email'], $_REQUEST['phone']);        
			echo "<tr><td colspan="."2".">Congratulations! You have successfully registered!</td></tr>";
			echo "<tr><td>Your user code is:".$_REQUEST['usercode']."</td></tr>";
			echo "<tr><td colspan="."2".">You need to enter the above user code and password to login later</td></tr>";
        }*/
?>

</form>
</table>
</td>
<td></td>
</tr>
<tr>
<td colspan="2" style="text-align:center;">Copyright © Muslim Community Edmonton 2011</td>
</tr>
</table>
<!-- HTML comments -->
</body>
</html>