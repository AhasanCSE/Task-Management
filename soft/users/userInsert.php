<?php
include '../../config/db_connection.php';
function userInsert($name,$phone,$email,$pass,$con){
    date_default_timezone_set("Asia/Dhaka");
    $current_date = date("Y-m-d H:i:sa");
    //$password = md5($pass);
    $sql="SELECT `USER_EMAIL` FROM `users` WHERE USER_EMAIL='$email'";
    $COUNT=mysqli_num_rows(mysqli_query($con,$sql));
    if($COUNT>0)
    {
        echo 0;
        
    }
    else
    {

    $sql = "insert into users set USER_NAME='".$name."',USER_PHONE='".$phone."',USER_EMAIL='".$email."',PASSWORD='".$pass."',CREATED_ON='".$current_date."'";

    if(mysqli_query($con,$sql)){
        echo 1;
    }else{
        echo 0;
    }
    }
}
function userUpdate($name,$id,$phone,$email,$con){
    date_default_timezone_set("Asia/Dhaka");
    $current_date = date("Y-m-d H:i:sa");

    $sql = "UPDATE  users set USER_NAME='".$name."',USER_PHONE='".$phone."',USER_EMAIL='".$email."',UPDATED_ON='".$current_date."' WHERE USER_NO='$id'";
    if(mysqli_query($con,$sql)){
        echo 1;
    }else{
        echo 0;
    }
    
}
if(isset($_POST['insert'])){
    userInsert($_POST['USER_NAME'],$_POST['USER_PHONE'],$_POST['USER_EMAIL'],$_POST['PASSWORD'],$con);
}
if(isset($_POST['update'])){
    userUpdate($_POST['USER_NAME'],$_POST['id'],$_POST['USER_PHONE'],$_POST['USER_EMAIL'],$con);
}


?>