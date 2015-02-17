<?php
include("db_connection.php");
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
} //else echo("Oracle Connection Successful.");
?>