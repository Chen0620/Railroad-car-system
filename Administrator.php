<?php
	session_start();
	include('include/db_connect.php');
	$u=$_SESSION['uName'];
	echo "<b>Welcome Administrator $u!</b>";

?>
<style>
#tabs{
font-size:80%;
}
</style>
<link rel="stylesheet" href="themes/blue/style.css" type="text/css" id="" media="print, projection, screen" />
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.17.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.metadata.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#myAccordion').accordion();
		$('#Accordion').accordion();
		$("#tabs").tabs();
		$('#date').datepicker({
			dateFormat: 'd-M-yy'
		});
		// Make the button tag a jQuery UI button
		$('#openDialog').button();
		
		// When the user clicks the button...
		$('#openDialog').click(function() {
			$('#dialogBox').dialog('open');
			return false;
		});
		
		// Set up the dialog widget
		$('#dialogBox').dialog({
			autoOpen: false,
			modal: true
		});
	});
	$(document).ready(function() 
		 { 
		 $('table').tablesorter(); 
		} 
	); 
</script>

<div id="tabs">
    <ul>
		<li><a href="#fragment-3"><span>Web Loggings</span></a></li>
		<li><a href="#fragment-4"><span></span>Employee Management</a></li>
		<li><a href="#fragment-5"><span>Reservation Assignment</span></a></li>
		<li><a href="#fragment-6"><span>Edit Information</span></a></li>
    </ul>
  
	<div id="fragment-3">
        <p>You can view web logging from all employees and customers here.</p>
		
		<form method="POST" action="index.php">
			<input type="submit" name="weblog" value="View Engineer WebLogging">
			<input type="submit" name="weblog" value="View Conductor WebLogging">
			<input type="submit" name="weblog" value="View Customer WebLogging">
			<input type="submit" name="weblog" value="View Admin WebLogging">
		</form>
		
		<?php
			session_start();
			$s=$_POST['weblog'];
			if($s!='')
			{
				$_SESSION['private']=no;
				if(strcmp($s,'View Engineer WebLogging')==0)
					$_SESSION['type']=Engineer;
				if(strcmp($s,'View Conductor WebLogging')==0)
					$_SESSION['type']=Conductor;
				if(strcmp($s,'View Customer WebLogging')==0)
					$_SESSION['type']=Customer;
				if(strcmp($s,'View Admin WebLogging')==0)
					$_SESSION['type']=Admin;
				include('include/displayWeblogging.php');
			}
			
				
			
			
		?>
    </div>
	<div id="fragment-4">
        <p>You can add or delete employees here.</p>
		<div id="Accordion">
		<h2><a href="#">Add Employee</a></h2>
		<div>
			<?php
				session_start();
				if($_POST['add']!='')
				{
					$username=$_POST['usr_name'];
					$fname=$_POST['f_name'];
					$lname=$_POST['l_name'];
					$empty=sha1('');
					$p1=sha1($_POST['usr_pass']);
					$p2=sha1($_POST['usr_pass2']);
					
					if($_POST['usr_name']==''||$_POST['f_name']==''||$_POST['l_name']==''||strcmp($p1,$empty)==0||strcmp($p2,$empty)==0)
						echo "Please fill in all the required fields.<br />\n";
					else
					{
						if(strcmp($_POST['usr_pass'],$_POST['usr_pass2'])!=0)
							echo "Your passwords do not match.<br />\n";
						
						$query="SELECT Username from Employees where Username=:username";
						$stmt=oci_parse($conn,$query);
						if($stmt)
						{
							oci_bind_by_name($stmt,':username',$username);
							oci_execute($stmt);
							$num = oci_fetch_all($stmt,$result);
						}
						if( $num!=0)
							echo "The username has been used. Please choose another.";					
						else
						{
							echo "You have successfully add an employee.";
							echo "<div id='dialogBox' title='New Employee'>";
							include('include/empAdd.php');
							echo "</div><button id='openDialog'>View Here!</button>";
						}
					}
				}
			?>
			<form method="POST" action="index.php">
				<p>* are required.</p>
					Username: <input type="text" name="usr_name" size=20>*<br />
				
					Firstname: <input type="text" name="f_name" size=20>*<br />
				
					Lastname: <input type="text" name="l_name" size=20>*<br />
				
					Password: <input type="password" name="usr_pass" size=20>*<br />
				
					Re-Enter Password: <input type="password" name="usr_pass2" size=20>*<br />
				
					SSN:<input type="text" name="ssn" size=11 maxlength=11>
					
					<label for="date">Employment Date:</label>
					<input id="date" name='empdate' type="text" /><br />
					
					<label><b>Department:</b></label>
					<select name="department">
						<option>Administrator</option>
						<option>Engineer</option>
						<option>Conductor</option>
					</select>
					
					<input type="submit" name="add" value="Add">
				
			</form>

		</div>
		<h2><a href="#">Delete Employee</a></h2>
		<div>
			
			<?php include('include/deleteEmp.php'); ?>
		</div>
		<h2><a href="#">View Employee Info</a></h2>
		<div>
			<?php include('include/admin/_displayEmp.php');
			?>
		</div>
	</div>
    </div>
	<div id="fragment-5">
        <p>You can assign employees to reservation here.</p>
		<?php
			session_start();
			include('include/db_connect.php');
			
			if($_POST['assignthem']!='')
				include('include/assignEmp.php');
			
			//show available employees
			echo "Here available employees.<br />\n";
			echo "<form name='choosedest' method='post' action='index.php'>";
			$query="SELECT EmpID,FirstName,LastName,Department,Rank,Status FROM Employees WHERE Assignment='Unassigned' AND Status='Active'";
			$stmt = oci_parse($conn,$query);
			oci_execute($stmt);
			echo ("<table id=\"myTable\" class=\"tablesorter\">");
			echo ("<thead><th>ID</th><th>First Name</th><th>Last Name</th><th>Department</th><th>Rank</th><th>Status</th><th>Assign</th></thead><tbody>");
			$i=0;
			while ($row = oci_fetch_array($stmt, OCI_BOTH)) 
			{
				// Use the uppercase column names for the associative array indices
				echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td>";
				echo "<td><input type='checkbox' name='assign[$i]; value='assigned'></td></tr>";
				$_SESSION['empid'][$i]=$row[0];
				$i++;
			}
			$_SESSION['i']=$i;
			echo ("</tbody></table>");
						
			//show reservations need to be assigned
			echo "Please choose one reservation listed to make assignment.<br />";
			$query="SELECT OrderID, Trainnumber FROM FINALORDER WHERE EMPID=-1";
			$stmt = oci_parse($conn,$query);
			oci_execute($stmt);
			echo ("<table id=\"myTable\" class=\"tablesorter\">");
			echo ("<thead><th>OrderID</th><th>Train Number</th><th>Assign</th></thead><tbody>");
			$j=0;
			while ($row = oci_fetch_array($stmt, OCI_BOTH)) 
			{
				// Use the uppercase column names for the associative array indices
				echo "<tr><td>$row[0]</td><td>$row[1]</td>";
				echo "<td><input type='checkbox' name='order[$j]'; value='ordered'></td></tr>";
				$_SESSION['orderid'][$j]=$row[0];
				$j++;
			}
			$_SESSION['j']=$j;
			echo ("</tbody></table>");
			echo  "<input type='submit' name='assignthem' value='Choose'></form>\n";
		?>
		
    </div>
	<div id="fragment-6">
        <p>You can view and edit all customers personal information here.</p>
		<div id="myAccordion">
		<h2><a href="#">View Customers</a></h2>
		<div>
			<?php include('include/admin/_displayCustomers.php');?>
		</div>
		<h2><a href="#">Edit Customer Data</a></h2>
		<div>
			Not Yet Completed
		</div>
		</div>
    </div>
</div>
