<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='c'){
            header("location: ../client_login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../client_login.php");
    }
    

    //import database
    include("../connection.php");
    $userrow = $database->query("select * from client where cemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["cid"];
    $username=$userfetch["cname"];


    if($_POST){
        if(isset($_POST["booknow"])){
            $apponum=$_POST["apponum"];
            $scheduleid=$_POST["scheduleid"];
            $date=$_POST["date"];
            $scheduleid=$_POST["scheduleid"];
            $sql2="insert into appointment(pid,apponum,scheduleid,appodate) values ($userid,$apponum,$scheduleid,'$date')";
            $result= $database->query($sql2);
            //echo $apponom;
            header("location: appointment.php?action=booking-added&id=".$apponum."&titleget=none");

        }
    }
 ?>