<?php
include '../../config/db_connection.php';
if(isset($_POST['task_retrieve']) && $_POST['task_retrieve']!=""){
    taskRetrieve($con);
}
if(isset($_POST['search']) && $_POST['search']!=""){
    taskSearch($_POST['name'],$_POST['Issue_Date'],$_POST['ASSIGN_TO'],$con);
}

function taskSearch($name,$date,$engr,$con){
    $where="";
    if($name!=""){
       $where.="AND projects.PROJECT_NAME LIKE '%".$name."%'"; 
    }
    if($date!=""){
       $where.="AND tasks.ISSUE_DATE='".$date."'"; 
    }if($engr!="-1"){
       $where.="AND users.USER_NO='".$engr."'"; 
    }
    $sql = "SELECT tasks.TASK_NO, status.STATUS_NAME, projects.PROJECT_NAME , tasks.WORK_HOUR, tasks.TASK_TITLE, tasks.DESCRIPTION, tasks.ISSUE_DATE, tasks.FINISH_DATE, users.USER_NAME FROM tasks LEFT JOIN users ON users.USER_NO = tasks.ASSIGN_TO LEFT JOIN projects ON projects.PROJECT_NO = tasks.PROJECT_NO LEFT JOIN status ON status.STATUS_NO = tasks.STATUS ORDER BY tasks.TASK_NO DESC LIMIT 20";
    $query = mysqli_query($con,$sql);
    if($query){
        $i=1;
        foreach($query as $row){
            echo "<tr>";
            echo "<td class='text-center'>".$i."</td>";
            echo "<td class='text-center'>".$row['PROJECT_NAME']."</td>";
            echo "<td class='text-center'>".$row['TASK_TITLE']."</td>";
            echo "<td class='text-center'>".$row['DESCRIPTION']."</td>";
            echo "<td class='text-center'>".$row['ISSUE_DATE']."</td>";
            echo "<td class='text-center'>".$row['USER_NAME']."</td>";
            echo "<td class='text-center'>".$row['WORK_HOUR']."</td>";

            echo "<td class='text-center'>".$row['STATUS_NAME']."</td>";
            echo "<td class='text-center'>" . "<div class='btn-group'><a data-toggle='tooltip' title='Edit' class='btn btn-xs btn-warning editbtn' href='task_setup.php?task_no=".$row['TASK_NO']."'><i class=' fa fa-pencil'></i>Edit</a>" . "</div></td>";
            echo "</tr>";
            $i++;
        }
    }
}

function taskRetrieve($con){
    $sql = "SELECT tasks.TASK_NO, status.STATUS_NAME, projects.PROJECT_NAME , tasks.WORK_HOUR, tasks.TASK_TITLE, tasks.DESCRIPTION, tasks.ISSUE_DATE, tasks.FINISH_DATE, users.USER_NAME FROM tasks LEFT JOIN users ON users.USER_NO = tasks.ASSIGN_TO LEFT JOIN projects ON projects.PROJECT_NO = tasks.PROJECT_NO LEFT JOIN status ON status.STATUS_NO = tasks.STATUS ORDER BY tasks.TASK_NO DESC LIMIT 20";
    $query = mysqli_query($con,$sql);
    if($query){
        $i=1;
        foreach($query as $row){
            echo "<tr>";
            echo "<td class='text-center'>".$i."</td>";
            echo "<td class='text-center'>".$row['PROJECT_NAME']."</td>";
            echo "<td class='text-center'>".$row['TASK_TITLE']."</td>";
            echo "<td class='text-center'>".$row['DESCRIPTION']."</td>";
            echo "<td class='text-center'>".$row['ISSUE_DATE']."</td>";
            echo "<td class='text-center'>".$row['USER_NAME']."</td>";
            echo "<td class='text-center'>".$row['WORK_HOUR']."</td>";
             echo "<td class='text-center'>".$row['FINISH_DATE']."</td>";
    
            echo "<td class='text-center'>".$row['STATUS_NAME']."</td>";
            echo "<td class='text-center'>" . "<div class='btn-group'><a data-toggle='tooltip' title='Edit' class='btn btn-xs btn-warning editbtn' href='task_setup.php?task_no=".$row['TASK_NO']."'><i class=' fa fa-eye'></i> View</a>" . "</div></td>";
            echo "</tr>";
            $i++;
        }
    }
}
?>