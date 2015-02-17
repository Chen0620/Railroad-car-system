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
  <?php if($_GET['about'] == 1) include("include/_about.php");
                            else include('include/_admin.php'); ?>
</div>
<div class="ads">
  <?php include('include/_ads.php'); ?>
</div>
<div class="footer">
  <?php include('include/_footer.php'); ?>
</div>
</div>

</html>