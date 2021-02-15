<?php include 'include/header.php';?>
<?php $table_heading = "Address";?>
<?php include 'include/sidebar.php';?>
<?php 
  include 'include/body-top.php';
  $targetpage="user.php";

?>

<fieldset class='scheduler-border'>
<legend class='scheduler-border'>User Registration</legend>
<?php if (isset($_GET['delete'])){
    $id=$_GET['delete'];
    $sql="DELETE FROM `users` WHERE `USER_NO` = '$id'";
    $res=mysqli_query($con,$sql);
    if($res){
        echo '<meta http-equiv="refresh" content="0;url=http://bdabashon.com/bdsoft/soft/user.php">';
    }
    
}
?>
<?php if (isset($_GET['edit'])){
    $id=$_GET['edit'];
    $sql="SELECT * FROM users WHERE USER_NO='$id'";
    $row = mysqli_fetch_array(mysqli_query($con,$sql));
    
}
?>

<form class='cmxform form-horizontal'>
    <div class="col-md-6">
        
   <div class='form-group'>
      <label for='NAME' class='control-label col-lg-4'>USER NAME</label>
      <div class='col-lg-8'><input class='form-control field_data' name='USER_NAME' id='USER_NAME' type='text'  value="<?=$row['USER_NAME']?>" req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   <div class='form-group'>
      <label for='NAME' class='control-label col-lg-4'>USER PHONE</label>
      <div class='col-lg-8'><input class='form-control field_data' name='USER_PHONE' id='USER_PHONE' type='text'   value="<?=$row['USER_PHONE']?>" req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   </div>
   <div class="col-md-6">
   
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>USER EMAIL</label>
      <div class='col-lg-8'><input class='form-control field_data' name='USER_EMAIL' id='USER_EMAIL' type='email'  value="<?=$row['USER_EMAIL']?>" req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   <?php if(isset($_GET['edit'])=="") { ?>
   <div class='form-group'>
      <label for='ADDRESS' class='control-label col-lg-4'>PASSWORD</label>
      <div class='col-lg-8'><input class='form-control field_data' name='PASSWORD' id='PASSWORD' type='password'   value='' req='1' is_double = '0' maxlength = '255'/></div>
   </div>
   <div class='form-group'>
      <div class='col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5 pull-right'>
          <input type='button' class='btn btn-primary pull-right' table_name='gen_addbooks' id='btnAdd' value='Save'/></div>
   </div>
   <?php } else { ?>
   <input type="hidden" id="id" value="<?=$row['USER_NO']?>">
   <div class='form-group'>
      <div class='col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5 pull-right'><input type='button' class='btn btn-primary pull-right' table_name='gen_addbooks' id='btnUpdate' value='Update'/></div>
   </div>
   
   <?php }  ?>
   
   
   </div>
</form>
</fieldset>

<table id="table_hide" class="table table-bordered" style ="margin-top:50px;">
        <thead>	
    	<tr>
        	<td><strong>Sr No</strong></td>
        	<td><strong>Name</strong></td>
        	<td><strong>Phone</strong></td>
        	<td><strong>Email</strong></td>
        	<td><strong>Action</strong></td>
        
        </tr>
            </thead>
    <?php

	$sql= "SELECT *FROM users";

    $query=mysqli_query($con,$sql);
 
		$i = 1;
		while($row = mysqli_fetch_array($query)){
	?>
    	 <tbody id="myTable">
    	<tr>
        	<td><?=$i++?></td>
        	<td><?=$row['USER_NAME']?></td>
        	<td><?=$row['USER_PHONE']?></td>
        	<td><?=$row['USER_EMAIL']?></td>
        	
        	<td>
        	    
        	   <center> 
        	   <a id="edit" href="<?=$targetpage.'?edit='.$row['USER_NO']?>" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i></a>
               <a  href="<?=$targetpage.'?delete='.$row['USER_NO']?>" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
               </center>
        	    
        	</td>
        </tr>
    
    <?php } ?>
         </tbody>
    </table>




<?php include 'include/footer.php';?>

<script>
function clear(){
    $(".field_data").each(function(){
        $(".field_data").val(' ');
    });
}
function userInsert(USER_NAME,USER_PHONE,USER_EMAIL,PASSWORD){
    $.ajax({
    url:"users/userInsert.php",
    method:"post",
    dataType:"html",
    data:({"insert":"insert","USER_NAME":USER_NAME,"USER_PHONE":USER_PHONE,"USER_EMAIL":USER_EMAIL,"PASSWORD":PASSWORD}),
    success:function(result){
        if(result==1){
            alert("Data Save Successfully");
            clear();
        }else{
            alert("Failed to Insert");
        }
    }
    });
}
function userUpdate(USER_NAME,id,USER_PHONE,USER_EMAIL){
    $.ajax({
    url:"users/userInsert.php",
    method:"post",
    dataType:"html",
    data:({"update":"update","id":id,"USER_NAME":USER_NAME,"USER_PHONE":USER_PHONE,"USER_EMAIL":USER_EMAIL}),
    success:function(result){
        if(result==1){
            alert("Successfully Updated");
            clear();
        }else{
            alert("Failed to Update Data!!");
        }
    }
    });
}
    $(document).ready(function(){
        
        $("#btnAdd").on("click",function(){
        var USER_NAME = $("#USER_NAME").val().trim();
        var USER_PHONE = $("#USER_PHONE").val();
        var USER_EMAIL = $("#USER_EMAIL").val().trim();
        var PASSWORD = $("#PASSWORD").val().trim();
        var ok = false  ;
         $(".field_data").each(function(){
          var check=$(this).val();
          if(check=="")
          {
              ok = true ;
              alert("Every Field is required");
              return false;
          }
         });
         if(ok==false){
             userInsert(USER_NAME,USER_PHONE,USER_EMAIL,PASSWORD);
         }
        
        });
        
      $("#btnUpdate").on("click",function(){
        var USER_NAME = $("#USER_NAME").val().trim();
        var USER_PHONE = $("#USER_PHONE").val();
        var USER_EMAIL = $("#USER_EMAIL").val().trim();
        var id=$("#id").val();
        userUpdate(USER_NAME,id,USER_PHONE,USER_EMAIL);
          
      });  
        
    });
    
    
</script>
