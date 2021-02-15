<?php include 'include/header.php';?>
<?php $table_heading = "Address";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
<fieldset class='scheduler-border'>
<legend class='scheduler-border'>Task Setup</legend>
<form class='cmxform form-horizontal'>
    <div class="col-md-6">
     <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>Select Task</label>
      <div class='col-lg-8'>
          <select class='form-control' name='ASSIGN_TO' id='ASSIGN_TO'></select>
      </div>
   </div>   
   <div class='form-group'>
      <label for='NAME' class='control-label col-lg-4'>Task Note</label>
      <div class='col-lg-8'>
          <textarea class='form-control'></textarea>
      </div>
   </div>
   </div>
   
   <div class="col-md-6">
   
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>Attachment URL</label>
      <div class='col-lg-8'><input class='form-control field_data' name='WORK_HOUR' id='WORK_HOUR' type='text' value='' req='1' is_double = '0' maxlength = '255'/></div>
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
         <th>#</th>
         <th>Title</th>
         <th>Description</th>
         <th>ISSUE_DATE</th>
         <th>ASSIGN_TO</th>
         <th>WORK_HOUR</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody id='recordList'></tbody>
</table>

<?php include 'include/footer.php';?>
