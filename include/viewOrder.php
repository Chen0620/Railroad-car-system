<?php
	session_start();
	include('db_connect.php');
	
	$customid=$_SESSION['uID'];
	
	
	
	/*if(strcmp($_POST['placeorder'],'')!=0)
	{
		$query="INSERT INTO Payments (Method, Total_cost, Customid) VALUES (:method,:total,:customid)";
		$stmt=oci_parse($conn,$query);
		if($stmt)
		{
			oci_bind_by_name($stmt,':method',$pay);
			oci_bind_by_name($stmt,':total',$total);
			oci_bind_by_name($stmt,':customid',$customid);
			oci_execute($stmt);
		}
	}*/
	
	if(strcmp($_SESSION['view'],'')!=0)
	{
		echo "Your Reservation:<br />\n";
		$query="SELECT CUSTOMID,FIRSTNAME,LASTNAME,ADDRESS FROM CUSTOMERS WHERE CUSTOMID=:customid";
		$stmt=oci_parse($conn,$query);
		if($stmt)
		{
			oci_bind_by_name($stmt,':customid',$customid);
			oci_execute($stmt);
			while($row=oci_fetch_array($stmt, OCI_NUM))
			{
				echo "Customer ID: $row[0]<br />Firstname: $row[1]<br />Lastname: $row[2]<br />Address: $row[3]<br />\n";
				
			}
		}
		
		$query="SELECT TRAINNUMBER,DEPARTURECITY,DESTINATIONCITY FROM TRAINS WHERE trainnumber=:customid";
		$stmt=oci_parse($conn,$query);
		if($stmt)
		{
			oci_bind_by_name($stmt,':customid',$customid);
			oci_execute($stmt);
			while($row=oci_fetch_array($stmt, OCI_NUM))
			{
				$trainnumber=$row[0];
				echo "Train Number: $row[0]<br />Departure: $row[1]<br />Destination: $row[2]<br />\n";
			}
		}
		
		
		$query="SELECT CARSN FROM Reservations WHERE CUSTOMID=:customid";
		$stmt=oci_parse($conn,$query);
		if($stmt)
		{
			oci_bind_by_name($stmt,':customid',$customid);
			oci_execute($stmt);
			echo "CarSN: ";
			while($row=oci_fetch_array($stmt,OCI_NUM))
			{
				foreach($row as $col_value)
				{
					echo "$col_value ";
				}
			}
			echo "<br />\n";
		}
		
		$query="SELECT method,TOTAL_COST FROM PAYMENTS WHERE CUSTOMID=:customid";
		$stmt=oci_parse($conn,$query);
		if($stmt)
		{
			oci_bind_by_name($stmt,':customid',$customid);
			oci_execute($stmt);
			while($row=oci_fetch_array($stmt,OCI_NUM))
			{
				echo "Payment Method: $row[0]<br />Total Cost: $row[1]<br />\n";
			}
		}	
	}
	if(strcmp($_SESSION['placeorder'],'')!=0)
	{
		$query="select orderid from finalorder where trainnumber = :trainnumber";
		$stmt=oci_parse($conn,$query);
		if($stmt)
		{
			oci_bind_by_name($stmt,':trainnumber',$trainnumber);
			oci_execute($stmt);
			while($row=oci_fetch_array($stmt,OCI_NUM))
			{	
				$orderid=$row[0];
			}
			if($orderid=='')
			{
				$query="INSERT INTO FINALORDER (TRAINNUMBER) VALUES (:trainnumber)";
				$stmt=oci_parse($conn,$query);
				if($stmt)
				{
					oci_bind_by_name($stmt,':trainnumber',$trainnumber);
					oci_execute($stmt);
				}
			}
		}
	}
?>