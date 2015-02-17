<?php
	// Login Script
	session_start();
	include('db_connect.php');
	$_SESSION['errorFlag']=false;
	$_SESSION['login']=1;
	
	$salt = md5("AlpineStars");
	$hashed = sha1($_POST['usr_pass']);
	$hashedpass = sha1($salt.$hashed);
	$username=$_POST['usr_name'];
	$emptypass=sha1('');
	$usertype=$_POST['usertype'];

	if($username=='') 
	{
		$_SESSION["error[0]"] = 'Please insert your username.';
		$_SESSION['errorFlag']= true;
	}
	if(strcmp($hashed,$emptypass)==0) 
	{
		$_SESSION["error[4]"] = 'Please insert your Password.';
		$_SESSION['errorFlag']= true;
	}
	if($usertype=='')
	{
		$_SESSION["error[5]"] = 'Please select a user type.';
		$_SESSION['errorFlag']= true;
	}
	if($_SESSION['errorFlag']==1)
		header('Location:../index.php');
	else
	{
		if($usertype=='customer')
		{
			$query = "SELECT Username,Password FROM Customers WHERE Username=:username AND Password=:hashedpass";
			$stmt=oci_parse($conn,$query);
			if($stmt)
			{
				oci_bind_by_name($stmt,':username',$username);
				oci_bind_by_name($stmt,':hashedpass',$hashedpass);
				oci_execute($stmt);
				$nrow=oci_fetch_all($stmt,$result);
				oci_free_statement($stmt);
				if($nrow==0)
				{
					$_SESSION["error[4]"]='Your username does not match password or username does not exists.';
					$_SESSION['errorFlag']= true;
					header('Location:../index.php');
				}
				else
				{
					$_SESSION['uName']=$username;
					$_SESSION['utype']=customer;
					header('Location:../index.php');
					$act = "User Logged In";
					$query = "INSERT INTO weblogging (Usertype,Username,dateofchange,action) VALUES ('Customer',:username,sysdate,'$act')";
					$stmt = oci_parse($conn,$query);
					if($stmt)
					{
						oci_bind_by_name($stmt,':username',$username);
						oci_execute($stmt);
					}
				}
			}
			$username=$_SESSION['uName'];
			$query="SELECT CustomID from Customers WHERE Username=:username";
			$stmt=oci_parse($conn,$query);
			if($stmt)
			{
				oci_bind_by_name($stmt,':username',$username);
				oci_execute($stmt);
				while($row=oci_fetch_array($stmt, OCI_NUM))
				{
					$customid=$row[0];
					$_SESSION['uID']=$customid;
				}
			}
			
		}
		if($usertype=='admin')
		{
			$query = "SELECT Username,Password FROM Employees WHERE Username=:username AND Password=:hashedpass AND Department='administrator'";
			$stmt=oci_parse($conn,$query);
			if($stmt)
			{
				oci_bind_by_name($stmt,':username',$username);
				oci_bind_by_name($stmt,':hashedpass',$hashedpass);
				oci_execute($stmt);
				$nrow=oci_fetch_all($stmt,$result);
				oci_free_statement($stmt);
				if($nrow==0)
				{
					$_SESSION["error[4]"]='Your username does not match password or username does not exists.';
					$_SESSION['errorFlag']= true;
					header('Location:../index.php');
				}
				else
				{
					$_SESSION['uName']=$username;
					$_SESSION['utype']='administrator';
					//include("_insertWeblog.php?usr_action=\"User Logged In\"");
					//INSERT INTO weblogging (Usertype,Username,dateofchange,action) VALUES (1,Jim,sysdate,'User Logged In')
					$act = "User Logged In";
					$query = "INSERT INTO weblogging (Usertype,Username,dateofchange,action) VALUES ('Admin',:username,sysdate,'$act')";
					 $stmt = oci_parse($conn,$query);
					 if($stmt)
					 {
						 oci_bind_by_name($stmt,':username',$username);
						 oci_execute($stmt);
					 }
					header('Location:../index.php');
				}
			}
		}
		if($usertype=='engineer')
		{
			$query = "SELECT Username,Password FROM Employees WHERE Username=:username AND Password=:hashedpass AND Department='Engineer'";
			$stmt=oci_parse($conn,$query);
			if($stmt)
			{
				oci_bind_by_name($stmt,':username',$username);
				oci_bind_by_name($stmt,':hashedpass',$hashedpass);
				oci_execute($stmt);
				$nrow=oci_fetch_all($stmt,$result);
				oci_free_statement($stmt);
				if($nrow==0)
				{
					$_SESSION["error[4]"]='Your username does not match password or username does not exists.';
					$_SESSION['errorFlag']= true;
					header('Location:../index.php');
				}
				else
				{
					$_SESSION['uName']=$username;
					$_SESSION['utype']='engineer';
					//include("_insertWeblog.php?usr_action=\"User Logged In\"");
					//INSERT INTO weblogging (Usertype,Username,dateofchange,action) VALUES (1,Jim,sysdate,'User Logged In')
					$act = "User Logged In";
					$query = "INSERT INTO weblogging (Usertype,Username,dateofchange,action) VALUES ('Admin',:username,sysdate,'$act')";
					 $stmt = oci_parse($conn,$query);
					 if($stmt)
					 {
						 oci_bind_by_name($stmt,':username',$username);
						 oci_execute($stmt);
					 }
					header('Location:../index.php');
				}
			}
		}
		if($usertype=='conductor')
		{
			$query = "SELECT Username,Password FROM Employees WHERE Username=:username AND Password=:hashedpass AND Department='Conductor'";
			$stmt=oci_parse($conn,$query);
			if($stmt)
			{
				oci_bind_by_name($stmt,':username',$username);
				oci_bind_by_name($stmt,':hashedpass',$hashedpass);
				oci_execute($stmt);
				$nrow=oci_fetch_all($stmt,$result);
				oci_free_statement($stmt);
				if($nrow==0)
				{
					$_SESSION["error[4]"]='Your username does not match password or username does not exists.';
					$_SESSION['errorFlag']= true;
					header('Location:../index.php');
				}
				else
				{
					$_SESSION['uName']=$username;
					$_SESSION['utype']='conductor';
					//include("_insertWeblog.php?usr_action=\"User Logged In\"");
					//INSERT INTO weblogging (Usertype,Username,dateofchange,action) VALUES (1,Jim,sysdate,'User Logged In')
					$act = "User Logged In";
					$query = "INSERT INTO weblogging (Usertype,Username,dateofchange,action) VALUES ('Admin',:username,sysdate,'$act')";
					 $stmt = oci_parse($conn,$query);
					 if($stmt)
					 {
						 oci_bind_by_name($stmt,':username',$username);
						 oci_execute($stmt);
					 }
					header('Location:../index.php');
				}
			}
		}
	}
?>