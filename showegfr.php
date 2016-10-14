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
<h4 class="modal-title" id="myModalLabel">กราฟระดับค่า eGFR HN : <?php echo $hn; ?></h4>
</div>
<div class="modal-body">
กราฟระดับค่า eGFR

<?php
$query = "select date(ovst.vstdttm) as visitdate,visitgfr.gfr
from ovst inner join visitgfr on ovst.vn = visitgfr.vn
where ovst.hn = '".$hn."' order by ovst.vstdttm DESC
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
    $('#egfrchart').highcharts({
        chart: {
            type: 'line',
        },
				colors: [
					'#AA00FF'
				],
        title: {
            text: 'กราฟระดับค่า eGFR'
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
                to: 14,
                color: '#B71C1C',
                label: {
                    text: 'Stage 5',
                    style: {
                        color: '#FFFFFF'
                    }
                }
            }, { // Light breeze
                from: 15,
                to: 30,
                color: '#F44336',
                label: {
                    text: 'Stage 4',
                    style: {
                        color: '#FFFFFF'
                    }
                }
            }, { // Gentle breeze
                from: 31,
                to: 45,
                color: '#FF9800',
                label: {
                    text: 'Stage 3B',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Moderate breeze
                from: 46,
                to: 59,
                color: '#FFFF00',
                label: {
                    text: 'Stage 3A',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Moderate breeze
                from: 60,
                to: 89,
                color: '#2E7D32',
                label: {
                    text: 'Stage 2',
                    style: {
                        color: '#FFFFFF'
                    }
                }
            }, { // Moderate breeze
                from: 90,
                to: 500,
                color: '#9CCC65',
                label: {
                    text: 'Stage 1',
                    style: {
                        color: '#FFFFFF'
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
            name: 'ค่า eGFR',
            data: [<?php echo join(',',$data); ?>]

        }]
    });
});
</script>
<!--แสดงกราฟ-->
<div id="egfrchart" style="width:60%"></div>
