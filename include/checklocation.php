<style>
#locerror{
color:red;
font-size:80%;
}

</style>

<?php
	session_start();
	include('db_connect.php');
	$customid=$_SESSION['uID'];
	
	//select all the reserved cars' location into an array 
	$query="SELECT cars.location from (reservations inner join cars on reservations.carsn=cars.carsn) where reservations.customid=:customid";
	$stmt=oci_parse($conn,$query);
	if($stmt)
	{
		oci_bind_by_name($stmt,':customid',$customid);
		oci_execute($stmt);
		$i=0;
		//echo "<table>\n";
		//echo "<tr><th>Location</th></tr>\n";
		while($row=oci_fetch_array($stmt, OCI_NUM))
		{
			//echo "<tr>\n";
			$loc[$i]=$row[0];
			//echo "<td>$loc[$i]</td>\n";
			//echo "</tr>\n";
			$i++;
		}
		$total=$i;
	}
	$j=0;
	for($i=0;$i<$total;$i++)
	{
		for($j=0;$j<$total;$j++)
		{
			if($loc[$i]!=$loc[$j])
			{
				$_SESSION['locFlag']=1;
			}
		}
	}
	if($_SESSION['locFlag']==1)
	{
		echo "<div id='locerror'><b>Your cars do not in the same city. Please change your reservation.</b></div>";
		$_SESSION['locFlag']=0;
	}
	else
	{
		$_SESSION['departure']=$loc[0];
		echo "Departure city: $loc[0] <br />\n";
		
	}
?>