<?php
require_once 'config.php';
date_default_timezone_set('Asia/Kolkata');

$sid=$_GET["sid"];

$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$res=mysqli_query($con,"select * from alarmsets where sid='$sid'");
$arr = array();
while($row = $res->fetch_assoc())
{
	$arr[]= $row;
}
$cdate = date('Y-m-d');
$ctime = date('H:i');

echo $cdate," - ", $ctime;
for ($i=0; $i < sizeof($arr); $i++) { 
	if($cdate==$arr[$i]['tdate'])
	{
		if($ctime==$arr[$i]['ttime'])
		{
			$ret = array('check' => 'True');
			return $ret;
		}
	}
}
$ret = array('check' => 'False');
return $ret;

?>