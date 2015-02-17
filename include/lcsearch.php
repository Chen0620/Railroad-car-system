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
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Untitled Document</title>
		<link rel="stylesheet" href="../themes/blue/style.css" type="text/css" id="" media="print, projection, screen" />
		<script type="text/javascript" src="../js/jquery-ui-1.8.17.custom.min.js.js"></script>
		<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
		<script type="text/javascript">
		$(function() {
			$('table').tablesorter();
		});
		</script>
	</head>

<?php
	session_start();
	include('db_connect.php');
	
	$locotype = $_POST['locotype'];
	$locoloc = $_POST['locolocation'];
	$cabtype=$_POST['cabtype'];
	$cabloc=$_POST['cablocation'];

	//view all cars
	$lcallcar=$_POST['lcallcar'];
	if($lcallcar!='')
	{
		$query = "SELECT * FROM locomotives where resvid IS NULL ORDER BY LOCSN ASC";
			$stmt=oci_parse($conn, $query);
			if($stmt)
			{
				oci_execute($stmt);
			}
			echo "<form name='reserveform' method='post' action='include/confirmResv.php'>\n";
			echo"<table>\n";
			echo "<tr><th>Loco Serial Number</th><th>Model</th><th>Engine Type</th><th>Manufacturer</th><th>Location</th><th>Service Date</th><th>Type</th><th>Uses</th><th>Reserve</th></tr>";
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
			
			echo "<br />\n";
		
		$query = "SELECT * FROM Caboose where resvid IS NULL ORDER BY CABSN ASC";
			$stmt=oci_parse($conn, $query);
			if($stmt)
			{
				oci_execute($stmt);
			}
			
			echo"<table>\n";
			echo "<tr><th>Caboose Serial Number</th><th>Model</th><th>Manufacturer</th><th>Location</th><th>Service Date</th><th>Reserve</th></tr>";
			$k=$_SESSION['s'];
			while($row=oci_fetch_array($stmt, OCI_NUM))
			{
				echo"<tr>\n";
				$j=0;
				foreach($row as $col_value)
				{
					echo"<td>$col_value</td>\n";
					if($j==0)
						$_SESSION['carsn'][$k]=$col_value;
					$k++;
				}
				echo "<td><input type='checkbox' name='res[$k]' value='reserve' /></td>\n";
				echo"</tr>\n";
				$i++;
			}
			$_SESSION['s']=$i;
			
			echo"</table>\n";
			oci_free_statement($stmt);
			echo "<input name='reservet' type='submit' value='Reserve these!'/>\n";
			echo "</form><br />\n";
	}
	
?>