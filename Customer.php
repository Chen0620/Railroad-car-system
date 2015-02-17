<?php
	session_start();
	$u=$_SESSION['uName'];
	echo "<b>Welcome Customer $u!</b>";
?>
<style>
#edit{
font-size:70%;
}
tr:hover{
background-color:pink;
}
table{
font-size:80%;
text-align:center;
}
th{
color:blue;
}
#userinput{
font-size:90%;
}
#button{
font-size:80%;
}

</style>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.17.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
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
</script>

<div id="tabs">
    <ul>
        <li><a href="#fragment-1"><span>Search</span></a></li>
        <li><a href="#fragment-2"><span>Reservation</span></a></li>
        <li><a href="#fragment-3"><span>Personal Info</span></a></li>
		<li><a href="#fragment-4"><span>My Web Logging</span></a></li>
    </ul>
    <div id="fragment-1">
        <p>In search page, you can search or sort cars by types, location and price.</p>
	<?php
		session_start();
		$reserve=$_SESSION['reserved'];
		
		if($reserve==1)
		{
			echo "You have successfully reserved! You can view them in reservation tab.<br />\n";
		}
		//if($_SESSION['carselected']==1)
			//echo "The car has been selected. Please select another.<br />\n";
		//$_SESSION['carselected']=0;
		$reserve==0;
	?>
	<form method='POST' action='index.php'>
		<p><b>You're searching for:</b></p>
		<p>
			<b>Type:</b><br />
			<input type='radio' name='type' value='grain car' />Grain Car
			<input type='radio' name='type' value='coal car' />Coal Car
			<input type='radio' name='type' value='Hopper' />Hopper
			<input type='radio' name='type' value='Flat bed' />Flat Bed
			<input type='radio' name='type' value='Boxcar' />Boxcar
	<br/>	<input type='radio' name='type' value='Chemical Tank' />Chemical Tank
		</p>
		<p>
			<label><b>Location:</b></label>
			<select name="location">
				<option value="all" selected="selected"></option>
				<option value='Baltimore'>Baltimore</option>
				<option value="Boston">Boston</option>
				<option value='Chicago'>Chicago</option>
				<option value='Columbia'>Columbia</option>
				<option value="Detroit">Detroit</option>
				<option value="Duluth">Duluth</option>
				<option value="Kansas">Kansas</option>
				<option value="Las Vegas">Las Vegas</option>
				<option value='Los Angeles'>Los Angeles</option>
				<option value="Miami">Miami</option>
				<option value='New York'>New York</option>
				<option value='Orlando'>Orlando</option>
				<option value="Philadelphia">Philadelphia</option>
				<option value="Pittsburgh">Pittsburgh</option>
				<option value="Portland">Portland</option>
				<option value="Saint Louis">St. Louis</option>	
				<option value="San Diego">San Diego</option>
				<option value="Savannah">Savannah</option>
				<option value="Seattle">Seattle</option>
				<option value="Tacoma">Tacoma</option>
				<option value="Toledo">Toledo</option>
				<option value="Washington DC">Washington DC</option>		
				
			</select>
		</p>
		<p>
				<label for="price"><b>Price($0-$999):</b></label>
				<br />
				From:<input id="startprice" name="startprice" type="text"/>
				To:<input id="endprice" name="endprice" type="text"/>
		</p>
			
		<input name="search" type="submit" value="Search"/>
		<input type="submit" name="allcar" value="View All Cars"/>
	</form>
	
	<form method='POST' action='index.php'>
		<p><b>You're searching for locomotives and cabooses:</b></p>
		<b>Locomotives:</b><br />
		<b>Type:</b><br />
			<input type='radio' name='locotype' value='diesel' />Diesel
			<input type='radio' name='locotype' value='steam' />Steam
		<br/>
		
		<label><b>Location:</b></label>
			<select name="loclocation">
				<option value="all" selected="selected"></option>
				<option value='Baltimore'>Baltimore</option>
				<option value="Boston">Boston</option>
				<option value='Chicago'>Chicago</option>
				<option value='Columbia'>Columbia</option>
				<option value="Detroit">Detroit</option>
				<option value="Duluth">Duluth</option>
				<option value="Kansas">Kansas</option>
				<option value="Las Vegas">Las Vegas</option>
				<option value='Los Angeles'>Los Angeles</option>
				<option value="Miami">Miami</option>
				<option value='New York'>New York</option>
				<option value='Orlando'>Orlando</option>
				<option value="Philadelphia">Philadelphia</option>
				<option value="Pittsburgh">Pittsburgh</option>
				<option value="Portland">Portland</option>
				<option value="Saint Louis">St. Louis</option>	
				<option value="San Diego">San Diego</option>
				<option value="Savannah">Savannah</option>
				<option value="Seattle">Seattle</option>
				<option value="Tacoma">Tacoma</option>
				<option value="Toledo">Toledo</option>
				<option value="Washington DC">Washington DC</option>		
			</select><br />
		<br /><br />
		<b>Caboose:</b><br />
		<b>Manufacturer: </b><br />
			<input type='radio' name='cabtype' value='BNSF' />BNSF
			<input type='radio' name='cabtype' value='Union Pacific' />Union Pacific
			<input type='radio' name='cabtype' value='SantaFe' />SantaFe
		<br/>
		<label><b>Location:</b></label>
			<select name="cablocation">
				<option value="all" selected="selected"></option>
				<option value='Baltimore'>Baltimore</option>
				<option value='Chicago'>Chicago</option>
				<option value='Los Angeles'>Los Angeles</option>
				<option value='New York'>New York</option>
				<option value="Philadelphia">Philadelphia</option>
				<option value="Saint Louis">St. Louis</option>	
				<option value="San Diego">San Diego</option>
				<option value="Tacoma">Tacoma</option>
				<option value="Washington DC">Washington DC</option>
			</select><br />
		<input name="lcsearch" type="submit" value="Search"/>
		<input type="submit" name="lcallcar" value="View All Cars"/>
	</form>
	
	
	<?php
		session_start();
		$search=$_POST['search'];
		$allcar=$_POST['allcar'];
		if($search!=''||$allcar!='')
		{
			include('include/search.php');
		}
		
		$lcsearch=$_POST['lcsearch'];
		$lcallcar=$_POST['lcallcar'];
		if($lcsearch!=''||$lcallcar!='')
		{
			include('include/lcsearch.php');
		}
		
	?>
    </div>
    <div id="fragment-2">
        <p>You can view your reservation and status here.</p>
		<div id="myAccordion">
			<h3><a href="#">Reservation On Progress</a></h3>
			<div>
			<p>You can delelte your reserved cars use the checkboxes or confirm your reservation.</p>
			<?php
				session_start();
				include('include/db_connect.php');
				
				$customid=$_SESSION['uID'];
				$deleterows=$_POST['deleterows'];
				$de=$_POST['de'];
				$nrow=count($de);
				$i=$_SESSION['totalrows'];
				
				//delete cars
				if($deleterows!='')
				{
					$num=0;
					for($num=0;$num<$i;$num++)
					{
						if($de[$num]!='')
						{
							$deletecarsn=$_SESSION['carsnde'][$num];
							
							//return reservation id
							$query="SELECT RESVID FROM RESERVATIONS WHERE CARSN=:carsn";
							$stmt=oci_parse($conn,$query);
							if($stmt)
							{
								oci_bind_by_name($stmt,':carsn',$deletecarsn);
								oci_execute($stmt);
								while($row=oci_fetch_array($stmt, OCI_NUM))
									$deresvid=$row[0];
							}
							
							//delete reservation id of the selected cars
							$query="UPDATE CARS SET RESVID=NULL, CUSTOMID=NULL WHERE CARSN=:carsn";
							$stmt=oci_parse($conn,$query);
							if($stmt)
							{
								oci_bind_by_name($stmt,':carsn',$deletecarsn);
								oci_execute($stmt);
							}
							
							//delete cars from reservation
							$query="DELETE FROM RESERVATIONS WHERE CARSN=:carsn";
							$stmt=oci_parse($conn,$query);
							if($stmt)
							{
								oci_bind_by_name($stmt,':carsn',$deletecarsn);
								oci_execute($stmt);
							}
						}
					}
					
				}
				
				//check if in the same location
				include('include/checklocation.php');
				$_SESSION['paymethod']=$_POST['pay'];
				$_SESSION['dest']=$_POST['destcity'];
				$username=$_SESSION['uName'];				
				
				$query="SELECT reservations.customid,reservation_date,reservations.carsn,cars.type,cars.location,cars.price FROM (reservations inner join cars on cars.carsn=reservations.carsn) WHERE reservations.customid=:customid";
					$stmt=oci_parse($conn,$query);
					if($stmt)
					{
						oci_bind_by_name($stmt,':customID',$customid);
						oci_execute($stmt);
					}
						echo "<form name='deleteform' method='post' action='index.php'>\n";
						echo "<table>\n";
						echo "<tr><th>TrainNo.</th><th>Reservation Date</th><th>Car Serial Number</th><th>Car Type</th><th>Location</th><th>Price</th><th>Delete</th></tr>";
						$i=0;
						while($row=oci_fetch_array($stmt,OCI_NUM))
						{
							echo "<tr>\n";
							$j=0;
							foreach($row as $col_value)
							{
								echo "<td>$col_value</td>\n";
								if($j==2)
									$_SESSION['carsnde'][$i]=$col_value;
								$j++;
							}
							echo "<td><input type='checkbox' name='de[$i]' value='delete' /></td>\n";
							echo "</tr>\n";
							$i++;
						}
						$_SESSION['totalrows']=$i;
						echo "</table>\n";
						oci_free_statement($stmt);
						echo "<div id='userinput'><b><input name='deleterows' type='submit' value='Delete these!'/><br />\n";
						echo "</form><br /></b></div>\n";
						
						echo "<div id='userinput'><form name='choosedest' method='post' action='index.php'>\n";
						echo "<label><b>Destination City:</b></label>\n
								<select name='destcity'>\n
									<option value=''></option>\n
									<option value='Baltimore'>Baltimore</option>\n
									<option value='Boston'>Boston</option>\n
									<option value='Chicago'>Chicago</option>\n
									<option value='Columbia'>Columbia</option>\n
									<option value='Detroit'>Detroit</option>\n
									<option value='Duluth'>Duluth</option>\n
									<option value='Kansas'>Kansas</option>\n
									<option value='Las Vegas'>Las Vegas</option>\n
									<option value='Los Angeles'>Los Angeles</option>\n
									<option value='Miami'>Miami</option>\n
									<option value='New York'>New York</option>\n
									<option value='Orlando'>Orlando</option>\n
									<option value='Philadelphia'>Philadelphia</option>\n
									<option value='Pittsburgh'>Pittsburgh</option>\n
									<option value='Portland'>Portland</option>\n
									<option value='Saint Louis'>St. Louis</option>\n
									<option value='San Diego'>San Diego</option>\n
									<option value='Savannah'>Savannah</option>\n
									<option value='Seattle'>Seattle</option>\n
									<option value='Tacoma'>Tacoma</option>\n
									<option value='Toledo'>Toledo</option>\n
									<option value='Washington DC'>Washington DC</option>\n		
								</select> *required\n";
						
						echo "<label><b><br />Payment Method:</b></label>\n
								<select name='pay'>\n
									<option value='Please select'></option>\n
									<option value='Credit Card'>Credit Card</option>\n
									<option value='Gift Card'>Gift Card</option>\n
									<option value='Check'>Check</option>\n
								</select> *required\n";
						echo "<br /><input type='submit' name='paymethod' value='Confirm'>\n";
						echo "</form><br /></div>\n";
					
					
					//calculate total price
					include('include/price.php');
			
					
					//complete payment
					include('include/placeorder.php');
					//$_SESSION['']
					
					//place order
					echo "<div id='button'>";
					echo "<form name='choosedest' method='post' action='index.php'>
						<input type='submit' name='view' value='View My Order'/>";
					echo "<form name='choosedest' method='post' action='index.php'>
							<input type='submit' name='deleteorder' value='Delete Order'/>
						";
					echo "<form name='choosedest' method='post' action='index.php'>
							<input type='submit' name='placeorder' value='Place Order'/>
						</form><br />";
					echo "</div>";
					$_SESSION['view']=$_POST['view'];
					$_SESSION['placeorder']=$_POST['placeorder'];
					$_SESSION['deleteorder']=$_POST['deleteorder'];
					if(strcmp($_POST['placeorder'],'')!=0)
					{
						echo "Thank you! Your reservation has been placed!";
						$_POST['view']='';
						
						$act='Place order';
						$query = "INSERT INTO weblogging (Usertype,Username,dateofchange,action) VALUES ('Customer',:username,sysdate,'$act')";
						$stmt = oci_parse($conn,$query);
						if($stmt)
						{
							oci_bind_by_name($stmt,':username',$username);
							oci_execute($stmt);
						}
					}
					if(strcmp($_POST['view'],'')!=0)
						include('include/viewOrder.php');
					
					if(strcmp($_POST['deleteorder'],'')!=0)
					{
						
					}
					
					
					
					
						
			?>
			</div>
			<h3><a href="#">Reservation Confrimed</a></h3>
			<div>
			<?php
				session_start();
				include('db_connect.php');
				
				if(strcmp($_POST['placeorder'],'')!=0)
				{
					$_SESSION['view']=1;
					include('include/viewOrder.php');
				}
			
			?>
			</div>
		</div>
	
    </div>
    <div id="fragment-3">
        <p>You can view and edit your personal information here.</p>
		<div id="Accordion">
			<h3><a href="#">View Personal Info</a></h3>
			<div>
				<?php
					session_start();
					include('include/db_connect.php');
					$username=$_SESSION['uName'];
					
					if($_POST['edit']!='')
					{
						if($_POST['euname']!='')
						{
							$euname=$_POST['euname'];
							$query="UPDATE Customers SET Username=:uname WHERE Username='$username'";
							$stmt=oci_parse($conn,$query);
							if($stmt)
							{
								oci_bind_by_name($stmt,':uname',$euname);
								oci_execute($stmt);
							}
							$username=$euname;
							$_SESSION['uName']=$username;	
						}
						if($_POST['epassword']!=''||$_POST['epassword2']!='')
						{
							if(strcmp($_POST['epassword'],$_POST['epassword2'])!=0)
								echo "Your passwords do not match!<br />\n";
							else
							{
								$ep=sha1($_POST['euname']);
								$salt = md5("AlpineStars");
								$ehashedp=sha1($salt.$ep);
								$query="UPDATE Customers SET Password=:ep WHERE Username='$username'";
								$stmt=oci_parse($conn,$query);
								if($stmt)
								{
									oci_bind_by_name($stmt,':ep',$ep);
									oci_execute($stmt);
								}
							}
						}
						if($_POST['efname']!='')
						{
							$efname=$_POST['efname'];
							$query="UPDATE Customers SET Firstname=:fname WHERE Username='$username'";
							$stmt=oci_parse($conn,$query);
							if($stmt)
							{
								oci_bind_by_name($stmt,':fname',$efname);
								oci_execute($stmt);
							}
						}
						if($_POST['elname']!='')
						{
							$elname=$_POST['elname'];
							$query="UPDATE Customers SET Lastname=:lname WHERE Username='$username'";
							$stmt=oci_parse($conn,$query);
							if($stmt)
							{
								oci_bind_by_name($stmt,':lname',$elname);
								oci_execute($stmt);
							}
						}
						if($_POST['eaddress']!='')
						{
							$eaddress=$_POST['eaddress'];
							$query="UPDATE Customers SET Address=:eaddress WHERE Username='$username'";
							$stmt=oci_parse($conn,$query);
							if($stmt)
							{
								oci_bind_by_name($stmt,':eaddress',$eaddress);
								oci_execute($stmt);
							}
						}
						if($_POST['esex']!='')
						{
							$esex=$_POST['esex'];
							$query="UPDATE Customers SET Sex=:esex WHERE Username='$username'";
							$stmt=oci_parse($conn,$query);
							if($stmt)
							{
								oci_bind_by_name($stmt,':esex',$esex);
								oci_execute($stmt);
							}
						}
						if($_POST['eage']!='')
						{
							$eage=$_POST['eage'];
							$query="UPDATE Customers SET Age=:eage WHERE Username='$username'";
							$stmt=oci_parse($conn,$query);
							if($stmt)
							{
								oci_bind_by_name($stmt,':eage',$eage);
								oci_execute($stmt);
							}
						}
						if($_POST['eemail']!='')
						{
							$eemail=$_POST['eemail'];
							$query="UPDATE Customers SET Email=:eemail WHERE Username='$username'";
							$stmt=oci_parse($conn,$query);
							if($stmt)
							{
								oci_bind_by_name($stmt,':eemail',$eemail);
								oci_execute($stmt);
							}
						}
						if($_POST['bday']!='')
						{
							$ebday=$_POST['bday'];
							
							$query="UPDATE Customers SET Birthday=:ebday WHERE Username='$username'";
							$stmt=oci_parse($conn,$query);
							if($stmt)
							{
									oci_bind_by_name($stmt,':ebday',$ebday);
									oci_execute($stmt);
							}
						}
							
					}
					
				
						$query="SELECT CustomID,Firstname,Lastname,Address,Username,Sex,Age,Email,Birthday FROM Customers WHERE Username=:username";
						$stmt=oci_parse($conn,$query);
						if($stmt)
						{
							oci_bind_by_name($stmt,':username',$username);
							oci_execute($stmt);
							while($row=oci_fetch_array($stmt,OCI_NUM))
							{
								echo "Customer ID:" . $row[0]."<br />\n";
								echo "Firstname:" . $row[1]."<br />\n";
								echo "Lastname:" . $row[2]."<br />\n";
								echo "Address:" . $row[3]."<br />\n";
								echo "Username:" . $row[4]."<br />\n";
								echo "Sex:" . $row[5]."<br />\n";
								echo "Age:" . $row[6]."<br />\n";
								echo "Email:" . $row[7]."<br />\n";
								echo "Birthday:" . $row[8]."<br />\n";
							}
						}
				?>
			</div>
			<h3><a href="#">Edit personal Info</a></h3>
			<div id="edit">
				<form method="POST" action="index.php">
					
						<label for="euname"><b>New Username:</b></label>
						<input id="euname" name="euname" type="text"/>
						<br />
						<label for="epassword"><b>New Password:</b></label>
						<input id="epassword" name="epassword" type="password"/>
						<br />
						<label for="epassword2"><b>Re-enter Password:</b></label>
						<input id="epassword2" name="epassword2" type="password"/>
						<br />
						<label for="efname"><b>New Firstname:</b></label>
						<input id="efname" name="efname" type="text"/>
						<br />
						<label for="elname"><b>New Lastname:</b></label>
						<input id="elname" name="elname" type="text"/>
						<br />
						<label for="eaddress"><b>New Address:</b></label>
						<input id="eaddress" name="eaddress" type="text"/>
						<br />
						<label for="esex"><b>Sex:</b></label>
						<input name="esex" value="Male" type="radio"/>Male
						<input name="esex" value="Female" type="radio"/>Female
						
						<label for="eage"><b>Age:</b></label>
						<input id="eage" name="eage" type="text"/>
						<br />
						<label for="eemail"><b>Email:</b></label>
						<input id="eemail" name="eemail" type="text"/>
						
						<label for="date">Birthday:</label>
						<input id="date" name="bday" type="text" />

						
						<br />
					<input type="submit" value="Edit" name="edit"> 
				</form>
			</div>	
		</div>
    </div>
    <div id="fragment-4">
        <p>You can view your web logging info here since your registration.</p>
	<?php
		$query="SELECT * FROM Weblogging WHERE Username=:username ORDER BY LogID ASC";
		$stmt=oci_parse($conn,$query);
		if($stmt)
		{
			oci_bind_by_name($stmt,':username',$username);
			oci_execute($stmt);
			echo "<table>\n";
			echo"<tr><th>Log ID</th><th>User Type</th><th>Username</th><th>Date of Change</th><th>Action</th></tr>";
			while($row=oci_fetch_array($stmt,OCI_NUM))
			{
				echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";
			}
			echo "</table>\n";
		}
	?>
    </div>
</div>



<?php
	session_start();

?>