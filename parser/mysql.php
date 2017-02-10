
<?php
//資料庫設定
//資料庫位置
$db_server = "localhost";
//資料庫名稱
$db_name = "funghi_db";
//資料庫管理者帳號
$db_user = "root";
//資料庫管理者密碼
$db_passwd = "1j4xu61j4fu4";

$con = new mysqli($db_server, $db_user, $db_passwd, $db_name);
if ($con->connect_error)
  {
  echo "Failed to connect to MySQL: " . $con->connect_error;
  }

//資料庫連線採UTF8

$con->query("SET NAMES utf8");
//mysqli_query($con,"SET CHARACTER SET UTF8");


?> 
