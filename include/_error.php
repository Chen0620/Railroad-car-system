<?php
	session_start();
	if($_SESSION['errorFlag']==1)
	{
		for($i=0;$i<=6;$i++)
			$err[$i]=$_SESSION["error[$i]"];
		echo "<p class='error'>\n";
		foreach($err as $msg)
		{
			if($msg!='') 
				echo "$msg<br />\n"; 
		}
		echo "</p>\n";
	}
	if($_SESSION['login']==1)
		include('../login.php');
	else
		include('_register.php');
	session_destroy();
?>