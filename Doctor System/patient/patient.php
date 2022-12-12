<?php
session_start();
include_once '../controller.php';
$controller = new Controller();
if(!isset($_SESSION['patientSession']))
{
	$controller->newPage("../index.php");
}

$usersession = $_SESSION['patientSession'];


$res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient=".$usersession);


$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);

switch ($_GET['teleport']){
case "1":
    $controller->newPage("patientlogout.php?logout");
case "2":
	$controller->newPage("profile.php?icPatient=".$userRow['icPatient']);
case "3":
    $controller->newPage("patientapplist.php?icPatient=".$userRow['icPatient']);
}

?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="assets/css/material.css" rel="stylesheet">
		<link href="assets/css/default/style.css" rel="stylesheet">
		<link href="assets/css/default/blocks.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
		
	</head>
	<body>
		
		<nav class="navbar navbar-default " role="navigation">
			<div class="container-fluid">
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<ul class="nav navbar-nav">
							<li><a href="patient.php">На главную</a></li>
							<li><a href="patient.php?teleport=3">Записи</a></li>
						</ul>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['Name']; ?> <?php echo $userRow['Famil']; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
									<a href="patient.php?teleport=2"><i class="fa fa-fw fa-user"></i> Профиль</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="patient.php?teleport=1"><i class="fa fa-fw fa-power-off"></i> Выход</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<section id="promo-1" class="content-block promo-1 min-height-600px bg-offwhite">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-8">
						
						
						<?php if ($userRow['Address']=="") {
						echo "<div class='row'>";
							echo "<div class='col-lg-12'>";
								echo "<div class='alert alert-danger alert-dismissable'>";
									echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
									echo " <i class='fa fa-info-circle'></i>  <strong>Ваш профиль не полный, заполните ваш профиль, пройдя на вкладку Профиль.</strong>" ;
								echo "  </div>";
							echo "</div>";
							
							} else {
							}
							?>
							<h2>С возвращением <?php echo $userRow['Name']; ?> <?php echo $userRow['Famil']; ?>, сделать запись к врачу вы можете прямо тут.</h2>
							<div class="input-group" style="margin-bottom:10px;">
								<div class="input-group-addon">
									<i class="fa fa-calendar">
									</i>
								</div>
								<input class="form-control" id="date" name="date" value="<?php echo date("Y-m-d")?>" onchange="showUser(this.value)"/>
							</div>
						</div>
						<script>
						function showUser(str) {
						
						if (str == "") {
						document.getElementById("txtHint").innerHTML = "No data to be shown";
						return;
						} else {
						if (window.XMLHttpRequest) {
						xmlhttp = new XMLHttpRequest();
						} else {
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
						}
						};
						xmlhttp.open("GET","getschedule.php?q="+str,true);
						console.log(str);
						xmlhttp.send();
						}
						}
						</script>
						<div class="container">
							<div class="row">
								<div class="col-xs-12 col-md-8">
									<div id="txtHint"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		</section>
		<?php $controller->footer()?>

		

		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/date/bootstrap-datepicker.js"></script>
		<script src="assets/js/moment.js"></script>
		<script src="assets/js/transition.js"></script>
		<script src="assets/js/collapse.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="assets/js/bootstrap.min.js"></script>
		
		<script>
		$(document).ready(function(){
		var date_input=$('input[name="date"]');
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
		format: 'yyyy-mm-dd',
		container: container,
		todayHighlight: true,
		autoclose: true,
		})
		})
		</script>
		
		
	</body>
</html>