<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Clients</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
    <?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    

    //import database
    include("../connection.php");

    
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/profile_pic/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title">Administrator</p>
                                    <p class="profile-subtitle2"><?php echo $_SESSION["user"] ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                <a href="../logout.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord" >
                        <a href="index.php" class="non-style-link-menu"><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-employee ">
                        <a href="employees.php" class="non-style-link-menu "><div><p class="menu-text">Personnel</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-schedule">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">Schedule</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">Appointment</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-client  menu-active menu-icon-client-active">
                        <a href="clients.php" class="non-style-link-menu  non-style-link-menu-active"><div><p class="menu-text">Clients</p></a></div>
                    </td>
                </tr>

            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%">

                    <a href="clients.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                        
                    </td>
                    <td>
                        
                        <form action="" method="post" class="header-search">

                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Client name or Email" list="client">&nbsp;&nbsp;
                            
                            <?php
                                echo '<datalist id="client">';
                                $list11 = $database->query("select  cname,cemail from client;");

                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $d=$row00["cname"];
                                    $c=$row00["cemail"];
                                    echo "<option value='$d'><br/>";
                                    echo "<option value='$c'><br/>";
                                };

                            echo ' </datalist>';
?>
                            
                       
                            <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        
                        </form>
                        
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 
                        date_default_timezone_set('Asia/Kolkata');

                        $date = date('Y-m-d');
                        echo $date;
                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
               
                
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Clients (<?php echo $list11->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                <?php
                    if($_POST){
                        $keyword=$_POST["search"];
                        
                        $sqlmain= "select * from client where cemail='$keyword' or cname='$keyword' or cname like '$keyword%' or cname like '%$keyword' or cname like '%$keyword%' ";
                    }else{
                        $sqlmain= "select * from client order by cid desc";

                    }



                ?>
                  
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown"  style="border-spacing:0;">
                        <thead>
                        <tr>
                                <th class="table-headin">
                                    
                                
                                Name
                                
                                </th>

                                <th class="table-headin">
                                    Email
                                </th>

                                <th class="table-headin">
                                
                                Contact
                                
                                </th>
                                
                                <th class="table-headin">
                                    
                                    Type
                                    
                                </th>
                                <th class="table-headin">
                                    
                                    Status
                                    
                                </th>
                                <th class="table-headin">
                                    
                                    Action
                                    
                                </tr>
                        </thead>
                        <tbody>
                        
                            <?php

                                
                                $result= $database->query($sqlmain);

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  could not find anything related to your keywords!</p>
                                    <a class="non-style-link" href="clients.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Clients &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                for ( $x=0; $x<$result->num_rows;$x++){
                                    $row=$result->fetch_assoc();
                                    $cid=$row["cid"];
                                    $name=$row["cname"];
                                    $email=$row["cemail"];
                                    $contact=$row["ccontact"];
                                    $company_name=$row["ccompany_name"];
                                    $company_position=$row["ccompany_position"];
                                    $address=$row["caddress"];
                                    $status=$row["cstatus"];
                                    $status_res= $database->query("select status from client_status where id='$status'");
                                    $status_array= $status_res->fetch_assoc();
                                    $status_name=$status_array["status"];
                                    $type=$row["ctype"];
                                    $type_res= $database->query("select type from client_type where id='$type'");
                                    $type_array= $type_res->fetch_assoc();
                                    $type_name=$type_array["type"];

                                    echo '<tr>
                                        <td> &nbsp;'.
                                        substr($name,0,30)
                                        .'</td>
                                        <td>
                                        '.substr($email,0,20).'
                                         </td>
                                        <td>
                                            '.substr($contact,0,10).'
                                        </td>
                                        <td>
                                        '.substr($type_name,0,12).'
                                        </td>
                                        <td>
                                        '.substr($status_name,0,12).'
                                        </td>
                                        <td >
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <a href="?action=edit&id='.$cid.'&error=0" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-edit"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Edit</font></button></a>
                                       
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="?action=view&id='.$cid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>

                                       &nbsp;&nbsp;&nbsp;
                                       <a href="?action=drop&id='.$cid.'&name='.$name.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Delete</font></button></a>
                                        </div>
                                        </td>
                                    </tr>';
                                    
                                }
                            }
                                 
                            ?>
 
                            </tbody>

                        </table>
                        </div>
                        </center>
                   </td> 
                </tr>
                       
                        
                        
            </table>
        </div>
    </div>
    <?php 
    if($_GET){
        
        $id=$_GET["id"];
        $action=$_GET["action"];
        if($action=='drop'){
            $nameget=$_GET["name"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="clients.php">&times;</a>
                        <div class="content">
                            You want to delete this record<br>('.substr($nameget,0,40).').
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-clients.php?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="clients.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            ';
        }elseif($action=='view'){
            $sqlmain= "select * from client where cid='$id'";
            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();
            $name=$row["cname"];
            $email=$row["cemail"];
            $contact=$row["ccontact"];
            $company_name=$row["ccompany_name"];
            $company_position=$row["ccompany_position"];
            $address=$row["caddress"];
            $status=$row["cstatus"];
            $status_res= $database->query("select status from client_status where id='$status'");
            $status_array= $status_res->fetch_assoc();
            $status_name=$status_array["status"];
            $type=$row["ctype"];
            $type_res= $database->query("select type from client_type where id='$type'");
            $type_array= $type_res->fetch_assoc();
            $type_name=$type_array["type"];

            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2></h2>
                        <a class="close" href="clients.php">&times;</a>
                        <div class="content">
                            
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-employee-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p>
                                        Client ID: P-'.$id.' (Auto-generated)
                                    <br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    '.$name.'<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$email.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="contact" class="form-label">Contact: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$contact.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="type" class="form-label">Company Type: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                            '.$type_name.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="status" class="form-label">Status: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                            '.$status_name.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="company_name" class="form-label">Company or Organization Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                            '.$company_name.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="company_position" class="form-label">Company or Organization Position: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                            '.$company_position.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="address" class="form-label">Address: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                            '.$address.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="clients.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                
                                    
                                </td>
                
                            </tr>
                           

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
            }elseif($action=='edit'){
            $sqlmain= "select * from client where cid='$id'";
            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();
            $name=$row["cname"];
            $email=$row["cemail"];
            $contact=$row["ccontact"];
            $company_name=$row["ccompany_name"];
            $company_position=$row["ccompany_position"];
            $address=$row["caddress"];
            $status=$row["cstatus"];
            $status_res= $database->query("select status from client_status where id='$status'");
            $status_array= $status_res->fetch_assoc();
            $status_name=$status_array["status"];
            $type=$row["ctype"];
            $type_res= $database->query("select type from client_type where id='$type'");
            $type_array= $type_res->fetch_assoc();
            $type_name=$type_array["type"];

            $error_1=$_GET["error"];
                $errorlist= array(
                    '1'=>'<label for="prompt" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
                    '2'=>'<label for="prompt" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Confirmation Error! Reconfirm Password</label>',
                    '3'=>'<label for="prompt" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                    '4'=>"",
                    '0'=>'',

                );

            if($error_1!='4'){
                    echo '
                    <div id="popup1" class="overlay">
                            <div class="popup">
                            <center>
                            
                                <a class="close" href="clients.php">&times;</a> 
                                <div style="display: flex;justify-content: center;">
                                <div class="abc">
                                <table width="80%" class="sub-table scrolldown add-employee-form-container" border="0">
                                <tr>
                                        <td class="label-td" colspan="2">'.
                                            $errorlist[$error_1]
                                        .'</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Edit Client Details.</p>
                                        Client ID: P-'.$id.' (Auto-generated)<br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <form action="edit-clients.php" method="POST" class="add-new-form">
                                            <label for="name" class="form-label">Name: </label>
                                            <input type="text" name="name" class="input-text" placeholder="Personnel Name" value="'.$name.'" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="Email" class="form-label">Email: </label>
                                            <input type="hidden" value="'.$id.'" name="id00">
                                            <input type="hidden" name="oldemail" value="'.$email.'" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                        <input type="email" name="email" class="input-text" placeholder="Email Address" value="'.$email.'" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="contact" class="form-label">Contact: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="tel" name="contact" class="input-text" placeholder="Contact Number" value="'.$contact.'" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="type" class="form-label">Choose client type: (Current '.$type_name.')</label>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <select name="type" id="" class="box">';
                                                
                
                                                $list11 = $database->query("select  * from  client_type;");
                
                                                for ($y=0;$y<$list11->num_rows;$y++){
                                                    $row00=$list11->fetch_assoc();
                                                    $sn=$row00["type"];
                                                    $id00=$row00["id"];
                                                    echo "<option value=".$id00.">$sn</option><br/>";
                                                };
                                    
                                    echo     ' </select><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="status" class="form-label">Choose client status: (Current '.$status_name.')</label>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <select name="status" id="" class="box">';
                                                
                
                                                $list11 = $database->query("select  * from  client_status;");
                
                                                for ($y=0;$y<$list11->num_rows;$y++){
                                                    $row00=$list11->fetch_assoc();
                                                    $sn=$row00["status"];
                                                    $id00=$row00["id"];
                                                    echo "<option value=".$id00.">$sn</option><br/>";
                                                };
                
                                echo     ' </select><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="company_name" class="form-label">Company or Organization Name: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="company_name" class="input-text" placeholder="Company or Organization Name" value="'.$company_name.'" ><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="company_position" class="form-label">Companyor Organization Position: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="company_position" class="input-text" placeholder="Company or Organization Position" value="'.$company_position.'" ><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="address" class="form-label">Address: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="address" class="input-text" placeholder="Address" value="'.$address.'" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="password" class="form-label">Password: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="password" name="password" class="input-text" placeholder="Password" required><br>
                                        </td>
                                    </tr><tr>
                                        <td class="label-td" colspan="2">
                                            <label for="cpassword" class="form-label">Confirm Password: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="password" name="cpassword" class="input-text" placeholder="Confirm Password" required><br>
                                        </td>
                                    </tr>
                                    
                        
                                    <tr>
                                        <td colspan="2">
                                            <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        
                                            <input type="submit" value="Save" class="login-btn btn-primary btn">
                                        </td>
                        
                                    </tr>
                                
                                    </form>
                                    </tr>
                                </table>
                                </div>
                                </div>
                            </center>
                            <br><br>
                    </div>
                    </div>
                    ';
        }else{
            echo '
                <div id="popup1" class="overlay">
                        <div class="popup">
                        <center>
                        <br><br><br><br>
                            <h2>Edited Successfully!</h2>
                            <a class="close" href="clients.php">&times;</a>
                            <div class="content">
                                
                                
                            </div>
                            <div style="display: flex;justify-content: center;">
                            
                            <a href="clients.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>

                            </div>
                            <br><br>
                        </center>
                </div>
                </div>
    ';



        }; };
    };

?>
</div>

</body>
</html>



















