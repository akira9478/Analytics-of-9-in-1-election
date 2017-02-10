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

echo "<script>";
echo "$(function () {

    $(document).ready(function () {

        // Build the chart
        $('#container1').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: '男性候選人比例'
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
$str="男";
$sql = "SELECT * FROM dbhw WHERE sex LIKE '%$str%' AND elected='*'";
$result=$con->query($sql);
$elected = mysqli_num_rows($result);

$sql2 = "SELECT * FROM dbhw WHERE sex LIKE '%$str%'";
$result2=$con->query($sql2);
$all = mysqli_num_rows($result2);
$rate1 =round($elected / $all *100,2);
$rate2 =round(($all-$elected) / $all *100,2);
echo "{
                        name: '當選男性',
                        y: ".$rate1.",
                        sliced: true,
                        selected: true
                    },";
echo "                    ['未當選男性',   ".$rate2."]
";
//echo $rate;
echo "
                ]
            }]
        });
    });

});";
echo "</script>";

echo "<script>";
echo "$(function () {

    $(document).ready(function () {

        // Build the chart
        $('#container2').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: '女性候選人比例'
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
$str="女";
$sql = "SELECT * FROM dbhw WHERE sex LIKE '%$str%' AND elected='*'";
$result=$con->query($sql);
$elected = mysqli_num_rows($result);

$sql2 = "SELECT * FROM dbhw WHERE sex LIKE '%$str%'";
$result2=$con->query($sql2);
$all = mysqli_num_rows($result2);
$rate1 =round($elected / $all *100,2);
$rate2 =round(($all-$elected) / $all *100,2);
echo "{
                        name: '當選女性',
                        y: ".$rate1.",
                        sliced: true,
                        selected: true
                    },";
echo "                    ['未當選女性',   ".$rate2."]
";
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
	        <li><a href="fn.php">姓氏菜市場名</a></li>
		<li class="active"><a href="mf.php">男女比例</a></li>
		<li><a href="party.php">政黨平均年齡</a></li>
		<li><a href="re.php">連任比率</a></li>
	</ul>
</div>
</div>
</nav>
<table class="container">
<tbody>
<td class="col-md-6">
<div id="container1">

</div></td>
<td class="col-md-6">
<div id="container2">

</div>
</td>
</tbody>
</table>

</body>