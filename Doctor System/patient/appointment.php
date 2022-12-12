<?php
session_start();
include_once '../controller.php';
$controller = new Controller();
$session= $_SESSION['patientSession'];
if (isset($_GET['Date']) && isset($_GET['Id'])) {
	$appdate =$_GET['Date'];
	$appid = $_GET['Id'];
}
$res = mysqli_query($con,"SELECT a.*, b.* FROM doctorschedule a INNER JOIN patient b
WHERE a.Date='$appdate' AND scheduleId=$appid AND b.icPatient=$session");
$docres = mysqli_query($con,"SELECT a.*, b.* FROM doctorschedule a JOIN doctor b
ON a.Date='$appdate' AND scheduleId=$appid AND a.doctorIc = b.icDoctor");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
$docRow=mysqli_fetch_array($docres,MYSQLI_ASSOC);

if ($_GET['teleport'] == 1)
{
	$controller->newPage("patient.php");
}
	
if (isset($_POST['appointment'])) {
$patientIc = mysqli_real_escape_string($con,$userRow['icPatient']);
$scheduleid = mysqli_real_escape_string($con,$appid);
$avail = "Недоступно";


$query = "INSERT INTO appointment (  patientIc , scheduleId )
VALUES ( '$patientIc', '$scheduleid') ";

$sql = $controller->updateData('doctorschedule', $avail, $scheduleid);
$scheduleres=mysqli_query($con,$sql);
if ($scheduleres) {
	$btn= "disable";
} 


$result = mysqli_query($con,$query);
if( $result )
{
?>
<script type="text/javascript">
alert('Appointment made successfully.');
</script>
<?php
$controller->newPage("patientapplist.php");
}
else
{
	echo mysqli_error($con);
?>
<script type="text/javascript">
alert('Appointment booking fail. Please try again.');
</script>
<?php
$controller->newPage("patient.php");
}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/default/style.css" rel="stylesheet">
		<link href="assets/css/default/blocks.css" rcel="stylesheet">
	</head>
	<body>
		<!-- navigation -->
		<div class="container" style='padding-bottom:800px'>
			<section style="padding-bottom: 50px; padding-top: 50px;">
				<div class="row">
					<!-- start -->
					<!-- USER PROFILE ROW STARTS-->
					<div class="row">				
						<div class="col-md-9 col-sm-9  user-wrapper">
							<div class="description">
								
								
								<div class="panel panel-default">
									<div class="panel-body">
										
										
										<form class="form" role="form" method="POST" accept-charset="UTF-8">
											<div class="panel panel-default">
												<div class="panel-heading">Подтверждение записи</div>
												<div class="panel-body">
													
													ФИО: <?php echo $userRow['Name'] ?> <?php echo $userRow['Famil'] ?><br>
													Полис: <?php echo $userRow['icPatient'] ?><br>
													Дата рождения: <?php echo $userRow['DR'] ?><br><br>
													Врач: <?php echo $docRow['Name'] ?> <?php echo $docRow['Famil'] ?><br>													
													Дата приема: <?php echo $userRow['Date'] ?><br>
													Время: <?php echo $userRow['Time'] ?> <br>
													Адрес приема: <?php echo $docRow['Address'] ?> <br>
												</div>
											</div>
											
											
											<div class="form-group">
													<div class="centerblock">
													<input type="submit" name="appointment" id="submit" class="btn btn-primary" value="Записаться">
													<a href="appointment.php?teleport=1" class="btn btn-primary">Назад</a>
												</div>
											</div>
										</form>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
				</div>
			</section>
		</div>
					<?php $controller->footer()?>
				</body>
				
			</html>