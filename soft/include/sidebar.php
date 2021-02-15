        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li class="sub-menu">
                            <a href="">
                                <i class="fa fa-user"></i>
                                <span>Users</span>
                            </a>
                            <ul class="sub">
                                <li>
                                        <a href="user.php">
                                            <i class="fa fa-user"></i>
                                            <span>User Registration</span>
                                        </a>
                                    </li>
                                   
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="">
                                <i class="fa fa-user"></i>
                                <span>Task</span>
                            </a>
                            <?php
                            if( $_SESSION['user']['USER_TYPE'] == 1 ){
                        ?>
                            <ul class="sub">
                                <li>
                                    <a href="task_setup.php">
                                <i class="fa fa-user"></i>
                                <span>Task Setup</span>
                            </a>
                                </li>
                            </ul>
                            <?php } ?>
                            <ul class="sub">
                                    <li>
                                        <a href="task_list.php">
                                            <i class="fa fa-user"></i>
                                            <span>Task List</span>
                                        </a>
                                    </li>
                                     <li>
                                        <a href="my_task.php">
                                            <i class="fa fa-user"></i>
                                            <span>My Task</span>
                                        </a>
                                    </li>
                                  
                            </ul>
                        </li>
                        <li>
                            <a href="project_setup.php">
                                <i class="fa fa-user"></i>
                                <span>project Setup</span>
                            </a>
                        </li>
                        <?php
                            if( $_SESSION['user']['USER_TYPE'] == 1 ){
                        ?>
                        <li class="sub-menu">
                                <a  href="completeTask.php">
                                    <i class="fa fa-user"></i>
                                    <span>Complete Task</span>
                                </a>
                                
                        </li>
                        <?php } ?>
                        <li class="sub-menu">
                                <a  href="../javascript:;">
                                    <i class="fa fa-user"></i>
                                    <span>Accounts</span>
                                </a>
                                <ul class="sub">
                                    <li>
                                        <a href="">
                                            <i class="fa fa-user"></i>
                                            <span>Expense</span>
                                        </a>
                                    <ul class="sub">
                                        <li>
                                            <a href="acc_head_setup.php">
                                                <i class="fa fa-user"></i>
                                                <span>Expense Head Setup</span>
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a href="expenses.php">
                                                <i class="fa fa-user"></i>
                                                <span>Expenses</span>
                                            </a>
                                        </li>
                                         
                                  
                                    </ul>
                            <!--<ul class="sub">-->
                            <!--        <li>-->
                            <!--            <a href="ta.php">-->
                            <!--                <i class="fa fa-user"></i>-->
                            <!--                <span>TA</span>-->
                            <!--            </a>-->
                            <!--        </li>-->
                                  
                            <!--</ul>-->
                            
                            <!--<ul class="sub">-->
                            <!--        <li>-->
                            <!--            <a href="da.php">-->
                            <!--                <i class="fa fa-user"></i>-->
                            <!--                <span>DA</span>-->
                            <!--            </a>-->
                            <!--        </li>-->
                                  
                            <!--</ul>-->
                                    </li>
                                    
                            </ul>
                        </li>
                        <li class="sub-menu">
                                <a  href="../javascript:;">
                                    <i class="fa fa-user"></i>
                                    <span>Cash</span>
                                </a>
                                <ul class="sub">
                                    
                                         <li>
                                            <a href="acc_cash_setup.php">
                                                <i class="fa fa-user"></i>
                                                <span>Cash Setup</span>
                                            </a>
                                        </li>
                                    
                                    
                            </ul>
                        </li>
                            
                                  
                            </ul> 
                        </li>                  
                 </ul>            
            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->