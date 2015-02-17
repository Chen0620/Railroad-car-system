<?php
session_start();
include("../db_connect.php");

$userAction = $_GET[usr_action];

$conn = oci_new_connect("cs3380sp12grp3","WyJNKXEV","dbase1");
if (!$conn) {
	$e = oci_error();
	die("Failed to connect: " . $e['message']);
}
$query = "INSERT INTO weblogging (Usertype,Username,dateofchange,action)
		VALUES (1,'$_SESSION[uName]',sysdate,$userAction)";
$stmt = oci_parse($conn,$query);
oci_execute($stmt);

oci_free_statement($stmt);
oci_close($conn);

//INSERT INTO weblogging (Usertype,Username,dateofchange) VALUES (1,'$_SESSION[uName]',now())
?>