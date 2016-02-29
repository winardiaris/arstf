<?php
function view($filename){
	$view_dir = "static/inc/view/";
	$list_view = scandir($view_dir);
	$count_view = count($list_view);
	
	for($i=2;$i<$count_view;$i++){
		$fname = explode(".",$list_view[$i]);
		$fname = $fname[0];
		
		if($fname==$filename){
			include($view_dir.$list_view[$i]);
		}
	} 
}

?>
