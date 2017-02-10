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
$party=array();
$sql="SELECT DISTINCT party FROM dbhw";
$result=$con->query($sql);
while($row = $result->fetch_assoc()){
        $party[] = $row; 
}
date_default_timezone_set("Asia/Taipei");
$now = date('Y');

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
$i=0;
while($i<count($party)){
echo "'".$party[$i]['party']; if($i==count($party)-1){echo "']";}else{echo"',";}
$i++;
}           
echo "
        },
        yAxis: {
            opposite: true
        },
        series: [{
            name: '當選人平均年齡',
            data: [";
$i=0;
while($i<count($party)){
$str=$party[$i]['party'];
$sql = "SELECT birth FROM dbhw WHERE party LIKE '$str' AND elected='*'";
$result=$con->query($sql);
$count = mysqli_num_rows($result);
$sum=0;
while ($row = $result->fetch_assoc()) {
			$age = $now - $row['birth'];
      $sum += $age;        
			}
if($count!=0){$avg= round($sum/$count,2);}else{$avg=0;}

echo $avg; if($i==count($party)-1){echo "]";}else{echo",";}
$i++;
}            


echo "            
        },{
            name: '候選人平均年齡',
            data: [";
$i=0;
while($i<count($party)){
$str=$party[$i]['party'];
$sql = "SELECT birth FROM dbhw WHERE party LIKE '$str'";
$result=$con->query($sql);
$count = mysqli_num_rows($result);
$sum=0;
while ($row = $result->fetch_assoc()) {
			$age = $now - $row['birth'];
      $sum += $age;        
			}
if($count!=0){$avg= round($sum/$count,2);}else{$avg=0;}

echo $avg; if($i==count($party)-1){echo "]";}else{echo",";}
$i++;
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
		<li><a href="age.php">年齡分布</a></li>
	        <li><a href="fn.php">姓氏菜市場名</a></li>
		<li><a href="mf.php">男女比例</a></li>
		<li class="active"><a href="party.php">政黨平均年齡</a></li>
		<li><a href="re.php">連任比率</a></li>
	</ul>
</div>
</div>
</nav>
<div id="container" role="main">


</div>
<?php



?>
</body>