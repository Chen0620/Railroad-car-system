<?php
	session_start();
	include('db_connect.php');
	
	$username=$_SESSION['uName'];
	$dest=$_SESSION['dest'];
	$dep=$_SESSION['departure'];
	$pay=$_SESSION['paymethod'];
	
	
	if(strcmp($_POST['view'],'')==0)
	{
		$query="select customid from customers where username=:username";
		$stmt=oci_parse($conn,$query);
		if($stmt)
		{
			oci_bind_by_name($stmt,':username',$username);
			oci_execute($stmt);
			while($row=oci_fetch_array($stmt, OCI_NUM))
				$_SESSION['uID']=$row[0];
		}
		$customid=$_SESSION['uID'];
		$trainnumber=$_SESSION['uID'];
		
		$choose=$_POST['destcity'];
		//insert dest$dep into trains table
		$query="SELECT TRAINNUMBER FROM TRAINS WHERE TRAINNUMBER=:customid";
		$stmt=oci_parse($conn,$query);
		oci_bind_by_name($stmt,':customid',$customid);
		oci_execute($stmt);
		while($row=oci_fetch_array($stmt, OCI_NUM))
				$id=$row[0];
		
		if($id=='')
		{
			$query="INSERT INTO TRAINS (DEPARTURECITY,DESTINATIONCITY, TRAINNUMBER) VALUES (:dep,:dest,:customid)";
			$stmt=oci_parse($conn,$query);
			if($stmt)
			{
				oci_bind_by_name($stmt,':customid',$customid);
				oci_bind_by_name($stmt,':dep',$dep);
				oci_bind_by_name($stmt,':dest',$dest);
				oci_execute($stmt);
			}
		}
		else
		{
			
			$query="UPDATE TRAINS SET DEPARTURECITY=:dep, DESTINATIONCITY=:dest WHERE TRAINNUMBER=:trainnumber";
			$stmt=oci_parse($conn,$query);
			if($stmt)
			{
				oci_bind_by_name($stmt,':trainnumber',$trainnumber);
				oci_bind_by_name($stmt,':dep',$dep);
				oci_bind_by_name($stmt,':dest',$dest);
				oci_execute($stmt);
			}
		}
		
		/*
			$query="SELECT DESTINATIONCITY from Trains where trainnumber=:trainnumber";
			$stmt=oci_parse($conn,$query);
			if($stmt)
			{
				oci_bind_by_name($stmt,':trainnumber',$trainnumber);
				oci_execute($stmt);
				while($row=oci_fetch_array($stmt, OCI_NUM))
				{
					$_SESSION['dest']=$row[0];
					$dest=$_SESSION['dest'];
				}
			}
		*/
		$choosepay=$_SESSION['paymethod'];
		
		if($choosepay!='')
		{
			$query="SELECT CUSTOMID from payments WHERE CUSTOMID=:customid";
			$stmt=oci_parse($conn,$query);
			if($stmt)
			{
				oci_bind_by_name($stmt,':customid',$customid);
				oci_execute($stmt);
				while($row=oci_fetch_array($stmt, OCI_NUM))
				{
					$id=$row[0];
				}
			}
			
			if($id=='')
			{
				
				$query="INSERT INTO PAYMENTS (method,CUSTOMID) VALUES (:method,:customid)";
				$stmt=oci_parse($conn,$query);
				if($stmt)
				{
					oci_bind_by_name($stmt,':customid',$customid);
					oci_bind_by_name($stmt,':method',$choosepay);
					oci_execute($stmt);
				}
			}
			else
			{
				
				$query="UPDATE PAYMENTS SET METHOD=:method WHERE CUSTOMID=:customid";
				$stmt=oci_parse($conn,$query);
				oci_execute($stmt);
				if($stmt)
				{
					oci_bind_by_name($stmt,':customid',$customid);
					oci_bind_by_name($stmt,':method',$choosepay);
					oci_execute($stmt);
				}
			}
			
			
		}
	}
	
	
?>