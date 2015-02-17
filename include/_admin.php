
<?php
session_start();

// If statements that will limit the selection of the user by there clearence
if(isset($_SESSION[admin])){
    echo("<h2>Admin</h2><br />");
        if($_GET[tool] == null){
            echo("<a href=\"admin.php?tool=1\">Display Customers</a><br />");
            echo("<a href=\"admin.php?tool=4\">Display Employees</a><br />");
            echo("<a href=\"admin.php?tool=5\">Display Cars</a><br />");
            echo("<a href=\"admin.php?tool=2\">Add Car</a><br />");
            echo("<a href=\"admin.php?tool=3\">Add Employee</a><br />");
            echo("<a href=\"admin.php?tool=6\">Display Weblog</a><br />");
        }
        if($_GET[tool] == 1) include('admin/_displayCustomers.php');
        if($_GET[tool] == 2) include('admin/_insertCar.php');
        if($_GET[tool] == 3) include('admin/_insertEmp.php');
        if($_GET[tool] == 4) include('admin/_displayEmp.php');
        if($_GET[tool] == 5) include('admin/_displayCars.php');
        if($_GET[tool] == 6) include('admin/_displayWeblog.php');
}
/*
if(isset($_SESSION[conductor])){
    echo("<h2>Conductor</h2><br />");
    echo("<p>To be entered later.<br />");
}
if(isset($_SESSION[engineer])){
    echo("<h2>Engineer</h2><br />");
    echo("<p>To be entered later.<br />");
}
if(isset($_SESSION[employee])){
    echo("<h2>Employee</h2><br />");
    echo("<p>To be entered later.<br />");
}
*/
?>