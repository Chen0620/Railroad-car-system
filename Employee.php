<?php
	session_start();
	$u=$_SESSION['uName'];
	echo "<b>Welcome Employee $u!</b>";

?>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.17.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#accordion').accordion();
		$("#tabs").tabs();
	});
</script>

<div id="tabs">
    <ul>
        <li><a href="#fragment-1"><span>Personal Info</span></a></li>
		<li><a href="#fragment-2"><span>My Assignments</span></a></li>
		<li><a href="#fragment-3"><span>My Web Logging</span></a></li>
    </ul>
    <div id="fragment-1">
        <p>You can view and edit your personal information here.</p>
		<?php
			session_start();
			
			include('include/empPersInfo.php');
		?>
    </div>
	<div id="fragment-2">
        <p>You can view your train assignments here with all detail informatoin.</p>
		<?php
			session_start();
			include('include/db_connect.php');
			$empid=$_SESSION['uID'];
			
			$query="SELECT TRAINNUMBER FROM FINALORDER WHERE EMPID=:empid";
			$stmt=oci_parse($conn,$query);
			if($stmt)
			{
				oci_bind_by_name($stmt,':empid',$empid);
				oci_execute($stmt);
				while($row=oci_fetch_array($stmt, OCI_NUM))
					$trainnumber=$row[0];
				if($trainnumber!='')
					echo "You have been assigned to Train Number: $trainnumber.<br />\n";
				else
					echo "You have not been assigned to any trains yet.<br />\n";
			}
		
		?>
    </div>
	<div id="fragment-3">
        <p>You can view your web logging info here since your registration.</p>
		<?php 
		session_start();
		include('include/db_connect.php');
		$username=$_SESSION['uName'];
		
		$act='Employee Logged in';
		$query = "INSERT INTO weblogging (Usertype,Username,dateofchange,action) VALUES ('Employee',:username,sysdate,'$act')";
		$stmt = oci_parse($conn,$query);
		if($stmt)
		{
			oci_bind_by_name($stmt,':username',$username);
			oci_execute($stmt);
		}
		
		$query="SELECT logid,usertype,username,action,dateofchange FROM weblogging WHERE USERNAME=:username AND USERTYPE='Employee' ORDER BY LOGID DESC";
		$stmt = oci_parse($conn,$query);
		if($stmt)
		{
			oci_bind_by_name($stmt,':username',$username);
			oci_execute($stmt);
			echo "<table>\n";
			echo "<tr><th>Log ID</th><th>Usertype</th><<th>Username</th><th>Action</th><th>Date of Change</th></tr>";
			while($row=oci_fetch_array($stmt, OCI_NUM))
			{
				echo "<tr>";
				foreach($row as $col_value)
					echo "<td>$col_value</td>\n";
				echo "</tr>";
			}
			echo "</table>";
		}
		
	?>
    </div>
	
	
		
</div>
