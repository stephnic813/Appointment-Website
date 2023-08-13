<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
        
    <title>Create Account</title>
    <style>
        .container{
            animation: transitionIn-X 0.5s;
        }
    </style>
</head>
<body>
<?php

//Unset all the server side variables

session_start();

$_SESSION["user"]="";
$_SESSION["usertype"]="";

// Set the new timezone
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');

$_SESSION["date"]=$date;


//import database
include("connection.php");





if($_POST){

    $result= $database->query("select * from webuser");
     
    $doc = $_SESSION["date"];

    $file = 'signup.json';
    $jsonData = file_get_contents($file);
    $personalData = json_decode($jsonData, true);

    $fname = $personalData['fname'];
    $lname = $personalData['lname'];
    $name=$fname." ".$lname;
    $contact = $personalData['contact_no'];
    $address = $personalData['address'];

    $company_type = $personalData['company_type'];
    $company_name = $personalData['company_name'];
    $company_position = $personalData['company_position'];
    $client_status = $personalData['client_status'];
    //$profile_pic = $personalData['profile-pic'];

    $profile_pic = $_FILES["profile-pic"]["name"];
    //$profile_pic_tempname = ['profile-pic-tempname'];
    //$profile_pic_folder = "img" . $profile_pic;

    
    $email=$_POST['newemail'];
    $newpassword=$_POST['newpassword'];
    $cpassword=$_POST['cpassword'];

    if ($newpassword==$cpassword){
        $result= $database->query("select * from webuser where email='$email';");

        if($result->num_rows==1){
            $error='<label for="prompt" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>';
        }else{

            if (is_uploaded_file($_FILES['profile-pic']['tmp_name'])) {
                $profile_pic = $_FILES['profile-pic']['name'];
                $profile_pic_folder = "img/profile_pic/" . $profile_pic;

                if (move_uploaded_file($_FILES['profile-pic']['tmp_name'], $profile_pic_folder)) {
                    // File uploaded successfully
                    $database->query("insert into client(cemail,cname,cpassword,cdoc,ccontact,caddress,ctype,cstatus,ccompany_name,ccompany_position,cprofile_pic) values('$email','$name','$newpassword','$doc','$contact','$address','$company_type','$client_status','$company_name','$company_position','$profile_pic')");
                    $database->query("insert into webuser values('$email','c')");

                    $_SESSION["user"]=$email;
                    $_SESSION["usertype"]="c";
                    $_SESSION["username"]=$fname;

                    header('Location: client/index.php');
                } else {
                    // Error uploading file
                    $error='<label for="prompt" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Error uploading file.</label>';
                }
            } else {
                // File not uploaded
                $error='<label for="prompt" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">File not uploaded.</label>';
            }
        }
    }




    
}else{
    //header('location: signup.php');
    $error='<label for="promter" class="form-label"></label>';
}

?>


    <center>
    <div class="container">
        <table border="0" style="width: 69%;">
            <tr>
                <td colspan="2">
                    <p class="header-text">Let's Get Started</p>
                    <p class="sub-text">It's Okey, Now Create User Account.</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" enctype="multipart/form-data" >

                            <!--profile pic-->
            <tr>
                <td class="label-td" colspan="2">
                    <label for="profile-pic" class="form-label">Upload your photo </label>
                </td>
            </tr>
            <td class="label-td" colspan="2">
                    <input type="file" name="profile-pic" class="input-text" placeholder="upload picture" required>
                </td>
            </tr>
            
                <td class="label-td" colspan="2">
                    <label for="newemail" class="form-label">Email: </label>
                </td>
            </tr>
            <tr>

            <tr>
                <td class="label-td" colspan="2">
                    <input type="email" name="newemail" class="input-text" placeholder="Email Address" required>
                </td>
                
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="newpassword" class="form-label">Create New Password: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="password" name="newpassword" class="input-text" placeholder="New Password" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="cpassword" class="form-label">Conform Password: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="password" name="cpassword" class="input-text" placeholder="Conform Password" required>
                </td>
            </tr>


     
            <tr>
                
                <td colspan="2">
                    <?php echo $error ?>

                </td>
            </tr>
            
            <tr>
                <td>
                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >
                </td>
                <td>
                    <input type="submit" value="Sign Up" class="login-btn btn-primary btn">
                </td>

            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                    <a href="client_login.php" class="hover-link1 non-style-link">Login</a>
                    <br><br><br>
                </td>
            </tr>

                    </form>
            </tr>
        </table>

    </div>
</center>
</body>
</html>