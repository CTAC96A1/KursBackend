<?php
session_start();
include_once '../controller.php';
$controller = new Controller();
$session=$_SESSION[ 'patientSession'];
$res = $controller->selectData('pathient(applist)(res)', $session);
$userRow=mysqli_fetch_array($res);

	switch ($_GET['teleport']){
case "1":
    $controller->newPage("patient.php");
case "2":
	$controller->newPage("profile.php?icPatient=".$userRow['icPatient']);
case "3":
    $controller->newPage("patientapplist.php?icPatient=".$userRow['icPatient']);
case "4":
    $controller->newPage("patientlogout.php?logout");
}
?>
<!DOCTYPE html>
<html >
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="assets/css/material.css" rel="stylesheet">
		
		<link href="assets/css/default/style.css" rel="stylesheet">
		<link href="assets/css/default/blocks.css" rcel="stylesheet">

	</head>
	<body >
		<nav class="navbar navbar-default " role="navigation">
			<div class="container-fluid">
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<ul class="nav navbar-nav">
							<li><a href="patientapplist.php?teleport=1">На главную</a></li>
							<li><a href="patientapplist.php?teleport=3">Записи</a></li>
						</ul>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['Name']; ?> <?php echo $userRow['Famil']; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
									<a href="patientapplist.php?teleport=2"><i class="fa fa-fw fa-user"></i> Профиль</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="patientapplist.php?teleport=4"><i class="fa fa-fw fa-power-off"></i> Выход</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
<?php


echo "<div class='container' style='padding-bottom:970px'>";
echo "<div class='row'>";
echo "<div class='page-header'>";
echo "<h1>Ваши записи </h1>";
echo "</div>";
echo "<div class='panel panel-primary'>";
echo "<div class='panel-body'>";
echo "<table class='table table-hover'>";
echo "<thead>";
echo "<tr>";
echo "<th>Ваш полис </th>";
echo "<th>Имя посетителя</th>";
echo "<th>Фамилия посетителя</th>";
echo "<th>Имя врача </th>";
echo "<th>Фамилия врача </th>";
echo "<th>Местонахождение кабинета</th>";
echo "<th>День недели </th>";
echo "<th>Дата </th>";
echo "<th>Время начала </th>";
echo "<th>Удалить запись </th>";
echo "</tr>";
echo "</thead>";

$res = $controller->selectData('pathient(applist)(res)', $session);
$docrrs = $controller->selectData('pathient(applist)(docrrs)', $session);

$docRow=mysqli_fetch_array($docrrs);



while ($userRow = mysqli_fetch_array($res)) {
echo "<tbody>";
echo "<tr>";
echo "<td>" . $userRow['patientIc'] . "</td>";
echo "<td>" . $userRow['Name'] . "</td>";
echo "<td>" . $userRow['Famil'] . "</td>";
echo "<td>" . $docRow['Name'] . "</td>";
echo "<td>" . $docRow['Famil'] . "</td>";
echo "<td>" . $docRow['Address'] . "</td>";
echo "<td>" . $userRow['Day'] . "</td>";
echo "<td>" . $userRow['Date'] . "</td>";
echo "<td>" . $userRow['Time'] . "</td>";
echo "<td class='text-center'><a href='#' id='".$userRow['Id']."' class='delete'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a></td>";
}

echo "</tr>";
echo "</tbody>";
echo "</table>";

?>
	</div>
</div>
</div>
</div>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(function() {
$(".delete").click(function(){
var element = $(this);
var appid = element.attr("id");
var info = 'id=' + appid;
if(confirm("Вы уверены, что хотите удалить приём из списка?"))
{
 $.ajax({
   type: "POST",
   url: "deleteappointment.php",
   data: info,
   success: function(){
 }
});
  $(this).parent().parent().fadeOut(300, function(){ $(this).remove();});
 }
return false;
});
});
</script>
<?php $controller->footer()?>
</body>
</html>