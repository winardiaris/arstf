<?php
//  untuk memilih tabel dengan keluaran json
function select_tbl($table,$field_name=null,$where=null,$limit=null,$debug=null){
	$DB=DB();
	if(isset($table)){
		$sql = "SELECT";
		
		if(isset($field_name)){
			$sql .=" ".$field_name." ";
		}
		else{
			$sql .=" * ";
		}
		
		$sql .="FROM `$table` ";
		
		if(isset($where)){
			$sql .=" WHERE $where ";
		}
		
		if(isset($limit)){
			$sql .=" LIMIT $limit ";
		}
		
		if(empty($debug)){
			$q = mysqli_query($DB,$sql);
			$count = mysqli_num_fields($q);
			$datas = array();
						
			while($d=mysqli_fetch_array($q)){
				$fname = array();
				$dataa = array();
				for($i=0;$i<$count;$i++){
					array_push($dataa,balikin($d[$i]));
				}
				$finfo = mysqli_fetch_fields($q);
				foreach ($finfo as $val) {
					array_push($fname,$val->name);
				}
				$combine = array_combine($fname,$dataa);
				array_push($datas,$combine);
			}
			$data = array("data"=>$datas);
			return $data;
		}	
		else{
			return $sql.PHP_EOL;
		}
	}
	else{
		return status(0);
	}
}
//  untuk memilih tabel berdasarkan kueri mysql dengan keluaran json
function select_tbl_qry($query,$debug=null){
	$DB=DB();
	if(isset($query)){
		$sql = $query;
		if(empty($debug)){
			$q = mysqli_query($DB,$sql);
			$count = mysqli_num_fields($q);
						
			$datas = array();
			while($d=mysqli_fetch_array($q)){
				$fname = array();
				$dataa = array();
				for($i=0;$i<$count;$i++){
					array_push($dataa,balikin($d[$i]));
				}
				$finfo = mysqli_fetch_fields($q);
				foreach ($finfo as $val) {
					array_push($fname,$val->name);
				}
				$combine = array_combine($fname,$dataa);
				array_push($datas,$combine);
			}
			$data = array("data"=>$datas);
			return $data;
		}	
		else{
			return $sql.PHP_EOL;
		}
	}
	else{
		return status("error");
	}
}
//  untuk memasukan data ke tabel dengan keluaran json
function insert_to_tbl($table,$field_name,$value_data,$debug=null){
	$DB=DB();
	if(isset($table)){
		if(isset($field_name) and isset($value_data)){
			$sql = "INSERT INTO `$table`";
			$sql .=" ($field_name,`c_at`)";
			$sql .=" VALUES($value_data,'".__NOW__."')";
			
			if(isset($where)){
				$sql .=" WHERE $where ";
			}
			
			if(empty($debug)){
				$q = mysqli_query($DB,$sql);
				if($q){
					return true;
				}
			}	
			else{
				return $sql.PHP_EOL;
			}
			
		}
		else{
			return false;
		}
	}
	else{
		return false;
	}
}
//  untuk merubah data di tabel dengan keluaran json
function update_tbl($table,$set_data,$where,$debug=null){
	$DB=DB();
	if(isset($table)){
		if(isset($set_data)){
			$sql = "UPDATE `$table` SET $set_data ";
			$sql .= ",`u_at`='".__NOW__."' ";
			if(isset($where)){
				$sql .=" WHERE $where ";
			}
			
			if(empty($debug)){
				$q = mysqli_query($DB,$sql);
				if($q){
					return status("success");
				}
			}	
			else{
				return $sql.PHP_EOL;
			}
		}
		else{
			return status("error");
		}
	}
	else{
		return status("error");
	}
}
// 	untuk eksekusi kueri mysql
function exec_qry($query,$debug=null){
	$DB=DB();
	if(isset($query)){
		if(empty($debug)){
			$q = mysqli_query($DB,$query);
			if($q){
				return true;
			}
		}
		else{
			return $query;
		}
	}
	else{
		return false;
	}
}
//	untuk mengahapus data di table dengan keluaran json
function delete_data_tbl($table,$where,$debug=null){
	$DB=DB();
	if(isset($table)){
		$query = "DELETE FROM `$table` WHERE $where";
		if(empty($debug)){
			$q = mysqli_query($DB,$query);
			if($q){
				return true;
			}
		}
		else{
			return $query;
		}
	}
	else{
		return false;
	}
}
//	untuk menghapus tabel
function delete_tbl($table){
	$query = "DROP TABLE `$table`";
	$q = exec_qry($query);
	return $q;
}
// untuk menghitung jumlah data pada tabel
function count_on_tbl($table,$where){
	if(isset($table) and isset($where)){
		$count = array_sum(array_map("count",select_tbl($table,null,$where)));
		return $count;
	}
	else{
		return status("error");
	}
}
?>
