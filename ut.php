<? session_start();
@header("Content-Type: text/html; charset=tis-620");
require_once("function.php");
$obj=new mndb;
$obj->ConnDB(); 
$ip=$obj->getIP();
?>
<?
switch($op){


case "1": {
$day=$obj->getday();
$timed=$obj->gettime();
$years=$obj->getQuery("years"," where status='1' ");
$rowssubcriterion=$obj->getQuery("subcriterion"," where id='$subcriterion_id' and  criterion_id='$criterion_id'");
$obj->getDelete(" workpoint "," where hospcode='$hospcode' and criterion_id='$criterion_id' and subcriterion_id='$subcriterion_id' and years='$years->name' ");
$obj->getInsert(" workpoint "," '','$hospcode','$criterion_id','$subcriterion_id','$point','$rowssubcriterion->devide','$rowssubcriterion->multiply','$years->name','$ip','$day','$timed' ");
}
break;

case "2": {
$years=$obj->getQuery("years"," where status='1' ");
$lev=$obj->getQuery("level"," where criterion_id='$criterion_id' and levelname='$levelname' ");
$obj->getDelete(" level "," where criterion_id='$criterion_id' and levelname='$levelname' ");
$obj->getInsert(" level "," '','$levelname','$criterion_id','$years->name' ");
}
break;

case "3": {
		$obj->ConnDB();
		$sqlr=mysql_query("select * from hospcode where (hospname like '%$dp%') order by hospname asc");
		while($rowr=mysql_fetch_object($sqlr)){
		?>
		<option value="<?=$rowr->hospname;?>"><?=$rowr->hospcode;?></option>
		<?
		}
} break;

}
?>