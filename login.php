<?php
include "conn.php";

	session_start();
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;

	
	//Sanitize the POST values

	$login = ($_POST['username']);
	$password = ($_POST['password']);
	
	
	if(empty($login) || empty($password)){
        $message = 'All field are required';//echo $message;
	}
	 
   else{
		//Create query
		$qry="SELECT * FROM user WHERE username='$login' AND password='$password'";
		$result=($qry);
        $qry = $db->prepare("SELECT * From users WHERE username =? AND password=?");

		 $qry-> execute(array($login,$password));


			if($qry ->rowCount() >0){         
			
				$position=$qry->fetchAll();
					foreach ($position as $account){
						$account_type=$account["account"] AND $user_full_name=$account["full_name"] AND $department=$account['department_name'];
					}
				
					//assign global seccion variables
					session_regenerate_id();
					$_SESSION['SESS_USERNAME'] = $login;
					$_SESSION['SESS_PASSWORD'] = $password;
					$_SESSION['SESS_FULL_NAME'] = $user_full_name;
					$_SESSION['SESS_POSITION'] = $account_type;

					if($account_type =="admin"){
						echo 1;
					}
					
					elseif($account_type =="front_desk"){
						echo 2;
					}
					session_write_close();
				
			}
			else{
				echo 0;
			}
				
					//	$qry->execute(array($login,$password));				
                  	//  $_SESSION['username'] = $login;
                    //  echo $login."<br>";
                   	//  echo $password;
                    //  echo 1;				
			
		
     }
?>