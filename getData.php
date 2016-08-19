<?php
include('include/config.inc.php') ;
$op = $_GET['op'] ;
//$_GET['vn'] = 554491 ;
switch($op){

case "visit":
$sql = "select pt.fname,pt.lname,if(pt.male =1, 'ชาย','หญิง') as sex,round(DATEDIFF(CURDATE(),pt.brthdate) / 365.25) as age,ovst.vn,ovst.vstdttm
from ovst inner join ovstdx on ovst.vn = ovstdx.vn
inner join pt on ovst.hn = pt.hn
where pt.pop_id = ".$_GET['pop_id']."
group by ovst.vn order by ovst.vstdttm desc"  ;
$query = mysqli_query($conn,$sql) ;
?>
<select name="visitdate" multiple="multiple" style="width:150px;height:100%;overflow-y:hidden" onchange="showDiag(this.value)">
<?php
	while($arr = mysqli_fetch_array($query)){
?>
		<option value="<?php echo $arr['vn'] ; ?>"><?php echo $arr['vstdttm'] ; ?></option>
<?php
	}
echo "</select>" ;
$_SESSION["fname"] = $arr["fname"];
$_SESSION["lname"] = $arr["lname"];
$_SESSION["sex"] = $arr["sex"];
$_SESSION["age"] = $arr["age"];
break;

case "diag":
$sql = "select * from ovstdx where ovstdx.vn = ".$_GET['vn'] ;
$query = mysqli_query($conn,$sql) or die(mysql_error()) ;
while($arr = mysqli_fetch_array($query)){
	echo $arr['icd10'].' - '.$arr['icd10name']."<br>" ;
}
?>
<iframe onload="showRx(<?php echo $_GET['vn'] ; ?>)" frameborder='0' width='0' height='0'></iframe>
<?php
//echo "Hello World" ;
break;

case "rx":
	$sql = "select * from prscdt inner join prsc on prsc.prscno = prscdt.prscno where prsc.vn = ".$_GET['vn'] ;
$query = mysqli_query($conn,$sql) or die(mysql_error()) ;
echo "<table class='ui table'>" ;
echo "<tr><td>ชื่อยา</td><td>จำนวน</td><td>Medusage</td></tr>" ;
while($arr = mysqli_fetch_array($query)){
	echo "<tr>" ;
	echo '<td>'.$arr['nameprscdt'].'</td><td>'.$arr['qty'].'</td><td>'.$arr['medusage']."</td></tr>" ;
}
echo "</table>" ;
?>
<iframe onload="showProced(<?php echo $_GET['vn'] ; ?>)" frameborder='0' width='0' height='0'></iframe>
<?php
break;

case "proced":
$sql = "select * from oprt where oprt.vn = ".$_GET['vn'] ;
$query = mysqli_query($conn,$sql) or die(mysql_error()) ;
while($arr = mysqli_fetch_array($query)){
	echo $arr['icd9cm'].' - '.$arr['icd9name']."<br>" ;
}
?>
<iframe onload="showCC(<?php echo $_GET['vn'] ; ?>)" frameborder='0' width='0' height='0'></iframe>
<?php
break;

case "cc":
$sql = "select group_concat(symptom) as cc
from symptm where vn =".$_GET['vn']." group by vn" ;
$query = mysqli_query($conn,$sql) or die(mysql_error()) ;
while($arr = mysqli_fetch_array($query)){
	echo $arr['cc']."<br>" ;
}
?>

<iframe onload="showPI(<?php echo $_GET['vn'] ; ?>)" frameborder='0' width='0' height='0'></iframe>
<?php
break;

case "pi":
$sql = "select group_concat(pillness) as pi
from pillness where vn =".$_GET['vn']." group by vn" ;
$query = mysqli_query($conn,$sql) or die(mysql_error()) ;
while($arr = mysqli_fetch_array($query)){
	echo $arr['pi']."<br>" ;
}
?>
<iframe onload="showPE(<?php echo $_GET['vn'] ; ?>)" frameborder='0' width='0' height='0'></iframe>
<?php
break;
case "pe":
$sql = "select sign
from sign where vn =".$_GET['vn'] ;
$query = mysqli_query($conn,$sql) or die(mysql_error()) ;
while($arr = mysqli_fetch_array($query)){
	echo $arr['sign']."<br>" ;
}
?>

<iframe onload="showLAB(<?php echo $_GET['vn'] ; ?>)" frameborder='0' width='0' height='0'></iframe>
<?php
break;
case "lab":
$sql = "select lbbk.labcode,lbbk.ln,lab.labname
from lbbk inner join lab on lbbk.labcode = lab.labcode where lbbk.vn = ".$_GET['vn'] ;
$query = mysqli_query($conn,$sql) ;
while($arr = mysqli_fetch_array($query)){
	echo $arr['labname']."<br>" ;
}
?>
<?php
}
?>
