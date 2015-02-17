<?php

$conn = oci_new_connect("cs3380sp12grp3","WyJNKXEV","dbase1");
if (!$conn) {
	$e = oci_error();
	die("Failed to connect: " . $e['message']);
}

?>
