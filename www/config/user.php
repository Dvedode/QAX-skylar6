<?php  
session_start();

//Check login
if(!isset($_SESSION['userid'])){  
    header("Location:http://git-core03.qianxin-inc.cn:8080/");  
    exit();  
}  

//login information
include('conn.php');  
$userid = $_SESSION['userid'];  //chenge
$username = $_SESSION['username'];   //Test#77@Skyeye
$user_query = mysql_query("select * from user_list where userid = '$userid' limit 1");  
$row = mysql_fetch_array($user_query);  

?>
