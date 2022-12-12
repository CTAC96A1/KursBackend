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


if (isset($_POST['submit'])) {
$Name = $_POST['Name'];
$Famil = $_POST['Famil'];
$Phone = $_POST['Phone'];
$Email = $_POST['Email'];
$Address = $_POST['Address'];

$result = $controller->updateData('doctor', $Name, $Famil, $Phone, $Email, $Address, $_SESSION['doctorSession']);
$controller->newPage("doctorprofile.php");
}

switch ($_GET['teleport']){
case "1":
    $controller->newPage("doctordashboard.php");
case "2":
    $controller->newPage("doctorprofile.php");
case "3":
    $controller->newPage("addschedule.php");
}



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Добро пожаловать <?php echo $userRow['Name'];?> <?php echo $userRow['Famil'];?></title>
        <link href="assets/css/material.css" rel="stylesheet">
        <link href="assets/css/sb-admin.css" rel="stylesheet">
        <link href="assets/css/time/bootstrap-clockpicker.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    </head>
    <body>
        <div id="wrapper">
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    </button>
                    <a class="navbar-brand" href="doctordashboard.php">Добро пожаловать <?php echo $userRow['Name'];?> <?php echo $userRow['Famil'];?></a>
                </div>
                <ul class="nav navbar-right top-nav">
                    
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['Name']; ?> <?php echo $userRow['Famil']; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="doctorprofile.php?teleport=2"><i class="fa fa-fw fa-user"></i> Ваш профиль</a>
                            </li>
                           
                            <li class="divider"></li>
                            <li>
                                <a href="logout.php?logout"><i class="fa fa-fw fa-power-off"></i> Выход</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                         <li>
                            <a href="doctorprofile.php?teleport=1"><i class="fa fa-fw fa-dashboard"></i> Рабочий лист</a>
                        </li>
                        <li>
                            <a href="doctorprofile.php?teleport=3"><i class="fa fa-fw fa-table"></i>Ваше расписание</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="page-header">
                            Профиль врача
                            </h2>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Подробнее</h3>
                        </div>
                        <div class="panel-body">
                          <div class="container">
            <section style="padding-bottom: 50px; padding-top: 50px;">
                <div class="row">
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            
                            <div class="user-wrapper">
                                <img src="assets/img/doctor01.png" class="img-responsive" />
                                <div class="description">
                                    <h4><?php echo $userRow['Name']; ?> <?php echo $userRow['Famil']; ?></h4>
                                    <h5> <strong> Доктор </strong></h5>
                                    
                                    <hr />
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Изменить профиль</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-9 col-sm-9  user-wrapper">
                            <div class="description">
                                <h3> <?php echo $userRow['Name']; ?> <?php echo $userRow['Famil']; ?> </h3>
                                <hr />
                                
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        
                                        
                                        <table class="table table-user-information" align="center">
                                            <tbody>
                                                <tr>
                                                    <td>ИН врача</td>
                                                    <td><?php echo $userRow['icDoctor']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Адрес приема</td>
                                                    <td><?php echo $userRow['Address']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Номер телефона</td>
                                                    <td><?php echo $userRow['Phone']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td><?php echo $userRow['Email']; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Дата рождения</td>
                                                    <td><?php echo $userRow['DR']; ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Изменение профиля</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?php $_PHP_SELF ?>" method="post" >
                                            <table class="table table-user-information">
                                                <tbody>
                                                    <tr>
                                                        <td>ИН врача:</td>
                                                        <td><?php echo $userRow['icDoctor']; ?></td>
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
                                                        <td>Номер телефона</td>
                                                        <td><input type="text" class="form-control" name="Phone" value="<?php echo $userRow['Phone']; ?>"  /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td><input type="text" class="form-control" name="Email" value="<?php echo $userRow['Email']; ?>"  /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Адрес</td>
                                                        <td><textarea class="form-control" name="Address"  ><?php echo $userRow['Address']; ?></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="submit" name="submit" class="btn btn-info" value="Обновить информацию"></td>
                                                        </tr>
                                                    </tbody>
                                                    
                                                </table> 
                                            </form>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <br /><br/>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        <script src="../patient/assets/js/jquery.js"></script>
        <script src="../patient/assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-clockpicker.js"></script>
    </body>
</html>