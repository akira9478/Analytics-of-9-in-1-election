<!DOCTYPE html>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <!-- Bootstrap -->
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="highcharts/js/highcharts.js"></script>
<script src="highcharts/js/highcharts-3d.js"></script>
<script src="highcharts/js/modules/exporting.js"></script>
<?php
include('mysql.php');
date_default_timezone_set("Asia/Taipei");
$now = date('Y');
$time = array($now-20,$now-30,$now-40,$now-50,$now-60,$now-70,$now-80,$now-90);





//for($i=0;$i<7;$i++)
//echo $time[$i]."-".$time[$i+1]."<br>";



echo "<script>";
echo "$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column',
            margin: 75,
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 7,
                depth: 70
            }
        },
        title: {
            text: '各年齡參選分布'
        },
        subtitle: {
            text: ''
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },        
        xAxis: {
            categories: [";
for($a=0;$a<7;$a++){$b=$a+1; $x=$now-$time[$a]; $y=$now-$time[$b]; echo "'".$x."~".$y."歲"; if($b==7){echo "']";}else{echo"',";}}            
echo "
        },
        yAxis: {
            opposite: true
        },
        series: [{
            name: '當選人數',
            data: [";
for($i=0;$i<7;$i++){
$j=$i+1;
$sql = "SELECT COUNT(*) FROM dbhw WHERE birth BETWEEN $time[$j]+1 AND $time[$i] AND elected='*'";
$result=$con->query($sql);
$rowcount = $result->fetch_assoc();
echo $rowcount['COUNT(*)'];
if($j==7){echo "]";}else{echo",";}
}
echo "            
        },{
            name: '候選人數',
            data: [";
for($i=0;$i<7;$i++){
$j=$i+1;
$sql = "SELECT * FROM dbhw WHERE birth BETWEEN $time[$j]+1 AND $time[$i]";
$result=$con->query($sql);
$rowcount = mysqli_num_rows($result);
echo $rowcount;
if($j==7){echo "]";}else{echo",";}
}
echo "
        }]

";
echo "";
echo "";
echo "    });";
echo "});";
echo "</script>";
?>




<body>
<nav class="navbar navbar-inverse navbar-static-top">
<div class="container">
   <div class="navbar-header"><a class="navbar-brand" href="index.php">中央選舉委員會</a></div>
<div class="navbar-collapse" >
	<ul class="nav navbar-nav">
		<li><a href="index.php">村里長搜尋</a></li>
		<li class="active"><a href="age.php">年齡分布</a></li>
	        <li><a href="fn.php">姓氏菜市場名</a></li>
		<li><a href="mf.php">男女比例</a></li>
		<li><a href="party.php">政黨平均年齡</a></li>
		<li><a href="re.php">連任比率</a></li>
	</ul>
</div>
</div>
</nav>
<div id="container" role="main">


</div>
</body>