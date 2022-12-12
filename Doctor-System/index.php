<?php
session_start();
include_once 'controller.php';
$controller = new Controller();
if (isset($_SESSION['patientSession']) != "") {
    $controller->newPage("patient/patient.php");
}
if (isset($_POST['login']))
{
    $icPatient = mysqli_real_escape_string($con,$_POST['icPatient']);
    $password  = mysqli_real_escape_string($con,$_POST['password']);

    $res = $controller->selectData('patient', $icPatient);
    $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
    if ($row['password'] == $password)
    {
        $_SESSION['patientSession'] = $row['icPatient'];
        ?>
        <script type="text/javascript">
        alert('Вход успешен');
        </script>
        <?php
        $controller->newPage("patient/patient.php");
    } 
    else {
        ?>
        <script>
        alert('Неверный ввод ');
        </script>
        <?php
    }
}
?>

<?php

if ($_GET['teleport'] == "1")
{
    $controller->newPage("adminlogin.php");
}

if (isset($_POST['signup'])) {
$Name             = mysqli_real_escape_string($con,$_POST['Name']);
$Famil            = mysqli_real_escape_string($con,$_POST['Famil']);
$Email            = mysqli_real_escape_string($con,$_POST['Email']);
$icPatient        = mysqli_real_escape_string($con,$_POST['icPatient']);
$password         = mysqli_real_escape_string($con,$_POST['password']);
$month            = mysqli_real_escape_string($con,$_POST['month']);
$day              = mysqli_real_escape_string($con,$_POST['day']);
$year             = mysqli_real_escape_string($con,$_POST['year']);
$DR       = $year . "-" . $month . "-" . $day;
$Gender    = mysqli_real_escape_string($con,$_POST['Gender']);
$result = $controller->inputData('patient', $icPatient, $password, $Name, $Famil, $DR, $Gender, $Email);
echo mysqli_error($con);
if( $result )
{
?>
<script type="text/javascript">
alert('Регистрация прошла успешно, авторизируйтесь на сайте для продолжения');
</script>
<?php
}
else
{
?>
<script type="text/javascript">
alert('Пользователь с таким полисом уже зарегистрирован');
</script>
<?php
}

}
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Наша Поликлиника</title>
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style1.css" rel="stylesheet">
        <link href="assets/css/blocks.css" rel="stylesheet">
        <link href="assets/css/material.css" rel="stylesheet">
    </head>

    <body>
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php?teleport=1">Вход для врачей</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">Регистрация</h3>
                    </div>
                    <div class="modal-body">
                        <div class="container" id="wrap">
                            <div class="row">
                                <div class="col-md-6">
                                    
                                    <form action="<?php $_PHP_SELF ?>" method="POST" accept-charset="utf-8" class="form" role="form">
                                        <div class="row">
                                            <div class="col-xs-6 col-md-6">
                                                <input type="text" name="Name" value="" class="form-control input-lg" placeholder="Имя" required />
                                            </div>
                                            <div class="col-xs-6 col-md-6">
                                                <input type="text" name="Famil" value="" class="form-control input-lg" placeholder="Фамилия" required />
                                            </div>
                                        </div>
                                        
                                        <input type="text" name="Email" value="" class="form-control input-lg" placeholder="E-mail"  required/>
                                        <input type="number" name="icPatient" value="" class="form-control input-lg" placeholder="№ полиса"  required/>
                                        
                                        
                                        <input type="password" name="password" value="" class="form-control input-lg" placeholder="Пароль"  required/>
                                        
                                        <input type="password" name="confirm_password" value="" class="form-control input-lg" placeholder="Повторите пароль"  required/>
                                        <label>Дата рождения</label>
                                        <div class="row">
                                            
                                            <div class="col-xs-4 col-md-4">
                                                <select name="year" class = "form-control input-lg" required>
                                                    <option value="">Год</option>
                                                    <option value="1947">1947</option>
                                                    <option value="1948">1948</option>
                                                    <option value="1949">1949</option>
                                                    <option value="1950">1950</option>
                                                    <option value="1951">1951</option>
                                                    <option value="1952">1952</option>
                                                    <option value="1953">1953</option>
                                                    <option value="1954">1954</option>
                                                    <option value="1955">1955</option>
                                                    <option value="1956">1956</option>
                                                    <option value="1957">1957</option>
                                                    <option value="1958">1958</option>
                                                    <option value="1959">1959</option>
                                                    <option value="1960">1960</option>
                                                    <option value="1961">1961</option>
                                                    <option value="1962">1962</option>
                                                    <option value="1963">1963</option>
                                                    <option value="1964">1964</option>
                                                    <option value="1965">1965</option>
                                                    <option value="1966">1966</option>
                                                    <option value="1967">1967</option>
                                                    <option value="1968">1968</option>
                                                    <option value="1969">1969</option>
                                                    <option value="1970">1970</option>
                                                    <option value="1971">1971</option>
                                                    <option value="1972">1972</option>
                                                    <option value="1973">1973</option>
                                                    <option value="1974">1974</option>
                                                    <option value="1975">1975</option>
                                                    <option value="1976">1976</option>
                                                    <option value="1977">1977</option>
                                                    <option value="1978">1978</option>
                                                    <option value="1979">1979</option>
                                                    <option value="1980">1980</option>
                                                    <option value="1981">1981</option>
                                                    <option value="1982">1982</option>
                                                    <option value="1983">1983</option>
                                                    <option value="1984">1984</option>
                                                    <option value="1985">1985</option>
                                                    <option value="1986">1986</option>
                                                    <option value="1987">1987</option>
                                                    <option value="1988">1988</option>
                                                    <option value="1989">1989</option>
                                                    <option value="1990">1990</option>
                                                    <option value="1991">1991</option>
                                                    <option value="1992">1992</option>
                                                    <option value="1993">1993</option>
                                                    <option value="1994">1994</option>
                                                    <option value="1995">1995</option>
                                                    <option value="1996">1996</option>
                                                    <option value="1997">1997</option>
                                                    <option value="1998">1998</option>
                                                    <option value="1999">1999</option>
                                                    <option value="2000">2000</option>
                                                    <option value="2001">2001</option>
                                                    <option value="2002">2002</option>
                                                    <option value="2003">2003</option>
                                                    <option value="2004">2004</option>
                                                    <option value="2005">2005</option>
                                                    <option value="2006">2006</option>
                                                    <option value="2007">2007</option>
                                                    <option value="2008">2008</option>
                                                    <option value="2009">2009</option>
                                                    <option value="2010">2010</option>
                                                    <option value="2011">2011</option>
                                                    <option value="2012">2012</option>
                                                    <option value="2013">2013</option>
                                                    <option value="2014">2014</option>
                                                    <option value="2015">2015</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                </select>
                                            </div>

                                            <div class="col-xs-4 col-md-4">
                                                <select name="month" class = "form-control input-lg" required>
                                                    <option value="">Месяц</option>
                                                    <option value="01">Январь</option>
                                                    <option value="02">Февраль</option>
                                                    <option value="03">Март</option>
                                                    <option value="04">Апрель</option>
                                                    <option value="05">Май</option>
                                                    <option value="06">Июнь</option>
                                                    <option value="07">Июль</option>
                                                    <option value="08">Август</option>
                                                    <option value="09">Сентябрь</option>
                                                    <option value="10">Октябрь</option>
                                                    <option value="11">Ноябрь</option>
                                                    <option value="12">Декабрь</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-4 col-md-4">
                                                <select name="day" class = "form-control input-lg" required>
                                                    <option value="">День</option>
                                                    <option value="01">1</option>
                                                    <option value="02">2</option>
                                                    <option value="03">3</option>
                                                    <option value="04">4</option>
                                                    <option value="05">5</option>
                                                    <option value="06">6</option>
                                                    <option value="07">7</option>
                                                    <option value="08">8</option>
                                                    <option value="09">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                </select>
                                            </div>
                                            
                                        </div>
                                        <label>Пол:   </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="Gender" value="Мужчина" required/>Муж.
                                        </label>
                                        <label class="radio-inline" >
                                            <input type="radio" name="Gender" value="Женщина" required/>Жен.
                                        </label>
                                        <br />
                                        
                                        <button class="btn btn-lg btn-primary btn-block signup-btn" type="submit" name="signup" id="signup">Зарегистрироваться</button>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section id="promo-1" class="content-block promo-1 min-height-600px bg-offwhite">
            <div class="container">
                <div class="row">
                
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <form class="form" role="form" method="POST" accept-charset="UTF-8" >
                                                <div class="form-group">
                                                    <label class="sr-only" for="icPatient">E-mail</label>
                                                    <input type="text" class="form-control" name="icPatient" placeholder="№ медицинского полиса" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="password">Пароль</label>
                                                    <input type="password" class="form-control" name="password" placeholder="Пароль" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="login" id="login" class="btn btn-primary btn-block">Войти</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                <a class="a-button" href="#" data-toggle="modal" data-target="#myModal"href="#">Зарегистрироваться</a>
                       
                        <script>

                            function showUser(str) {
                                
                                if (str == "") {
                                    document.getElementById("txtHint").innerHTML = "";
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
                                    xmlhttp.open("GET","getuser.php?q="+str,true);
                                    console.log(str);
                                    xmlhttp.send();
                                }
                            }
                        </script>
                        <div id="txtHint"><b> </b></div>
                    </div>
                </div>
            </div>
        </section>
                  <?php $controller->footer()?>
    </div>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>