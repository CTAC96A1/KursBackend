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

    public function selectData($tablename='',$one='', $two='', $three='')
    {
    switch ($tablename){
        case 'patient':
            {
                $query = "SELECT * FROM patient WHERE icPatient = '$one'";
                break;
            }
        case 'doctor':
            {
                $query = "SELECT * FROM doctor WHERE icDoctor = $one";
                break;
            }
        case 'doctor(docdashboar)(long)':
            {
                $query = "SELECT a.*, b.*,c.*
                            FROM patient a
                            JOIN appointment b
                            On a.icPatient = b.patientIc
                            JOIN doctorschedule c
                            On b.scheduleId=c.scheduleId
                            Order By Id desc";
                break;
            }
        case 'pathient(patapp)(res)':
            {
                $query = "SELECT a.*, b.* FROM doctorschedule a INNER JOIN patient b WHERE a.Date='$one' AND scheduleId='$two' AND b.icPatient='$three' ";
                break;
            }
        case 'pathient(patapp)(docres)':
            {
                $query = "SELECT a.*, b.* FROM doctorschedule a JOIN doctor b ON a.Date='$one' AND scheduleId='$two' AND a.doctorIc = b.icDoctor ";
                break;
            }
        case 'pathient(getsch)(res)':
            {
                $query = "SELECT * FROM doctorschedule, doctor WHERE Date ='$one' and icDoctor = doctorIc";
                break;
            }
        case 'pathient(getsched)(reszap)':
            {
                $query = "SELECT a.*, b.* FROM doctorschedule a, patient b WHERE a.Date='$one' AND scheduleId='$two' AND b.icPatient='$three'";
                break;
            }
        case 'pathient(applist)(res)':
            {
                $query = "SELECT a.*, b.*,c.* FROM patient a
                                                JOIN appointment b
                                                On a.icPatient = b.patientIc
                                                JOIN doctorschedule c
                                                On b.scheduleId=c.scheduleId
                                                WHERE b.patientIc ='$one'";
                break;
            }
        case 'pathient(applist)(docrrs)':
            {
                $query = "SELECT d.*
                            FROM patient a
                            JOIN appointment b
                            On a.icPatient = b.patientIc
                            JOIN doctorschedule c
                            On b.scheduleId=c.scheduleId
                            JOIN doctor d
                            On c.doctorIc = d.icDoctor
                            WHERE b.patientIc ='$one'";
                break;
            }
        }
        $result = mysqli_query($GLOBALS['con'], $query);
        return $result;
    }

}

?>