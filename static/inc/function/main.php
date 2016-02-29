<?php
//untuk menambahkan data keuangan
function add_data($user_id,$date,$token,$type,$value,$desc){
	if(isset($user_id)){
		$token 				= UbahSimbol($token);
		$desc 				= UbahSimbol($desc);
		$check_token 	= count_on_tbl("data","`token`='$token' and `desc`='$desc'");
		if($check_token>0){
			$output 		= status("duplicate");
		}
		else{
			$check_user = count_on_tbl("user","`user_id`='$user_id'");
			if($check_user>0){
				$output 	= insert_to_tbl("data","`user_id`,`date`,`token`,`type`,`value`,`desc`","'$user_id','$date','$token','$type','$value','$desc'");
			}
		}
		return $output;
	}
	else{
		return status("error");
	}
	
}

//menampilkan data dari database dengan output json
function list_data($user_id,$did=null,$date=null,$from=null,$to=null,$type=null,$status=null,$limit=null,$search=null){
	if(isset($user_id)){
		if(!empty($did)){
			$qry	= "select * from `data` where `user_id`='$user_id' and `did`='$did'";
		}
		else{
			if(!empty($date) and empty($from) and empty($to)){
				$date = " and `date`='$date' ";
			}
			elseif(!empty($from) and !empty($to) and empty($date)){
				$date = " and (`date` BETWEEN '$from' and '$to') ";
			}
			
			if(isset($type)){
				$type = " and `type`='$type' ";
			}
			
			if(!empty($search)){
				$search = " and `desc` like '%$search%' or `token` like '%$search%' ";
			}
			
			if(isset($status)){
				$status = " and `status`='$status' "; 
			}
			else{
				$status = " and `status`='1' ";
			}
			
			if(isset($limit)){
				$limit = " limit $limit ";
			}
			$qry	= "select * from `data` where `user_id`='$user_id' $date $type $status $search $limit";
		}
		$data = select_tbl_qry($qry);
		$json = json_encode($data, JSON_PRETTY_PRINT); 
		return $json;
	}
	else{
		return "[]";
	}
}
function saldodata($user_id,$date=null,$from=null,$to=null,$status=null,$limit=null,$search=null){
	$jin = total_value_data($user_id,$date,$from,$to,'in',$status,$limit,$search);
	$jout = total_value_data($user_id,$date,$from,$to,'out',$status,$limit,$search);
	
	$in_ = json_decode($jin);
	$out_ = json_decode($jout);
	
	$in=0;
	$out=0;
	foreach($in_->data as $data){
		$in += $data->total;
	}
	foreach($out_->data as $data){
		$out += $data->total;
	}
	
	$saldo=$in-$out;
	$output = array("user_id"=>$user_id,"saldo"=>$saldo);
	return json_encode($output);
}

//merubah status data menjadi 0 yang artinya data sudah dihapus
function delete_data($did,$desc){
	if(isset($did) and isset($desc)){	
		$desc_a = select_tbl("data","`desc`","`did`='$did'");
		$desc_a = $desc_a[0]['desc'];
		$desc_a = explode("|",$desc_a);
		$desc_a	= $desc_a[0];
		
		$output = update_tbl("data","`status`='0' , `desc`='".$desc_a." | ".UbahSimbol($desc)."'","`did`='$did'");
		return $output;
	}
	else{
		return status("error");
	}
	
}

function update_data($user_id,$did,$date,$token,$type,$value,$desc){
	$tbl_name="data";
	$set_data = "`date`='$date',`token`='$token',`type`='$type',`value`='$value',`desc`='$desc'";
	$where = "`did`='$did' and `user_id`='$user_id'";
	
	return update_tbl($tbl_name,$set_data,$where);
}

//menampilkan jumlah value(uang) baik untuk in/out
function total_value_data($user_id,$date=null,$from=null,$to=null,$type=null,$status=null,$limit=null,$search=null){
	if(isset($user_id)){
		
		if(isset($date) and empty($from) and empty($to)){
			$date = " and `date`='$date' ";
		}
		elseif(isset($from) and isset($to) and empty($date)){
			$date = " and (`date` BETWEEN '$from' and '$to') ";
		}
		
		if(isset($type)){
			$type = " and `type`='$type' ";
		}
		
		if(isset($search)){
			$search = " and `desc` like '%$search%' or `token` like '%$search%' ";
		}
		
		if(isset($status)){
			if($status!="all"){
				$status = " and `status`='$status' "; 
			}
			else{
				$status = "";
			}
		}
		else{
			$status = " and `status`='1' ";
		}
		
		if(isset($limit)){
			$limit = " limit $limit ";
		}
		
		$q = "select sum(`value`) as `total` from `data` where `user_id`='$user_id' $date $type $status $search $limit";
		$data = select_tbl_qry($q);
		$json = json_encode($data);
		
		return $json;		
	}
	else{
		return status("error");
	}
}


?>
