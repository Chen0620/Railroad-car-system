
<?php
session_start();
$_SESSION[uName] = "Test";
$_SESSION[admin] = 1;
$_SESSION[conductor] = 1;
$_SESSION[engineer] = 1;
$_SESSION[employee] = 1;
header("Location: index.php");
?>