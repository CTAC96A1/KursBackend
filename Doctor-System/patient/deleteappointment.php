<?php
include_once '../controller.php';
$controller = new Controller();
$id = $_POST['id'];
$dost = "Доступно";
$update = $controller->updateData('doctorschedule, appointment', $dost, $id);
$delete = $controller->deleteData('appointment(delapppath)', $id);
?>