<?php
$server='localhost';
$username='root'; ///change the user name if user is not root
$password='rootbeer'; ///change the password if pass is not the same
$dbname='bulletinboard'; //change the dbname if it is not same u



$conn = mysql_connect($server,$username,$password);

mysql_select_db($dbname);


/// whatever u want to show just include it here the field name
$sql = "SELECT userid, filedata, filename FROM sigpic";

$result = @mysql_query($sql) or die(mysql_error());

echo "<table border=1>";

echo "<tr><th>imgid</th><th>imgtype</th><th>imgdata</th></tr>";
$i=0;
while ($rs=mysql_fetch_array($result)) {

echo "<tr><td>".$rs[0]."</td>";

$mydata = base64_encode($rs[1]);

$data1 = base64_decode($mydata);
$im = imagecreatefromstring($data1);
if ($im !== false) {
//header('Content-Type: image/png');
$image=$i.'.jpg';
imagejpeg($im, $image);
echo "<td><img src =".$image."></td>";
$i++;
}
else {
echo 'An error occurred.';
}

echo "<td>".$rs[2]."</td></tr>";

}; 
?>