<head>
<script type="text/javascript" src="jquery-latest.js"></script>
<script type="text/javascript" src="jquery.metadata.js"></script>
<script type="text/javascript" src="jquery.tablesorter.js"></script>
<script type="text/javascript" src="jquery.tablesorter.min.js"></script>

<script type="text/javascript" src="http://babbage.cs.missouri.edu/~cs3380sp12grp3/cms%20project/js/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="http://babbage.cs.missouri.edu/~cs3380sp12grp3/cms%20project/js/jquery.tablesorter.js">
$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 
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

echo ("<h2>Display Cars</h2>");
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