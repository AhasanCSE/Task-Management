<?php
include '../../../config/db_connection.php';
if(isset($_POST['head']) && $_POST['head']!=""){
    headInsert($_POST['HEAD_NAME'],$_POST['NARRATION'],$con);
}

if(isset($_POST['project']) && $_POST['project']!=""){
    projectInsert($_POST['PROJECT_NAME'],$_POST['PROJECT_CODE'],$con);
}

if(isset($_POST['ta']) && $_POST['ta']!=""){
    taInsert($_POST['PROJECT_NO'],$_POST['TRAVEL_DATE'],$_POST['FROM'],$_POST['TO'],$_POST['TRAVEL_DETAILS'],$_POST['TRAVEL_COST'],$con);
}

if(isset($_POST['da']) && $_POST['da']!=""){
    daInsert($_POST['PROJECT_NO'],$_POST['TRAVEL_DATE'],$_POST['FROM'],$_POST['TO'],$_POST['TRAVEL_DETAILS'],$_POST['TRAVEL_COST'],$con);
}

function taInsert($no,$date,$from,$to,$tr_details,$cost,$con){
    date_default_timezone_set("Asia/Dhaka");
    $current_date = date("Y-m-d H:i:sa");
    $sql = "insert into inv_travel_allowances set PROJECT_NO='".$no."',TRAVEL_DATE='".$date."',TRAVEL_FROM='".$from."',TRAVEL_TO='".$to."',TRAVEL_DETAILS='".$tr_details."',TRAVEL_COST='".$cost."',CREATED_ON='".$current_date."'";
    if(mysqli_query($con,$sql)){
        echo 1;
    }else{
        echo 0;
    }
}

function projectInsert($name,$code,$con){
    date_default_timezone_set("Asia/Dhaka");
    $current_date = date("Y-m-d H:i:sa");
    $sql = "insert into projects set PROJECT_NAME='".$name."',PROJECT_CODE='".$code."',CREATED_ON='".$current_date."'";
    if(mysqli_query($con,$sql)){
        echo 1;
    }else{
        echo 0;
    }
}

function headInsert($name,$narration,$con){
    date_default_timezone_set("Asia/Dhaka");
    $current_date = date("Y-m-d H:i:sa");
    $sql = "insert into acc_expense_heads set HEAD_NAME='".$name."',NARRATION='".$narration."',CREATED_ON='".$current_date."'";
    if(mysqli_query($con,$sql)){
        echo 1;
    }else{
        echo 0;
    }
}



?>