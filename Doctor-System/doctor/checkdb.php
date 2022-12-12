<?php
include_once '../controller.php';
$controller = new Controller();
$userid = $_GET['userid'];
$chkYesNo = $_GET['chkYesNo'];

$update = $result = $controller->updateData('appointment', $userid);;

?>