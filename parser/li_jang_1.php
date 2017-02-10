<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include('simple_html_dom.php');
include('mysql.php');//sql connect data

$url='http://db.cec.gov.tw/histQuery.jsp?voteCode=20141101Y1B3&qryType=ctks';//url change 
$html1 = file_get_html($url);
foreach($html1->find('.data td a') as $element)//loop layer1
{
$element=$element->href;
$element="http://db.cec.gov.tw/".$element;//get url
$html2 = file_get_html($element);
foreach($html2->find('.data') as $data)//loop layer2
{
$i=1;
foreach($data->find('td') as $local)//loop layer3
{
if(isset($local->rowspan)){$value[0]=strip_tags($local);
}//get addr
else{$value[$i]=strip_tags($local);
	$i++;
}//get data
}

/*
//sql auto input (use mysqli)
$area=$value[0];
$name=$value[1];
$no=$value[2];
$sex=$value[3];
$birth=$value[4];
$party=$value[5];
$votes=$value[6];
$vote_rate=$value[7];
$elected=$value[8];
$now=$value[9];
$sql="INSERT INTO `dbhw`(`area`, `name`, `no`, `sex`, `birth`, `party`, `votes`, `vote_rate`, `elected`, `now`)
VALUES ('$area','$name','$no','$sex','$birth','$party','$votes','$vote_rate','$elected','$now')";
if(mysqli_query($con,$sql)){echo "success!!!";}
else{echo "failed!!!";}
*/
for($k=1;$k<10;$k++){ echo $value[$k];}
echo $value[0]."<br>";
}
}



?>
