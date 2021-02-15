<?php
    session_start() ;
    $cur = date( "Y-m-d h:i:s" ) ;
    if( isset( $_POST['SaveTA'] ) )
    {
        include '../../config/db_connection.php';
        
        $programmerNo = $_POST['PROGRAMMER_NAME'] ;
        $ExpenseHead = $_POST['ExpenseHead'] ;
        $SaveDate = $_POST['SaveDate'] ;
        $PROJECT_NO = $_POST['PROJECT_NO'] ;
        $TRAVEL_DATE = $_POST['TRAVEL_DATE'] ;
        $FROM = $_POST['FROM'] ;
        $TO = $_POST['TO'] ;
        $TRAVEL_DETAILS = $_POST['TRAVEL_DETAILS'] ;
        $TRAVEL_COST = $_POST['TRAVEL_COST'] ;
        
        $query = "INSERT INTO inv_travel_allowances SET EXPENSE_HEAD_NO = '$ExpenseHead',  USER_NO = '$programmerNo', 
        `PROJECT_NO` = '$PROJECT_NO', `TRAVEL_DATE` = '$TRAVEL_DATE', `TRAVEL_FROM` = '$FROM', `TRAVEL_TO` = '$TO', 
        `TRAVEL_DETAILS` = '$TRAVEL_DETAILS', `TRAVEL_COST` = '$TRAVEL_COST', `CREATED_ON` = '$SaveDate'" ;
        $result = mysqli_query( $con , $query ) ;
        if( $result )
        {
            echo 1 ;
        }
        else
        {
            echo 0 ;
        }
    }


    if( isset( $_POST['SaveDA'] ) ) 
    {
        include '../../config/db_connection.php';
        
        $ExpenseHead = $_POST['ExpenseHead'] ;
        $PROJECT_NO_DA = $_POST['PROJECT_NO_DA'] ;
        $DATE = $_POST['DATE'] ;
        $DETAILS = $_POST['DETAILS'] ;
        $COST = $_POST['COST'] ;
        $SaveDate = $_POST['SaveDate'] ;
        
        $query = "INSERT INTO inv_daily_allowances SET EXPENSE_HEAD_NO = '$ExpenseHead',  `PROJECT_NO` = '$PROJECT_NO_DA', 
        `DATE` = '$DATE', `DETAILS` = '$DETAILS', `COST` = '$COST', `CREATED_ON` = '$SaveDate'" ;
        $result = mysqli_query( $con , $query ) ;
        if( $result )
        {
            echo 1; 
        }
        else
        {
            echo 0 ;
        }
    }
    
    if( isset( $_POST['SaveREQ'] ) ) 
    {
        include '../../config/db_connection.php';
        
        $ExpenseHead = $_POST['ExpenseHead'] ;
        $ITEMS_NAME = $_POST['ITEMS_NAME'] ;
        $DESCRIPTION = $_POST['DESCRIPTION'] ;
        $NUMBER_OF_ITEMS = $_POST['NUMBER_OF_ITEMS'] ;
        $APPROXIMATE_PRICE = $_POST['APPROXIMATE_PRICE'] ;
        $SaveDate = $_POST['SaveDate'] ;

        $query = "INSERT INTO inv_requisitions SET `EXPENSE_HEAD_NO`= '$ExpenseHead',NUMBER_OF_ITEM = '$NUMBER_OF_ITEMS' , `ITEM_NAME` = '$ITEMS_NAME', `DETAILS` = '$DESCRIPTION', `AMOUNT` = '$APPROXIMATE_PRICE',  `CREATED_ON` = '$SaveDate'";
        $result = mysqli_query( $con , $query ) ;
        
        if( $result )
        {
            echo 1; 
        }
        else
        {
            echo 0 ;
        }
    }
    
    if( isset( $_POST['TAData'] ) )
    {
        include '../../config/db_connection.php';
        $query = "SELECT inv_travel_allowances.*, users.USER_NAME, projects.PROJECT_NAME FROM `inv_travel_allowances` LEFT JOIN 
        projects ON projects.PROJECT_NO = inv_travel_allowances.PROJECT_NO LEFT JOIN users ON users.USER_NO = inv_travel_allowances.USER_NO WHERE inv_travel_allowances.IS_APPROVED = 0
        ORDER BY `TRAVEL_ALLOWANCE_NO` DESC LIMIT 10";
    
        $result = mysqli_query( $con , $query ) ;
        $count = 1 ;
        foreach( $result as $value )
        {
            echo "<tr>" ;
                echo "<td>".$count++."</td>" ;
                echo "<td>".$value['USER_NAME']."</td>" ;
                echo "<td>".$value['PROJECT_NAME']."</td>" ;
                echo "<td>".$value['TRAVEL_DATE']."</td>" ;
                echo "<td>".$value['TRAVEL_FROM']."</td>" ;
                echo "<td>".$value['TRAVEL_TO']."</td>" ;
                echo "<td>".$value['TRAVEL_DETAILS']."</td>" ;
                echo "<td>".$value['TRAVEL_COST']."</td>" ;
                echo $value['TRAVEL_ALLOWANCE_NO'];
                if( $_SESSION['user']['USER_TYPE']  == 1 )
                {
                    echo "<td>";
                    echo "<a href='expenses.php?editTA=".$value['TRAVEL_ALLOWANCE_NO']."' class = 'btn btn-success'><i class = 'fa fa-pencil'></i>Edit</a>";
                    echo "<a href='expenses.php?deleteTA=".$value['TRAVEL_ALLOWANCE_NO']."' class = 'btn btn-danger'><i class='fa fa-trash-o'></i>Delete</a>";
                    echo "</td>" ;
                }
                else if( $_SESSION['user']['USER_TYPE']  == 0  )
                {
                    echo "<td>";
                    echo "<a href='expenses.php?acceptTA=".$value['TRAVEL_ALLOWANCE_NO']."&&amount=".$value['TRAVEL_COST']."' class = 'btn btn-success'><i class='fa fa-check-square'></i>Accept</a>";
                    echo "<a href='expenses.php?deleteTA=".$value['TRAVEL_ALLOWANCE_NO']."' class = 'btn btn-danger'><i class='fa fa-times-circle'></i>Decline</a>";
                    echo "</td>" ;
                }
                else
                {
                    echo "<td></td>" ;
                }
            echo "</tr>" ;
        }
    }
    
    if( isset( $_POST['DAData'] ) )
    {
        include '../../config/db_connection.php';
        $query = "SELECT inv_daily_allowances.*, acc_expense_heads.HEAD_NAME, projects.PROJECT_NAME FROM inv_daily_allowances LEFT JOIN acc_expense_heads ON acc_expense_heads.EXPENSE_HEAD_NO = inv_daily_allowances.EXPENSE_HEAD_NO LEFT JOIN projects ON projects.PROJECT_NO = inv_daily_allowances.PROJECT_NO WHERE inv_daily_allowances.IS_APPROVED = 0 ORDER BY inv_daily_allowances.DAILY_ALLOWANCE_NO DESC LIMIT 10";
        
        $result = mysqli_query( $con , $query ) ;
        $count = 1 ;
        foreach( $result as $value )
        {
            echo "<tr>" ;
                echo "<td>".$count++."</td>" ;
                echo "<td>".$value['HEAD_NAME']."</td>" ;
                echo "<td>".$value['PROJECT_NAME']."</td>" ;
                echo "<td>".$value['DATE']."</td>" ;
                echo "<td>".$value['DETAILS']."</td>" ;
                echo "<td>".$value['COST']."</td>" ;
               
                
                if( $_SESSION['user']['USER_TYPE']  == 1 )
                {
                    echo "<td>";
                    echo "<a href='expenses.php?editDA=".$value['DAILY_ALLOWANCE_NO']."' class = 'btn btn-success'><i class = 'fa fa-pencil'></i>Edit</a>";
                    echo "<a href='expenses.php?deleteDA=".$value['DAILY_ALLOWANCE_NO']."' class = 'btn btn-danger'><i class='fa fa-trash-o'></i>Delete</a>";
                    echo "</td>" ;
                }
                else if( $_SESSION['user']['USER_TYPE']  == 0  )
                {
                    echo "<td>";
                    echo "<a href='expenses.php?acceptDA=".$value['DAILY_ALLOWANCE_NO']."&&amount=".$value['COST']."' class = 'btn btn-success'><i class='fa fa-check-square'></i>Accept</a>";
                    echo "<a href='expenses.php?deleteDA=".$value['DAILY_ALLOWANCE_NO']."' class = 'btn btn-danger'><i class='fa fa-times-circle'></i>Decline</a>";
                    echo "</td>" ;
                }
                else
                {
                    echo "<td></td>" ;
                }
            echo "</tr>" ;
        }
    }
    
    if( isset( $_POST['RQData'] ) )
    {
        include '../../config/db_connection.php';
        $query = "SELECT inv_requisitions.*,acc_expense_heads.HEAD_NAME FROM inv_requisitions LEFT JOIN acc_expense_heads ON acc_expense_heads.EXPENSE_HEAD_NO=inv_requisitions.EXPENSE_HEAD_NO WHERE inv_requisitions.IS_APPROVED = 0 ORDER BY inv_requisitions.REQUISITION_NO DESC LIMIT 10";
        
        $result = mysqli_query( $con , $query ) ;
        $count = 1 ;
        foreach( $result as $value )
        {
            echo "<tr>" ;
                echo "<td>".$count++."</td>" ;
                echo "<td>".$value['HEAD_NAME']."</td>" ;
                echo "<td>".$value['ITEM_NAME']."</td>" ;
                echo "<td>".$value['NUMBER_OF_ITEM']."</td>" ;
               
                echo "<td>".$value['AMOUNT']."</td>" ;
                 echo "<td>".$value['DETAILS']."</td>" ;
               
                
                if( $_SESSION['user']['USER_TYPE']  == 1 )
                {
                    echo "<td>";
                    echo "<a href='expenses.php?editRQ=".$value['REQUISITION_NO']."' class = 'btn btn-success'><i class = 'fa fa-pencil'></i>Edit</a>";
                    echo "<a href='expenses.php?deleteRQ=".$value['REQUISITION_NO']."' class = 'btn btn-danger'><i class='fa fa-trash-o'></i>Delete</a>";
                    echo "</td>" ;
                }
                else if( $_SESSION['user']['USER_TYPE']  == 0  )
                {
                    echo "<td>";
                    echo "<a href='expenses.php?acceptRQ=".$value['REQUISITION_NO']."' class = 'btn btn-success'><i class='fa fa-check-square'></i>Accept</a>";
                    echo "<a href='expenses.php?deleteRQ=".$value['REQUISITION_NO']."' class = 'btn btn-danger'><i class='fa fa-times-circle'></i>Decline</a>";
                    echo "</td>" ;
                }
                else
                {
                    echo "<td></td>" ;
                }
            echo "</tr>" ;
        }
    }

?>