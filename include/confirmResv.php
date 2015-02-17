<?php
	session_start();
	include('db_connect.php');

	$re=$_POST['res'];
	$nrow=count($re);
	$reserve=$_POST['reservet'];
	$i=$_SESSION['s'];
	
	
	$query="INSERT INTO TRAINS (TRAINNUMBER) VALUES (:trainnumber)";
	$stmt=oci_parse($conn,$query);
	if($stmt)
	{
		oci_bind_by_name($stmt,':trainnumber',$customid);
		oci_execute($stmt);
	}
	
	$customid=$_SESSION['uID'];
	
	if($reserve!='')
	{
		$num=0;
		for($num=0;$num<$i;$num++)
		{
			if($re[$num]!='')
			{
				$carsn=$_SESSION['carsn'][$num];
				//echo "Reservered: $carsn <----- $num<br />";
				
				//reserve
				$query="INSERT INTO Reservations (CarSN,CustomID,trainnumber,RESERVATION_DATE) VALUES (:carsn, :customid, :trainnumber,sysdate)";
				$stmt=oci_parse($conn,$query);
				if($stmt)
				{
					oci_bind_by_name($stmt,':carsn',$carsn);
					oci_bind_by_name($stmt,':customid',$customid);
					oci_bind_by_name($stmt,':trainnumber',$customid);
					oci_execute($stmt);
				}
				$_SESSION['trainnumber']=$customid;
				
				//return the resvid of the car selected
				$query="SELECT RESVID from Reservations WHERE CustomID=:customid";
				$stmt=oci_parse($conn,$query);
				if($stmt)
				{
					oci_bind_by_name($stmt,':customid',$customid);
					oci_execute($stmt);
					while($row=oci_fetch_array($stmt, OCI_NUM))
					{
						$selectedresvid=$row[0];
					}
				}
				
				//assign resrID to the car selected
				$query="update CARS set RESVID=:resvid,CUSTOMID=:customid WHERE CARSN=:carsn";
				$stmt=oci_parse($conn,$query);
				if($stmt)
				{
					oci_bind_by_name($stmt,':customid',$customid);
					oci_bind_by_name($stmt,':resvid',$selectedresvid);
					oci_bind_by_name($stmt,':carsn',$carsn);
					oci_execute($stmt);
				}
			}
		}
	}
	$_SESSION['reserved']=1;
	header('Location:../index.php');
?>