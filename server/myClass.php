<?php
require_once 'config.php';
date_default_timezone_set('Asia/Kolkata');
class myClass
{
	public function login($user,$pass)
	{
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$res=mysqli_query($con,"select pass from users where user = '$user'");
		$data = mysqli_fetch_array($res);
		if($pass==$data[0])
			$arr=array('check' => 'True');
		else
			$arr=array('check' => 'False');
		return $arr;	
		mysqli_close($con);	
	}

	public function showItems()
	{
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$res=mysqli_query($con,"select * from items");
		$arr = array();
		while($row = $res->fetch_assoc())
		{
			$arr[]= $row;
		}
		return $arr;
		mysqli_close($con);	
	}

	public function showItem($id)
	{
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$res=mysqli_query($con,"select * from items where id= $id");
		$arr = array();
		while($row = $res->fetch_assoc())
		{
			$arr[]= $row;
		}
		return $arr;
		mysqli_close($con);	
	}

	public function IssuedList()
	{
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$res=mysqli_query($con,"select items.id, items.name, description, box, vendor, location from items join issued using (id) GROUP by id");
		$arr = array();
		while($row = $res->fetch_assoc())
		{
			$arr[]= $row;
		}
		return $arr;
		mysqli_close($con);	
	}

	public function RejectedList()
	{
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$res=mysqli_query($con,"select items.id, items.name, description, items.box, vendor, location from items join rejected using (id) GROUP by id ");
		$arr = array();
		while($row = $res->fetch_assoc())
		{
			$arr[]= $row;
		}
		return $arr;
		mysqli_close($con);	
	}

	public function showIssued($id)
	{
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$res=mysqli_query($con,"select * from issued where id= $id");
		$arr = array();
		while($row = $res->fetch_assoc())
		{
			$arr[]= $row;
		}
		return $arr;
		mysqli_close($con);	
	}

	public function showRejected($id)
	{
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$res=mysqli_query($con,"select * from rejected where id= $id");
		$arr = array();
		while($row = $res->fetch_assoc())
		{
			$arr[]= $row;
		}
		return $arr;
		mysqli_close($con);	
	}	
	
	public function updateItem($id,$quantity,$box,$vendor,$location,$addby)
	{
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$cdate = date('Y-m-d');
		$res=mysqli_query($con,"update items set quantity = $quantity, box='$box', vendor='$vendor', location='$location',addby='$addby', adate='$cdate' where id = $id");
		if($res)
			$arr=array('check' => 'True');
		else
			$arr=array('check' => 'False');
		return $arr;
		mysqli_close($con);			
	}

	public function addItem($img,$name,$desc,$price,$quantity,$box,$vendor,$location,$addby)
	{
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$cdate = date('Y-m-d');
		$res=mysqli_query($con,"insert into items(name,description,price,img,box,vendor,location,quantity,addby,adate) values ('$name','$desc','$price','$img','$box','$vendor','$location',$quantity,'$addby','$cdate')");
		if($res)
			$arr=array('check' => 'True');
		else
			$arr=array('check' => 'False');
		return $arr;
		mysqli_close($con);	
	}	

	public function delItem($id)
	{
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$res=mysqli_query($con,"delete from items where id = $id");
		if($res)
			$arr=array('check' => 'True');
		else
			$arr=array('check' => 'False');
		return $arr;
		mysqli_close($con);	
	}	

	public function rejectItem($id,$quantity,$box,$desc)
	{
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$cdate = date('Y-m-d');
		$q1=mysqli_query($con,"update items set quantity = quantity - $quantity where id = $id");
		$q2=mysqli_query($con,"insert into rejected(id, quantity, box, rdesc, idate) values($id,$quantity,'$box','$desc','$cdate');");
		if($q1 and $q2)
			$arr=array('check' => 'True');
		else
			$arr=array('check' => 'False');
		return $arr;
		mysqli_close($con);	
	}	

	public function issueItem($id,$quantity,$name,$desc)
	{
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$cdate = date('Y-m-d');
		$q1=mysqli_query($con,"update items set quantity = quantity - $quantity where id = $id");
		$q2=mysqli_query($con,"insert into issued(id, quantity, name, idesc, idate) values($id,$quantity,'$name','$desc','$cdate');");
		if($q1 and $q2)
			$arr=array('check' => 'True');
		else
			$arr=array('check' => 'False');
		return $arr;
		mysqli_close($con);	
	}

	public function submitedItem($id)
	{
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$q1=mysqli_query($con,"select id, quantity from issued where issueid = $id");
		if($q1)
		{
			$data = mysqli_fetch_array($q1);
			$q1=mysqli_query($con,"update items set quantity = quantity + $data[1] where id = $data[0]");
			$q2=mysqli_query($con,"delete from issued where issueid = $id");
			if($q2)
				$arr=array('check' => 'True');
		}
		else
			$arr=array('check' => 'False');
		return $arr;
		mysqli_close($con);	
	}

	public function addUser($user,$pass)
	{
		$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$res=mysqli_query($con,"insert into users values ('$user','$pass')");
		if($res)
			$arr=array('check' => 'True');
		else
			$arr=array('check' => 'False');
		return $arr;
		mysqli_close($con);	
	}
}
?>