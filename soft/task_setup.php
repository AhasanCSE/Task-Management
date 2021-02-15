<?php session_start(); ?>
<?php include 'include/header.php';?>
<?php $table_heading = "Address";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';
 $CURR_TIME = date('Y-m-d h:i:s'); 

 //echo $user_id;
?>
<?php
if(isset($_POST['btnUpdate'])){
     $user_id= $_SESSION['user']['USER_NO'];
    $task_no = $_GET['task_no'];
    $STATUS = $_POST['STATUS'];
    $ATTACH_URL = trim($_POST['ATTACH_URL']);
    $NOTE = trim($_POST['NOTE']);
    $sql = "update tasks set STATUS='".$STATUS."' where TASK_NO='".$task_no."'";
    $a=0;
    if(mysqli_query($con,$sql)){
        
        if($ATTACH_URL!=""){
            $sql = "insert into task_attachments set TASK_NO='".$task_no."',ATTACH_URL='".$ATTACH_URL."',CREATED_ON='$CURR_TIME',CREATED_BY='$user_id'";
            echo $sql;
            mysqli_query($con,$sql);
            
        }
               
        
        
        if($NOTE!=""){
        $sql = "insert into notes set TASK_NO='".$task_no."',NOTE='".$NOTE."',CREATED_ON='$CURR_TIME',CREATED_BY='$user_id'";
        echo $sql;
        mysqli_query($con,$sql);
           
        }
       
         echo "<meta http-equiv='refresh' content='0; URL=task_list.php'>";
     
    }
}
?>
<?php
if(isset($_GET['task_no'])){
    $task_no = $_GET['task_no'];
    $sql = "SELECT tasks.*,projects.PROJECT_NAME,users.USER_NAME,status.STATUS_NAME FROM tasks LEFT JOIN projects ON tasks.PROJECT_NO=projects.PROJECT_NO LEFT JOIN users ON tasks.ASSIGN_TO=users.USER_NO LEFT JOIN status ON tasks.STATUS=status.STATUS_NO where tasks.TASK_NO='".$task_no."'";
    $query = mysqli_query($con,$sql);
    $data = mysqli_fetch_assoc($query);
?>

<fieldset class='scheduler-border'>
<legend class='scheduler-border'>Task Setup</legend>
<form class='cmxform form-horizontal' method="post" action="">
    <div class="col-md-6">
        <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>Project</label>
      <div class='col-lg-8'>
          <select class='form-control search' style="width:100%;" id='PROJECT_NO' name='PROJECT_NO' disabled>
              <?php
              $sql = "select * from projects";
              $query = mysqli_query($con,$sql);
             
             
              echo "<option value='-1'>".'Select'."</option>";
              foreach($query as $row){
                   $project_no = $data['PROJECT_NO'];
              $selected="";
                  if($project_no==$row['PROJECT_NO']){
                      $selected.="selected";
                      
                  }
                  echo "<option value='".$row['PROJECT_NO']."'$selected>".$row['PROJECT_NAME']."</OPTION>";
              
                  
              }
              ?>
          </select>
      </div>
   </div>
   <div class='form-group'>
      <label for='NAME' class='control-label col-lg-4'>Task Tittle</label>
      <div class='col-lg-8'><input class='form-control field_data' name='TASK_TITLE' id='TASK_TITLE' type='text' value='<?=$data['TASK_TITLE']?>' disabled req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   <div class='form-group'>
      <label for='AGE' class='control-label col-lg-4'>Description</label>
      <div class='col-lg-8'>
          <textarea class='form-control field_data' id='DESCRIPTION' name='DESCRIPTION' disabled><?=$data['DESCRIPTION']?></textarea>
      </div>
   </div>
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>Issue Date</label>
      <div class='col-lg-8'><input class='form-control field_data' name='ISSUE_DATE' id='ISSUE_DATE' type='date' value='<?=$data['ISSUE_DATE']?>' disabled req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>Note</label>
      <div class='col-lg-8'><textarea class='form-control field_data' id='NOTE' name='NOTE'></textarea></div>
   </div>
   </div>
   <div class="col-md-6">
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>ASSIGN TO</label>
      <div class='col-lg-8'>
          <select class='form-control search' style='width:100%;' name='ASSIGN_TO' id='ASSIGN_TO' disabled>
              <?php
              $sql = "select * from users";
              $query = mysqli_query($con,$sql);
              
              echo "<option value='-1'>".'Select'."</option>";
              foreach($query as $row){
                  $assign_to = $data['ASSIGN_TO'];
                    $selected="";
                  if($assign_to==$row['USER_NO']){
                      $selected.="selected";
                  }
                  echo "<option value='".$row['USER_NO']."' $selected>".$row['USER_NAME']."</OPTION>";
                  
              }
              ?>
          </select>
      </div>
   </div>
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>WORK HOUR</label>
      <div class='col-lg-8'><input class='form-control field_data' name='WORK_HOUR' id='WORK_HOUR' type='text' value='<?=$data['WORK_HOUR']?>' disabled req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>STATUS</label>
      <div class='col-lg-8'>
          <select class='form-control search' style='width:100%;' id='STATUS' name='STATUS'>
              <?php
              $sql = "select * from status";
              $query = mysqli_query($con,$sql);
              echo "<option value='-1'>".'Select'."</option>";
              foreach($query as $row){
                   $status_no = $data['STATUS'];
                  $selected="";
                  if($status_no==$row['STATUS_NO']){
                      $selected.="selected";
                      
                  }
                  echo "<option value='".$row['STATUS_NO']."'$selected>".$row['STATUS_NAME']."</OPTION>";
                  
              }
              ?>
          </select>
      </div>
   </div>
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>URL</label>
      <div class='col-lg-8'><input class='form-control field_data' name='ATTACH_URL' id='ATTACH_URL' type='text' value='' req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   
   <div class='form-group'>
      <div class='col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5 pull-right'>
          <input type='submit' class='btn btn-primary pull-right' table_name='gen_addbooks' name='btnUpdate' value='Update'/></div>
   </div>
   </div>
</form>
</fieldset>
<?php
}
else
{?>
<fieldset class='scheduler-border'>
<legend class='scheduler-border'>Task Setup</legend>
<form class='cmxform form-horizontal'>
    <div class="col-md-6">
        <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>Project</label>
      <div class='col-lg-8'>
          <select class='form-control search' style="width:100%;" id='PROJECT_NO' name='PROJECT_NO'>
              <?php
              $sql = "select * from projects order by PROJECT_NO DESC";
              $query = mysqli_query($con,$sql);
              echo "<option value='-1'>".'Select'."</option>";
              foreach($query as $row){
                  echo "<option value='".$row['PROJECT_NO']."'>".$row['PROJECT_NAME']."</OPTION>";
              }
              ?>
          </select>
      </div>
   </div>
   <div class='form-group'>
      <label for='NAME' class='control-label col-lg-4'>Task Tittle</label>
      <div class='col-lg-8'><input class='form-control field_data' name='TASK_TITLE' id='TASK_TITLE' type='text' value='' req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   <div class='form-group'>
      <label for='AGE' class='control-label col-lg-4'>Description</label>
      <div class='col-lg-8'>
          <textarea class='form-control field_data' id='DESCRIPTION' name='DESCRIPTION'></textarea>
      </div>
   </div>
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>Issue Date</label>
      <div class='col-lg-8'><input class='form-control field_data' name='ISSUE_DATE' id='ISSUE_DATE' type='date' value='<?=date("Y-m-d")?>' req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   </div>
   <div class="col-md-6">
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>ASSIGN TO</label>
      <div class='col-lg-8'>
          <select class='form-control search' style='width:100%;' name='ASSIGN_TO' id='ASSIGN_TO'>
              <?php
              $sql = "select * from users order by USER_NO DESC";
              $query = mysqli_query($con,$sql);
              echo "<option value='-1'>".'Select'."</option>";
              foreach($query as $row){
                  echo "<option value='".$row['USER_NO']."'>".$row['USER_NAME']."</OPTION>";
              }
              ?>
          </select>
      </div>
   </div>
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>WORK HOUR</label>
      <div class='col-lg-8'><input class='form-control field_data' name='WORK_HOUR' id='WORK_HOUR' type='text' value='' req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>STATUS</label>
      <div class='col-lg-8'>
          <select class='form-control search' style='width:100%;' id='STATUS' name='STATUS'>
              <?php
              $sql = "select * from status";
              $query = mysqli_query($con,$sql);
              echo "<option value='-1'>".'Select'."</option>";
              foreach($query as $row){
                  echo "<option value='".$row['STATUS_NO']."'>".$row['STATUS_NAME']."</OPTION>";
              }
              ?>
          </select>
      </div>
   </div>
   
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>URL</label>
      <div class='col-lg-8'><input class='form-control field_data' name='ATTACH_URL' id='ATTACH_URL' type='text' value='' req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>End Date</label>
      <div class='col-lg-8'>
          <input class='form-control field_data' name='EndDate' id='EndDate' type='date'  req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   <div class='form-group'>
      <div class='col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5 pull-right'>
          <input type='button' class='btn btn-primary pull-right' table_name='gen_addbooks' id='btnAdd' value='Save'/></div>
   </div>
   </div>
</form>
</fieldset>
<?php
}
?>

<!--<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>-->
<!--   <thead>-->
<!--      <tr>-->
<!--         <th class="text-center">#</th>-->
<!--         <th class="text-center">ProjectName</th>-->
<!--         <th class="text-center">Title</th>-->
<!--         <th class="text-center">Description</th>-->
<!--         <th class="text-center">ISSUE DATE</th>-->
<!--         <th class="text-center">ASSIGN TO</th>-->
<!--         <th class="text-center">WORK HOUR</th>-->
<!--         <th class="text-center">Status</th>-->
<!--         <th class="text-center">Action</th>-->
<!--      </tr>-->
<!--   </thead>-->
<!--   <tbody id='recordList'></tbody>-->
<!--</table>-->

<?php include 'include/footer.php';?>

<script>
function clear(){
    $(".field_data").each(function(){
        $(".field_data").val(' ');
    });
}
function taskInsert(task,PROJECT_NO,TASK_TITLE,DESCRIPTION,ISSUE_DATE,ASSIGN_TO,WORK_HOUR,STATUS,ATTACH_URL, EndDate){
    $.ajax({
    url:"task/taskInsert.php",
    method:"post",
    dataType:"html",
    data:{task:task,PROJECT_NO:PROJECT_NO,TASK_TITLE:TASK_TITLE,DESCRIPTION:DESCRIPTION,ISSUE_DATE:ISSUE_DATE,ASSIGN_TO:ASSIGN_TO,WORK_HOUR:WORK_HOUR,STATUS:STATUS,ATTACH_URL:ATTACH_URL, EndDate:EndDate},
    success:function(result){
        console.log( result ) ;
        if(result==1){
            alert("Data Save Successfully");
            clear();
            taskRetrieve("task_retrieve");
        }else{
            alert("Error!!");
        }
    }
    });
}

function taskRetrieve(task_retrieve){
    $.ajax({
        url:"task/taskRetrieve.php",
        method:"post",
        dataType:"html",
        data:{task_retrieve:task_retrieve},
        success:function(result){
            $("#recordList").html(result);
        }
    });
}
    $(document).ready(function(){
        
        taskRetrieve("task_retrieve");
        
        $("#btnAdd").on("click",function(){
            var PROJECT_NO = $("#PROJECT_NO").val();
            var TASK_TITLE = $("#TASK_TITLE").val().trim();
            var DESCRIPTION = $("#DESCRIPTION").val().trim();
            var ISSUE_DATE = $("#ISSUE_DATE").val();
            var ASSIGN_TO = $("#ASSIGN_TO").val();
            var WORK_HOUR = $("#WORK_HOUR").val();
            var STATUS = $("#STATUS").val();
            var ATTACH_URL = $("#ATTACH_URL").val().trim();
            var EndDate = $("#EndDate").val() ;
            taskInsert("task",PROJECT_NO,TASK_TITLE,DESCRIPTION,ISSUE_DATE,ASSIGN_TO,WORK_HOUR,STATUS,ATTACH_URL, EndDate);
            
        });
    });
</script>
