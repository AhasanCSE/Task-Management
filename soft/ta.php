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
      <label for='NAME' class='control-label col-lg-4'>Travel Date</label>
      <div class='col-lg-8'><input class='form-control field_data' name='TRAVEL_DATE' id='TRAVEL_DATE' type='date' value='' req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>From</label>
      <div class='col-lg-8'><input class='form-control field_data' name='FROM' id='FROM' type='text' value='' req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>To</label>
      <div class='col-lg-8'><input class='form-control field_data' name='TO' id='TO' type='text' value='' req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   </div>
   <div class="col-md-6">
   <div class='form-group'>
      <label for='AGE' class='control-label col-lg-4'>TRAVEL DETAILS</label>
      <div class='col-lg-8'>
          <textarea class='form-control field_data' id='TRAVEL_DETAILS' name='TRAVEL_DETAILS'></textarea>
      </div>
   </div>
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>TRAVEL COST</label>
      <div class='col-lg-8'><input class='form-control field_data' name='TRAVEL_COST' id='TRAVEL_COST' type='text' value='' req='1' is_double = '0' maxlength = '255'/></div>
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
         <th class='text-center'>From</th>
         <th class='text-center'>To</th>
         <th class='text-center'>Description</th>
         <th class='text-center'>Cost Amount</th>
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
function taInsert(ta,PROJECT_NO,TRAVEL_DATE,FROM,TO,TRAVEL_DETAILS,TRAVEL_COST){
    $.ajax({
        url:"account/expense/expenseInsert.php",
        method:"post",
        dataType:"html",
        data:{ta:ta,PROJECT_NO:PROJECT_NO,TRAVEL_DATE:TRAVEL_DATE,FROM:FROM,TO:TO,TRAVEL_DETAILS:TRAVEL_DETAILS,TRAVEL_COST:TRAVEL_COST},
        success:function(result){
            if(result==1){
            alert("Data Save Successfully");
            clear();
            taRetrieve("ta_retrieve");
            }else{
                alert("Error");
            }
        }
    });
}

function taRetrieve(ta_retrieve){
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
         taRetrieve("ta_retrieve");
      $("#btnAdd").on("click",function(){
        var PROJECT_NO = $("#PROJECT_NO option:selected").val();
        var TRAVEL_DATE = $("#TRAVEL_DATE").val();
        var FROM = $("#FROM").val();
        var TO = $("#TO").val();
        var TRAVEL_DETAILS = $("#TRAVEL_DETAILS").val();
        var TRAVEL_COST = $("#TRAVEL_COST").val();
        taInsert("ta",PROJECT_NO,TRAVEL_DATE,FROM,TO,TRAVEL_DETAILS,TRAVEL_COST);
        });
    });
</script>