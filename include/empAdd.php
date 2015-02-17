<?php
	session_start();
	include('db_connect.php');
	
	$username=$_POST['usr_name'];
	$fname=$_POST['f_name'];
	$lname=$_POST['l_name'];
	$p1=sha1($_POST['usr_pass']);
	$p2=sha1($_POST['usr_pass2']);
	$salt = md5("AlpineStars");
	$hashedp1=sha1($salt.$p1);
	$hashedp2=sha1($salt.$p2);
	$ssn=$_POST['ssn'];
	$empdate=$_POST['empdate'];
	$dep=$_POST['department'];
	
	$query="INSERT INTO Employees (Firstname,Lastname,Employment_Date,Username,Password,SSN,Department) VALUES (:fname,:lname,:empdate,:username,:hashedp1,:ssn,:dep)";
	
	$stmt=oci_parse($conn,$query);
	if($stmt)
	{
		oci_bind_by_name($stmt,':fname',$fname);
		oci_bind_by_name($stmt,':lname',$lname);
		oci_bind_by_name($stmt,':empdate',$empdate);
		oci_bind_by_name($stmt,':username',$username);
		oci_bind_by_name($stmt,':hashedp1',$hashedp1);
		oci_bind_by_name($stmt,':ssn',$ssn);
		oci_bind_by_name($stmt,':dep',$dep);
		oci_execute($stmt);
					$act = "Created Employee ".$username;
					$query = "INSERT INTO weblogging (Usertype,Username,dateofchange,action) VALUES ('Admin',:username,sysdate,'$act')";
					$stmt = oci_parse($conn,$query);
					if($stmt)
					{
						oci_bind_by_name($stmt,':username',$username);
						oci_execute($stmt);
					}
	}
	
	$query="SELECT * FROM Employees WHERE Username=:username";
	$stmt=oci_parse($conn,$query);
	if($stmt)
	{
		oci_bind_by_name($stmt,':username',$username);
		oci_execute($stmt);
		while($row=oci_fetch_array($stmt,OCI_NUM))
		{
			echo "Employee ID: " . $row[0]."<br />\n";
			echo "Firstname: " . $row[1]."<br />\n";
			echo "Lastname: " . $row[2]."<br />\n";
			echo "Employment Date: " . $row[3]."<br />\n";
			echo "Username: " . $row[4]."<br />\n";
			echo "SSN: " . $row[6]."<br />\n";
			echo "Department: " . $row[7]."<br />\n";
		}
	}
?>