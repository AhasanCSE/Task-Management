<?php include 'include/header.php';?>
<?php $table_heading = "Address";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
<fieldset class='scheduler-border'>
<legend class='scheduler-border'>Project Setup</legend>
<form class='cmxform form-horizontal'>
   
   <div class='form-group'>
      <label for='NAME' class='control-label col-lg-3'>Project Name</label>
      <div class='col-lg-5'><input class='form-control field_data' name='PROJECT_NAME' id='PROJECT_NAME' type='text' value='' req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   <div class='form-group'>
      <label for='AGE' class='control-label col-lg-3'>Project Code</label>
     
          <div class='col-lg-5'><input class='form-control field_data' name='PROJECT_CODE' id='PROJECT_CODE' type='text' value='' req='1' is_double = '0' maxlength = '255'/></div>
      
   </div>
   
   <div class='form-group'>
      <div class='col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5'><input type='button' class='btn btn-primary pull-right' table_name='gen_addbooks' id='btnAdd' value='Save'/></div>
   </div>
   
</form>
</fieldset>


<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
   <thead>
      <tr>
         <th class="text-center">#</th>
         <th class="text-center">Project Code</th>
         <th class="text-center">Project Name</th>
         <th class="text-center">Action</th>
      </tr>
   </thead>
   <tbody id='recordList'></tbody>
</table>

<?php include 'include/footer.php';?>

<script>
function clear(){
    $(".field_data").each(function(){
        $(".field_data").val(' ');
    });
}
function projectInsert(project,PROJECT_NAME,PROJECT_CODE){
    $.ajax({
        url:"account/expense/expenseInsert.php",
        method:"post",
        dataType:"html",
        data:{project:project,PROJECT_NAME:PROJECT_NAME,PROJECT_CODE:PROJECT_CODE},
        success:function(result){
            if(result==1){
            alert("Data Save Successfully");
            clear();
            projectRetrieve("project_retrieve");
            }else{
                alert("Error");
            }
        }
    });
}
function projectRetrieve(project_retrieve){
    $.ajax({
        url:"account/expense/expenseRetrieve.php",
        method:"post",
        dataType:"html",
        data:{project_retrieve:project_retrieve},
        success:function(result){
            $("#recordList").html(result);
        }
    });
}


    $(document).ready(function(){
        projectRetrieve("project_retrieve");
        
        $("#btnAdd").on("click",function(){
            var PROJECT_NAME = $("#PROJECT_NAME").val().trim();
            var PROJECT_CODE = $("#PROJECT_CODE").val().trim();
            projectInsert("project",PROJECT_NAME,PROJECT_CODE);
        });
        
        
    });
</script>
