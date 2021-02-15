<?php include 'include/header.php';?>
<?php $table_heading = "Task List";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
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
         <th class="text-center">Note</th>
         <th class="text-center">URL</th>
         <th class="text-center">Status</th>
         <th class="text-center">Action</th>
      </tr>
   </thead>
   <tbody id='recordList'></tbody>
</table>



<?php include 'include/footer.php';?>