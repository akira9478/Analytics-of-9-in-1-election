<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
<link href="../fonts.css" rel="stylesheet" type="text/css" media="all" />
</head> 
<div>

<?php
include('simple_html_dom.php');

$url='http://db.cec.gov.tw/histQuery.jsp?voteCode=20141101V1E1&qryType=ctks';
$html1 = file_get_html($url);
foreach($html1->find('.data td a') as $element)
{
$element=$element->href;
$element="http://db.cec.gov.tw/".$element;//loop layer1
$html2 = file_get_html($element);
$str="";
foreach($html2->find('.data') as $data)
{
foreach($data->find('td') as $local)
{
if(isset($local->rowspan)){$str=strip_tags($local);}
else{echo strip_tags($local)."'";}
}
echo $str;
echo "<br>";
}
}   
?>
</div>
