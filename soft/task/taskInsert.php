<?php
include '../../config/db_connection.php';
if(isset($_POST['task']) && $_POST['task']!=""){
    taskInsert($_POST['PROJECT_NO'],$_POST['TASK_TITLE'],$_POST['DESCRIPTION'],$_POST['ISSUE_DATE'],$_POST['ASSIGN_TO'],$_POST['WORK_HOUR'],$_POST['STATUS'],$_POST['ATTACH_URL'],$con, $_POST['EndDate']);
}

function taskInsert($project,$task,$desc,$date,$asign,$hour,$status,$ATTACH_URL,$con , $EndDate){
    date_default_timezone_set("Asia/Dhaka");
    $current_date = date("Y-m-d h:i:s a");
    $sql = "insert into tasks set PROJECT_NO='".$project."',TASK_TITLE='".$task."',DESCRIPTION='".$desc."',ISSUE_DATE='".$date."',ASSIGN_TO='".$asign."',WORK_HOUR='".$hour."',STATUS='".$status."', FINISH_DATE='$EndDate'";
    // echo $sql ;
    if(mysqli_query($con,$sql)){
        if($ATTACH_URL!=""){
        $task_no = mysqli_insert_id($con);
        $sql = "insert into task_attachments set TASK_NO='".$task_no."',ATTACH_URL='".$ATTACH_URL."'";
        // echo $sql ;
            if(mysqli_query($con,$sql)){
                echo 1;
            }else{
                echo 0;
            }
        }
    }else{
        echo 0;
    }
}
?>