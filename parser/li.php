<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include('simple_html_dom.php');
include('mysql.php');

$url='http://db.cec.gov.tw/histQuery.jsp?voteCode=20141101Y1B3&qryType=ctks';
$html1 = file_get_html($url);
foreach($html1->find('.data td') as $element)//loop layer1
{
if(isset($element->rowspan)){
$name=strip_tags($element);

$sql="INSERT INTO `dbhw_1`(`name`)
VALUES ('$name')";
//if(mysqli_query($con,$sql)){echo "success!!!";}
//else{echo "failed!!!";}
}
}
   
?>
