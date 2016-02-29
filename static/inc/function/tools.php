<?php
function UbahSimbol($str){
	$str = trim(htmlentities(htmlspecialchars($str)));
	$search = array ("'\''",
						"'%'",
						"'@'",
						"'_'",
						"'1=1'",
						"'/'",
						"'!'",
						"'<'",
						"'>'",
						"'\('",
						"'\)'",
						"';'",
						"'-'",
						"'_'",
						"'\['",
						"'\]'",
						"'\,'"
					);

	$replace = array ("xpsijix",
						"xprsnx",
						"xtkeongx",
						"xgwahx",
						"x1smdgan1x",
						"xgmringx",
						"xpentungx",
						"xkkirix",
						"xkkananx",
						"xkkurix",
						"xkkurnanx",
						"xkommax",
						"xstrix",
						"xstripbwhx",
						"xsiku1x",
						"xsiku2x",
						"xkomax"
					);

	$str = preg_replace($search,$replace,$str);
	return $str;
	
}
function Balikins($str){
	$search = array ("'xpsijix'",
						"'xprsnx'",
						"'xtkeongx'",
						"'xgwahx'",
						"'x1smdgan1x'",
						"'xgmringx'",
						"'xpentungx'",
						"'xkkirix'",
						"'xkkananx'",
						"'xkkurix'",
						"'xkkurnanx'",
						"'xkommax'",
						"'xstrix'",
						"'xstripbwhx'",
						"'&quot;'",
						"'xsiku1x'",
						"'xsiku2x'",
						"'xkomax'");

	$replace = array ("'",
						"%",
						"@",
						"_",
						"1=1",
						"/",
						"!",
						"<",
						">",
						"(",
						")",
						";",
						"-",
						"_",
						"'",
						"[",
						"]",
						","
						);

	$str = preg_replace($search,$replace,$str);

	return $str;
 }
function Balikin($str){
	$str=Balikins($str);
	$str = htmlspecialchars_decode(htmlspecialchars_decode(html_entity_decode($str, ENT_NOQUOTES, 'UTF-8')));
	
	return $str;
}
 
function UbahXXX($str){
	$str = trim($str);
	$search = array ("'\''",
						"'%'",
						"'@'",
						"'_'",
						"'1=1'",
						"'/'",
						"'!'",
						"'<'",
						"'>'",
						"'\('",
						"'\)'",
						"'\{'",
						"'\}'",
						"'\*'",
						"'&'",
						"'\^'",
						"'\"'",
						"';'",
						"'-'",
						"'_'",
						"'\['",
						"'\]'",
						"'\.'",
						"':'",
						"'  '",
						"'\\$'",
						"'#'",
						"'~'",
						"'`'",
						"'\+'",
						"'='",
						"'\?'",
						"'\|'",
						"'\\\'",
						"'/'",
						"'\,'"
					);

	$replace = array (" ");

	$str = preg_replace($search,$replace,$str);
	return $str;
	
}
 
function UbahBulan1($str){
	$str = trim(htmlentities(htmlspecialchars($str)));
	$search = array ("'Januari'","'Februari'","'Maret'","'April'","'Mei'","'Juni'","'Juli'","'Agustus'","'September'","'Oktober'","'Nopember'","'Desember'");
	$replace = array ("01","02","03","04","05","06","07","08","09","10","11","12");
	$str = preg_replace($search,$replace,$str);
	return $str;
}
function UbahBulan2($str){
	$str = trim(htmlentities(htmlspecialchars($str)));
	$search = array ("'January'","'February'","'March'","'April'","'May'","'June'","'July'","'August'","'September'","'October'","'November'","'December'");
	$replace = array ("01","02","03","04","05","06","07","08","09","10","11","12");
	$str = preg_replace($search,$replace,$str);
	return $str;
}
function UbahBulan3($str){
	$str = trim(htmlentities(htmlspecialchars($str)));
	$search = array ("'Jan'","'Feb'","'Mar'","'Apr'","'May'","'Jun'","'Jul'","'Agu'","'Sep'","'Okt'","'Nov'","'Des'");
	$replace = array ("01","02","03","04","05","06","07","08","09","10","11","12");
	$str = preg_replace($search,$replace,$str);
	return $str;
}
function UbahBulan($str){
	$str=UbahBulan1($str);
	$str=UbahBulan2($str);
	$str=UbahBulan3($str);
	return $str;
	
}

function ifset($str){
	if(isset($_REQUEST[$str])){
		return $_REQUEST[$str];
	}
	else{
		return null;
	}
}
function real_url($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Must be set to true so that PHP follows any "Location:" header
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$a = curl_exec($ch); // $a will contain all headers

	$url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); // This is what you need, it will return you the last effective URL
	return $url; // Voila
}
//menampilkan sebuah data dari basisdata sesuai dengan data dasar
//contohnya ingin mengetahui data user_real_name pada table user dengan user_id
function get_data($from_data,$value_data,$select_field,$from_table){
	$qry = "SELECT `$select_field` as `getdata` FROM `$from_table` WHERE `$from_data`='$value_data'";
	$data = select_tbl_qry($qry);
	$json = json_encode($data);
	return Balikin($json);
}
function status($i){
	$array = array("status"=>$i);
	$data = array("data"=>$array);
	return json_encode($data);
}
function generate_controller(){
	$DB=DB();
	$q = mysqli_query($DB,"SHOW TABLES");
	 $fieldList = array();
  while($result = mysqli_fetch_array($q)){
		$qq = mysqli_query($DB,"select * from $result[0]");
		while ($property = mysqli_fetch_field($qq)) {
		    array_push($fieldList,$property->name);
		}
  }
  $unique = array_unique($fieldList);
  asort($unique);
  
  foreach($unique as $data){
		$pos = strpos($data,"password");
		if($pos==true){
			echo "\$$data = md5(ifset('$data'));<br>";
			
		}else{
			echo "\$$data = ifset('$data');<br>";	
		}
	}
 }
 
function get_ip(){
	$ip=0;
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		    $ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		    $ip = $_SERVER['REMOTE_ADDR'];
		}
		
	return $ip;
}	
function current_url(){
$s = &$_SERVER;
$ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
$sp = strtolower($s['SERVER_PROTOCOL']);
$protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
$port = $s['SERVER_PORT'];
$port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
$host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
$host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
$uri = $protocol . '://' . $host . $s['REQUEST_URI'];
$segments = explode('?', $uri, 2);
$url = $segments[0];
return $url;
}
//	untuk mengembalikan data yang terdapat pada request/get/post berupa array
function request(){
	$key = array();
	$value = array();
	foreach ($_REQUEST as $key_ => $value_) {
    array_push($key,$key_);
    array_push($value,$value_);
	}
	$result = array_combine($key,$value);
	unset($result["op"]);
	return $result;
}
?>
