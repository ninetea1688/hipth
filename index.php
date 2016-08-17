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

  <script src="jquery/jquery.js"></script>
  <script src="dist/semantic.js"></script>
  <script src="examples/homepage.js"></script>
  <script src="ajax.js"></script>
	</head>	
	<body>
	<!--start menu -->
		<div class="ui orange inverted menu">
		  <a class="active item">
		    <i class="home icon"></i> หน้าหลัก
		  </a>
		  <a class="item">
		    <i class="mail icon"></i> ดูประวัติเก่า
		  </a>
		    <div class="ui dropdown item">
			    Dropdown <i class="dropdown icon"></i>
			    <div class="menu">
			      <div class="item">Choice 1</div>
			      <div class="item">Choice 2</div>
			      <div class="item">Choice 3</div>
			    </div>
  			</div>
		  <a class="item">
		    <i class="user icon"></i> ออกระบบ
		  </a>  			
    	</div>  
    <!-- end menu -->
	<!-- start grid -->
	<div class="ui stackable two column grid">
	    <div class="two wide column"> <!-- start left grid -->
	    	<!-- start select box -->
				<div class="ui form">
					<div class="field">
						<?php
						$sql = "select ovst.vn,ovst.vstdttm 
						from ovst inner join ovstdx on ovst.vn = ovstdx.vn where ovst.hn = '5923' group by ovst.vn order by ovst.vstdttm desc"  ;
						$query = mysqli_query($conn,$sql) ;						
						?>
						<select name="visitdate" multiple="multiple" style="width:150px;height:100%;overflow-y:hidden" onchange="showDiag(this.value)">
						<?php
							while($arr = mysqli_fetch_array($query)){
						?>
						    <option value="<?php echo $arr['vn'] ; ?>"><?php echo $arr['vstdttm'] ; ?></option>
						<?php
							}
						?>
						 </select>		
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
	</body>
</html>
