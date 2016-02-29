<?php
//=================================== ==========================================
	
	
	
	define("__BASE_URL__"		,$BASE_URL);
	define("__DB_SERVER__"	,$DB_SERVER);
	define("__DB_NAME__"		,$DB_NAME);
	define("__DB_USER__"		,$DB_USER);
	define("__DB_PASSWD__"	,$DB_PASSWD);
	define("__NO0__"				,0);
	define("__NO1__"				,1);
	define("__NOW__"				,date("Y-m-d H:i:s"));
	define("__TODAY__"			,date("Y-m-d"));
	define("__TIMEZONE__"		,$TIME_ZONE);
	
	//connection db
	function DB(){
		$DB = mysqli_connect(__DB_SERVER__,__DB_USER__,__DB_PASSWD__,__DB_NAME__);

	// Check connection
		if (mysqli_connect_errno()){ 
			return "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		else{
			return $DB;
		}
	}
	
	
	
	date_default_timezone_set(__TIMEZONE__);
	session_start();
	ob_start();
?>
