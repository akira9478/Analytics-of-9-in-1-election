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
if(!empty($_POST['se'])){$low_bound=mysqli_real_escape_string($con,$_POST['se']);}else{$low_bound=150;}

$first_name=array();
$sql = "SELECT DISTINCT MID(name,1,1) FROM dbhw";
$result = $con->query($sql);
		while ($row = $result->fetch_assoc()) {
			$first_name[]=$row;        
			}
$i=0;
$count=array();
$max=0;
while($i<count($first_name)){
$str=$first_name[$i]['MID(name,1,1)'];
$sql = "SELECT COUNT(*) as total FROM dbhw WHERE name LIKE '$str%'";
$result = $con->query($sql);
$row = $result->fetch_assoc();
if($row['total']>=$low_bound){$count[$i]=$row['total'];}else{$count[$i]=0;}
if($count[$i]>$count[$max]){$max=$i;}
$i++;
}

echo "<script>";
echo "$(function () {

    $(document).ready(function () {

        // Build the chart
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: '姓氏比例'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: '人數比例',
                data: [
                     ";


		
echo "{
                        name: '".$first_name[$max]['MID(name,1,1)']."',
                        y: ".$count[$max].",
                        sliced: true,
                        selected: true
                    },";
for($i=0;$i<count($first_name);$i++){
if($count[$i]!=0){
if($i==$max){
}else if($i==count($first_name)-1){
echo "                    ['".$first_name[$i]['MID(name,1,1)']."',   ".$count[$i]."]
";
}else{
echo "                    ['".$first_name[$i]['MID(name,1,1)']."',   ".$count[$i]."],
";
}
}
}                    

//echo $rate;
echo "
                ]
            }]
        });
    });

});";
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
	        <li class="active"><a href="fn.php">姓氏菜市場名</a></li>
		<li><a href="mf.php">男女比例</a></li>
		<li><a href="party.php">政黨平均年齡</a></li>
		<li><a href="re.php">連任比率</a></li>
	</ul>
</div>
</div>
</nav>
<div class="container">
<table class="container">
<tbody>
<td class="col-md-2">
<div>
<form method="post" class="form-inline" action="fn.php">
<div class="form-group">
<select name="se" class="form-control" >
<option value="">請選擇</option>
<option value="200">大於200</option>
<option value="500">大於500</option>
<option value="1000">大於1000</option>
</select>
</div>

<button type="submit" class="btn btn-default">送出</button>


</form>


</div></td>
<td class="col-md-6">

<div id="container">

</div>
</td>
</tbody>
</table>
</div>
</body>