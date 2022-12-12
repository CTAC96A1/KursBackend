<?php
session_start();
include_once '../controller.php';
$controller = new Controller();
if(!isset($_SESSION['doctorSession']))
{
    $controller->newPage("../index.php");
}
$usersession = $_SESSION['doctorSession'];
$res=mysqli_query($con,"SELECT * FROM doctor WHERE icDoctor=".$usersession);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);

switch ($_GET['teleport']){
case "1":
    $controller->newPage("addschedule.php");
case "2":
    $controller->newPage("doctorprofile.php");
}



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Добро пожаловать <?php echo $userRow['Name'];?> <?php echo $userRow['Famil'];?></title>
        <link href="assets/css/material.css" rel="stylesheet">
        <link href="assets/css/sb-admin.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
    </head>
    <body>
        <div id="wrapper">

            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="doctordashboard.php">Добро пожаловать <?php echo $userRow['Name'];?> <?php echo $userRow['Famil'];?></a>
                </div>
                <ul class="nav navbar-right top-nav">
                    
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['Name']; ?> <?php echo $userRow['Famil']; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="doctordashboard.php?teleport=2"><i class="fa fa-fw fa-user"></i> Профиль</a>
                            </li>
                           
                            <li class="divider"></li>
                            <li>
                                <a href="logout.php?logout"><i class="fa fa-fw fa-power-off"></i> Выйти</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li class="active">
                            <a href="doctordashboard.php"><i class="fa fa-fw fa-dashboard"></i> Рабочий лист</a>
                        </li>
                        <li>
                            <a href="doctordashboard.php?teleport=1"><i class="fa fa-fw fa-table"></i> Ваше расписание</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div id="page-wrapper">
                <div class="container-fluid">
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="page-header">
                            Рабочий лист
                            </h2>
                        </div>
                    </div>

                    <div class="panel panel-primary filterable">
                       <div class="panel-heading">
                        <h3 class="panel-title">Список приемов</h3>
                        </div>
                        <div class="panel-body">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="filters">
                                    <th><input type="text" class="form-control" placeholder="Полис пациента" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Имя" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Фамилия" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Телефон" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Email" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="День недели" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Дата" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Начало приема" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Конец приема" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Статус приема" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Прием завершен" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Удалить" disabled></th>
                                </tr>
                            </thead>
                            
                            <?php 
                            $res=mysqli_query($con,"SELECT a.*, b.*,c.*
                                                    FROM patient a
                                                    JOIN appointment b
                                                    On a.icPatient = b.patientIc
                                                    JOIN doctorschedule c
                                                    On b.scheduleId=c.scheduleId
                                                    Order By Id desc");
                                  if (!$res) {
                                    printf("Error: %s\n", mysqli_error($con));
                                    exit();
                                }
                            while ($appointment=mysqli_fetch_array($res)) {
                                if ($appointment['doctorIc'] == $userRow['icDoctor'])
                                {
                                if ($appointment['status']=='В процессе') {
                                    $status="danger";
                                    $icon='remove';
                                    $checked='';

                                } else {
                                    $status="success";
                                    $icon='ok';
                                    $checked = 'disabled';
                                }

                                
                              
                                
                             
                                

                                

                                echo "<tbody>";
                                echo "<tr class='$status'>";
                                    echo "<td>" . $appointment['patientIc'] . "</td>";
                                    echo "<td>" . $appointment['Name'] . "</td>";
                                    echo "<td>" . $appointment['Famil'] . "</td>";
                                    echo "<td>" . $appointment['Phone'] . "</td>";
                                    echo "<td>" . $appointment['Email'] . "</td>";
                                    echo "<td>" . $appointment['Day'] . "</td>";
                                    echo "<td>" . $appointment['Date'] . "</td>";
                                    echo "<td>" . $appointment['Time'] . "</td>";
                                    echo "<td>" . $appointment['End'] . "</td>";
                                    echo "<td><span class='glyphicon glyphicon-".$icon."' aria-hidden='true'></span>".' '."". $appointment['status'] . "</td>";
                                    echo "<form method='POST'>";
                                    echo "<td class='text-center'><input type='checkbox' name='enable' id='enable' value='".$appointment['Id']."' onclick='chkit(".$appointment['Id'].",this.checked);' ".$checked."></td>";
                                    echo "<td class='text-center'><a href='#' id='".$appointment['Id']."' class='delete'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                            </td>";
                            }
                            } 
                                echo "</tr>";
                           echo "</tbody>";
                       echo "</table>";
                        ?>
                    </div>
                </div>
<script type="text/javascript">
function chkit(uid, chk) {
   chk = (chk==true ? "1" : "0");
   var url = "checkdb.php?userid="+uid+"&chkYesNo="+chk;
   if(window.XMLHttpRequest) {
      req = new XMLHttpRequest();
   } else if(window.ActiveXObject) {
      req = new ActiveXObject("Microsoft.XMLHTTP");
   }
   req.open("GET", url, true);
   req.send(null);
}
</script>


 
                </div>
            </div>
        </div>


       
        <script src="../patient/assets/js/jquery.js"></script>
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
<script src="../patient/assets/js/bootstrap.min.js"></script>
					<?php $controller->footer()?>
</body>
</html>