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
<style>
tr:hover{
background-color:pink;
}
</style>
<?php

	include("db_connect.php");
	$username=$_SESSION['uName'];
	$utype=$_SESSION['type'];
	$p=$_SESSION['private'];
	
	if($p=='yes')
	{
		
		$query="SELECT * FROM Weblogging WHERE Username=:username AND UserType=:utype ORDER BY LogID desc";
		$stmt=oci_parse($conn,$query);
		if($stmt)
		{
			oci_bind_by_name($stmt,':username',$username);
			oci_bind_by_name($stmt,':utype',$utype);
			oci_execute($stmt);
			echo "<table>\n";
			echo"<thead><tr><th>Log ID</th><th>User Type</th><th>Username</th><th>Date of Change</th><th>Action</th></tr></thead><tbody>";
			while($row=oci_fetch_array($stmt,OCI_NUM))
			{
				echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";
			}
			echo "</tbody></table>\n";
		}
	}
	else
	{
		$query="SELECT * FROM Weblogging WHERE UserType=:utype ORDER BY LogID desc";
		$stmt=oci_parse($conn,$query);
		if($stmt)
		{
			oci_bind_by_name($stmt,':utype',$utype);
			oci_execute($stmt);
			echo "<table>\n";
			echo"<thead><tr><th>Log ID</th><th>User Type</th><th>Username</th><th>Date of Change</th><th>Action</th></tr></thead><tbody>";
			while($row=oci_fetch_array($stmt,OCI_NUM))
			{
				echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";
			}
			echo "</tbody></table>\n";
		}
	}
	oci_free_statement($stmt);
	oci_close($conn);

?>