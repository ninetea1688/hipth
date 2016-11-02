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
<h4 class="modal-title" id="myModalLabel">กราฟระดับค่า FBS HN : <?php echo $hn; ?></h4>
</div>
<div class="modal-body">
กราฟระดับน้ำตาล

<?php
$query = "select date(lbbk.vstdttm) as visitdate,replace(
	if(instr(lfbs.fbs,'(')=0,
		if(instr(lfbs.fbs,'*')=0,lfbs.fbs,
			substr(lfbs.fbs,1,instr(lfbs.fbs,'*')-1)),
		if(instr(lfbs.fbs,'*')=0,
			substr(lfbs.fbs,1,instr(lfbs.fbs,'(')-1),
			if(instr(lfbs.fbs,'(')<instr(lfbs.fbs,'*'),
				substr(lfbs.fbs,1,instr(lfbs.fbs,'(')-1),
				substr(lfbs.fbs,1,instr(lfbs.fbs,'*')-1)
			)
		)
	),' ','') as labresult
from lbbk inner join lfbs on lbbk.ln = lfbs.ln
inner join lab on lab.labcode = lbbk.labcode
where lab.labcode = '028' and lbbk.hn = ".$hn."
order by lbbk.vstdttm ASC
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
    $('#barchart').highcharts({
        chart: {
            type: 'line',
        },
        title: {
            text: 'กราฟระดับค่า FBS'
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
   $data[] = $row[$c_field];
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
						minorGridLineWidth: 0,
            gridLineWidth: 0,
            alternateGridColor: null,
            plotBands: [{ // Light air
                from: 0,
                to: 125,
                color: 'rgba(0,255,0,0.3)',
                label: {
                    text: 'เขียว',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Light breeze
                from: 126,
                to: 154,
                color: 'rgba(255,255,0,0.3)',
                label: {
                    text: 'เหลือง',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Gentle breeze
                from: 155,
                to: 182,
                color: 'rgba(255, 165, 0, 0.3)',
                label: {
                    text: 'ส้ม',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Moderate breeze
                from: 183,
                to: 500,
                color: 'rgba(255,0,0,0.3)',
                label: {
                    text: 'แดง',
                    style: {
                        color: '#606060'
                    }
                }
            }]
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
            name: 'ค่าระดับน้ำตาล',
            data: [<?php echo join(',',$data); ?>]

        }]
    });
});
</script>
<!--แสดงกราฟ-->
<div id="barchart" style="width:60%"></div>
