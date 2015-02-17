<style>
tr:hover{
background-color:pink;
}
table{
font-size:80%;
text-align:center;
}
th{
color:blue;
}
</style>

<?php
	//customer search page
	session_start();
	include('db_connect.php');


	$type = $_POST['type'];
	$loc = $_POST['location'];
	$startp = $_POST['startprice'];
	$endp = $_POST['endprice'];

	
	//view all cars
		$allcar=$_POST['allcar'];
		if($allcar!='')
		{
			
			$query = "SELECT * FROM Cars where resvid IS NULL ORDER BY CarSN ASC";
			$stmt=oci_parse($conn, $query);
			if($stmt)
			{
				oci_execute($stmt);
			}
			echo "<form name='reserveform' method='post' action='include/confirmResv.php'>\n";
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
		}
		
		if($type!='')
			echo "<b>Type:</b> $type  <br />\n";
		if($loc!='')
			echo "<b>Location:</b> $loc <br />\n";
		if($startp!=''||$endp!='')
		{
			if($startp=='')
				echo "<b>Price:</b> $0~\$$endp<br />\n";
			else if($endp=='')
				echo "<b>Price:</b>\$$startp~$999<br />\n";
			else
				echo"<b>Pric:</b>\$$startp~$$endp<br />\n";
		}
		
	//location is not selected
//begin changes
if($loc == 'all'){

	if(!empty($type) && empty($startp) && empty($endp))
	{
		$query = "SELECT * FROM Cars WHERE Type = :type AND resvid IS NULL";
		$stmt=oci_parse($conn, $query);
		{
			oci_bind_by_name($stmt, ':type', $type);
			oci_execute($stmt);
		}
		echo "<form name='reserveform' method='post' action='include/confirmResv.php'>\n";
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
	
	}
	else if(!empty($type) && !empty($startp) && empty($endp))//filled: type. startp
	{
		$query = "SELECT * FROM Cars WHERE Type = :type AND Price > :startp AND resvid IS NULL";
		$stmt=oci_parse($conn, $query);
		{
			oci_bind_by_name($stmt, ':startp', $startp);
			oci_bind_by_name($stmt, ':type', $type);
			oci_execute($stmt);
		}
	echo "<form name='reserveform' method='post' action='include/confirmResv.php'>\n";
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
	
	}
	else if(!empty($type) && empty($startp) && !empty($endp))//filled:type. endp
	{
		$query = "SELECT * FROM Cars WHERE Type = :type AND Price < :endp AND resvid IS NULL";
		$stmt=oci_parse($conn, $query);
		{
			oci_bind_by_name($stmt, ':endp', $endp);
			oci_bind_by_name($stmt, ':type', $type);
			oci_execute($stmt);
		}
	echo "<form name='reserveform' method='post' action='include/confirmResv.php'>\n";
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
	
	}
	else if(!empty($type) && !empty($startp) && !empty($endp))//filled: type.startp.endp
	{
		$query = "SELECT * FROM Cars WHERE Type = :type AND Price BETWEEN :startp AND :endp AND resvid IS NULL";
		$stmt=oci_parse($conn, $query);
		{
			oci_bind_by_name($stmt, ':type', $type);
			oci_bind_by_name($stmt, ':startp', $startp);
			oci_bind_by_name($stmt, ':endp', $endp);
			oci_execute($stmt);
		}
	echo "<form name='reserveform' method='post' action='include/confirmResv.php'>\n";
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
	
	}
	else if(empty($type) && !empty($startp) && empty($endp))//filled:startp
	{
		$query = "SELECT * FROM Cars WHERE Price > :startp AND resvid IS NULL";
		$stmt=oci_parse($conn, $query);
		{
			oci_bind_by_name($stmt, ':startp', $startp);
			oci_execute($stmt);
		}
	echo "<form name='reserveform' method='post' action='include/confirmResv.php'>\n";
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
	
	}
	else if(empty($type) && empty($startp) && !empty($endp))//filled:endp
	{
		$query = "SELECT * FROM Cars WHERE Price < :endp AND resvid IS NULL";
		$stmt=oci_parse($conn, $query);
		{
			oci_bind_by_name($stmt, ':endp', $endp);
			oci_execute($stmt);
		}
	echo "<form name='reserveform' method='post' action='include/confirmResv.php'>\n";
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
	
	}
	else if(empty($type) && !empty($startp) && !empty($endp))//filled:startp.endp
	{
		$query = "SELECT * FROM Cars WHERE Price BETWEEN :startp AND :endp AND resvid IS NULL";
		$stmt=oci_parse($conn, $query);
		{
			oci_bind_by_name($stmt, ':startp', $startp);
			oci_bind_by_name($stmt, ':endp', $endp);
			oci_execute($stmt);
		}
	echo "<form name='reserveform' method='post' action='include/confirmResv.php'>\n";
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
	
	}
//end changes
//else with "{" are changes
}else{
	//only location is selected
	if(empty($type) && empty($startp) && empty($endp) && !empty($loc))
		{
			$query = "SELECT * FROM Cars WHERE Location = :loc AND resvid IS NULL";
			$stmt=oci_parse($conn, $query);
			{
				oci_bind_by_name($stmt, ':loc', $loc);
				oci_execute($stmt);
				
			}

			
				echo "<form name='reserveform' method='post' action='include/confirmResv.php'>\n";
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
		}//when price is not selected(location and type are selected)
	else if(empty($startp) && empty($endp) && !empty($loc) && !empty($type))
		{
		
			$query = "SELECT * FROM Cars WHERE Location = :loc AND Type = :type";
			$stmt=oci_parse($conn, $query);
			if($stmt)
			{
				oci_bind_by_name($stmt, ':loc', $loc);
				oci_bind_by_name($stmt, ':type', $type);
				oci_execute($stmt);
			}
			echo "<form name='reserveform' method='post' action='include/confirmResv.php'>\n";
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
		}
	else if(empty($startp) && empty($type) && !empty($endp))//EMPTY: type/start price FILLED: loc/end price
		{
			$query = "SELECT * FROM Cars WHERE Location = :loc  AND Price < :endp";
			$stmt=oci_parse($conn, $query);
			if($stmt)
			{
				oci_bind_by_name($stmt, ':loc', $loc);
				oci_bind_by_name($stmt, ':startp', $startp);
				oci_bind_by_name($stmt, ':endp', $endp);
				oci_execute($stmt);
			}
			echo "<form name='reserveform' method='post' action='include/confirmResv.php'>\n";
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
		}

	else if (empty($endp) && empty($type) && !empty($startp))//EMPTY: end price/type FILLED: location/start price
		{
			$query = "SELECT * FROM Cars WHERE Location = :loc AND Price > :startp";
			$stmt=oci_parse($conn, $query);
			if($stmt)
			{
				oci_bind_by_name($stmt, ':loc', $loc);
				oci_bind_by_name($stmt, ':startp', $startp);
				oci_execute($stmt);
			}
			echo "<form name='reserveform' method='post' action='include/confirmResv.php'>\n";
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
		}
	else if (empty($endp) && !empty($type) && !empty($startp))//EMPTY: end price/ FILLED: location/start price/type
		{
			$query = "SELECT * FROM Cars WHERE Type = :type AND Location = :loc AND Price > :startp";
			$stmt=oci_parse($conn, $query);
			if($stmt)
			{
				oci_bind_by_name($stmt, ':loc', $loc);
				oci_bind_by_name($stmt, ':type', $type);
				oci_bind_by_name($stmt, ':startp', $startp);
				oci_execute($stmt);
			}
			echo "<form name='reserveform' method='post' action='include/confirmResv.php'>\n";
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
		}
	else if (!empty($endp) && !empty($type) && empty($startp))//EMPTY: start price/ FILLED: location/end price/type
		{
			$query = "SELECT * FROM Cars WHERE Type = :type AND Location = :loc AND Price < :endp";
			$stmt=oci_parse($conn, $query);
			if($stmt)
			{
				oci_bind_by_name($stmt, ':loc', $loc);
				oci_bind_by_name($stmt, ':type', $type);
				oci_bind_by_name($stmt, ':endp', $endp);
				oci_execute($stmt);
			}
			echo "<form name='reserveform' method='post' action='include/confirmResv.php'>\n";
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
		}
	else if (!empty($endp) && empty($type) && !empty($startp))//EMPTY: type/ FILLED: location/end price/start price
		{
			$query = "SELECT * FROM Cars WHERE Location = :loc AND Price BETWEEN :startp AND :endp";
			$stmt=oci_parse($conn, $query);
			if($stmt)
			{
				oci_bind_by_name($stmt, ':loc', $loc);
				oci_bind_by_name($stmt, ':endp', $endp);
				oci_bind_by_name($stmt, ':startp', $startp);
				oci_execute($stmt);
			}
			echo "<form name='reserveform' method='post' action='include/confirmResv.php'>\n";
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
		}
	else{//if all categories contain information
			$query = "SELECT * FROM Cars WHERE Location = :loc AND Type = :type AND Price BETWEEN :startp AND :endp";
			$stmt=oci_parse($conn, $query);
			if($stmt)
			{
				oci_bind_by_name($stmt, ':loc', $loc);
				oci_bind_by_name($stmt, ':type', $type);
				oci_bind_by_name($stmt, ':startp', $startp);
				oci_bind_by_name($stmt, ':endp', $endp);
				oci_execute($stmt);
			}
			echo "<form name='reserveform' method='post' action='include/confirmResv.php'>\n";
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
		}
		
		
	
	
}
?>