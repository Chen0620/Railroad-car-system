<style>
#price{
color:LightCoral;
font-size:90%;
}
</style>

<?php
	session_start();
	include('db_connect.php');
	
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
	
	//select all the reserved cars' location into an array 
	$query="SELECT cars.price from (reservations inner join cars on reservations.carsn=cars.carsn) where reservations.customid=:customid";
	$stmt=oci_parse($conn,$query);
	if($stmt)
	{
		oci_bind_by_name($stmt,':customid',$customid);
		oci_execute($stmt);
		$sum=0;
		while($row=oci_fetch_array($stmt, OCI_NUM))
		{
			$sum=$sum+$row[0];
		}
	}
	echo "<div id='price'><b>\n";
	echo "Subtotal(without Tax): \$$sum<br />\n";
	$total=$sum*1.05;
	$_SESSION['totalcost']=$total;
	echo "Total (Plus 5% sales tax): \$$total<br />\n";
	echo "</b></div>";
	
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
			
			$query="INSERT INTO PAYMENTS (TOTAL_COST,CUSTOMID) VALUES (:total,:customid)";
			$stmt=oci_parse($conn,$query);
			if($stmt)
			{
				oci_bind_by_name($stmt,':customid',$customid);
				oci_bind_by_name($stmt,':total',$total);
				oci_execute($stmt);
			}
		}
		else
		{
			
			$query="UPDATE PAYMENTS SET TOTAL_COST=:total WHERE CUSTOMID=:customid";
			$stmt=oci_parse($conn,$query);
			if($stmt)
			{
				oci_bind_by_name($stmt,':customid',$customid);
				oci_bind_by_name($stmt,':total',$total);
				oci_execute($stmt);
			}
		}
		
		
	
?>