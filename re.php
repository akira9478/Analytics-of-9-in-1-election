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

if(!empty($_POST['se'])){
$party=array();
$sql="SELECT DISTINCT party FROM dbhw";
$result=$con->query($sql);
while($row = $result->fetch_assoc()){
        $party[] = $row; 
}
$value=mysqli_real_escape_string($con,$_POST['se']);
$sql = "SELECT name FROM dbhw_1 WHERE id='$value'";
$result = $con->query($sql);
		while ($row = $result->fetch_assoc()) {
			$city = $row['name'];        
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
                text: '".$city."候選人連任比例'
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
                name: 'Browser share',
                data: [
                     ";
$str="是";
$i=0;
while($i<count($party)){
$party_str=$party[$i]['party'];
$sql = "SELECT COUNT(*) as total FROM dbhw WHERE area LIKE '%$city%' AND now LIKE '%$str%' AND elected='*' AND party LIKE '%$party_str%'";
$result=$con->query($sql);
$row = $result->fetch_assoc();
$re[$i] = $row['total'];
$i++;
}
$sql2 = "SELECT COUNT(*) as total FROM dbhw WHERE area LIKE '%$city%' AND now LIKE '%$str%' AND elected=' '";
$result2=$con->query($sql2);
$row = $result2->fetch_assoc();
$no_re = $row['total'];

$max=$defa=$no_re;
$max_str=$defa_str="未連任成功";

$i=0;
while($i<count($party)){
if($re[$i]>$max){$max=$re[$i]; $max_str=$party[$i]['party'];}
$i++;
}

echo "{
                        name: '".$max_str."',
                        y: ".$max.",
                        sliced: true,
                        selected: true
                    },";
$i=0;                    
while($i<count($party)){
$party_str=$party[$i]['party'];
if($re[$i]!=0){
if($re[$i]==$max){}
else if($i==count($party)-1){echo "                    ['".$party_str."',   ".$re[$i]."]
";}
else{echo "                    ['".$party_str."',   ".$re[$i]."],
";
}
}
$i++;
}
if($max_str!=$defa_str){echo "                    ['".$defa_str."',   ".$defa."],
";
}                    

echo "
                ]
            }]
        });
    });

});";
echo "</script>"; }
else{
$party=array();
$sql="SELECT DISTINCT party FROM dbhw";
$result=$con->query($sql);
while($row = $result->fetch_assoc()){
        $party[] = $row; 
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
                text: '全國候選人連任比例'
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
                name: '連任比例',
                data: [
                     ";
$str="是";
$i=0;
while($i<count($party)){
$party_str=$party[$i]['party'];
$sql = "SELECT COUNT(*) as total FROM dbhw WHERE now LIKE '%$str%' AND elected='*' AND party LIKE '%$party_str%'";
$result=$con->query($sql);
$row = $result->fetch_assoc();
$re[$i] = $row['total'];
$i++;
}
$sql2 = "SELECT COUNT(*) as total FROM dbhw WHERE now LIKE '%$str%' AND elected=' '";
$result2=$con->query($sql2);
$row = $result2->fetch_assoc();
$no_re = $row['total'];

$max=$defa=$no_re;
$max_str=$defa_str="未連任成功";

$i=0;
while($i<count($party)){
if($re[$i]>$max){$max=$re[$i]; $max_str=$party[$i]['party'];}
$i++;
}

echo "{
                        name: '".$max_str."',
                        y: ".$max.",
                        sliced: true,
                        selected: true
                    },";
$i=0;                    
while($i<count($party)){
$party_str=$party[$i]['party'];
if($re[$i]!=0){
if($re[$i]==$max){}
else if($i==count($party)-1){echo "                    ['".$party_str."',   ".$re[$i]."]
";}
else{echo "                    ['".$party_str."',   ".$re[$i]."],
";
}
}
$i++;
}
if($max_str!=$defa_str){echo "                    ['".$defa_str."',   ".$defa."],
";
}                   

echo "
                ]
            }]
        });
    });

});";
echo "</script>"; 
}

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
		<li><a href="party.php">政黨平均年齡</a></li>
		<li class="active"><a href="re.php">連任比率</a></li>
	</ul>
</div>
</div>
</nav>
<table class="container">
<tbody>
<td class="col-md-3">
<div>
<form method="post" class="form-inline" action="re.php">
<div class="form-group">
<select name="se" class="form-control" >
<option value="">請選擇</option>
<?php
$sql="SELECT * FROM dbhw_1 ";
$result=$con->query($sql);
while($row = $result->fetch_assoc()){
	$id = $row["id"];  
	$name = $row["name"];
	 echo '<option value='.$id.'>'.$name.'</option>';
}

?>
</select>
</div>

<button type="submit" class="btn btn-default">search</button>


</form>

</div></td>
<td class="col-md-9">
<div id="container">

</div>
</td>
</tbody>
</table>

</body>