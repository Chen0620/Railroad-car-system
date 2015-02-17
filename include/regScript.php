<?php
	session_start();
	include('db_connect.php');
	$_SESSION['errorFlag']=false;
	
	$username=$_POST['usr_name'];
	$firstname=$_POST['f_name'];
	$lastname=$_POST['l_name'];
	$address=$_POST['address'];
	$psw1=$_POST['usr_pass'];
	$psw2=$_POST['usr_pass2'];
	$_SESSION['login']=0;
	
	//check if all required fields are not null
	if($username=='') 
	{
		$_SESSION["error[0]"] = 'Please insert your username.';
		$_SESSION['errorFlag']= true;
	}
	if($firstname=='') 
	{
		$_SESSION["error[1]"]  = 'Please insert your firstname.';
		$_SESSION['errorFlag']= true;
	}
	if($lastname=='')
	{
		$_SESSION["error[2]"] ='Please insert your lastname.';
		$_SESSION['errorFlag']=true;
	}
	if($address=='') 
	{
		$_SESSION["error[3]"]  = 'Please insert your address.';
		$_SESSION['errorFlag']= true;
	}
	if($_POST['usr_pass']==''||$_POST['usr_pass2']=='') 
	{
		$_SESSION["error[4]"]  = 'Please insert your password.';
		$_SESSION['errorFlag']= true;
	}
	if($_SESSION['errorFlag']==1)
		header('Location:../index.php');

	if(strcmp("$psw1","$psw2")!=0) 
	{
		$_SESSION["error[5]"]  = 'Your passwords do not match!';
		$_SESSION['errorFlag']= true;
	}
	
	$query="SELECT Username FROM Customers WHERE Username=:usrname";
	
	$stmt=oci_parse($conn,$query);
	if($stmt)//security
	{
		oci_bind_by_name($stmt,':usrname',$username);
		oci_execute($stmt);
		$num = oci_fetch_all($stmt,$result);
		if( $num!=0)
		{ 
			$_SESSION["error[6]"]  ='Username Is Already in use, Please select a different Username.';
			$_SESSION['errorFlag']= true;
					$act = "Account Creation Failed";
					$query = "INSERT INTO weblogging (Usertype,Username,dateofchange,action) VALUES (1,'$username',sysdate,'$act')";
					 $stmt = oci_parse($conn,$query);
					 oci_execute($stmt);
		}
	}
	
	if($_SESSION['errorFlag']==1)
		header('Location:../index.php');
	else
	{
		$salt = md5("AlpineStars");
		$hashed = sha1($_POST[usr_pass]);
		$hashedpass = sha1($salt.$hashed);
		
		$query = "INSERT INTO Customers (Username,Firstname,Lastname,Password,Address) VALUES (:username,:firstname,:lastname,:hashedpass,:address)";
		$stmt=oci_parse($conn,$query);
		if($stmt)
		{
			oci_bind_by_name($stmt,':firstname',$firstname);
			oci_bind_by_name($stmt,':lastname',$lastname);
			oci_bind_by_name($stmt,':username',$username);
			oci_bind_by_name($stmt,':hashedpass',$hashedpass);
			oci_bind_by_name($stmt,':address',$address);
			oci_execute($stmt);
		}
		oci_free_statement($stmt);
		//include("include/_insertWeblog.php?usr_action=\"Account Created\"");
		$act = "Account Created";
		$query = "INSERT INTO weblogging (Usertype,Username,dateofchange,action) VALUES (Customer,:username,sysdate,'$act')";
		$stmt = oci_parse($conn,$query);
		if($stmt)
		{
			oci_bind_by_name($stmt,':username',$username);
			oci_execute($stmt);
		}
		header('Location: ../index.php');
	} 
	 
?>