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
<h4 class="modal-title" id="myModalLabel">กราฟระดับค่าความดัน HN : <?php echo $hn; ?></h4>
</div>
<div class="modal-body">
กราฟระดับความดัน

<?php
$query = "select date(ovst.vstdttm) as visitdate,ovst.sbp,ovst.dbp
from ovst inner join ovstdx on ovst.vn = ovstdx.vn
where hn = ".$hn."
group by ovst.vn
order by ovst.vstdttm ASC
limit 12";

// $stmt = mysqli_prepare($conn,'select pt.hn,pt.pop_id,pt.fname,pt.lname,if(pt.male =1, "ชาย","หญิง") as sex,round(DATEDIFF(CURDATE(),pt.brthdate) / 365.25) as age
// from pt where pt.pop_id = ?') ;
//echo print_r($conn);

$res_c = $conn->query($query);

if (!$res_c) {
    die('<p><strong style="color:#FF0000">!! Invalid query:</strong> ' . $mysqli->error.'</p>');
}
?>
<script type="text/javascript">
$(function () {
    $('#sbpdbpchart').highcharts({
        chart: {
            type: 'line',
        },
				colors: [
					'#EC407A','#00C853'
				],
        title: {
            text: 'กราฟระดับค่าความดัน'
        },
/*        subtitle: {
            text: ''
        },*/
        xAxis: {
            categories: [
   <?php
   $c_field = $res_c->field_count-1;
    $c=0; while($row = $res_c->fetch_array(MYSQLI_NUM)){ $c++; ?>
   <?php if($c>1){ ?>,<?php }
   $data1[] = $row[1];
	 $data2[] = $row[2];
   ?>
                '<?php echo htmlspecialchars(addslashes(str_replace("\t","",str_replace("\n","",str_replace("\r","",$row[0]))))); ?>'
   <?php } ?>
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Values'
            },
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:,.0f} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            line: {
                pointPadding: 0.2,
                borderWidth: 0,
    dataLabels: {
     enabled: true
    }
   }
        },
  credits: {
   enabled: false
  },
        series: [{
            name: 'SBP',
            data: [<?php echo join(',',$data1); ?>]

        },{
            name: 'DBP',
            data: [<?php echo join(',',$data2); ?>]

        }]
    });
});
</script>
<!--แสดงกราฟ-->
<div id="sbpdbpchart" style="width:60%"></div>
