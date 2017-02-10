<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include('simple_html_dom.php');
include('mysql.php');

$url1='http://db.cec.gov.tw/histQuery.jsp?voteCode=20141101Y1B3&qryType=ctks';
$url2='http://db.cec.gov.tw/histQuery.jsp?voteCode=20141101V1E1&qryType=ctks';
function li3($url){
include('mysql.php');

$html1 = file_get_html($url);
foreach($html1->find('.data td') as $element){
if(isset($element->rowspan)){
$name1=strip_tags($element);
}else if(strip_tags($element)!="&nbsp;")
{
$href=$element->find('a');
$htm=$href[0]->href;
$name2=strip_tags($element);

$sql="SELECT *
FROM `dbhw_2`
WHERE `city`='$name1' AND `name`='$name2'";

$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
	   $num1=$row['city_id'];
	   $num2=$row['id'];
	   }


$h="http://db.cec.gov.tw/".$htm;//get url
echo $element->href;
$html2 = file_get_html($h);
foreach($html2->find('.data td') as $data)//loop layer2
{
if(isset($data->rowspan)){
$name=strip_tags($data);
$sname=$name1.$name2;
$name=substr($name,strlen($sname));
$sql="INSERT INTO `dbhw_3`(`city`, `city_id`, `cont`, `cont_id`, `name`)
VALUES ('$name1','$num1','$name2','$num2','$name')";
if(mysqli_query($con,$sql)){echo "success!!!";}
else{echo "failed!!!";}
echo "<br>";
}
//get addr
}
}
  
}
}

//li3($url1);
//li3($url2);
?>
