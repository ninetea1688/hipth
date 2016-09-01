<?php
session_start();
if(!isset($_SESSION['user_session']))
{
	header("Location: index.php");
}
$exp=explode(",",$_GET['Val']);
include('include/config.inc.php') ;

$ln = $exp[0];
$labcode = $exp[1];
$labname = $exp[2];
$dbf = $exp[3] ;


 ?>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">ผลตรวจ <?php echo $exp[2];?></h4>
</div>
<div class="modal-body">

เลขที่ตรวจ LAB <?php echo $exp[0].'   รหัส LAB '.$exp[1].'  '  ;?>
<!-- get lab result -->
<?php
  if(empty($dbf)){
    $sql = "select dbfs from lab where labcode =".$labcode;
    $query = mysqli_query($conn,$sql);
    $arr = mysqli_fetch_array($query);
    $dbft = explode(",",$arr[0]);
    echo "<br>";
    $x = count($dbft);
    for($i=0;$i<$x;$i++){
      $dbf =  $dbft[$i];
        echo "<br>";
 ?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
<tr>
<?php
//$ln=$_GET['ln'];		    //HN
//$dbf=$_GET['dbf'];	  //ชื่อ lab
//$labsname=$_GET['labname'];	  //ชื่อ lab



///$visitdate = $_GET['visitdate'];
echo "ตารางเก็บผล : ".$dbf."<br>" ;
//echo "วันที่ตรวจ : ".$visitdate."<br>" ;
$dbfx=strtolower($dbf);
$query3 = "SELECT a.* FROM $dbfx  a WHERE a.ln = $ln "; // Query fieldname

$result3 = mysqli_query($conn,$query3);

// A two-dimensional array:

while ($property3 = mysqli_fetch_field($result3)){
echo  "<td class='success'  height='25'>";
echo $property3->name . "<br>"; // ชื่อฟิวด์
echo  "</td>";
}
echo  "</tr>";
echo  "<tr>";
$numrows4=mysqli_num_fields($result3);
while ($property4 = mysqli_fetch_array($result3)){
for ($ii=0;$ii<$numrows4;$ii++) echo "<td bgcolor='#FFFFFF' height='25'>".$property4[$ii]."</td>"; //ผล lab
}
?>
</tr>
</table>
<?php
}
}else{
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
<tr>
<?php
//$ln=$_GET['ln'];		    //HN
//$dbf=$_GET['dbf'];	  //ชื่อ lab
//$labsname=$_GET['labname'];	  //ชื่อ lab



///$visitdate = $_GET['visitdate'];
echo "ตารางเก็บผล : ".$dbf."<br>" ;
//echo "วันที่ตรวจ : ".$visitdate."<br>" ;
$dbfx=strtolower($dbf);
$query3 = "SELECT a.* FROM $dbfx  a WHERE a.ln = $ln "; // Query fieldname

$result3 = mysqli_query($conn,$query3);

// A two-dimensional array:

while ($property3 = mysqli_fetch_field($result3)){
echo  "<td class='success'  height='25'>";
echo $property3->name . "<br>"; // ชื่อฟิวด์
echo  "</td>";
}
echo  "</tr>";
echo  "<tr>";
$numrows4=mysqli_num_fields($result3);
while ($property4 = mysqli_fetch_array($result3)){
for ($ii=0;$ii<$numrows4;$ii++) echo "<td bgcolor='#FFFFFF' height='25'>".$property4[$ii]."</td>"; //ผล lab
}
?>
</tr>
</table>
<?php
}
 ?>
<!-- end get lab result -->

</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
