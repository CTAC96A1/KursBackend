<?php
include_once '../controller.php';
$controller = new Controller();
$id = $_POST['id'];

$delete = $controller->deleteData('appointment(delapp)', $id);
$delete = $controller->deleteData('doctorschedule(delapp)', $id);
?>

