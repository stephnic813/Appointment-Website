<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='e'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    
    if($_POST){
        //import database
        include("../connection.php");
        $title=$_POST["title"];
        $eid=$_POST["eid"];
        $nop=$_POST["nop"];
        $date=$_POST["date"];
        $time=$_POST["time"];
        $schedtype=$_POST["schedtype"];
        $schedplace=$_POST["schedplace"];
        $schedlink=$_POST["schedlink"];
        $sql="insert into schedule (eid,title,scheduledate,scheduletime,nop,schedule_type,schedule_set,schedule_meeting) values ('$eid','$title','$date','$time','$nop','$schedtype','$schedplace','$schedlink');";
        $result= $database->query($sql);
        header("location: schedule.php?action=session-added&title=$title");
        
    }


?>