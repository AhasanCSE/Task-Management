<?php include 'include/header.php';?>
<?php $table_heading = "Address";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
<fieldset class='scheduler-border'>
<legend class='scheduler-border'>TA</legend>
<form class='cmxform form-horizontal'>
    <div class="col-md-6">
        <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>Project</label>
      <div class='col-lg-8'>
          <select class='form-control search' style="width:100%;" id='PROJECT_NO' name='PROJECT_NO'>
              <?php
              $sql = "select * from projects order by PROJECT_NO DESC";
              $query = mysqli_query($con,$sql);
              foreach($query as $row){
                  echo "<option value='".$row['PROJECT_NO']."'>".$row['PROJECT_NAME']."</OPTION>";
              }
              ?>
          </select>
      </div>
   </div>
   <div class='form-group'>
      <label for='NAME' class='control-label col-lg-4'> Date</label>
      <div class='col-lg-8'><input class='form-control field_data' name='DATE' id='DATE' type='date' value='' req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   
   </div>
   <div class="col-md-6">
   <div class='form-group'>
      <label for='AGE' class='control-label col-lg-4'> DETAILS</label>
      <div class='col-lg-8'>
          <textarea class='form-control field_data' id='DETAILS' name='DETAILS'></textarea>
      </div>
   </div>
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'> COST</label>
      <div class='col-lg-8'><input class='form-control field_data' name='COST' id='COST' type='text' value='' req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   
   <div class='form-group'>
      <div class='col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5 pull-right'><input type='button' class='btn btn-primary pull-right' table_name='gen_addbooks' id='btnAdd' value='Save'/></div>
   </div>
   </div>
</form>
</fieldset>


<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '>
   <thead>
      <tr>
         <th class='text-center'>#</th>
         <th class='text-center'>ProjectName</th>
         <th class='text-center'>Date</th>
         <th class='text-center'>Details</th>
         <th class='text-center'>Cost</th>
         <th class='text-center'>Action</th>
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
function daInsert(da,PROJECT_NO,DATE,DETAILS,COST){
    $.ajax({
        url:"account/expense/expenseInsert.php",
        method:"post",
        dataType:"html",
        data:{da:da,PROJECT_NO:PROJECT_NO,DATE:DATE,DETAILS:DETAILS,COST:COST},
        success:function(result){
            if(result==1){
            alert("Data Save Successfully");
            clear();
            daRetrieve("ta_retrieve");
            }else{
                alert("Error");
            }
        }
    });
}

function daRetrieve(da_retrieve){
    $.ajax({
        url:"account/expense/expenseRetrieve.php",
        method:"post",
        dataType:"html",
        data:{ta_retrieve:ta_retrieve},
        success:function(result){
            $("#recordList").html(result);
        }
    });
}
    $(document).ready(function(){
         daRetrieve("da_retrieve");
      $("#btnAdd").on("click",function(){
        var PROJECT_NO = $("#PROJECT_NO option:selected").val();
        var DATE = $("#DATE").val();
        var DETAILS = $("#DETAILS").val();
        var COST = $("#COST").val();
        daInsert("da",PROJECT_NO,DATE,DETAILS,COST);
        });
    });
</script>