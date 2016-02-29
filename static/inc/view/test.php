<html>
<head>
	<title>Bantuan - </title>
	<link href='static/css/bootstrap.css' rel='stylesheet'>
</head>
<body>
<div class='col-lg-10'>
<h1></h1>
<?php
	$input = create_input("input1","input1",null,null,"text");
	$input .= create_input("input2","input2",null,"combobox1","text");
	$input .="<div class='input-group'>";
	$input .= create_input("combobox1","combobox1",null,"combobox1","checkbox");
	$input .= create_label(null,null,null,"combobox");
	$input .="</div>";
	
	echo create_form("form1","","POST",$input);

?>

</div>
</body>
</html>
