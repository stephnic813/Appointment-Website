
    <?php
    
    

    //import database
    include("../connection.php");



    if($_POST){
        //print_r($_POST);
        $result= $database->query("select * from webuser");
        $name=$_POST['name'];
        $oldemail=$_POST["oldemail"];
        $email=$_POST['email'];
        $contact=$_POST['contact'];
        $company_name=$_POST['company_name'];
        $company_position=$_POST['company_position'];
        $address=$_POST['address'];
        $status=$_POST['status'];
        $type=$_POST['type'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $id=$_POST['id00'];
        
        if ($password==$cpassword){
            $error='3';
            $result= $database->query("select client.cid from client inner join webuser on client.cemail=webuser.email where webuser.email='$email';");
            if($result->num_rows==1){
                $id2=$result->fetch_assoc()["cid"];
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
                
                $sql1="update client set cname='$name',cemail='$email',ccontact='$contact',ccompany_name='$company_name',ccompany_position='$company_position',caddress='$address',cstatus='$status',ctype='$type',cpassword='$password' where cid='$id' ;";
                $database->query($sql1);
                
                $sql1="update webuser set email='$email' where email='$oldemail' ;";

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
    

    header("location: clients.php?action=edit&error=".$error."&id=".$id);
    ?>
    
   

</body>
</html>