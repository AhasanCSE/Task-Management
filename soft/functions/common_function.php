<?php
		function ShowEmployees($con,$EMPLOYEES){
		 echo $sql = "SELECT `FULL_NAME` FROM `employees_setup` LEFT JOIN `gen_users` ON `gen_users`.`USER_NO`=`employees_setup`.`USER_NO` WHERE `EMPLOYEE_NO` IN ($EMPLOYEES)";
		$query = mysqli_query($con,$sql);
		$result="";
		while($row = mysqli_fetch_array($query)):
			$result.=",".$row['FULL_NAME'];
		endwhile;
		return substr($result, 1);
	}
?>