
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<head>
<link href="../fonts.css" rel="stylesheet" type="text/css" media="all" />

</head> 

<div>



<?php
include('simple_html_dom.php');


$url='http://db.cec.gov.tw/histQuery.jsp?voteCode=20141101V1E1&qryType=ctks&prvCode=09&cityCode=007&deptCode=010';
$html2 = file_get_html($url);

$html3 = file_get_html($url);

foreach($html2->find('.data td[rowspan=]') as $v)
{
$v->outertext = "<span>".strip_tags($v)."</span>";
}
foreach($html2->find('.data td') as $local)
{
echo $local;
echo "<br>";
}
echo $html2;

echo "<br>";



           

   
?>

   </div>
