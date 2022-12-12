<?php
include_once '../controller.php';
$userid = $_GET['userid'];
$chkYesNo = $_GET['chkYesNo'];

$update = $result = $controller->updateData('appointment', $userid);;

?>