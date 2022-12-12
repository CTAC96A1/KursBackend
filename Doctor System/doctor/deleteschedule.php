<?php
include_once '../controller.php';
$id = $_POST['id'];
$delete = $controller->deleteData('doctorschedule(delsched)', $id);


?>

