<?php
 session_start();
require_once 'assets/conn/dbconnect.php';
$GLOBALS['con'] = $con;

class Controller
{

    public function newPage(string $newURL)
    {
        header('Location: '. $newURL);
        die();
    }
    public function footer()
    {
        include 'footer.php';
    }
    public function inputData($tablename='',$one='', $two='', $three='',$fourth='',$five='',$six='',$seven='')
    {
        switch ($tablename){
        case 'patient':
            {
                $query = "INSERT INTO ".$tablename." (  icPatient, password, Name, Famil,  DR, Gender,   Email )
                    VALUES ( '$one', '$two', '$three', '$fourth', '$five', '$six', '$seven' )";
                break;
            }
        case 'patientappoint':
            {
                $query = "INSERT INTO appointment (  patientIc , scheduleId )
                            VALUES ( '$one', '$two') ";
                break;
            }
        case 'doctorschedule':
            {
                $query = " INSERT INTO ".$tablename." ( doctorIc,  Date, Day, Time, End,  Avaible)
                             VALUES ( '$one','$two', '$three', '$fourth', '$five', '$six' ) ";
                break;
            }
        }
        $result = mysqli_query($GLOBALS['con'], $query);
        return $result;
    }
    public function updateData($tablename='',$one='', $two='', $three='',$fourth='',$five='',$six='',$seven='',$eith='')
    {
    switch ($tablename){
        case 'patient':
            {
                $query = "UPDATE ".$tablename."  patient SET Name='$one', Famil='$two',  DR='$three', Gender='$fourth', Address='$five', Phone='$six', Email='$seven' WHERE icPatient='$eith'";
                break;
            }
        case 'doctor':
            {
                $query = "UPDATE ".$tablename." SET Name='$one', Famil='$two', Phone='$three', Email='$fourth', Address='$five' WHERE icDoctor= '$six' ";
                break;
            }
        case 'appointment':
            {
                $query = " UPDATE ".$tablename." SET status='Завершено' WHERE Id=$one";
                break;
            }
        case 'doctorschedule':
            {
                $query = " UPDATE ".$tablename." SET Avaible = '$one' WHERE scheduleId = $two";
                break;
            }
        case 'doctorschedule, appointment':
            {
                $query = " UPDATE doctorschedule, appointment SET Avaible ='$one' WHERE Id='$two' and appointment.scheduleId=doctorschedule.scheduleId";
                break;
            }
        case 'doctorschedule(getschedule)':
            {
                $query = " UPDATE doctorschedule SET Avaible = '$one' WHERE scheduleId = '$two'";
                break;
            }
        }
        $result = mysqli_query($GLOBALS['con'], $query);
        return $result;
    }

    public function deleteData($tablename='',$one='')
    {
    switch ($tablename){
        case 'appointment(delapp)':
            {
                $query = "DELETE FROM appointment WHERE Id='$one'";
                break;
            }
        case 'doctorschedule(delapp)':
            {
                $query = "DELETE FROM doctorschedule WHERE scheduleId='$one'";
                break;
            }
        case 'doctorschedule(delsched)':
            {
                $query = "DELETE FROM doctorschedule WHERE scheduleId='$one'";
                break;
            }
        case 'appointment(delapppath)':
            {
                $query = "DELETE FROM appointment WHERE Id='$one'";
                break;
            }
        }
        $result = mysqli_query($GLOBALS['con'], $query);
        return $result;
    }

    public function selectAllWithoutData($tablename='')
    {

        $query = "select * FROM ".$tablename."";
        $result = mysqli_query($GLOBALS['con'], $query);
        return $result;
    }

    public function selectData($tablename='',$one='')
    {
    switch ($tablename){
        case 'patient(index)':
            {
                $query = "SELECT * FROM patient WHERE icPatient = '$one'";
                break;
            }
        case 'doctor(adminlog)':
            {
                $query = "SELECT * FROM doctor WHERE icDoctor = '$one'";
                break;
            }
        case 'doctorschedule(delsched)':
            {
                $query = "DELETE FROM doctorschedule WHERE scheduleId='$one'";
                break;
            }
        case 'appointment(delapppath)':
            {
                $query = "DELETE FROM appointment WHERE Id='$one'";
                break;
            }
        }
        $result = mysqli_query($GLOBALS['con'], $query);
        return $result;
    }

}

?>