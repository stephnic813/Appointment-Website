
    <?php
    
    

    //import database
    include("../connection.php");



    if($_POST){
        //print_r($_POST);
        $result= $database->query("select * from mgt_user");
        $name=$_POST['name'];
        $number=$_POST['number'];
        $oldnumber=$_POST["oldnumber"];
        $position=$_POST['position'];
        $email=$_POST['email'];
        $contact=$_POST['contact'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $id=$_POST['id00'];
        
        if ($password==$cpassword){
            $error='3';
            $result= $database->query("select employee.eid from employee inner join mgt_user on employee.enumber=mgt_user.enumber where mgt_user.enumber='$number';");
            //$resultqq= $database->query("select * from employee where eid='$id';");
            if($result->num_rows==1){
                $id2=$result->fetch_assoc()["eid"];
            }else{
                $id2=$id;
            }
            
            echo $id2."jdfjdfdh";
            if($id2!=$id){
                $error='1';
                //$resultqq1= $database->query("select * from employee where eemail='$email';");
                //$did= $resultqq1->fetch_assoc()["eid"];
                //if($resultqq1->num_rows==1){
                    
            }else{

                //$sql1="insert into employee(eemail,ename,epassword,enumber,econtact,eposition) values('$email','$name','$password','$number','$contact',$position);";
                $sql1="update employee set eemail='$email',ename='$name',epassword='$password',enumber='$number',econtact='$contact',eposition='$position' where eid='$id' ;";
                $database->query($sql1);
                
                $sql1="update mgt_user set enumber='$number' where enumber='$oldnumber' ;";
                $database->query($sql1);
                //echo $sql1;
                //echo $sql2;
                $error= '4';
                
            }
            
        }else{
            $error='2';
        }
    
    
        
        
    }else{
        //header('location: signup.php');
        $error='3';
    }
    

    header("location: employees.php?action=edit&error=".$error."&id=".$id);
    ?>
    
   

</body>
</html>