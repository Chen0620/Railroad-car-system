	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Untitled Document</title>
		<link rel="stylesheet" href="../../themes/blue/style.css" type="text/css" id="" media="print, projection, screen" />
		<script type="text/javascript" src="../../js/jquery-ui-1.8.17.custom.min.js.js"></script>
		<script type="text/javascript" src="../../js/jquery.tablesorter.js"></script>
		<script type="text/javascript">
		$(function() {
			$('table').tablesorter();
		});
		</script>
	</head>
<?php

include("../db_connect.php");

$conn = oci_new_connect("cs3380sp12grp3","WyJNKXEV","dbase1");
if (!$conn) {
	$e = oci_error();
	die("Failed to connect: " . $e['message']);
}

$query = "SELECT CarSN,Model,Location,servicedate,type,resvid FROM Cars";
$stmt = oci_parse($conn,$query);
oci_execute($stmt);

echo ("<h2>Display Customers</h2>");
echo ("<table id=\"myTable\" class=\"tablesorter\" border=1>");
echo("<thead><th>Serial Number</th><th>Model</th><th>Location</th><th>Last Service Date</th><th>Type</th><th>Resvation ID</th></thead><tbody>");
while ($row = oci_fetch_array($stmt, OCI_BOTH)) {
    // Use the uppercase column names for the associative array indices
    echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td></tr>";
}
echo ("</tbody></table>");

oci_free_statement($stmt);
oci_close($conn);

?>