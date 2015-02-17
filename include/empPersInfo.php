<style>
tr:hover{
background-color:pink;
}
table{
font-size:80%;
text-align:center;
}
</style>

<?php
	//employee view 
	session_start();
	$u=$_SESSION['uName'];
	include('db_connect.php');
	
//if the employee is a conductor a seperate query will be used
//to search the conductor table
if($_SESSION['utype']=='conductor'){
//select employee with the current username in
//order to fnd the employee id
$query="select empid from employees where username = :u";
$stmt=oci_parse($conn, $query);
	if ($stmt){//echo"hello";
	oci_bind_by_name($stmt, ':u', $u);
	oci_execute($stmt);
	}
	
	while($row=oci_fetch_array($stmt, OCI_NUM))
		{//assing the empid to a variable
		$empid=$row[0];
		}
	//use empid to find the personal information of the user
	$query1="select * from conductors where empid = :empid";
	$stmt1=oci_parse($conn, $query1);
	if($stmt1)
	{
		oci_bind_by_name($stmt1, ':empid', $empid);
		oci_execute($stmt1);
	}
	//display results
	echo"<table>\n";
	echo "<tr><th>Engineer ID</th><th>Department</th><th>Conductor ID</th><th>Address</th><th>Birthday</th><th>Sex</th><th>Age</th><th>Email</th><th>Description</th></tr>";
	while($row1=oci_fetch_array($stmt1, OCI_NUM))
		{
		echo"<tr>\n";
		foreach($row1 as $col_value1)
			echo"<td>$col_value1</td>\n";
		echo"</tr>\n";
		}
	echo"</table>\n";
	oci_free_statement($stmt);
	oci_free_statement($stmt1);
	
}
//else the employee is an engineer
else{
//query to find emp id of current user
$query="select empid from employees where username = :u";
$stmt=oci_parse($conn, $query);
	if ($stmt){
	oci_bind_by_name($stmt, ':u', $u);
	oci_execute($stmt);
	}
	
	while($row=oci_fetch_array($stmt, OCI_NUM))
		{//assing empid to variable
		$empid=$row[0];
		}
	//query to find personal info of engineer
	$query1="select * from engineers where empid = :empid";
	$stmt1=oci_parse($conn, $query1);
	if($stmt1)
	{
		oci_bind_by_name($stmt1, ':empid', $empid);
		oci_execute($stmt1);
	}
	//display info
	echo"<table>\n";
	echo "<tr><th>Engineer ID</th><th>Department</th><th>Employee ID</th><th>Address</th><th>Birthday</th><th>Sex</th><th>Age</th><th>Description</th><th>Email</th></tr>";
	while($row1=oci_fetch_array($stmt1, OCI_NUM))
		{
		echo"<tr>\n";
		foreach($row1 as $col_value1)
			echo"<td>$col_value1</td>\n";
		echo"</tr>\n";
		}
	echo"</table>\n";
	oci_free_statement($stmt);
	oci_free_statement($stmt1);
	//echo $empid;
}

?>