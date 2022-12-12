<?php
include_once '../controller.php';
// Get the variables.
$id = $_POST['id'];

$delete = $controller->deleteData('appointment(delapp)', $id);
$delete = $controller->deleteData('doctorschedule(delapp)', $id);
?>

