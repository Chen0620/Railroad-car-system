Navigation<br />
<br />
<a href="index.php">Home</a><br />
<a href="index.php?about=1">About<br /></a>

<?php
session_start();

// If statements that will limit the selection of the user by there clearence
if(isset($_SESSION[admin])){
    echo("<a href=\"admin.php\">Administration</a><br />");
}
/*if(isset($_SESSION[conductor])){
    echo("<a href=\"admin.php\">Conductor Page</a><br />");
}
if(isset($_SESSION[engineer])){
    echo("<a href=\"admin.php\">Engineer Page</a><br />");
}
if(isset($_SESSION[employee])){
    echo("<a href=\"admin.php\">Employee Page</a><br />");
}
if(isset($_SESSION[isLoggedIn]))
{
    echo("<a href=\"customer.php\">Customer Page</a><br />");
}
*/


// Display Login if not logged in
if(!isset($_SESSION[uName])){
                            if($_GET[error] == 1) echo('<p>Login Failed.</p>');
                            include('login.php');
                            
}

// Display Basic User Info if logged in
if(isset($_SESSION[uName])){
    echo("<br />");
    echo("Logged in as $_SESSION[uName]<br />");
    echo("Ip Address: $_SERVER[REMOTE_ADDR]<br />");
    echo("<a href=\"logout.php\"><button>Logout</button></a><br />");
    
    
}?>