<?php
function get_marital_status_list(){
	$group_list = select_tbl("marital_status");
	$json = json_encode($group_list);
	return $json;
}
function get_data_family_relation_list(){
	$group_list = select_tbl("data_family_relation");
	$json = json_encode($group_list);
	return $json;
}
function get_data_country_list(){
	$group_list = select_tbl("data_country");
	$json = json_encode($group_list);
	return $json;
}
function get_data_region_province(){
	$data_region = select_tbl("data_region",null," LENGTH(`region_id`)<=2 ORDER BY `region_name` ASC");
	$json = json_encode($data_region);
	return $json;
}
function get_data_region_city($region_id){
	$data_region = select_tbl("data_region",null," `region_id` LIKE '$region_id%' AND LENGTH(`region_id`)>2 AND LENGTH(`region_id`)<=5 ORDER BY `region_name` ASC");
	$json = json_encode($data_region);
	return $json;
}
function get_data_region_village($region_id){
	$data_region = select_tbl("data_region",null," `region_id` LIKE '$region_id%' AND LENGTH(`region_id`)>5 AND LENGTH(`region_id`)<=8 ORDER BY `region_name` ASC");
	$json = json_encode($data_region);
	return $json;
}
?>
