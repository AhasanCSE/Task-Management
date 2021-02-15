<?php include 'include/header.php';?>
<?php $table_heading = "Expenses";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>

<!--Accept-->

<?php
    if( isset( $_GET['acceptTA'])) 
    {
        $id = $_GET['acceptTA'] ;
        $amount = $_GET['amount'] ;
        $query = "UPDATE inv_travel_allowances SET IS_APPROVED = 1 WHERE `TRAVEL_ALLOWANCE_NO` = '$id'" ;
        mysqli_autocommit( $con , true ) ;
        $result = mysqli_query( $con , $query ) ;
        
        $sql="INSERT INTO acc_cash SET `ACC_CASH`='$amount' ,`REMARKS`='TA Bill Deducted',`ACC_CASH_TYPE`='-1' ";
        $cash=mysqli_query($con,$sql);
        
        mysqli_close($con) ;
        echo "<meta http-equiv='refresh' content='0;url=expenses.php'>";
    }
    
    if( isset( $_GET['acceptDA'])) 
    {
        $id = $_GET['acceptDA'] ;
        $amount = $_GET['amount'] ;
        $query = "UPDATE inv_daily_allowances SET IS_APPROVED = 1 WHERE `DAILY_ALLOWANCE_NO` = '$id'" ;
        mysqli_autocommit( $con , true ) ;
        $result = mysqli_query( $con , $query ) ;
        
        $sql="INSERT INTO acc_cash SET `ACC_CASH`='$amount' ,`REMARKS`='DA Bill Deducted',`ACC_CASH_TYPE`='-1' ";
        $cash=mysqli_query($con,$sql);
        
        mysqli_close($con) ;
        echo "<meta http-equiv='refresh' content='0;url=expenses.php'>";
    }

?>

<?php
if (isset($_GET['deleteTA'])){
    $id=$_GET['deleteTA'];
    $sql=" DELETE FROM inv_travel_allowances WHERE TRAVEL_ALLOWANCE_NO='$id' ";
    mysqli_query($con,$sql);
    
}
if (isset($_GET['deleteDA'])){
    $id=$_GET['deleteDA'];
    $sql=" DELETE FROM inv_daily_allowances WHERE DAILY_ALLOWANCE_NO='$id' ";
    mysqli_query($con,$sql);
    
}
if (isset($_GET['deleteRQ'])){
    $id=$_GET['deleteRQ'];
    $sql=" DELETE FROM inv_requisitions WHERE REQUISITION_NO='$id' ";
    mysqli_query($con,$sql);
    
}

$query="SELECT sum(ACC_CASH*ACC_CASH_TYPE)as total FROM acc_cash ";
$result=mysqli_fetch_assoc(mysqli_query($con, $query));

?>

<div > <h4 style="color: red;">Cash In Hand:  <span><?=$result['total']?></span> </h4> </div>
<div id="expense" >
    <fieldset class='scheduler-border'>
    <legend class='scheduler-border'>Expense</legend>
        <form class='cmxform form-horizontal'>
            <div class="col-md-6">
                <div class='form-group'>
              <label for='ExpenseHead' class='control-label col-lg-4'>Expense Head</label>
              <div class='col-lg-8'>
                  <select class='form-control search' style="width:100%;" id='ExpenseHead' name='ExpenseHead'>
                     <option>Please Select One</option>
                         <?php
                            $query = "SELECT `EXPENSE_HEAD_NO`, `HEAD_NAME` FROM acc_expense_heads" ;
                            $result = mysqli_query( $con ,$query ) ;
                            foreach( $result as $value )
                            {
                                echo "<option value = '".$value['EXPENSE_HEAD_NO']."'>".$value['HEAD_NAME']."</option>" ;
                            }
                         ?>
                  </select>
              </div>
           </div>
           <div class='form-group'>
              <label for='Date' class='control-label col-lg-4'> Date</label>
                <div class='col-lg-8'>
                  <input class='form-control field_data' name='Date' id='Date' type='date' value='' req='1' is_double = '0' maxlength = '255'/>
                </div>
           </div>
           
           </div>
           
        </form>
    </fieldset>
</div>

<!--TA-->

<div id="ta" style = "display:none;">
<fieldset class='scheduler-border'>
<legend class='scheduler-border'>TA</legend>
<form class='cmxform form-horizontal'>
    <div class="col-md-6">
        <div class='form-group'>
      <label for='' class='control-label col-lg-4'>Programmer Name</label>
      <div class='col-lg-8'>
          <select class='form-control search' style="width:100%;" id='PROGRAMMER_NAME' name='PROGRAMMER_NAME'>
             
             
             <option>Please Select One</option>
             <?php
                $query = "SELECT `USER_NO`, `USER_NAME` FROM `users` " ;
                $result = mysqli_query( $con ,$query ) ;
                foreach( $result as $value )
                {
                    echo "<option value = '".$value['USER_NO']."'>".$value['USER_NAME']."</option>" ;
                }
             ?>

          </select>
      </div>
   </div>
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
      <label for='ADDRESS' class='control-label col-lg-4'>To</label>
      <div class='col-lg-8'><input class='form-control field_data' name='TO' id='TO' type='text' value='' req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   
   <div class='form-group'>
      <div class='col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5 pull-right'>
          <input type='button' class='btn btn-primary pull-right' table_name='gen_addbooks' id='TASave' value='Save'/>
    </div>
   </div>
   </div>
</form>
</fieldset>
</div>

<!--DA-->

<div id="da" style = "display:none;">
<fieldset class='scheduler-border'>
<legend class='scheduler-border'>DA</legend>
<form class='cmxform form-horizontal'>
    <div class="col-md-6">
        <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>Project</label>
      <div class='col-lg-8'>
          <select class='form-control custom search' style="width:100%;" id='PROJECT_NO_DA' name='PROJECT_NO_DA'>
              <?php
              $sql = "select * from projects order by PROJECT_NO DESC";
              $query = mysqli_query($con,$sql);
              foreach($query as $row){
                  echo "<option value='".$row['PROJECT_NO']."'>".$row['PROJECT_NAME']."</option>";
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
      <div class='col-lg-8'>
          <input class='form-control field_data' name='COST' id='COST' type='text' value='' req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   
   <div class='form-group'>
      <div class='col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5 pull-right'>
          <input type='button' class='btn btn-primary pull-right'  id='DASave' value='Save'/>
        </div>
   </div>
   </div>
</form>
</fieldset>
</div>

<!--Requisition-->

<div id="Requisition" style = "display:none;">
<fieldset class='scheduler-border'>
<legend class='scheduler-border'>Requisition</legend>
<form class='cmxform form-horizontal'>
    <div class="col-md-6">
        
   <div class='form-group'>
      <label for='NAME' class='control-label col-lg-4'> Item Name</label>
      <div class='col-lg-8'><input class='form-control field_data' name='ITEMS_NAME' id='ITEMS_NAME' type='text' value='' req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   <div class='form-group'>
      <label for='AGE' class='control-label col-lg-4'> Description</label>
      <div class='col-lg-8'>
          <textarea class='form-control field_data' id='DESCRIPTION' name='DESCRIPTION'></textarea> 
      </div>
   </div>
   
   </div>
   <div class="col-md-6">
   <div class='form-group'>
      <label for='AGE' class='control-label col-lg-4'> Number of Items</label>
      <div class='col-lg-8'>
          <input class='form-control field_data' name='NUMBER_OF_ITEMS' id='NUMBER_OF_ITEMS' type='text' value='' req='1' is_double = '0' maxlength = '255'/> 
      </div>
   </div>
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>Approximate Price</label>
      <div class='col-lg-8'>
          <input class='form-control field_data' name='APPROXIMATE_PRICE' id='APPROXIMATE_PRICE' type='text' value='' req='1' is_double = '0' maxlength = '255'/> 
         </div>
   </div>
   
   <div class='form-group'>
        <div class='col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5 pull-right'>
          <input type='button' class='btn btn-primary pull-right' table_name='gen_addbooks' id='REQSave' value='Save'/>
        </div>
   </div>
   </div>
</form>
</fieldset>
</div>


<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 ' style="display:none;" id="TA_TABLE">
   <thead>
      <tr>
         <th class='text-center'>#</th>
         <th class='text-center'>Programmer  Name</th>
         <th class='text-center'>Project Name</th>
         <th class='text-center'> Travel Date</th>
         <th class='text-center'>From</th>
         <th class='text-center'>To</th>
         <th class='text-center'>Travel Details</th>
         <th class='text-center'>Travel Cost</th>
         <th class='text-center'>Action</th>
      </tr>
   </thead>
   <tbody id='recordListTA'></tbody>
</table>
<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 ' style="display:none;" id="DA_TABLE">
   <thead>
      <tr>
         <th class='text-center'>#</th>
         <th class='text-center'>Expence Head</th>
         <th class='text-center'>Project Name</th>
         <th class='text-center'> Date</th>
        
         <th class='text-center'> Details</th>
         <th class='text-center'> Cost</th>
         <th class='text-center'>Action</th>
      </tr>
   </thead>
   <tbody id='recordListDA'>
       
   </tbody>
</table>
<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 '  style="display:none;" id="REQUISITION_TABLE">
   <thead>
      <tr>
         <th class='text-center'>#</th>
         <th class='text-center'> Expence Head</th>
         <th class='text-center'> Items Name</th>
        
         <th class='text-center'> Number Of Items</th>
         <th class='text-center'> Approximate Price</th>
          <th class='text-center'>Description</th>
         <th class='text-center'>Action</th>
      </tr>
   </thead>
   <tbody id='recordListRQ'></tbody>
</table>
<?php include 'include/footer.php';?>

 
 <script>
     
     function ClearAll( )
     {
         $(".field_data").val("") ;
     }
     function ShowHideMethod( Selected )
     {
        if( Selected == 1 )
             {
                $("#ta").show() ;
                $("#TA_TABLE").show();
                $("#DA_TABLE").hide();
                $("#REQUISITION_TABLE").hide();
                $("#da").hide() ;
                $("#Requisition").hide() ;
             }
             else if( Selected == 2 )
             {
                $("#ta").hide() ;
                $("#da").show() ;
                $("#Requisition").hide() ;
                 $("#TA_TABLE").hide();
                $("#DA_TABLE").show();
                $("#REQUISITION_TABLE").hide();
             }
             else if( Selected == 3 )
             {
                $("#ta").hide() ;
                $("#da").hide() ;
                $("#Requisition").show() ;
                 $("#TA_TABLE").hide();
                $("#DA_TABLE").hide();
                $("#REQUISITION_TABLE").show();
             }
             else
             {
                $("#ta").hide() ;
                $("#da").hide() ;
                $("#Requisition").hide() ;
                 $("#TA_TABLE").hide();
                $("#DA_TABLE").hide();
                $("#REQUISITION_TABLE").hide();
             } 
     }
     
     function SaveTA( PROGRAMMER_NAME ,ExpenseHead, SaveDate, PROJECT_NO, TRAVEL_DATE, FROM, TO, TRAVEL_DETAILS, TRAVEL_COST ) 
     {
         $.ajax( { 
             url:"ajax/SaveTA.php",
             method: "post",
             data:({ "SaveTA": "SaveTA", "PROGRAMMER_NAME":PROGRAMMER_NAME,"ExpenseHead":ExpenseHead, "SaveDate":SaveDate, "PROJECT_NO":PROJECT_NO, "TRAVEL_DATE":TRAVEL_DATE, "FROM":FROM, "TO":TO, "TRAVEL_DETAILS":TRAVEL_DETAILS, "TRAVEL_COST":TRAVEL_COST }) ,
             dataType: "html",
             success: function( Result )
             {
                 ClearAll() ;
                 getTAData( "TAData" ) ;
                alert("Save") ;
                
             }
         }) ;
     }
     function SaveDA( ExpenseHead,  PROJECT_NO_DA, DATE, DETAILS, COST ,SaveDate) {
         $.ajax( { 
             url:"ajax/SaveTA.php",
             method: "post",
             data:({ "SaveDA": "SaveDA", "ExpenseHead":ExpenseHead, "PROJECT_NO_DA":PROJECT_NO_DA, "DATE":DATE, "DETAILS":DETAILS, "COST":COST, "SaveDate":SaveDate }) ,
             dataType: "html",
             success: function( Result )
             {
                 ClearAll() ;
                  getDAData("DAData");
                //  console.log(Result) ;
                alert("Save DA") ;
             }
         }) ;
     }
     
     function SaveREQ( ExpenseHead, ITEMS_NAME, DESCRIPTION, NUMBER_OF_ITEMS, APPROXIMATE_PRICE , SaveDate) {
        $.ajax( { 
             url:"ajax/SaveTA.php",
             method: "post",
             data:({ "SaveREQ": "SaveREQ","ExpenseHead":ExpenseHead, "ITEMS_NAME":ITEMS_NAME, "DESCRIPTION":DESCRIPTION, "NUMBER_OF_ITEMS":NUMBER_OF_ITEMS,"APPROXIMATE_PRICE":APPROXIMATE_PRICE , "SaveDate": SaveDate}) ,
             dataType: "html",
             success: function( Result )
             {
                 ClearAll() ;
                 getRQData("RQData");
                alert("Save Req") ;
             }
         }) ; 
     }
     
     function getTAData( TAData ) 
     {
         $.ajax( { 
             url:"ajax/SaveTA.php",
             method: "post",
             data:({"TAData": TAData }),
             dataType: "html",
             success: function( Result )
             {
                 console.log(Result) ;
                $("#recordListTA").html(Result) ;
             }
         }) ;
     }
     function getDAData( DAData ) 
     {
         $.ajax( { 
             url:"ajax/SaveTA.php",
             method: "post",
             data:({"DAData": DAData }),
             dataType: "html",
             success: function( Result )
             {
                 console.log(Result) ;
                $("#recordListDA").html(Result) ;
             }
         }) ;
     }
     
     function getRQData( RQData ) 
     {
         $.ajax( { 
             url:"ajax/SaveTA.php",
             method: "post",
             data:({"RQData": RQData }),
             dataType: "html",
             success: function( Result )
             {
                 
                $("#recordListRQ").html(Result) ;
             }
         }) ;
     }
     
     
     $(document).ready( function( ) { 
         
         getTAData( "TAData" ) ;
         getDAData("DAData");
         getRQData("RQData");
         
         $("#ExpenseHead").on("change", function( ) {
             var Selected = $("#ExpenseHead option:selected").val() ;
             ShowHideMethod(Selected) ;
         }) ;
         
         $("#TASave").on("click" , function( ) { 
             var PROGRAMMER_NAME = $("#PROGRAMMER_NAME").val().trim() ;
             var ExpenseHead = $("#ExpenseHead").val().trim() ;
             var SaveDate = $("#Date").val().trim() ;
             var PROJECT_NO = $("#PROJECT_NO").val().trim() ;
             var TRAVEL_DATE = $("#TRAVEL_DATE").val().trim() ;
             var FROM = $("#FROM").val().trim() ;
             var TO = $("#TO").val().trim() ;
             var TRAVEL_DETAILS = $("#TRAVEL_DETAILS").val().trim() ;
             var TRAVEL_COST = $("#TRAVEL_COST").val().trim() ;
             
            SaveTA( PROGRAMMER_NAME, ExpenseHead, SaveDate, PROJECT_NO, TRAVEL_DATE, FROM, TO, TRAVEL_DETAILS, TRAVEL_COST ) ;
         }) ;
        
         
         $("#DASave").on("click" , function( ) { 
             var ExpenseHead = $("#ExpenseHead option:selected").val();
             var SaveDate = $("#Date").val().trim() ;
             var PROJECT_NO_DA = $("#PROJECT_NO_DA").val().trim() ;
             var DATE = $("#DATE").val().trim() ;
             var DETAILS = $("#DETAILS").val().trim() ;
             var COST = $("#COST").val().trim() ;
             
             console.log( "here" ) ;
             
            SaveDA(ExpenseHead, PROJECT_NO_DA, DATE, DETAILS, COST , SaveDate) ;
         }) ;
         
         $("#REQSave").on("click" , function( ) { 
             var ExpenseHead = $("#ExpenseHead option:selected").val();
             var SaveDate = $("#Date").val().trim() ;
             var ITEMS_NAME = $("#ITEMS_NAME").val().trim() ;
             var DESCRIPTION = $("#DESCRIPTION").val().trim() ;
             var NUMBER_OF_ITEMS = $("#NUMBER_OF_ITEMS").val().trim() ;
             var APPROXIMATE_PRICE = $("#APPROXIMATE_PRICE").val().trim() ;
             
             
            SaveREQ(ExpenseHead,ITEMS_NAME, DESCRIPTION, NUMBER_OF_ITEMS, APPROXIMATE_PRICE, SaveDate) ;
         }) ;
     }) ;
     
 </script>