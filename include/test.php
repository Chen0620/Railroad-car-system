<style>
tr:hover{
background-color:pink;
}
</style>

<?php
	session_start();
	include('db_connect.php');
	
	$type='Flat bed';
	
	$query = "SELECT * FROM Cars WHERE Type = :type AND resvid IS NULL";
		$stmt=oci_parse($conn, $query);
		{
			oci_bind_by_name($stmt, ':type', $type);
			oci_execute($stmt);
		}
	echo "<form name='reserveform' method='post' action='test.php'>\n";
	echo"<table>\n";
			echo "<tr><th>Car Serial Number</th><th>Model</th><th>Manufacturer</th><th>Location</th><th>Service Date</th><th>Type</th><th>Max Weight</th><th>Price</th><th>Reserve</th></tr>";
			$i=0;
			while($row=oci_fetch_array($stmt, OCI_NUM))
			{
				echo"<tr>\n";
				$j=0;
				foreach($row as $col_value)
				{
					echo"<td>$col_value</td>\n";
					if($j==0)
						$_SESSION['carsn'][$i]=$col_value;
					$j++;
				}
				echo "<td><input type='checkbox' name='res[$i]' value='reserve' /></td>\n";
				echo"</tr>\n";
				$i++;
			}
			$_SESSION['s']=$i;
			echo"</table>\n";
			oci_free_statement($stmt);
			echo "<input name='reservet' type='submit' value='Reserve these!'/>\n";
			echo "</form><br />\n";
			
	$re=$_POST['res'];
	$nrow=count($re);

	$reserve=$_POST['reservet'];
	$i=$_SESSION['s'];

	if($reserve!='')
	{
		$num=0;
		echo "i=$i<br />\n";
		for($num=0;$num<$i;$num++)
		{
			if($re[$num]!='')
			{
				$carsn=$_SESSION['carsn'][$num];
				echo "Reservered: $carsn <----- $num<br />";
			}
		}
	
	}
?>