<?php session_start(); ?>
<?php include 'include/header.php';?>
<?php $table_heading = "Task List";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
<fieldset class="scheduler-border">
    <legend class="scheduler-border">Search</legend>
    <form class='cmxform form-horizontal' method="post" action="">
    <div class='form-group'>
      <label for='NAME' class='control-label col-lg-3'>Project Name</label>
      <div class='col-lg-5'><input class='form-control field_data' name='Project_Name' id='Project_Name' type='text' value='' req='1' is_double = '0' maxlength = '255'/></div>
   </div> 
   <div class='form-group'>
      <label for='NAME' class='control-label col-lg-3'>Issue Date</label>
      <div class='col-lg-5'><input class='form-control field_data' name='Issue_Date' id='Issue_Date' type='date' value='' req='1' is_double = '0' maxlength = '255'/></div>
   </div> 
   <div class='form-group'>
      <label for='NAME' class='control-label col-lg-3'>Engineer</label>
      <div class='col-lg-5'>
          <select class='form-control search' style='width:100%;' name='ASSIGN_TO' id='ASSIGN_TO'>
              <?php
              $sql = "select * from users";
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
      <div class='col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5'><input type='button' class='btn btn-primary pull-right' table_name='gen_addbooks' id='btnSearch' value='Search'/></div>
   </div>
   </form>
</fieldset>
<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
   <thead>
      <tr>
         <th class="text-center">#</th>
         <th class="text-center">ProjectName</th>
         <th class="text-center">Title</th>
         <th class="text-center">Description</th>
         <th class="text-center">ISSUE DATE</th>
         <th class="text-center">ASSIGN TO</th>
         <th class="text-center">WORK HOUR</th>
         <th class="text-center">Finish Date</th>

         <th class="text-center">Status</th>
         <th class="text-center">Action</th>
      </tr>
   </thead>
   <tbody id='recordList'></tbody>
</table>

 
<?php include 'include/footer.php';?>

<script>

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

function taskSearch(search,name,Issue_Date,ASSIGN_TO){
    $.ajax({
        url:"task/taskRetrieve.php",
        method:"post",
        dataType:"html",
        data:{search:search,name:name,Issue_Date:Issue_Date,ASSIGN_TO:ASSIGN_TO},
        success:function(result){
            $("#recordList").html(result);
        }
    });
}
    $(document).ready(function(){
        taskRetrieve("task_retrieve");
        $("#btnSearch").on("click",function(){
            var name = $("#Project_Name").val().trim();
            var Issue_Date = $("#Issue_Date").val();
            var ASSIGN_TO = $("#ASSIGN_TO option:selected").val();
            taskSearch("search",name,Issue_Date,ASSIGN_TO);
        });
    });
</script>