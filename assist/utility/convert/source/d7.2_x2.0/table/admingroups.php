<?php
/*
 *
 *  * Copyright 2012-2020 the original author or authors.
 *  *
 *  * Licensed under the Apache License, Version 2.0 (the "License");
 *  * you may not use this file except in compliance with the License.
 *  * You may obtain a copy of the License at
 *  *
 *  *      https://www.apache.org/licenses/LICENSE-2.0
 *  *
 *  * Unless required by applicable law or agreed to in writing, software
 *  * distributed under the License is distributed on an "AS IS" BASIS,
 *  * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  * See the License for the specific language governing permissions and
 *  * limitations under the License.
 *
 */

/**
 * DiscuzX Convert
 *
 * $Id: admingroups.php 15808 2010-08-27 02:34:26Z monkey $
 */

$curprg = basename(__FILE__);

$table_source = $db_source->tablepre.'admingroups';
$table_target = $db_target->tablepre.'common_admingroup';

$limit = 2000;
$nextid = 0;

$start = getgpc('start');
if(empty($start)) {
	$start = 0;
	$db_target->query("DELETE FROM $table_target WHERE admingid>'3'");
}

$query = $db_source->query("SELECT * FROM $table_source WHERE admingid>'$start' ORDER BY admingid LIMIT $limit");
while ($row = $db_source->fetch_array($query)) {

	$nextid = $row['admingid'];

	$row  = daddslashes($row, 1);

	$data = implode_field_value($row, ',', db_table_fields($db_target, $table_target));
	$gidexist = 0;
	if($row['admingid'] < 4) {
		$gidexist = $db_target->result_first("SELECT admingid FROM $table_target WHERE admingid='".$row['admingid']."'");
	}
	if(!empty($gidexist)) {
		$db_target->query("UPDATE $table_target SET $data WHERE admingid='".$row['admingid']."'");
	} else {
		$db_target->query("INSERT INTO $table_target SET $data");
	}
}

if($nextid) {
	showmessage("继续转换数据表 ".$table_source." admingid > $nextid", "index.php?a=$action&source=$source&prg=$curprg&start=$nextid");
} else {
	$db_target->query("UPDATE $table_target SET allowbanvisituser='1' WHERE admingid='1' OR admingid='2'");
}

?>