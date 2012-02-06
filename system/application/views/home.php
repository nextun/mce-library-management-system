<html>
<head>
<title>:: MCE LIBRARY ::</title>
</head>
<body style="background-color:#FFA500;">
<h1><i>Muslim Community Edmonton Library Homepage</i></h1>
<table>
<tr>
<td>
    
<table width="500" height="300" border="0" style="background-color:#FFFFA5;">
<tr valign="top">
<td >   
<h2><i>News</i></h2>
<b><i>New books arrival</i></b>
</td></tr>
</table>

<table width="500" height="500" border="0" style="background-color:#FFFF13;">
<tr valign="top">
<td colspan="2" >   
<h2 ><i>Recommended Books</i></h2>
Based on mostly borrowed books recently<br />
<i><b>Hadith</b></i><br />
<i><b>Fiqh</b></i><br />
<i><b>Aqeedah</b></i><br />
</td>
<tr>
</table>

</td>

<td valign="top">
<table>    
<form action="index.php" method="post">
<tr><td><b>Find Books</b></td></tr>
<tr><td><input type="radio" name="keyword"/>Keyword </td>
<td><input type="radio" name="startword"/>Starting With</td></tr> 
<tr><td><input type="text" name="searchtopic"></td>
<!--<td><select>
  <option>Categories</option>
  <option>Hadith</option>
  <option>Fiqh</option>
  <option>Aqeedah</option>
  <option>Seerah</option>
  <option>History</option>
  <option>Family</option>
  <option>Women</option>
  <option>Mics.</option>
</select></td></tr> -->   
<tr><td><input type="submit" value="Search" name="search"></td></tr>
<?php
    if(isset($_REQUEST['search'])){
                
                echo "<br \>";
                if($_REQUEST['keyword'] != ""){
                    $flag='keyword';
                }else{$flag ='startword'; }   
                echo "<tr><td><a href='searchresult.php?key=".$_REQUEST['searchtopic']."&flag=".$flag."'>Check Search result</a></td></tr>";
					
    }
?>
</form>
</table>
&nbsp; &nbsp; &nbsp;
<form action="advancesearch.php" method="post">
<input type="submit" value="Advanced Search" name="advancesearch">   
</form>

<table>
<tr>    
<td><b><i>Already Registered?</i> Please login<b></td>
</tr>
<tr>
<td>
<form action="index.php" method="post">
<table>    
<tr><td>User Code</td><td><input type="text" size="30" name="usercode"></td></tr>
<tr><td>Password</td><td><input type="password" size="30" name="password"></td></tr>
<tr><td><input type="submit" value="Log in" name="login"></td></tr>
<?php
    if(isset($_REQUEST['login'])){
        $result=mysql_query("SELECT * FROM User WHERE User.User_code='".$_REQUEST['usercode']."' AND User.Password='".$_REQUEST['password']."'");
        $row=mysql_fetch_array($result);
        $usrid=$row['User_ID'];
        if($usrid != ""){
            $_SESSION['userid'] = $usrid;
        }else{
            echo "<tr><td>The user does not exist!</td></tr>";
            echo "<tr><td>Please try again!</td></tr>";
        }    
    }
?>

</table>    
</form>
</td>


<tr>
<td><b><i>New User?<a href="<?php echo base_url().'index.php/Register';?>">Please register</a></i></b></td>    
</tr>    
</table>

&nbsp; &nbsp; &nbsp;
<table>
<tr><td><b>Operating hour</b></td></tr>
<tr><td>Monday-Wednesday</td><td>:3:00 pm- 4:30 pm</td></tr>
<tr><td>Thursday</td><td>:3:00 pm-4:30 pm</td></tr>
<tr><td>Friday</td><td>:3:00 pm-4:30 pm</td></tr>
</table>    

&nbsp; &nbsp; &nbsp;
<table>
<tr><td><b>Community Survey</b></td></tr>
<tr><td>We always apprecaite our user's feedback</td></tr>
<tr><td>on our service. Please feel free to participate</td></tr>
<tr><td>in a communiity survey which helps us</td></tr>
<tr><td>to improve our service and library collections</td></tr>

<form action="survey.php" method="post">
<tr><td><input type="submit" value="Go to Survey" name="survey"></td></tr>
</table>

</td>
<td valign="top">
<?php
    if(isset($_SESSION['userid'])){
        echo "<a href='logout.php'>Log out</a>";
    }
?>
</td></tr>
<tr>
<td colspan="3" style="text-align:center;">Copyright © Muslim Community Edmonton 2011
</td>
</tr>
</table>
<!-- HTML comments -->
</body>
</html>