<?php
function save_new_user($group_id,$user_name,$user_real_name,$user_password,$user_info){
	$available_user = count_on_tbl("user","`user_name`='$user_name'");
	if($available_user >0){
		$output = status("duplicate");
	}
	else{
		$output = insert_to_tbl("user","`group_id`,`user_name`,`user_real_name`,`user_password`,`user_info`","'$group_id','$user_name','$user_real_name','$user_password','$user_info'");
	}
	return $output;
}
//memvalidasi pengguna dengan user_name dan user_password
function user_login($user_name,$user_password){
	if(isset($user_name) and isset($user_password)){
		$available_user = count_on_tbl("user","`user_name`='$user_name' and `user_password`='$user_password'");
		if($available_user>0){
			
			if(is_login($user_name)==false){
				set_user_last_login($user_name);
				return status("success");
			}
			else{
				return status("user_is_logged");
			}
		}
		else{
			return status("no_user");
		}
		return $available_user;
	}
	else{
		return status("error");
	}
}
function user_logout($secret_key){
	$output = update_tbl("user","`logged`='0',`secret_key`=''" ,"`secret_key`='$secret_key'");
	return $output;
}


function is_login($user_name){
	$data = count_on_tbl("user","`user_name`='$user_name' and `logged`='1'");
	if($data==1){
		return true;
	}
	else{
		return false;
	}
}

function update_user($user_id,$user_name,$user_password,$user_real_name,$user_info,$secret_key){
	$output = update_tbl("user","`user_password`='$user_password',`user_real_name`='$user_real_name',`user_name`='$user_name', `user_info`='$user_info' " ,"`user_id`='$user_id' and `secret_key`='$secret_key'");
	return $output;
}
function set_user_last_login($user_name){
	$secret_key = md5(__NOW__.$user_name);
	$ip_address = get_ip();
	
	update_tbl("user","`last_login`='".__NOW__."', `secret_key`='$secret_key', `last_ip_login`='$ip_address', `logged`='1'","`user_name`='$user_name'");	
}
//~ harus hanya bisa dipakai menggunakan secret key
function view_user($secret_key){
	$data = select_tbl("user","`user_id`,`group_id`,`user_name`,`user_real_name`,`user_info`,`last_login`,`last_ip_login`,`logged`,`c_at`,`u_at`","`secret_key`='$secret_key'");
	$json = json_encode($data); 
		return $json;
}
function secret_key_check($secret_key){
	$available = count_on_tbl("user","`secret_key`='$secret_key'");
	if($available >0){
		$output = status("success");
	}
	else{
		$output = status("error");
	}
	return $output;
}
function get_user_secret_key($user_name,$user_password){
		$secret_key = select_tbl("user","secret_key","`user_name`='$user_name' and `user_password`='$user_password'",1);
		$json = json_encode($secret_key);
		return $json;
}
function get_user_list(){
	$user_list = select_tbl("user","`user_id`,`group_id`,`user_name`,`user_real_name`,`last_login`,`last_ip_login`");
	$json = json_encode($user_list);
	return $json;
}
function get_user_group_list(){
	$group_list = select_tbl("user_group");
	$json = json_encode($group_list);
	return $json;
}
?>
