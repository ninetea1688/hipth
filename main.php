
<?php //session_start();
session_start();

if(!isset($_SESSION['user_session']))
{
	header("Location: index.php");
}
include("include/config.inc.php") ;

$stmt = $db_con->prepare("SELECT * FROM tbl_users WHERE user_id=:uid");
$stmt->execute(array(":uid"=>$_SESSION['user_session']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);


?>
<html>
	<head>
		<title>
			ระบบค้นหาประวัติผู้ป่วยออนไลน์ HI PTH System
		</title>
	<meta charset="utf8">
  <link rel="stylesheet" type="text/css" href="dist/semantic.css">
  <link rel="stylesheet" type="text/css" href="examples/homepage.css">
	<link rel="stylesheet" href="dist/bootstrap.min.css">
	<link href="sticky-footer.css" rel="stylesheet">

	<script src="jquery/jquery.js"></script>
	<script src="dist/semantic.js"></script>
	 <script src="dist/js/bootstrap.js"></script>
 <script src="dist/js/application.js"></script>
 <script src="dist/js/tooltip.js"></script>
  <script src="examples/homepage.js"></script>
  <script src="ajax.js"></script>
	<script src="jquery/popup.js"></script>

	<style>
		.loader
		{
			background-image: url(images/ajax-loader.gif);
			background-repeat: no-repeat;
			background-position: center;
			height: 100px;
		}

	</style>





	</head>
	<body>
	<div class="container-fluid">
	<!--start menu -->
		<div class="ui orange inverted menu">
		  <a class="active item">
		    <i class="home icon"></i> หน้าหลัก
		  </a>
		  <a class="item">
		    <i class="list icon"></i> ดูประวัติเก่า
		  </a>
		    <div class="ui dropdown item">
			    <i class="browser icon"></i> ระบบรายงาน
			    <div class="menu">
			      <div class="item">รายงานการเข้าดูประวัติ</div>
			      <div class="item">ประวัติการค้นประวัติผู้ป่วย</div>
			      <div class="item">รายงานวิเคราะห์การเข้าถึงข้อมูล</div>
			    </div>
  			</div>
				<ul class="nav navbar-nav navbar-right">

	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
<i class="users icon"></i>&nbsp;สวัสดี ' <?php echo $row['fname']; ?>&nbsp;<span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li><a href="#"><i class="user icon"></i>&nbsp;โปรไฟล์</a></li>
			<li><a href="logout.php"><i class="sign out icon"></i></span>&nbsp;ออกจากระบบ</a></li>
		</ul>
	</li>
</ul>
    	</div>
    <!-- end menu -->
	<!-- start search form -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<strong>ค้นหาผู้ป่วยจากเลขที่บัตรประชาชน หรือจาก ชื่อ หรือจาก นามสกุล</strong>
		</div>
    <div class="ui small form">
			<div class="panel-body">
			<div class="row">
				<!-- <div class="field">
					<i class="search icon"></i>
						ค้นหาผู้ป่วยจากเลขที่บัตรประชาชน หรือจาก ชื่อ หรือจาก นามสกุล
					</div> -->
					<div class="col-md-4">
						<div class="field ui action left icon input labeled">
							<i class="search icon"></i>
								<input type="text" name="cid" placeholder="ระบุ  CID ..." id="pop_id">
								<a class="ui label">
									ระบ CID  ......
								</a>
						</div>
					</div>
				<div class="col-md-4">
					<div class="field ui action left icon input labeled">
						<i class="search icon"></i>
							<input type="text" name="name" placeholder="ระบุชื่อ ..." id="fname" disabled>
							<a class="ui label">
								ระบุชื่อ  ......
							</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="field ui action left icon input labeled">
						<i class="search icon"></i>
							<input type="text" name="lname" placeholder="ระบุนามสกุล.." id="lname" disabled />
							<a class="ui label">
								ระบุนามสกุล..
							</a>
					</div>
				</div>

		</div>
		<p>
		<div class="row">
		  <div class="col-md-6 col-md-offset-3">
				<button type="submit" class="btn btn-info btn-block" onclick="showInfo(pop_id.value)">ค้นหาประวัติ</button>
			</div>
		</div>
		<!-- Show Patien Information -->
	<div class="ui steps" id = "showInfo">

	</div>
		<!-- End Show Information -->

		</div>
		</div>
	</div>
	<!-- end search form -->
	<!-- start grid -->
	<div class="ui stackable two column grid">
	    <div class="two wide column"> <!-- start left grid -->
	    	<!-- start select box -->
				<div class="ui form">
					<div id="Visit" class="field">
					 </div>
				</div>
	    	<!-- end select box -->
	    </div> <!-- end left grid -->
	    <div class="fourteen wide column" > <!-- start rigth grid -->
	 		<div class="ui three column grid">
			    <div class="column">
			    	<div class="column">
			    		<div class="ui segment">
  							<<a class="ui teal ribbon label"><i class="closed captioning icon"></i> C.C.</a>
  							<div id="CC"></div>
						</div>
			    	</div>
			    	<br>
			    	<div class="column">
			    		<div class="ui segment">
  							<a class="ui teal ribbon label"><i class="handicap icon"></i> Present illness</a>
  							<div id="PI"></div>
						</div>
			    	</div>
			    	<br>
			    	<div class="column">
			    		<div class="ui segment">
  							<a class="ui teal ribbon label"><i class="treatment icon"></i> P.E.</a>
  							<div id="PE"></div>
						</div>
			    	</div>
			    </div>
			    <div class="column">
			    	<div class="column">
			    		<div class="ui segment">
  							<a class="ui red ribbon label"><i class="doctor icon"></i> Diagnosis</a>
  							<div id="Diagnosis"></div>
						</div>
			    	</div>
			    	<br>
			    	<div class="column">
			    		<div class="ui segment">
  							<a class="ui teal ribbon label"><i class="theme icon"></i> Procedure</a>
  							<div id="Proced">
  							</div>
						</div>
			    	</div>
			    	<br>
			    	<div class="column">
			    		<div class="ui segment">
  							<a class="ui red ribbon label"><i class="eyedropper icon"></i> LAB</a>
  							<div id="LAB">
  							</div>
						</div>
			    	</div>
			    </div>
			    <div class="column">
			    	<div class="column">
			    		<div class="ui segment">
  							<a class="ui red ribbon label" style="hight:100%"><i class="first aid icon"></i> R.X.</a>
  							<div id="Rx"></div>
						</div>
			    	</div>
			    </div>
  			</div>
	    </div> <!-- end rigth grid -->
  	</div>
  	<!-- end grid -->
	</div>


	<div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
  <div class="modal-content" id="MyContent">

  </div>
  </div>



</div>


<script>
$('body').on('click', '.SendButton', function(){


		var Val = $(this).attr('data-id');
		$.ajax({url:"showcontent.php?Val="+Val,cache:false,success:function(result){
		 	$("#MyContent").html(result);
		}});


	});
</script>
<!--
<script>
$(document).on('click','.SendButton',function(e){
	e.preventDefault();
	$(".modal-body").html('');
	$(".modal-body").addClass('loader');
	$("#MyContent").modal('show');
})
</script>
-->
    <!--
    	<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">ผลแลบ</h4>
                    </div>
                    <div class="modal-body view-content">
                        ทดสอบ
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">ปิดหน้าต่าง</button>
                    </div>
                </div>
            </div>
        </div>
    -->
		<div>
			<p>
		</div>
		<div class="ui inverted vertical footer segment form-page">
	  <div class="ui container" align="right">
	    ออกแบบและพัฒนาโดย :: &copy; นายสุรชัย ศรีอาราม ฝ่ายสนับสนุนบริการสุขภาพ โรงพยาบาลเขื่องใน
	  </div>
	</div>
	</body>
</html>
