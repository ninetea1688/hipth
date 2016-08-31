<?php

/*
Author: Pradeep Khodke
URL: http://www.codingcage.com/
*/


session_start();

if(isset($_SESSION['user_session'])!="")
{
	header("Location: main.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ระบบติดตามการรักษาผู้ป่วย DMS</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../dist/components/header.css">
<script type="text/javascript" src="validation.min.js"></script>
<link href="style.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="script.js"></script>

</head>

<body>

<div class="signin-form">

	<div class="container">


       <form class="form-signin" method="post" id="login-form">

        <h2 class="form-signin-heading">
          <div class="content" align="center">
            <img src="images/moph-logo.png" class="image" height="64">
          กรุณายืนยันตัวบุคคล <br>เพื่อตรวจสอบสิทธิ์การใช้งาน
        </div>
        </h2><hr />

        <div id="error">
        <!-- error will be shown here ! -->
        </div>

        <div class="form-group">
        <input type="email" class="form-control" placeholder="อีเมลล์" name="user_email" id="user_email" />
        <span id="check-e"></span>
        </div>

        <div class="form-group">
        <input type="password" class="form-control" placeholder="รหัสผ่าน" name="password" id="password" />
        </div>

     	<hr />

        <div class="form-group">
            <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
    		<span class="glyphicon glyphicon-log-in"></span> &nbsp; เข้าสู่ระบบ
			</button>
        </div>

      </form>

    </div

</div>

<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
