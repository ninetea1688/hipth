<?php
session_start();
if(!isset($_SESSION['user_session']))
{
	header("Location: index.php");
}
$hn=$_GET['Val'];
include('include/config.inc.php') ;
?>
<div class="modal-header success" style="width:100%">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">ตาราง OnePage Control DM - HN : <?php echo $hn; ?></h4>
</div>
<div class="modal-body">
ตาราง OnePage Control DM
<?php
$query = "select ovst.hn,
date(ovst.vstdttm) as visitdate,
ovst.vn,
lbbk.ln,
MAX(lfbs.fbs) as fbs,
MAX(lhba1c.hba1c) as hba1c,MAX(ovst.sbp) as sbp,MAX(ovst.dbp) as dbp,MAX(lbuncr.creat) as CR,MAX(visitgfr.gfr) as GFR,MAX(llchol.lchol) as LDL,
MAX(ltg.tg) as TG, MAX(lualbmn.ual) as MicroUA
from lbbk inner join ovst on ovst.vn = lbbk.vn
left join lfbs on lbbk.ln = lfbs.ln
left join lhba1c on lbbk.ln = lhba1c.ln
left join lbuncr on lbbk.ln = lbuncr.ln
left join visitgfr on ovst.vn = visitgfr.vn
left join llchol on lbbk.ln = llchol.ln
left join ltg on lbbk.ln = ltg.ln
left join lualbmn on lbbk.ln = lualbmn.ln
WHERE ovst.hn = ".$hn." and date(ovst.vstdttm) > '2015-10-01'
GROUP BY ovst.vn
order by ovst.hn,ovst.vstdttm asc";


// $stmt = mysqli_prepare($conn,'select pt.hn,pt.pop_id,pt.fname,pt.lname,if(pt.male =1, "ชาย","หญิง") as sex,round(DATEDIFF(CURDATE(),pt.brthdate) / 365.25) as age
// from pt where pt.pop_id = ?') ;
//echo print_r($conn);

$res_c = $conn->query($query);

if (!$res_c) {
    die('<p><strong style="color:#FF0000">!! Invalid query:</strong> ' . $mysqli->error.'</p>');
}
?>

<table class="ui celled table">
  <thead>
    <tr>
      <th class="center aligned">วันที่</th>
      <th class="center aligned">FBS</th>
      <th class="center aligned">HBA1C</th>
			<th class="center aligned">BP</th>
			<th class="center aligned">Cr</th>
			<th class="center aligned">eGFR</th>
			<th class="center aligned">LDL</th>
			<th class="center aligned">TG</th>
			<th class="center aligned">Micro/UA</th>
    </tr>
  </thead>
  <tbody>
		<?php
    $c_field = $res_c->field_count-1;
     $c=0; while($row = $res_c->fetch_array(MYSQLI_NUM)){ $c++; ?>
    <?php if($c>1){ ?> <?php }
  //   $data1[] = $row[1];
 // 	 $data2[] = $row[2];
    ?>

    <tr>
      <td class="right aligned"><?php echo $row[1]; ?></td>
      <td class="right aligned"><?php echo $row[4]; ?></td>
      <td class="right aligned"><?php echo $row[5]; ?></td>
			<td class="right aligned"><?php echo $row[6]; ?></td>
	    <td class="right aligned"><?php echo $row[7]; ?></td>
	    <td class="right aligned"><?php echo $row[8]; ?></td>
			<td class="right aligned"><?php echo $row[9]; ?></td>
	    <td class="right aligned"><?php echo $row[10]; ?></td>
	    <td class="right aligned"><?php echo $row[11]; ?></td>
    </tr>
		<?php } ?>
  </tbody>
  <tfoot>
    <tr class="collapsing">
			<th >Gold</th>
			<th colspan="8">
				FBS 70-130 mg/dl, HBA1C < 7 %  BP < 140/80 ติดต่อกัน 2 ครั้ง</br>
				LDL < 100 Triglyceride < 150 ให้ ACEI ในผู้ป่วย HT + DM,  HT + Microalbumin </br>
				การให้ ASA ใน High Risk อายุ มากกว่าหรือเท่ากับ 50 ปี หญิง มากกว่าหรือเท่ากับ 60 ปี </br>
				หรือ Risk อย่างน้อย 1 ข้อ Smoking, HT, DLD, Albuminuria, FH Cardiovascular ในอายุยังน้อย </br>
				Metformin หญิง SCr มากกว่าหรือเท่ากับ 1.4	ชาย SCr มากกว่าหรือเท่ากับ 1.5 eGFR น้อยกว่าหรือเท่ากับ 30 </br>
				Glibenclamide eGFR < 30	Glipizide eGFR < 10 ต้องระวัง </br>
				Enalapil eGFR น้อยกว่าหรือเท่ากับ 25 SCr มากกว่า 3 </br>
				TG eGFR น้อยกว่า 15
			</th>
  	</tr>
	</tfoot>
</table>
