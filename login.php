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
            'employee_number'=>$_POST['mgt_number'],
            'employee_password'=>$_POST['mgt_password']
        );

        $jsonData = json_encode($loginData);
        $file = 'login.json';
        file_put_contents($file, $jsonData);

//json decode
        $file = 'login.json';
        $loginjsonData = file_get_contents($file);
        $loginData = json_decode($loginjsonData, true);

        $enumber = $loginData['employee_number'];
        $password = $loginData['employee_password'];



		//$enumber=$_POST['mgt_number'];
        //$password=$_POST['mgt_password'];
		
        $error='<label for="prompt" class="form-label"></label>';

        $result=$database->query("select * from mgt_user where enumber='$enumber'");
        if($result->num_rows==1){
            $utype=$result->fetch_assoc()['usertype'];
            if($utype=='a'){
                $checker = $database->query("select * from admin where aenumber='$enumber' and apassword='$password'");
                if ($checker->num_rows==1){
					$user=$checker->fetch_assoc()['aname'];
					
                    //   Admin dashbord
                    $_SESSION['user']=$user;
                    $_SESSION['usertype']='a';
                    
                    header('location: admin/index.php');

                }else{
                    $error='<label for="prompt" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Invalid employee number or password</label>';
                }

            }
            elseif($utype=='e'){
                $checker = $database->query("select * from employee where enumber='$enumber' and epassword='$password'");
                if ($checker->num_rows==1){
                    $user=$checker->fetch_assoc()['ename'];

                    //   employee dashbord
                    $_SESSION['user']=$user;
                    $_SESSION['usertype']='e';
                    header('location: employee/index.php');

                }else{
                    $error='<label for="prompt" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Invalid employee number or password</label>';
                }

            }
            
        }else{
            $error='<label for="prompt" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">This employee number does not exist.</label>';
        }
  
    }else{
        $error='<label for="prompt" class="form-label">&nbsp;</label>';
    }

    ?>

    <center>
    <div class="container">
        <table border="0" style="margin: 0;padding: 0;width: 60%;">
            <tr>
                <td>
                    <p class="header-text">Welcome, staff!</p>
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
                    <label for="mgt_number" class="form-label">Employee Number: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="text" name="mgt_number" class="input-text" placeholder="Employee Number" required>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <label for="mgt_password" class="form-label">Password: </label>
                </td>
            </tr>

            <tr>
                <td class="label-td">
                    <input type="password" name="mgt_password" class="input-text" placeholder="Password" required>
                </td>
            </tr>


            <tr>
                <td><br>
                <?php echo $error ?>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" value="Login" class="login-btn btn-primary btn">
                </td>
            </tr>
        </div>
            <tr>
                <td>
                    <br><br>
                </td>
            </tr>
                        
                      
                    </form>
        </table>

    </div>
</center>
</body>
</html>