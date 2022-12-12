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
$res = $controller->inputData('doctor(adminlog)', $icDoctor);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
        $Date            = mysqli_real_escape_string($con,$_POST['Date']);
        $Day     = mysqli_real_escape_string($con,$_POST['Day']);
        $Time       = mysqli_real_escape_string($con,$_POST['Time']);
        $End         = mysqli_real_escape_string($con,$_POST['End']);
        $Avaible       = mysqli_real_escape_string($con,$_POST['Avaible']);
        $icDoctor = $userRow['icDoctor'];

        $query = " INSERT INTO doctorschedule ( doctorIc,  Date, Day, Time, End,  Avaible)
        VALUES ( '$icDoctor','$Date', '$Day', '$Time', '$End', '$Avaible' ) ";

        $result = $controller->inputData('doctorschedule', $icDoctor, $Date, $Day, $Time, $End, $Avaible);
        echo mysqli_error($con);
        if( $result )
        {
            ?>
            <script type="text/javascript">
            alert('Запись успешно добавлена');
            </script>
            <?php
        }
        else
        {
            ?>
            <script type="text/javascript">
            alert('Создание записи не удалось, попробуйте снова');
            </script>
            <?php
        }

}


switch ($_GET['teleport']){
case "1":
    $controller->newPage("addschedule.php");
case "2":
    $controller->newPage("doctorprofile.php");
case "3":
    $controller->newPage("doctordashboard.php");
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
        <link href="assets/css/time/bootstrap-clockpicker.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

        <style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>
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
                                <a href="addschedule.php?teleport=2"><i class="fa fa-fw fa-user"></i> Ваш профиль</a>
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
                        <li>
                            <a href="addschedule.php?teleport=3"><i class="fa fa-fw fa-dashboard"></i> Рабочий лист</a>
                        </li>
                        <li class="active">
                            <a href="addschedule.php?teleport=1"><i class="fa fa-fw fa-table"></i> Ваше расписание</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div id="page-wrapper">
                <div class="container-fluid">
                    

                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="page-header">
                            Ваше расписание
                            </h2>
                        </div>
                    </div>

                    <div class="panel panel-primary">

                        <div class="panel-heading">
                            <h3 class="panel-title">Добавить приём</h3>
                        </div>

                        <div class="panel-body">
                            <div class="bootstrap-iso">
                             <div class="container-fluid">
                              <div class="row">
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                <form class="form-horizontal" method="post">
                                 <div class="form-group form-group-lg">
                                  <label class="control-label col-sm-2 requiredField" for="Date">
                                   Дата
                                   <span class="asteriskField">
                                    *
                                   </span>
                                  </label>
                                  <div class="col-sm-10">
                                   <div class="input-group">
                                    <div class="input-group-addon">
                                     <i class="fa fa-calendar">
                                     </i>
                                    </div>
                                    <input class="form-control" id="Date" name="Date" type="text" required/>
                                   </div>
                                  </div>
                                 </div>
                                 <div class="form-group form-group-lg">
                                  <label class="control-label col-sm-2 requiredField" for="Day">
                                   День
                                   <span class="asteriskField">
                                    *
                                   </span>
                                  </label>
                                  <div class="col-sm-10">
                                   <select class="select form-control" id="Day" name="Day" required>
                                    <option value="Понедельник">
                                     Понедельник
                                    </option>
                                    <option value="Вторник">
                                     Вторник
                                    </option>
                                    <option value="Среда">
                                     Среда
                                    </option>
                                    <option value="Четверг">
                                     Четверг
                                    </option>
                                    <option value="Пятница">
                                     Пятница
                                    </option>
                                    <option value="Суббота">
                                     Суббота
                                    </option>
                                    <option value="Воскресенье">
                                     Воскресенье
                                    </option>
                                   </select>
                                  </div>
                                 </div>
                                 <div class="form-group form-group-lg">
                                  <label class="control-label col-sm-2 requiredField" for="Time">
                                   Начало приема
                                   <span class="asteriskField">
                                    *
                                   </span>
                                  </label>

                                  <div class="col-sm-10">
                                   <div class="input-group clockpicker"  data-align="top" data-autoclose="true">
                                    <div class="input-group-addon">
                                     <i class="fa fa-clock-o">
                                     </i>
                                    </div>
                                    <input class="form-control" id="Time" name="Time" type="text" required/>
                                   </div>
                                  </div>
                                 </div>
                                 <div class="form-group form-group-lg">
                                  <label class="control-label col-sm-2 requiredField" for="End">
                                   Конец приема
                                   <span class="asteriskField">
                                    *
                                   </span>
                                  </label>
                                  <div class="col-sm-10">
                                   <div class="input-group clockpicker"  data-align="top" data-autoclose="true">
                                    <div class="input-group-addon">
                                     <i class="fa fa-clock-o">
                                     </i>
                                    </div>
                                    <input class="form-control" id="End" name="End" type="text" required/>
                                   </div>
                                  </div>
                                 </div>
                                 <div class="form-group form-group-lg">
                                  <label class="control-label col-sm-2 requiredField" for="Avaible">
                                   Доступность 
                                   <span class="asteriskField">
                                    *
                                   </span>
                                  </label>
                                  <div class="col-sm-10">
                                   <select class="select form-control" id="Avaible" name="Avaible" required>
                                    <option value="Доступно">
                                     Доступно
                                    </option>
                                    <option value="Недоступно">
                                     Недоступно
                                    </option>
                                   </select>
                                  </div>
                                 </div>
                                 <div class="form-group">
                                  <div class="col-sm-10 col-sm-offset-2">
                                   <button style="background-color:#694d00 " class="btn btn-primary " name="submit" type="submit">
                                    Создать
                                   </button>
                                  </div>
                                 </div>
                                </form>
                               </div>
                              </div>
                             </div>
                            </div>                        
                        </div>
                    </div>
                    <div class="panel panel-primary filterable">

                        <div class="panel-heading">
                            <h3 class="panel-title">Список записей</h3>
                        </div>
                        <div class="panel-body">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="filters">
                                    <th><input type="text" class="form-control" placeholder="Дата" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="День" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Время начала приема" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Время окончания приема" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Доступность приема" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Удалить прием" disabled></th>
                                </tr>
                            </thead>
                            
                            <?php 
                            $result=mysqli_query($con,"SELECT * FROM doctorschedule");
                            

                                  
                            while ($doctorschedule=mysqli_fetch_array($result)) 
                            {
                                if ($doctorschedule['doctorIc'] == $userRow['icDoctor'])
                                { 
                                    echo "<tbody>";
                                    echo "<tr>";
                                        echo "<td>" . $doctorschedule['Date'] . "</td>";
                                        echo "<td>" . $doctorschedule['Day'] . "</td>";
                                        echo "<td>" . $doctorschedule['Time'] . "</td>";
                                        echo "<td>" . $doctorschedule['End'] . "</td>";
                                        echo "<td>" . $doctorschedule['Avaible'] . "</td>";
                                        echo "<form method='POST'>";
                                        echo "<td class='text-center'><a href='#' id='".$doctorschedule['scheduleId']."' class='delete'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a> </td>";
                                }
                            } 
                                echo "</tr>";
                           echo "</tbody>";
                       echo "</table>";
                        ?>
                        </div>
                    </div>
                </div>
                
            </div>


       
<script src="../patient/assets/js/jquery.js"></script>
<script src="../patient/assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap-clockpicker.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

<script>
    $(document).ready(function(){
        var date_input=$('input[name="Date"]');
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>
<script type="text/javascript">
    $('.clockpicker').clockpicker();
</script>
 <script type="text/javascript">
$(function() {
$(".delete").click(function(){
var element = $(this);
var id = element.attr("id");
var info = 'id=' + id;
if(confirm("Вы уверены, что хотите удалить запись?"))
{
 $.ajax({
   type: "POST",
   url: "deleteschedule.php",
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