<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/login.css">
        
    <title>Login</title>
    
    <style>
        body{
    margin: 7%;
    
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

        $loginData=array(
            'email'=>$_POST['useremail'],
            'password'=>$_POST['userpassword']
        );

        $jsonData = json_encode($loginData);
        $file = 'client_login.json';
        file_put_contents($file, $jsonData);

//json decode
        $file = 'client_login.json';
        $loginjsonData = file_get_contents($file);
        $loginData = json_decode($loginjsonData, true);

        $email = $loginData['email'];
        $password = $loginData['password'];
        
        $error='<label for="prompt" class="form-label"></label>';

        $result= $database->query("select * from webuser where email='$email'");
        if($result->num_rows==1){
            $utype=$result->fetch_assoc()['usertype'];
            if ($utype=='c'){
                $checker = $database->query("select * from client where cemail='$email' and cpassword='$password'");
                if ($checker->num_rows==1){


                    //   CLient dashbord
                    $_SESSION['user']=$email;
                    $_SESSION['usertype']='c';
                    
                    header('location: client/index.php');

                }else{
                    $error='<label for="prompt" class="form-label" style="color:#ffccd5;text-align:center;">Wrong credentials: Invalid email or password</label>';
                }

            }
            
        }else{
            $error='<label for="prompt" class="form-label" style="color:#ffccd5;text-align:center;">We cannot find any account for this email.</label>';
        }






        
    }else{
        $error='<label for="prompt" class="form-label">&nbsp;</label>';
    }

    ?>





    <center>
    <div class="container" styles="background-color: red">
        <table border="0" style="margin: 0;padding: 0;width: 60%;">
            <tr>
                <td>
                    <p class="header-text">Set an Appointment</p>
                </td>
            </tr>
        <div class="form-body">
            <tr>
                <td>
                    <p class="sub-text">Login with your details to continue</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td">
                    <label for="useremail" class="form-label">Email: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="email" name="useremail" class="input-text" placeholder="Email Address" required>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <label for="userpassword" class="form-label">Password: </label>
                </td>
            </tr>

            <tr>
                <td class="label-td">
                    <input type="Password" name="userpassword" class="input-text" placeholder="Password" required>
                </td>
            </tr>


            <tr>
                <td><br>
                <?php echo $error ?>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" value="Login" class="login-btn btn-primary btn" >
                </td>
            </tr>
        </div>
            <tr>
                <td>
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Don't have an account&#63; </label>
                    <a href="signup.php" class="hover-link1 non-style-link">Sign Up</a>
                    <br><br><br>
                </td>
            </tr>
                        
                        
    
                        
                    </form>
        </table>

    </div>
</center>
</body>
</html>