<?php
if(isset($_REQUEST['op'])){
//-----------------------------------------
$op = ifset('op');
$limit = ifset('limit');

	if($op=="test"){
		view("test");
	}
}
else{
	view("help");
}



?>
