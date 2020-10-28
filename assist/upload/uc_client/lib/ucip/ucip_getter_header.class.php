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

/*
	[UCenter] (C)2001-2099 Comsenz Inc.
	This is NOT a freeware, use is subject to license terms

	$Id: ucip_getter_header.class.php 809 2019-12-19 12:00:00Z community $
*/

class ucip_getter_header {

	public static function get($s) {
		if (empty($s['header'])) {
			return $_SERVER['REMOTE_ADDR'];
		}
		$ip = $_SERVER['REMOTE_ADDR'];
		if ($s['header'] != 'HTTP_X_FORWARDED_FOR') {
			$ip = ucip::validate_ip($_SERVER[$s['header']]) ? $_SERVER[$s['header']] : $ip;
		} else {
			if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ",") > 0) {
				$exp = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);
				$ip = ucip::validate_ip(trim($exp[0])) ? $exp[0] : $ip;
			} else {
				$ip = ucip::validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $ip;
			}
		}
		return $ip;
	}

}