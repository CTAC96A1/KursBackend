<?php
session_start();
include_once '../controller.php';
$q = $_GET['q'];
$controller = new Controller();
$res = $controller->selectData('pathient(getsch)(res)', $q);
?>
<?php
	
if (isset($_POST['submit'])) {
            ?>
        <script type="text/javascript">
        alert('lol');
        </script>
        <?php
    $session= $_SESSION['patientSession'];
    $reszap = $controller->selectData('pathient(getsched)(reszap)', $Date, $Id, $session);
    $userRow=mysqli_fetch_array($reszap,MYSQLI_ASSOC);
    $patientIc = mysqli_real_escape_string($con,$userRow['icPatient']);
    $scheduleid = mysqli_real_escape_string($con,$Id);
    $avail = "Недоступно";


    $query = "INSERT INTO appointment (  patientIc , scheduleId )
    VALUES ( '$patientIc', '$scheduleid') ";

    $sql = $controller->updateData('doctorschedule(getschedule)', $avail, $scheduleid);
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
    }
    else
    {
            echo mysqli_error($con);
        ?>
        <script type="text/javascript">
        alert('Appointment booking fail. Please try again.');
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
        if (mysqli_num_rows($res)==0) {
        echo "<div class='alert alert-danger' role='alert'>На данную дату свободных записей нет, выберете другой день</div>";
        
        } else {
        echo "   <table class='table table-hover'>";
            echo " <thead>";
                echo " <tr>";
                    echo " <th>Имя</th>";
                    echo " <th>Фамилия</th>";
                    echo " <th>Дата</th>";
                    echo " <th>Адрес</th>";
                    echo "  <th>Время</th>";
                    echo "  <th>Запись</th>";
                echo " </tr>";
            echo "  </thead>";
            echo "  <tbody>";
                while($row = mysqli_fetch_array($res)) {
                ?>
                <tr>
                    <?php
                    if ($row['Avaible']!='Доступно') {
                    $avail="danger";
                    $btnstate="disabled";
                    $btnclick="danger";
                    } else {
                    $avail="primary";
                    $btnstate="";
                    $btnclick="primary";
                    }

                    echo "<td>" . $row['Name'] . "</td>";
                    echo "<td>" . $row['Famil'] . "</td>";
                    echo "<td>" . $row['Date'] . "</td>";
                    echo "<td>" . $row['Address'] . "</td>";
                    echo "<td>" . $row['Time'] . "</td>";
                    echo "<form method='POST'>";
                     echo "<td><a href='appointment.php?add &Id=" . $row['scheduleId'] . "&Date=".$q."' class='btn btn-".$btnclick." btn-xs' role='button' ".$btnstate.">Записаться</a></td>";
                    ?>
                </tr>
                
                <?php
                }
                }
                ?>
            </tbody>   
        </body>
    </html>