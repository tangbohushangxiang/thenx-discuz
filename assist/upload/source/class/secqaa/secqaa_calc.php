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
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: secqaa_calc.php 10395 2010-05-11 04:48:31Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class secqaa_calc {

	var $version = '1.0';
	var $name = 'calc_name';
	var $description = 'calc_desc';
	var $copyright = '<a href="http://www.comsenz.com" target="_blank">Comsenz Inc.</a>';
	var $customname = '';

	function make(&$question) {
		$a = rand(1, 90);
		$b = rand(1, 10);
		if(rand(0, 1)) {
			$question = $a.' + '.$b.' = ?';
			$answer = $a + $b;
		} else {
			$question = $a.' - '.$b.' = ?';
			$answer = $a - $b;
		}
		return $answer;
	}

}

?>