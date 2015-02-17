<?php

session_start();
include ('_config.php');
include ('db_connect.php');

if(isset($_POST['valid'])){

    $query="CREATE TABLE CMS_users (
                            user_id INT NOT NULL AUTO_INCREMENT,
			    user_name varchar(25) NOT NULL,
                            user_passhash varchar(25) NOT NULL,
                            email varchar(50) NOT NULL,
                            isAdmin int(2) NOT NULL)";
    mysql_query($query);
    
    $query="CREATE TABLE CMS_news (
			    id INT NOT NULL AUTO_INCREMENT,
                            article TEXT NOT NULL,
			    author VARCHAR(25),
			    date DATETIME NOT NULL,
                            visible INT NOT NULL)";
    mysql_query($query);
    
    $query="CREATE TABLE CMS_log (
			    id INT NOT NULL AUTO_INCREMENT,
                            user_name varchar(25) NOT NULL,
			    action varchar(30) NOT NULL,
			    date DATETIME NOT NULL,
			    IPadress varchar(16) NOT NULL,
                            visible INT NOT NULL)";
    mysql_query($query);

mysql_close();
echo ("Databases have been created!");
} else { echo "You forgot to check the box agreeing to build the databases"; }
?>
<form method="POST">
<table>

<tr><td><b>Validitiy Checker:</td>
	<td><input type="checkbox" NAME="valid" SIZE="40" /></td>
	<td>Check the box and click submit.</td>
</tr>
</table>

<br />
<input type="submit" value="Create Databases!" class="submit"/>
</form>

<?
include ('db_connect.php');

$check = mysql_query( "SELECT user_name,Email FROM CMS_users WHERE user_id = '$_POST[username]' OR Email = '$_POST[email]'" );
$query =( "INSERT INTO CMS_users (user_name,user_password,Email,isAdmin) VALUES ('$_POST[username]','$_POST[password]','$_POST[email]',1)");

    if(isset($_POST['valid1'])){
      if($_POST[password]==$_POST[password2]){
      if(1){    //mysql_num_rows($check) == 0){
                 echo "<b>Status: Your Registration is Complete, You may now login :D </b>";

                                       mail("amsmy2@gmail.com",
                                       "'$_POST[username]' has Registared on CMS",
                                       "A new member has regestered on CMS,
                                       Name: '$_POST[username]'
                                       Email: '$_POST[email]'
                                       Ip: $REMOTE_ADDR",
                                       "From: CMS Registartion"
                                       );

                      mysql_query($query);
                       } else { echo "#Username / Email is already Registered!#"; }
                                     } else { echo "<b>#Your Passwords did not match#</b>"; }
    }
mysql_close();
?>
Register Admin
<form method="POST">
<table>
<tr>    <td><b>User Name:</b></td>
	<td><input type="text" NAME="username" SIZE="40" /></td>
	<td>Choose a User name</td>
<tr>
        <td><b>Password:</td>
	<td><input type="password" NAME="password" SIZE="40" /></td>
	<td>Enter your password.</td>
        </tr>
<tr>
        <td><b>Re-Password:</b></td>
	<td><input type="password" NAME="password2" SIZE="40" /></td>
	<td>Just make sure :D.</td> 
        </tr>

<tr>    <td width="10%"><b>Email Address:</td>
	<td width="25%"><input type="text" NAME="email" SIZE="40" />
	<td width="50%">Please Enter a Valid Email Address incase we need to contact you about your team.</td></tr>
</table>
<center><b>Policy for User Protection</b>
                     <br>The owner of this site will not under any circumstances give out or use your email address for any purpose,
                     except for contact in case of an emergency or dispute/game report.
                     <br> You agree to follow the rules of the league and abid by the code of conduct.
<table>
<tr><td><b>Validitiy Checker:</td>
	<td><input type="checkbox" NAME="valid1" SIZE="40" /></td>
	<td>If you check the box you agree to the TOS. <br> Check the box and click submit.</td>
</tr>
</table>
<br />
<input type="submit" value="Submit Registration!">
</form>