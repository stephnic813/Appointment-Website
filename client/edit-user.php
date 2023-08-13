<?php
include("../connection.php");

if($_POST){
    //print_r($_POST);
    $result= $database->query("select * from webuser");
    $name=$_POST['name'];
    
    $oldemail=$_POST["oldemail"];
    $type=$_POST['type'];
    $status=$_POST['status'];
    $company_name=$_POST['company_name'];
    $company_position=$_POST['company_position'];
    $profile_pic=$_FILES['profile_pic']['name'];

    $email=$_POST['email'];
    $contact=$_POST['contact'];
    $address=$_POST['address'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    $id=$_POST['id00'];

    if ($password==$cpassword){
        $error='3';
        $aab="select client.cid from client inner join webuser on client.cemail=webuser.email where webuser.email='$email';";
        $result= $database->query($aab);

        if($result->num_rows==1){
            $id2=$result->fetch_assoc()["cid"];
        }else{
            $id2=$id;
        }

        if($id2!=$id){
            $error='1';
        }else{
            
            $sql1 = "update client set cemail='$email',cname='$name',cpassword='$password',ccontact='$contact',caddress='$address',ctype='$type',ccompany_name='$company_name',ccompany_position='$company_position',cstatus='$status'";
            
            if(!empty($profile_pic)){

                $target_dir = "../img/profile_pic/";
                $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
                move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file);

                $sql1 .= ",cprofile_pic='$profile_pic'";
                
            } else {
                echo "<srcipt>alert('Failed to upload')</script>;";
            }

            $sql1 .= " where cid=$id ;";

            $database->query($sql1);
            $sql2="update webuser set email='$email' where email='$oldemail' ;";
            $database->query($sql2);

            $error= '4';
        }
    }else{
        $error='2';
    }

}else{
    $error='3';
}

header("location: settings.php?action=edit&error=".$error."&id=".$id);
?>
