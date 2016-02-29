<?php
function create_form($name,$action,$method,$value,$id=null,$class=null){
	$form = "<form name='$name' action='$action' method='$method' id='$id' class='$class'>$value</form>";
	return $form;
}
function create_label($name,$id,$class,$value){
	$label = "<label name='$name' id='$id' class='$class'>$value</label>";
	return $label;
}
function create_input($name,$id,$class,$value,$type){
	if(empty($class)){
		$class = "form-control";
	}
	
	$input = "<input name='$name' id='$id' class='$class' value='$value' type='$type'>";
	return $input;
}

?>
