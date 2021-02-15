<?php include 'include/header.php';?>
<?php $table_heading = "CASH";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
<?php
$cur=date("Y-m-d h:i:s");
if(isset($_POST['AccAdd'])){
    $cash_amount=$_POST['cashAmount'];
    $remarks=$_POST['remarks'];
    $sql="INSERT INTO acc_cash SET `ACC_CASH`='$cash_amount' ,`REMARKS`='$remarks',`ACC_CASH_TYPE`='1', `CREATED_ON`='$cur' ";
    $result=mysqli_query($con,$sql);
}

?>
<fieldset class='scheduler-border'>
<legend class='scheduler-border'>Cash Setup</legend>
<form class='cmxform form-horizontal' action="" method="post">
   
   <div class='form-group'>
      <label for='NAME' class='control-label col-lg-3'>Cash Amount</label>
      <div class='col-lg-5'><input class='form-control field_data' name='cashAmount' id='cashAmount' type='text' value='' req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   <div class='form-group'>
      <label for='AGE' class='control-label col-lg-3'>Remarks</label>
      <div class='col-lg-5'>
          <textarea class='form-control field_data' id='remarks' name='remarks'></textarea>
      </div>
   </div>
   
   <div class='form-group'>
      <div class='col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5'>
          <input type='submit' class='btn btn-primary pull-right' name="AccAdd" id='AccAdd' value='Save'/></div>
   </div>
   
</form>
</fieldset>


<table class='table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 ' >
   <thead>
      <tr>
         <th class='text-center'>#</th>
         <th class='text-center'>Cash Amount</th>
         <th class='text-center'>Cash Type</th>
         <th class='text-center'>Remarks</th>
         <th class='text-center'>Date</th>
         
      </tr>
   </thead>
   <tbody >
       <?php
 $query="SELECT * FROM `acc_cash` ORDER BY `ACC_CASH_NO` DESC LIMIT 20";
 $resultShow=mysqli_query($con, $query);
  $count= 1;
  foreach($resultShow as $value){
            echo "<tr>" ;
                echo "<td>".$count++."</td>" ;
                echo "<td>".$value['ACC_CASH']."</td>" ;
                $typetest=$value['ACC_CASH_TYPE']==1? "In":"Out";
                echo "<td>".$typetest."</td>" ;
                echo "<td>".$value['REMARKS']."</td>" ;
                echo "<td>".$value['CREATED_ON']."</td>" ;
               
               
                
            echo "</tr>" ;
        }
?>
   </tbody>
</table>



<?php include 'include/footer.php';?>