<style>
#erroremp{
color:red;
}
</style>

<?php
	session_start();
	include('db_connect.php');
	
	$emp=$_POST['assign'];
	$or=$_POST['order'];
	$nume=$_SESSION['i'];
	$numo=$_SESSION['j'];
	$counter2=0;
	$counter1=0;
	$username=$_SESSION['uName'];
	
	for($i=0;$i<=$numo;$i++)
	{
		if($or[$i]!='')
		{
			$oid=$_SESSION['orderid'][$i];
			$counter2++;
		}
	}
	
	for($i=0;$i<$nume;$i++)
	{
		if($emp[$i]!='')
		{
			$eid[$counter1]=$_SESSION['empid'][$i];
			$counter1++;
		}
	}
	
	
	if($counter2!=1)
		echo "<div id='erroremp'><b>Please select one reservation.<br /></b></div>";
	if($counter1!=2)
		echo "<div id='erroremp'><b>Please select two employees for each reservation.<br /></b></div>";
	if($counter2==1&&$counter1==2)
	{
		$query="select trainnumber from finalorder where ORDERID=:orderid";
		$stmt=oci_parse($conn, $query);
		if($stmt)
		{
			oci_bind_by_name($stmt,':orderid',$oid);
			oci_execute($stmt);
			while ($row=oci_fetch_array($stmt, OCI_NUM))
			{
				$trainnumber=$row[0];
			}
		}
		
		
		$query="UPDATE FINALORDER SET EMPID=:eid WHERE ORDERID=:orderid";
		$stmt=oci_parse($conn, $query);
		if($stmt)
		{
			oci_bind_by_name($stmt,':eid',$eid[0]);
			oci_bind_by_name($stmt,':orderid',$oid);
			oci_execute($stmt);
		}
		
		$query="insert into finalorder (empid,trainnumber) values (:eid,:trainnumber)";
		$stmt=oci_parse($conn, $query);
		if($stmt)
		{
			oci_bind_by_name($stmt,':eid',$eid[1]);
			oci_bind_by_name($stmt,':trainnumber',$trainnumber);
			oci_execute($stmt);
		}
		
		$query="UPDATE employees SET ASSIGNMENT='Assigned' WHERE EMPID=:eid";
		$stmt=oci_parse($conn, $query);
		if($stmt)
		{
			oci_bind_by_name($stmt,':eid',$eid[0]);
			oci_execute($stmt);
		}
		$query="UPDATE employees SET ASSIGNMENT='Assigned' WHERE EMPID=:eid";
		$stmt=oci_parse($conn, $query);
		if($stmt)
		{
			oci_bind_by_name($stmt,':eid',$eid[1]);
			oci_execute($stmt);
		}
		
		echo "<b>You have successfully assigned two employees to a reservation!</b><br/>\n";
		
		$act='Assign Employees';
		$query = "INSERT INTO weblogging (Usertype,Username,dateofchange,action) VALUES ('Admin',:username,sysdate,'$act')";
		$stmt = oci_parse($conn,$query);
		if($stmt)
		{
			oci_bind_by_name($stmt,':username',$username);
			oci_execute($stmt);
		}
		
	}
	
	
?>