<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
        
    <title>Sign Up</title>
    
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



if($_POST){

    
    $profile_pic_tempname = $_FILES["profile-pic"]["tmp_name"];
    //$profile_pic_folder = "img" . $profile_pic;

    $personalData=array(
        'fname'=>$_POST['fname'],
        'lname'=>$_POST['lname'],
        'contact_no'=>$_POST['contact_no'],
        'address'=>$_POST['address'],
        'company_type'=>$_POST['company_type'],
        'company_name'=>$_POST['company_name'],
        'company_position'=>$_POST['company_position'],
		'client_status'=>$_POST['client_status'],

        
    );


    $jsonData = json_encode($personalData);
    $file = 'signup.json';
    file_put_contents($file, $jsonData);
    
    header("Location: create-account.php");

    


}

?>


    <center>
    <div class="container">
        <table border="0">
            <tr>
                <td colspan="2">
                    <p class="header-text">Let's Get Started</p>
                    <p class="sub-text">Add Your Personal Details to Continue</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td" colspan="2">
                    <label for="name" class="form-label">Name: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="text" name="fname" class="input-text" placeholder="First Name" required>
                </td>
                <td class="label-td">
                    <input type="text" name="lname" class="input-text" placeholder="Last Name" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="contact_no" class="form-label">Contact no: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="contact_no" class="input-text" placeholder="ex: 09xxxxxxxxx" pattern="[09]{1}[0-9]{9}" required>
                </td>
            </tr>
			<tr>
                <td class="label-td" colspan="2">
                    <label for="address" class="form-label">Address: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="address" class="input-text" placeholder="Address" required>
                </td>
            </tr>
            
             <!--company-type-->
            <tr>
                <td class="label-td" colspan="2">
                    <label for="company_type" class="form-label"> For who is this account?</label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <select id="company_type" name="company_type" value="" onchange="personal_or_organization()" title="Please choose one of the options" required>
                                    <option id="option_organization" value="" >please choose an option...</option>
									<option id="option_organization" value="1" >personal</option>
                                    <option id="option_personal" value="2" >company/organization</option>
                                </select>
                </td>
            </tr>
             <!--company name-->
            <tr>
                <td class="label-td" colspan="2">
                    <label for="company_name" class="form-label">Company/Organization name</label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" id="company_name" name="company_name" class="input-text" placeholder="name of company/organization" required>
                </td>
            </tr>
             <!--company-position-->
            <tr>
                <td class="label-td" colspan="2">
                    <label for="company_position" class="form-label">Company Position</label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" id="company_position" name="company_position" class="input-text" placeholder="Position" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
					<label for="company_position" class="form-label">Already an existing client of 8box?</label>
                </td>
            </tr>
			<tr>
                <td class="label-td" colspan="2">
					<select id="client_status" name="client_status" value="" title="Please choose one of the options" required>
									<option id="option_organization" value="" >please choose an option...</option>
                                    <option id="option_existing" value="1">Yes</option>
                                    <option id="option_prospective" value="2">No</option>
                                </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >
                </td>
                <td>
                    <input type="submit" value="Next" class="login-btn btn-primary btn">
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
<script src="signup.js"></script>
</body>
</html>