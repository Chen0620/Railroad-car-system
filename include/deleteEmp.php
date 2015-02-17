<?php
	session_start();
	include('db_connect.php');
	$deleteEmpID = $_POST['deleteID'];
	
	$query="DELETE FROM Employees WHERE EmpID = '$deleteEmpID'";
	$stmt=oci_parse($conn,$query);
	
	if($_POST[deleteID] != '')
	{
		oci_execute($stmt);
		echo("Successful");
					$act = "Deleted Employee ".$deleteEmpID;
					$query = "INSERT INTO weblogging (Usertype,Username,dateofchange,action) VALUES ('Admin',:username,sysdate,'$act')";
					$stmt = oci_parse($conn,$query);
					if($stmt)
					{
						oci_bind_by_name($stmt,':username',$username);
						oci_execute($stmt);
					}
	}

	
	
	
?>
<form method="POST" action="index.php">
				<p>* are required.</p>
					Employee's ID: <input type="text" name="deleteID" size=20>*<br />
					
					<input type="submit" name="deleteEmp" value="Delete Employee">
				
			</form>