<?php 
/*
$database = "fruit";
$username = "root";
$password = "66007079";
@$mysql = mysql_pconnect($database,$username,$password) or trigger_error(mysql_error(),E_USER_ERROR);

define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASSWORD", "66007079");
define("DB_DATABASE", "fruit");
$link = mysqli_connect("DB_HOST","$DB_USER","DB_PASSWORD","DB_DATABASE") or die("error");
mys
if(mysqli_connect_errno()){
	echo "failed to connect".mysqli_connect_errno();
}else{
	echo "連線成功";
}
*/
$conn = mysqli_connect("127.0.0.1","root","66007079","fruit");

$dbname = "fruit";
?>
