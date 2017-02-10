<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include('simple_html_dom.php');

$url1='http://db.cec.gov.tw/histQuery.jsp?voteCode=20141101Y1B3&qryType=ctks';
$url2='http://db.cec.gov.tw/histQuery.jsp?voteCode=20141101V1E1&qryType=ctks';
function li2($url){

include('mysql.php');
//include('simple_html_dom.php');

$html1 = file_get_html($url);
foreach($html1->find('.data td') as $element)//loop layer1
{
if(isset($element->rowspan)){
$num=strip_tags($element);

$sql="SELECT * 
FROM `dbhw_1`
WHERE `name`
LIKE '$num'";
$result=$con->query($sql);
while($row = $result->fetch_assoc()) {
	   $num=$row['id'];
	   $city=$row['name'];
	   }
}
else if(strip_tags($element)!="&nbsp;"){
$name=strip_tags($element);
$sql="INSERT INTO `dbhw_2`(`city_id`,`city`,`name`)
VALUES ('$num','$city','$name')";

if(mysqli_query($con,$sql)){echo "success!!!";}
else{echo "failed!!!";}
}
}




$con->close();
}
//li2($url1);
//li2($url2);
?>
