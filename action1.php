<?php
header('Content-Type: application/json;charset=utf-8');

include("mysql.php");

$value=mysqli_real_escape_string($con,$_POST['value']);//get ajax data 'lv'
$jarray = array();//使用array儲存結果，再以json_encode一次回傳
if($value != ""){
       $sql = "SELECT * FROM dbhw_2 WHERE city_id='$value'";
	        $result = $con->query($sql);
		if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$jarray[] = $row;        
			}
		}else{}
}else{
        echo 0;
    return;
}
echo json_encode($jarray);
$con->close();
return;
?>
