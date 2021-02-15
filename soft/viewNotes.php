<?php include 'include/header.php';?>
<?php $table_heading = "View Notes";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
<div  class="col-sm-12" style="padding:20px 0;">
    <h4 style="margin:auto;padding:10px 0;">Description : </br> </h4>
        <?php
        $task_no = $_GET['task_no'] ;
        $sql="SELECT `DESCRIPTION` FROM `tasks` WHERE TASK_NO='$task_no'";
        $res=mysqli_fetch_assoc(mysqli_query($con,$sql));
        echo $res['DESCRIPTION'];
        ?>
        
        
    
    </br>
</div>

<h4 style="margin:auto;padding:5px 0;">Notes : </br> </h4>

<table id="table_hide" class="table table-bordered" style ="margin-top:5px;">
        <thead>	
        	<tr>
            	
            	<td><strong>#</strong></td>
            	<td><strong>Notes</strong></td>
            	<td><strong>Created On</strong></td>
            		<td><strong>Created By</strong></td>
    
            </tr>
        </thead>
        <tbody>
            <?php
                $taskNo = $_GET['task_no'] ;
                
                $getAttachment= "SELECT `NOTE_NO`,`TASK_NO`,`NOTE`,notes.`CREATED_ON`,users.USER_NAME FROM notes LEFT JOIN users ON notes.CREATED_BY=users.USER_NO WHERE TASK_NO = '$taskNo' ORDER BY NOTE_NO DESC" ;

                $result = mysqli_query( $con ,$getAttachment) ;
                $count = 1 ;
                foreach( $result as $value )
                {
                    echo "<tr>" ;
                        echo "<td>".$count ++ ."</td>" ;
                         echo "<td>".$value['NOTE'] ."</td>" ;
                         echo "<td>".$value['CREATED_ON'] ."</td>" ;
                          echo "<td>".$value['USER_NAME'] ."</td>" ;
                         
                    echo "</tr>" ;
                }
            ?>
         </tbody>
    </table>


<h4 style="margin:auto;padding:5px 0;">URL : </br> </h4>
<table id="table_hide" class="table table-bordered" style ="margin-top:5px;">
        <thead>	
        	<tr>
            	
            	<td><strong>#</strong></td>
            	<td><strong>URL</strong></td>
            	<td><strong>Created On</strong></td>
            	<td><strong>Created By</strong></td>
    
            </tr>
        </thead>
        <tbody>
            <?php
                $taskNo = $_GET['task_no'] ;
                
                $getAttachment= "SELECT `TASK_NO`,`TASK_ATTACHMENT_NO`,`ATTACH_URL`,task_attachments.`CREATED_ON`,task_attachments.`CREATED_BY` ,users.USER_NAME FROM task_attachments LEFT JOIN users ON task_attachments.CREATED_BY=users.USER_NO WHERE TASK_NO = '$taskNo' ORDER BY `TASK_NO` DESC" ;
               
                
                $result = mysqli_query( $con ,$getAttachment) ;
                $count = 1 ;
                foreach( $result as $value )
                {
                    echo "<tr>" ;
                        echo "<td>".$count ++ ."</td>" ;
                         echo "<td>".$value['ATTACH_URL'] ."</td>" ;
                          echo "<td>".$value['CREATED_ON'] ."</td>" ;
                         echo "<td>".$value['USER_NAME'] ."</td>" ;
                         
                    echo "</tr>" ;
                }
            ?>
         </tbody>
    </table>


 <?php include 'include/footer.php';?>