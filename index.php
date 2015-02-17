<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="layout.css" />
</head>
<div class="container clear">
<div class="header">
  <?php include('include/_header.php'); ?>
</div>
<div class="navi">
  <?php include('include/_navi.php'); ?>
</div>
<div class="main">
  <?php 
	session_start();
	if($_GET['about'] == 1) 
		include("include/_about.php");
       else 
		include('include/_news.php');
	if($_SESSION['errorFlag']==1)
		include('include/_error.php');
	if(isset($_SESSION['uName']))
	{
		if($_SESSION['utype']=='customer')
			include('Customer.php');
		if($_SESSION['utype']=='administrator')
			include('Administrator.php');
		if($_SESSION['utype']=='conductor'||$_SESSION['utype']=='engineer')
			include('Employee.php');
	}
  ?>
</div>
<div class="ads">
  <?php include('include/_ads.php'); ?>
</div>
<div class="footer">
  <?php include('include/_footer.php'); ?>
</div>
</div>

</html>