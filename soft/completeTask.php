<?php include 'include/header.php';?>
<?php $table_heading = "Completed Task List";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>

<table id="table_hide" class="table table-bordered" style ="margin-top:5px;">
        <thead>	
        	<tr>
            	
            	<td><strong>#</strong></td>
            	<td><strong>Project Name</strong></td>
            	<td><strong>Tittle</strong></td>
            	<td><strong>Work Hour</strong></td>
            	<td><strong>Completed By</strong></td>
    
            </tr>
        </thead>
        <tbody>
            <?php
                 $sql = "SELECT tasks.TASK_NO, status.STATUS_NAME, projects.PROJECT_NAME , tasks.WORK_HOUR, tasks.TASK_TITLE, tasks.DESCRIPTION, tasks.ISSUE_DATE, tasks.FINISH_DATE, users.USER_NAME FROM tasks LEFT JOIN users ON users.USER_NO = tasks.ASSIGN_TO LEFT JOIN projects ON projects.PROJECT_NO = tasks.PROJECT_NO LEFT JOIN status ON status.STATUS_NO = tasks.STATUS WHERE status.STATUS_NO = '4'  ORDER BY tasks.TASK_NO DESC LIMIT 20";
                $result = mysqli_query($con,$sql);
                $count = 1 ;
                foreach( $result as $value )
                {
                    echo "<tr>" ;
                        
                            
                            echo "<td>".$count++."</td>" ;
                            echo "<td>".$value['PROJECT_NAME']."</td>" ;
                            echo "<td>".$value['TASK_TITLE']."</td>" ;
                            echo "<td>".$value['WORK_HOUR']."</td>" ;
                            echo "<td>".$value['USER_NAME']."</td>" ;
                        
                    echo "</tr>" ;
                }
                
            ?>
         </tbody>
    </table>





 <?php include 'include/footer.php';?>