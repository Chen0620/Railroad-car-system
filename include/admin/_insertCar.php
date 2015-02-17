<?php
include("../db_connect.php");

$conn = oci_new_connect("cs3380sp12grp3","WyJNKXEV","dbase1");
if (!$conn) {
	$e = oci_error();
	die("Failed to connect: " . $e['message']);
}
$query = "INSERT INTO cars (model,manufacturer,location,servicedate,type,maxweight,resvid)
		VALUES ('$_POST[model]','$_POST[manuf]','$_POST[loc]',now(),'$_POST[type]','$_POST[maxweight]')";
$stmt = oci_parse($conn,$query);
if($_POST[carsn] != '') oci_execute($stmt);

oci_free_statement($stmt);
oci_close($conn);
?>
<h1>Add Car</h1>
<table>
	<form method="POST">
		<p>* are required.</p>
		<tr><td>
			Model: </td><td><input type="text" name="model" size=40">*
		</tr></td>
		<tr><td>
			Manufacturer: </td><td><input type="text" name="manuf" size=40">*
		</tr></td>
		<p>
			<label>Location:</label>
			<select name="loc">
				<option value="STL">St. Louis</option>
				<option value="CHI">Chicago</option>
				<option value="LA">Los Angeles</option>
				<option value="NY">New York</option>
				<option value="Orlando">Orlando</option>
				<option value="WashDC">Washing DC</option>
				<option value="Miami">Miami</option>
				<option value="CoMo">Columbia</option>
				<option value="LasVegas">Las Vegas</option>
				<option value="Detroit">Detroit</option>
			</select>
		Type of Car: 
		<select name="type">
			<option value="Coal">Coal</option>
			 <option value="Flatbed">Flatbed</option>
			 <option value="Hopper">Hopper</option>
			  <option value="Grain">Grain</option>
			</select>
		</p>
		<tr><td>
			Max Weight: </td><td><input type="password" name="maxweight" size=40">*
		</tr></td>
		<tr><td>
			<input type="submit" value="submit">
		</tr></td>
	</form>
</table>