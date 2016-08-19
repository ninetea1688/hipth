<?php
include("include/config.inc.php") ;
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
  <script src="jquery/jquery.js"></script>
  <script src="dist/semantic.js"></script>
  <script src="examples/homepage.js"></script>
  <script src="ajax.js"></script>
	</head>
	<body>
	<div class="container-fluid">
	<!--start menu -->
		<div class="ui orange inverted menu">
		  <a class="active item">
		    <i class="home icon"></i> หน้าหลัก
		  </a>
		  <a class="item">
		    <i class="mail icon"></i> ดูประวัติเก่า
		  </a>
		    <div class="ui dropdown item">
			    ระบบรายงาน <i class="dropdown icon"></i>
			    <div class="menu">
			      <div class="item">รายงานการเข้าดูประวัติ</div>
			      <div class="item">ประวัติการค้นประวัติผู้ป่วย</div>
			      <div class="item">รายงานวิเคราะห์การเข้าถึงข้อมูล</div>
			    </div>
  			</div>
		  <a class="item">
		    <i class="user icon"></i> ออกระบบ
		  </a>
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
							<input type="text" name="name" placeholder="ระบุชื่อ ..." disabled>
							<a class="ui label">
								ระบุชื่อ  ......
							</a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="field ui action left icon input labeled">
						<i class="search icon"></i>
							<input type="text" name="lname" placeholder="ระบุนามสกุล.." disabled />
							<a class="ui label">
								ระบุนามสกุล..
							</a>
					</div>
				</div>

		</div>
		<p>
		<div class="row">
		  <div class="col-md-6 col-md-offset-3">
				<button type="submit" class="btn btn-info btn-block" onclick="showVisit(pop_id.value)">ค้นหาประวัติ</button>
			</div>
		</div>
		<!-- Show Patien Information -->
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
  							<<a class="ui teal ribbon label">C.C.</a>
  							<div id="CC"></div>
						</div>
			    	</div>
			    	<br>
			    	<div class="column">
			    		<div class="ui segment">
  							<a class="ui teal ribbon label">Present illness</a>
  							<div id="PI"></div>
						</div>
			    	</div>
			    	<br>
			    	<div class="column">
			    		<div class="ui segment">
  							<a class="ui teal ribbon label">P.E.</a>
  							<div id="PE"></div>
						</div>
			    	</div>
			    </div>
			    <div class="column">
			    	<div class="column">
			    		<div class="ui segment">
  							<a class="ui red ribbon label">Diagnosis</a>
  							<div id="Diagnosis"></div>
						</div>
			    	</div>
			    	<br>
			    	<div class="column">
			    		<div class="ui segment">
  							<a class="ui teal ribbon label">Procedure</a>
  							<div id="Proced">
  							</div>
						</div>
			    	</div>
			    	<br>
			    	<div class="column">
			    		<div class="ui segment">
  							<a class="ui red ribbon label">LAB</a>
  							<div id="LAB">
  							</div>
						</div>
			    	</div>
			    </div>
			    <div class="column">
			    	<div class="column">
			    		<div class="ui segment">
  							<a class="ui red ribbon label" style="hight:100%">R.X.</a>
  							<div id="Rx"></div>
						</div>
			    	</div>
			    </div>
  			</div>
	    </div> <!-- end rigth grid -->
  	</div>
  	<!-- end grid -->
	</div>
	</body>
</html>
