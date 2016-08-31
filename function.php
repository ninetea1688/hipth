<?php session_start(); extract($_POST);extract($_GET);extract($_REQUEST);//extract($_SESSION);
/*function session_register($name){
    global $$name;
    $_SESSION[$name] = $$name;
    $$name = &$_SESSION[$name];
}	*/
class ConnDB {
    private $conn;
    private $dbhost = "localhost";
    private $dbuser = "root";
    private $dbpass = "212224";
    private $dbname = "hi";

    function __construct(){

        $this->conn = new mysqli( $this->dbhost, $this->dbuser, $this->dbpass, $this->dbname );

        if( mysqli_connect_errno() )
        {
            die('Cannot connect to Database! : '. mysqli_connect_errno());
        }

        $this->conn->set_charset("utf8");
    }

	function session($var,$value){
	$_SESSION[$var]=$value;
	}

	function unset_session($var){
	$_SESSION[$var]=null;
	}

	function destroy_session(){
	session_destroy();
	}

	function numrows($table,$condition){
	$row=$this->conn->query("select * from $table $condition");
	$num=$row->num_rows;
	return $num;
    }

	function getQuery($table,$condition){
	$row=$this->conn->query("select * from $table $condition");
	$fetch=$row->fetch_object();
	return $fetch;
    }

	function getAll($condition){
	$row=$this->conn->query("$condition");
	$fetch=$row->fetch_object();
	return $fetch;
    }

	function getUpdate($table,$value,$condition){
	$row=$this->conn->query("update $table set $value $condition");
    }

	function getInsert($table,$value){
	$row=$this->conn->query("insert into $table values ($value)");
	return $row;
	}

	function getDelete($table,$condition){
	$row=$this->conn->query("delete from $table $condition");
	}

	function getFetch($condition){
	$row=$this->conn->query("$condition");
	return $row;
    }

	function __destruct(){
	 if($this->conn != null)
	 {
        $this->conn->close();
		}
	}


	function upLoad($folder,$pic,$image1,$ext){
			if(!empty($pic)){
			$dated = time();
			$image = $folder."/".md5($dated).$ext;
			copy($pic, $image);
			}else{$image=$image1;}
			return $image;
		}


		function upLoad2($folder,$pic,$image1,$ext){
			if(!empty($pic)){
			$dated = time();
			$image = $folder."/".md5($dated).$ext;
			copy($pic, $image);
			}else{$image=$image1;}
			return $image;
		}

		function upLoad3($folder,$pic,$image1,$ext){
			if(!empty($pic)){
			$dated = time();
			$image = $folder."/".md5($dated).$ext;
			copy($pic, $image);
			}else{$image=$image1;}
			return $image;
		}

	function getmain($url){
			echo "<script language='javascript'>location.replace('$url')</script>";
	}

	function a($url){
		return "location='index.php?files=$url'";
	}

	function chkAccess(){
	if(!isset($_SESSION['pid']))
	{
		echo "<script language='javascript'>location='index.php'</script>";
		echo '<meta http-equiv="refresh" content="0 URL=index.php">';
	}
	}

	function getIP(){

						if ($_SERVER['HTTP_CLIENT_IP']) {
						$IP = $_SERVER['HTTP_CLIENT_IP'];
						} elseif (ereg("[0-9]",$_SERVER["HTTP_X_FORWARDED_FOR"] )) {
						$IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
						} else {
						$IP = $_SERVER["REMOTE_ADDR"];
						}
						return $IP;
		}

		function getdatetime(){

						$datetime=date("Y-m-d H:i:s");
						return $datetime;
		}

		function gettime(){

						$timed=date("H:i");
						return $timed;
		}

		function getday(){

						$datetime=date("Y-m-d");
						return $datetime;
		}

		function showtime($data){
		$time=substr($data,0,5);
		$data = "เวลา ".$time." น. ";

		return $data;
		}

		function showdate($data){
		if(!empty($data) && $data!='0000-00-00 00:00:00' && $data!="0000-00-00"){
		$day=$data;
		$dd=substr($day,8,2);
		$mm=substr($day,5,2);
		$yy=substr($day,0,4);
		if($mm=="01"){$m="มกราคม";}
		if($mm=="02"){$m="กุมภาพันธ์";}
		if($mm=="03"){$m="มีนาคม";}
		if($mm=="03"){$m="มีนาคม";}
		if($mm=="04"){$m="เมษายน";}
		if($mm=="05"){$m="พฤษภาคม";}
		if($mm=="06"){$m="มิถุนายน";}
		if($mm=="07"){$m="กรกฎาคม";}
		if($mm=="08"){$m="สิงหาคม";}
		if($mm=="09"){$m="กันยายน";}
		if($mm=="10"){$m="ตุลาคม";}
		if($mm=="11"){$m="พฤศจิกายน";}
		if($mm=="12"){$m="ธันวาคม";}
		$y=$yy+543;
		$data = $dd." ".$m." ".$y;
		return $data;
		}else{
		echo "ไม่ระบุวันที่";
		}
		}

		 function shortdate($data){
		if(!empty($data) && $data!='0000-00-00 00:00:00' && $data!="0000-00-00"){
		$day=$data;
		$dd=substr($day,8,2);
		$mm=substr($day,5,2);
		$yy=substr($day,0,4);
		if($mm=="01"){$m="ม.ค.";}
		if($mm=="02"){$m="ก.พ.";}
		if($mm=="03"){$m="มี.ค.";}
		if($mm=="04"){$m="เม.ย.";}
		if($mm=="05"){$m="พ.ค.";}
		if($mm=="06"){$m="มิ.ย.";}
		if($mm=="07"){$m="ก.ค.";}
		if($mm=="08"){$m="ส.ค.";}
		if($mm=="09"){$m="ก.ย.";}
		if($mm=="10"){$m="ต.ค.";}
		if($mm=="11"){$m="พ.ย.";}
		if($mm=="12"){$m="ธ.ค.";}
		$y=$yy+543;
		$data = $dd." ".$m." ".$y;
		return $data;
		}else{
		echo "ไม่ระบุวันที่";
		}
		}

		function month($data){
		$day=$data;
		$mm=substr($day,5,2);
		$yy=substr($day,0,4);
		if($mm=="01"){$m="มกราคม";}
		if($mm=="02"){$m="กุมภาพันธ์";}
		if($mm=="03"){$m="มีนาคม";}
		if($mm=="03"){$m="มีนาคม";}
		if($mm=="04"){$m="เมษายน";}
		if($mm=="05"){$m="พฤษภาคม";}
		if($mm=="06"){$m="มิถุนายน";}
		if($mm=="07"){$m="กรกฎาคม";}
		if($mm=="08"){$m="สิงหาคม";}
		if($mm=="09"){$m="กันยายน";}
		if($mm=="10"){$m="ตุลาคม";}
		if($mm=="11"){$m="พฤศจิกายน";}
		if($mm=="12"){$m="ธันวาคม";}
		$y=$yy+543;
		$data = $m." ".$y;
		return $data;
		}




		function DateDiff($strDate1,$strDate2)
	 {
				return (strtotime($strDate2) - strtotime($strDate1))/  ( 60 * 60 * 24 );  // 1 day = 60*60*24
	 }

		function RandomString() {
			  $length = 14;
			  $letters = '1234567890qwertyuiopasdfghjklzxcvbnm';
			  $s = '';
			  $lettersLength = strlen($letters)-1;

			  for($i = 0 ; $i < $length ; $i++)
			  {
			  $s .= $letters[rand(0,$lettersLength)];
			  }
			  return $s;
		  }

}
?>
