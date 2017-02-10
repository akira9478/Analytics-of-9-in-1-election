<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include('simple_html_dom.php');
include('mysql.php');


$url1='http://db.cec.gov.tw/histQuery.jsp?voteCode=20141101Y1B3&qryType=ctks';
$url2='http://db.cec.gov.tw/histQuery.jsp?voteCode=20141101V1E1&qryType=ctks';
function li1($url){
include('mysql.php');

$html1 = file_get_html($url);
foreach($html1->find('.data td') as $element)//loop layer1
{
if(isset($element->rowspan)){
$name=strip_tags($element);

$sql="INSERT INTO `dbhw_1`(`name`)
VALUES ('$name')";
if(mysqli_query($con,$sql)){echo "success!!!";}
else{echo "failed!!!";}
}
}
}
//li1($url1);
//li2($url2);
?>
