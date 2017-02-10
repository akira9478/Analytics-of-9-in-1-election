<!DOCTYPE html>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <!-- Bootstrap -->
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script>  
 $(document).ready(function(){  
    $('#s1').change(function(){  
    $('#s2').empty();       //更動第一層時第二層清空
	  
	  var i=0; 
	  $.ajax({
	           url:  "action1.php", 
		         type:  "POST",
	           data: {value:$('#s1 option:selected').val()},  
	       datatype:  "json",  
	       success: function(result){  
	       //當第一層回到預設值時，第二層回到預設位置                     
	         	  
			       //依據第一層回傳的值去改變第二層的內容
             while(i<result.length){
                   
                  $("#s2").append("<option value="+result[i]['id']+">"+result[i]['name']+"</option>");
                
					        i++;  
			     } 
		 },  
		 error:  function(error){  
			       alert("error");  
		            }  
	    });//ajax1
         
        });  
   });  
</script> 
<script>  
 $(document).ready(function(){  
    $('#s2').change(function(){  
          //更動第一層時第二層清空
	  $('#s3').empty(); 
	  var i=0;  
	  $.ajax({
	           url:  "action2.php", 
		         type:  "POST",
	           data: {value:$('#s2 option:selected').val()},  
	       datatype:  "json",  
	       success: function(result){  
	       //當第一層回到預設值時，第二層回到預設位置                     
	         	  
			       //依據第一層回傳的值去改變第二層的內容
			         
             while(i<result.length){  
			          $("#s3").append("<option value="+result[i]['id']+">"+result[i]['name']+"</option>");
                
					        i++;  
			     } 
		 },  
		 error:  function(error){  
			       alert("error");  
		            }  
	    });   
        });  
   });  
</script>
<body>
<nav class="navbar navbar-inverse navbar-static-top">
<div class="container">
   <div class="navbar-header"><a class="navbar-brand" href="index.php">中央選舉委員會</a></div>
<div class="navbar-collapse" >
	<ul class="nav navbar-nav">
		<li class="active"><a href="index.php">村里長搜尋</a></li>
		<li><a href="age.php">年齡分布</a></li>
	        <li><a href="fn.php">姓氏菜市場名</a></li>
		<li><a href="mf.php">男女比例</a></li>
		<li><a href="party.php">政黨平均年齡</a></li>
		<li><a href="re.php">連任比率</a></li>
	</ul>
</div>
</div>
</nav>
<div class="container" role="main">
<div class="col-md-5 col-md-offset-1">
<form method="post" class="form-inline" action="index.php">
<div class="form-group">
<select id="s1" name="s1" class="form-control" >
<option value="">請選擇</option>
<?php
include('mysql.php');
$sql="SELECT * FROM dbhw_1";
$result=$con->query($sql);
while($row = $result->fetch_assoc()){
	$id = $row["id"];
	$name = $row["name"];
	 echo '<option value='.$id.'>'.$name.'</option>';
}

?>
</select>
</div>
<div class="form-group">
<select id="s2" name="s2" class="form-control" >
<option value="">請選擇</option>
</select>
</div>
<div class="form-group">
<select id="s3" name="s3" class="form-control" >
<option value="">請選擇</option>
</select>
</div>



<button type="submit" class="btn btn-default">search</button>


</form>



</div>






<?php
if(!empty($_POST['s3'])){
$s1=mysqli_real_escape_string($con,$_POST["s1"]);
$s2=mysqli_real_escape_string($con,$_POST["s2"]);
$s3=mysqli_real_escape_string($con,$_POST["s3"]);

$sql="SELECT * FROM dbhw_3 WHERE city_id='$s1' AND cont_id='$s2' AND id='$s3' ";
$result=$con->query($sql);
while($row = $result->fetch_assoc()){
        $city = $row["city"];
	$cont = $row["cont"];
	$name = $row["name"];
	$search = $city.$cont.$name;	        
	echo "<div class='col-md-4 '><p>".$city.$cont.$name."</p></div>";}
$sql2="SELECT * FROM dbhw WHERE area LIKE '%$search%'";
$result=$con->query($sql2);

echo "<div class='table-responsive col-md-8 col-md-offset-1 '>";

echo "<table class='table table-striped'>";
echo "<thead><tr>";
echo "<th>當選註記</th>";
echo "<th>號次</th>";
echo "<th>姓名</th>";
echo "<th>性別</th>";
echo "<th>得票數</th>";
echo "<th>得票率</th>";
echo "<th>推薦之政黨</th>";

echo "</tr></thead>";
echo "<tbody>";


while($row = $result->fetch_assoc()){
echo "<tr>";
echo "<td>".$row['elected']."</td>";
echo "<td>".$row['no']."</td>";
echo "<td>".$row['name']."</td>";
echo "<td>".$row['sex']."</td>";
echo "<td>".$row['votes']."</td>";
echo "<td>".$row['vote_rate']."</td>";
echo "<td>".$row['party']."</td>";
echo "</tr>";
}

echo "<tbody></table></div>";
}else{echo "<div class='col-md-4 '><p>不完整的地區名稱,請重新查詢</p></div>";}
?>                                         



</div>
</body>
