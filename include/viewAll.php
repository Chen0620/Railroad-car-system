<?php
//view all cars

	//customer search page
	session_start();
	include('db_connect.php');


	$type = $_POST['type'];
	$loc = $_POST['location'];
	$startp = $_POST['startprice'];
	$endp = $_POST['endprice'];

	/*if($type!='')
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
	*/
	
	$query = "SELECT * FROM Cars WHERE resvid IS NULL";
	$stmt=oci_parse($conn, $query);
	oci_execute($stmt);
	echo"<table>\n";
			echo "<tr><th>Car Serial Number</th><th>Model</th><th>Manufacturer</th><th>Location</th><th>Service Date</th><th>Type</th><th>Max Weight</th><th>Price</th></tr>";
			while($row=oci_fetch_array($stmt, OCI_NUM))
			{
			echo"<tr>\n";
			foreach($row as $col_value)
				echo"<td>$col_value</td>\n";
			echo"</tr>\n";
			}
			echo"</table>\n";
			oci_free_statement($stmt);
	
	
?>