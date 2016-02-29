<?php
include ("static/inc/conf.php");
include ("static/inc/con.php");

$function_dir = "static/inc/function/";
$list_function = scandir($function_dir);
$count_function = count($list_function);

for($i=2;$i<$count_function;$i++){
	$ext = end(explode(".",$list_function[$i]));
	if($ext=="php" or $ext =="PHP"){
		include($function_dir.$list_function[$i]);
	}
} 
include ("static/inc/view.php");
include ("static/inc/controller.php");


?>
