<?php
session_start();
include_once '../controller.php';
$controller = new Controller();
if(!isset($_SESSION['patientSession']))
{
	$controller->newPage("../index.php");
}
$res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient=".$_SESSION['patientSession']);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>
<!-- update -->
<?php
if (isset($_POST['submit'])) {
//variables
	$Name = $_POST['Name'];
	$Famil = $_POST['Famil'];
	$DR = $_POST['DR'];
	$Gender = $_POST['Gender'];
	$Address = $_POST['Address'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$res = $controller->updateData('patient', $Name, $Famil,$DR ,$Gender ,$Address ,$Phone ,$Email ,$_SESSION['patientSession'] );
	// $userRow=mysqli_fetch_array($res);
	header( 'Location: profile.php' ) ;
}

switch ($_GET['teleport']){
case "1":
    $controller->newPage("patientapplist.php?icPatient=<?php echo".$userRow."['icPatient']; ?>");
case "2":
    $controller->newPage("patientlogout.php?logout");
case "3":
    $controller->newPage("doctordashboard.php");
}


?>
<?php
$male="";
$female="";
if ($userRow['Gender']=='Мужчина') {
$male = "checked";
}elseif ($userRow['Gender']=='Женщина') {
$female = "checked";
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<!-- Bootstrap -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/default/style.css" rel="stylesheet">
		<!-- <link href="assets/css/default/style1.css" rel="stylesheet"> -->
		<link href="assets/css/default/blocks.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">

	</head>
	<body>
		
		<!-- navigation -->
		<nav class="navbar navbar-default " role="navigation">
			<div class="container-fluid">
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<ul class="nav navbar-nav">
							<li><a href="patient.php">На главную</a></li>
							<li><a href="profile.php?teleport=1">Записи</a></li>
						</ul>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['Name']; ?> <?php echo $userRow['Famil']; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
									<a href="profile.php?teleport=2"><i class="fa fa-fw fa-power-off"></i> Выход</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- navigation -->
		
		<div class="container">
			<section style="padding-bottom: 50px; padding-top: 50px;">
				<div class="row">
						
						<div class="col-md-9 col-sm-9  user-wrapper">
							<div class="description">
								<h3> <?php echo $userRow['Name']; ?> <?php echo $userRow['Famil']; ?> </h3>
								<hr />
								
								<div class="panel panel-default">
									<div class="panel-body">
										
										
										<table class="table table-user-information" align="center">
											<tbody>
												<tr>
													<td>Дата рождения</td>
													<td><?php echo $userRow['DR']; ?></td>
												</tr>
												<tr>
													<td>Пол</td>
													<td><?php echo $userRow['Gender']; ?></td>
												</tr>
												<tr>
													<td>Адрес проживания</td>
													<td><?php echo $userRow['Address']; ?>
													</td>
												</tr>
												<tr>
													<td>Мобильный телефон</td>
													<td><?php echo $userRow['Phone']; ?>
													</td>
												</tr>
												<tr>
													<td>Email</td>
													<td><?php echo $userRow['Email']; ?>
													</td>
												</tr>
												
											</tbody>
										</table>
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Изменить данные</button>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
					<!-- USER PROFILE ROW END-->
					<!-- end -->
					<div class="col-md-4">
						
						<!-- Large modal -->
						
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Обновление информации</h4>
									</div>
									<div class="modal-body">
										<!-- form start -->
										<form action="<?php $_PHP_SELF ?>" method="post" >
										<table class="table table-user-information">
												<tbody>
													<tr>
														<td>Страховой полис:</td>
														<td><?php echo $userRow['icPatient']; ?></td>
													</tr>
													<tr>
														<td>Имя:</td>
														<td><input type="text" class="form-control" name="Name" value="<?php echo $userRow['Name']; ?>"  /></td>
													</tr>
													<tr>
														<td>Фамилия</td>
														<td><input type="text" class="form-control" name="Famil" value="<?php echo $userRow['Famil']; ?>"  /></td>
													</tr>
													<tr>
														<td>Дата рождения</td>
														<td>
															<div class="form-group ">
																
																<div class="input-group">
																	<div class="input-group-addon">
																		<i class="fa fa-calendar">
																		</i>
																	</div>
																	<input class="form-control" id="DR" name="DR" placeholder="DD/MM/YYYY" type="text" value="<?php echo $userRow['DR']; ?>"/>
																</div>
															</div>
														</td>
														
													</tr>
													<tr>
														<td>Пол</td>
														<td>
															<div class="radio">
																<label><input type="radio" name="Gender" value="Мужчина" <?php echo $male; ?>>Мужчина</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="Gender" value="Женщина" <?php echo $female; ?>>Женщина</label>
															</div>
														</td>
													</tr>
													
													<tr>
														<td>Номер телефон</td>
														<td><input type="text" class="form-control" name="Phone" value="<?php echo $userRow['Phone']; ?>"  /></td>
													</tr>
													<tr>
														<td>Email</td>
														<td><input type="text" class="form-control" name="Email" value="<?php echo $userRow['Email']; ?>"  /></td>
													</tr>
													<tr>
														<td>Адрес домашнего проживания</td>
														<td><textarea class="form-control" name="Address"  ><?php echo $userRow['Address']; ?></textarea></td>
													</tr>
													<tr>
														<td>
															<input type="submit" name="submit" class="btn btn-info" value="Обновить информацию"></td>
														</tr>
													</tbody>
													
												</table>
												
												
												
											</form>
											<!-- form end -->
										</div>
										
									</div>
								</div>
							</div>
							<br /><br/>
						</div>
						
					</div>
					<!-- ROW END -->
				</section>
				<!-- SECTION END -->
									<?php $controller->footer()?>
			</div>
			<!-- CONATINER END -->
			<script src="assets/js/jquery.js"></script>
			<script src="assets/js/bootstrap.min.js"></script>
	</html>