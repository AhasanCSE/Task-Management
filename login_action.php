<?php
session_start();
include('config/db_connection.php');
$mgs = "";
if(isset($_POST['submit'])){  
	function menu($user_no,$URL,$con)
	{
		$sql = "SELECT DISTINCT B.`menu_name`,B.`menu_no` FROM `xxx_sub_menu_access` A
												INNER JOIN `xxx_sub_menu` C ON C.sub_menu_no = A.sub_menu_no
												INNER JOIN `xxx_menu` B ON B.menu_no = C.menu_no
												WHERE B.is_active = 1 AND C.is_active = 1 AND A.user_no = $user_no
												ORDER BY B.order_by ASC";
		$query = mysqli_query($con,$sql);
		$ul_start = "<ul class='nav navbar-nav side-nav'>";
				$list_dtl = "";
				while($row = mysqli_fetch_array($query)):
						$list_dtl .="<li><a href='javascript:;' data-toggle='collapse' data-target='#menu_".$row['menu_no']."'><i class='fa fa-fw fa-plus'></i>".$row['menu_name']."<i class='fa fa-fw fa-caret-down'></i></a>".sub_menu($row['menu_no'],$user_no,$URL,$con)."</li>";
				endwhile;
				$list_dtl .="<li><a style='margin-left: 0px;' href='".$URL."logout.php'>Logout</a></li>";
		$ul_end = "</ul>";
		$result = $ul_start.$list_dtl.$ul_end;
		return $result;
	}
	function sub_menu($menu_no,$user_no,$URL,$con)
	{
		$sql = "SELECT * FROM `xxx_sub_menu` 
						LEFT JOIN `xxx_sub_menu_access` ON `xxx_sub_menu_access`.`sub_menu_no` = `xxx_sub_menu`.`sub_menu_no`
						WHERE `menu_no` = '$menu_no' AND `is_active` = 1 AND `user_no` = '$user_no'";
		$query = mysqli_query($con,$sql);
		$ul_start = "<ul id='menu_".$menu_no."' class='collapse'>";
				$list_dtl = "";
				$target = "target='_blank'";
				while($row = mysqli_fetch_array($query)):
						$list_dtl .="<li><a href='".$URL.$row['sub_menu_link']."' >".$row['sub_menu_name']."</a></li>";
				endwhile;
		$ul_end = "</ul>";
		$result = $ul_start.$list_dtl.$ul_end;
		return $result;
	}
	date_default_timezone_set('Asia/Dhaka');
	$currentTime = date('Y-m-d H:s:i');
	$user = trim($_POST['username']);
	$pass = trim($_POST['password']);
	$md5pass = md5($pass);
	 $sql = "SELECT * FROM `users` WHERE `USER_EMAIL` = '$user' AND `PASSWORD` = '$pass'";
	$result = mysqli_query($con,$sql);
	$data = mysqli_fetch_assoc($result);
	
	if(!empty($data)){
		$_SESSION['user'] = $data;
		$date= date('Y-m-d H:i:s');
		$_SESSION['login_time'] = $date;
	//	echo $_SESSION['user']['USER_NAME'];	
		header('Location: soft/index.php');
		exit;
	}else{
// 		header('Location: soft/index.php');
		$mgs="Your Username or Password is not valid!";
	}
}
?>