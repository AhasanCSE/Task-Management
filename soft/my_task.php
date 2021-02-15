<?php session_start(); ?>
<?php include 'include/header.php';?>
<?php $table_heading = "Task List";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>


<table id="table_hide" class="table table-bordered" style ="margin-top:50px;">
        <thead>	
    	<tr>
        	
        	<td><strong>#</strong></td>
        	<td><strong>ProjectName</strong></td>
        	<td><strong>Title</strong></td>
        	<!--<td><strong>Description</strong></td>-->
        	<td><strong>ISSUE DATE</strong></td>
        	<td><strong>WORK HOUR </strong></td>
        	<td><strong>Finish Date</strong></td>

        	<td><strong>Status</strong></td>
        	<td><strong>Action</strong></td>
        
        
        </tr>
        </thead>
        <tbody>
            <?php
                
               
                $id = $_SESSION['user']['USER_NO'] ;
            	$sql = "SELECT tasks.TASK_NO, status.STATUS_NAME, projects.PROJECT_NAME , tasks.WORK_HOUR, tasks.TASK_TITLE, tasks.DESCRIPTION, tasks.ISSUE_DATE, tasks.FINISH_DATE, users.USER_NAME FROM tasks LEFT JOIN users ON users.USER_NO = tasks.ASSIGN_TO LEFT JOIN projects ON projects.PROJECT_NO = tasks.PROJECT_NO LEFT JOIN status ON status.STATUS_NO = tasks.STATUS WHERE ASSIGN_TO='$id' ORDER BY tasks.TASK_NO DESC LIMIT 20";
    
                $query=mysqli_query($con,$sql);
                $count = 1 ;
                foreach( $query as $value )
                {
                    echo "<tr>" ;
                        
                        echo "<td>".$count ++ ."</td>" ;
                        echo "<td>".$value['PROJECT_NAME']."</td>" ;
                        echo "<td>".$value['TASK_TITLE'] ."</td>" ;
                        //echo "<td>".$value['DESCRIPTION']."</td>" ;
                        echo "<td>".$value['ISSUE_DATE'] ."</td>" ;
                        echo "<td>".$value['WORK_HOUR'] ."</td>" ;
                        echo "<td>".$value['FINISH_DATE'] ."</td>" ;
                        
                        echo "<td>".$value['STATUS_NAME']."</td>" ;
                        echo "<td class='text-center'>" . "<div class='btn-group'><a data-toggle='tooltip' title='Edit' class='btn btn-xs btn-warning editbtn' href='viewNotes.php?task_no=".$value['TASK_NO']."'><i class=' fa fa-eye'></i>View</a>" . "</div></td>";
                        
                    echo "</tr>" ;
                }
 
	        ?>
         </tbody>
    </table>






<?php include 'include/footer.php';?>
