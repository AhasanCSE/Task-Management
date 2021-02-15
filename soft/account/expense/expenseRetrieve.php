<?php
include '../../../config/db_connection.php';
if(isset($_POST['head_retrieve']) && $_POST['head_retrieve']!=""){
    headRetrieve($con);
}

if(isset($_POST['project_retrieve']) && $_POST['project_retrieve']!=""){
    projectRetrieve($con);
}

if(isset($_POST['ta_retrieve']) && $_POST['ta_retrieve']!=""){
    taRetrieve($con);
}

function taRetrieve($con){
    $sql = "select inv_travel_allowances.*,projects.PROJECT_NAME from inv_travel_allowances LEFT JOIN projects ON inv_travel_allowances.PROJECT_NO=projects.PROJECT_NO";
    $query = mysqli_query($con,$sql);
    if($query){
        $i=1;
        foreach($query as $row){
            echo "<tr>";
            echo "<td class='text-center'>".$i."</td>";
            echo "<td class='text-center'>".$row['PROJECT_NAME']."</td>";
            echo "<td class='text-center'>".$row['TRAVEL_DATE']."</td>";
            echo "<td class='text-center'>".$row['TRAVEL_FROM']."</td>";
            echo "<td class='text-center'>".$row['TRAVEL_TO']."</td>";
            echo "<td class='text-center'>".$row['TRAVEL_DETAILS']."</td>";
            echo "<td class='text-center'>".$row['TRAVEL_COST']."</td>";
            echo "<td class='text-center'>" . "<div class='btn-group'><button data-toggle='tooltip' title='Edit' class='btn btn-xs btn-warning editbtn'  id='" . $row['PROJECT_NO'] . "' value='" . $i . "'>Accept</button>" . "<button data-toggle='tooltip'  title='Delete' class='btn btn-xs btn-danger deletebtn' id='" . $row['PROJECT_NO'] . "' value='" . $i . "'>Decline</button>" . "</div></td>";
            echo "</tr>";
            $i++;
        }
    }
}

function projectRetrieve($con){
    $sql = "select * from projects order by PROJECT_NO DESC";
    $query = mysqli_query($con,$sql);
    if($query){
        $i=1;
        foreach($query as $row){
            echo "<tr>";
            echo "<td class='text-center'>".$i."</td>";
            echo "<td class='text-center'>".$row['PROJECT_NAME']."</td>";
            echo "<td class='text-center'>".$row['PROJECT_CODE']."</td>";
            echo "<td class='text-center'>" . "<div class='btn-group'><button data-toggle='tooltip' title='Edit' class='btn btn-xs btn-warning editbtn'  id='" . $row['PROJECT_NO'] . "' value='" . $i . "'><i class=' fa fa-pencil'></i>Edit</button>" . "<button data-toggle='tooltip'  title='Delete' class='btn btn-xs btn-danger deletebtn' id='" . $row['PROJECT_NO'] . "' value='" . $i . "'><i class='fa fa-times'></i>Delete</button>" . "</div></td>";
            echo "</tr>";
            $i++;
        }
    }
}

function headRetrieve($con){
    $sql = "select * from acc_expense_heads";
    $query = mysqli_query($con,$sql);
    if($query){
        $i=1;
        foreach($query as $row){
            echo "<tr>";
            echo "<td class='text-center'>".$i."</td>";
            echo "<td class='text-center'>".$row['HEAD_NAME']."</td>";
            echo "<td class='text-center'>".$row['NARRATION']."</td>";
            echo "<td class='text-center'>" . "<div class='btn-group'><button data-toggle='tooltip' title='Edit' class='btn btn-xs btn-warning editbtn'  id='" . $row['EXPENSE_HEAD_NO'] . "' value='" . $i . "'><i class=' fa fa-pencil'></i>Edit</button>" . "<button data-toggle='tooltip'  title='Delete' class='btn btn-xs btn-danger deletebtn' id='" . $row['EXPENSE_HEAD_NO'] . "' value='" . $i . "'><i class='fa fa-times'></i>Delete</button>" . "</div></td>";
            echo "</tr>";
            $i++;
        }
    }
}
?>