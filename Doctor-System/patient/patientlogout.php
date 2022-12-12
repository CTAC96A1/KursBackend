<?php
session_start();
include_once '../controller.php';
$controller = new Controller();
if(!isset($_SESSION['patientSession']))
{
    $controller->newPage("patientdashboard.php");
}
else if(isset($_SESSION['patientSession'])!="")
{
 header("Location: ../index.php");
}

if(isset($_GET['logout']))
{
 session_destroy();
 unset($_SESSION['patientSession']);
 $controller->newPage("../index.php");
}
?>