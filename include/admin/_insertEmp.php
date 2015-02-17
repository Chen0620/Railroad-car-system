<?php
include("../db_connect.php");

$conn = oci_new_connect("cs3380sp12grp3","WyJNKXEV","dbase1");
if (!$conn) {
	$e = oci_error();
	die("Failed to connect: " . $e['message']);
}
$query = "INSERT INTO cars (Firstname,Lastname,EMPLOYMENT_Date,Username,Password,SSN,Department)
		VALUES ('$_POST[model]','$_POST[manuf]','$_POST[loc]','$_POST[svdate]','$_POST[type]','$_POST[maxweight]','$_POST[dept]')";
$stmt = oci_parse($conn,$query);
if($_POST[EmpID] != '') oci_execute($stmt);

oci_free_statement($stmt);
oci_close($conn);
?>
<h1>Add Employee</h1>
<table>
	<form method="POST">
		<p>* are required.</p>
		<tr><td>
			First Name: </td><td><input type="text" name="model" size=40">*
		</tr></td>
		<tr><td>
			Last Name: </td><td><input type="text" name="manuf" size=40">*
		</tr></td>
		<tr><td>
			Employment Date: </td><td><input type="text" name="loc" size=40">*
		</tr></td>
		<tr><td>
			Username: </td><td><input type="password" name="svdate" size=40">*
		</tr></td>
		<tr><td>
			Password: </td><td><input type="password" name="type" size=40">*
		</tr></td>
		<tr><td>
			SSN: </td><td><input type="password" name="maxweight" size=40">*
		</tr></td>
			<tr><td>
			Department: </td><td><input type="password" name="dept" size=40">*
		</tr></td>
		<tr><td>
			<input type="submit" value="submit">
		</tr></td>
	</form>
</table>