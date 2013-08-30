<?php

function add_name($name) {
	$name = mysql_real_escape_string($name);
	
	$query = "INSERT INTO `names` SET
				`name` = '{$name}'";
	
	mysql_query($query);
}

function get_names($start = 0, $per_page = null) {
	$names = array();
	$query = "SELECT `name` FROM `names` 
				LIMIT {$start}, {$per_page}";
	$query = mysql_query($query) or die(mysql_error());
	
	while ($row = mysql_fetch_assoc($query)) {
		$names[] = $row;
	}

	return $names;
}

function count_names() {
	$query = "SELECT COUNT(`id`) FROM `names`";
	$count = mysql_query($query);

	$result = mysql_result($count, 0);

	return $result;
}