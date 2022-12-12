<?php
session_start();
include_once 'controller.php';
$controller = new Controller();
if (isset($_SESSION['doctorSession']) != "") {
    $controller->newPage("doctor/doctordashboard.php");
}
if (isset($_POST['login']))
{
    $icDoctor = mysqli_real_escape_string($con,$_POST['icDoctor']);
    $password  = mysqli_real_escape_string($con,$_POST['password']);

    $res = $controller->selectData('doctor', $icDoctor);

    $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
    if ($row['password'] == $password)
    {
        $_SESSION['doctorSession'] = $row['icDoctor'];
        ?>
        <script type="text/javascript">
        alert('Login Success');
        </script>
        <?php
        $controller->newPage("doctor/doctordashboard.php");
    } else {
        ?>
        <script type="text/javascript">
            alert("Wrong input");
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Наша Поликлиника вход для врачей</title>
        <link href="assets/css/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="login-container">
                    <div id="output"></div>
                    <div class="avatar"></div>
                    <div class="form-box">
                        <form class="form" role="form" method="POST" accept-charset="UTF-8">
                            <input name="icDoctor" type="text" placeholder="Идентификатор Врача" required>
                            <input name="password" type="password" placeholder="Пароль" required>
                            <button class="btn btn-info btn-block login" type="submit" name="login">Войти</button>
                        </form>
                    </div>
                </div>
        </div>

        <script src="assets/js/jquery.js"></script>
    </body>
</html>