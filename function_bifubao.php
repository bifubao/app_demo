<?php
/**
 * common functions
*
* @author PanZhibiao
* @copyright bifubao.com
* @since 2014-03
*/
if(!defined('IN_BIFUBAO')) {
	exit('Access Denied');
}

// generate sign data string
function bifubao_make_sign_data($arr) {
	unset($arr['_signature_']);
	ksort($arr);
	$sign_str = '';
	if (!empty($arr)) {
		foreach ($arr as $_k => $_v) {
			$sign_str .= $_k . $_v;
		}
	}
	return $sign_str;
}


// get db handler
function bifubao_get_db($db_name) {
	global $_CFG;
	static $db = null;
	if (!empty($db)) {
		return $db;
	}
	$opt = &$_CFG[$db_name];  // alias
	try {
		$db = new PDO($opt['dsn'], $opt['username'], $opt['password'], $opt['options']);
		unset($_CFG[$db_name]);
	} catch (PDOException $e) {
		die('Connection DB failed: ' . $e->getMessage());
	}
	return $db;
}


// save callback to queue
function bifubao_save_callback_to_db($request_id, $content_type, $content) {
	$db = bifubao_get_db(DB_MAIN);
	
	$sql = "INSERT INTO `bifubao_queue_callback`(`handle_status`, `request_id`, 
				`content_type`, `content_json`, `creation_time`, `last_modify_time`) 
			VALUES (:handle_status, :request_id, 
				:content_type, :content_json, :creation_time, :last_modify_time)";
	$arr = array(
			':handle_status' => 100,  // 100: init 
			':request_id'    => $request_id,
			':content_type'  => $content_type, 
			':content_json'  => $content, 
			':creation_time'    => date('Y-m-d H:i:s'), 
			':last_modify_time' => date('Y-m-d H:i:s'),
	);
	$sth = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	try {
		if ($sth->execute($arr) == false) {
			$errInfo = $sth->errorInfo();
			die("pdo execute failure: {$errInfo[0]}, {$errInfo[1]}, {$errInfo[2]}");
		}
	} catch (PDOException $e) {
		$errInfo = $sth->errorInfo();
		die("pdo execute failure: {$errInfo[0]}, {$errInfo[1]}, {$errInfo[2]}");
	}
	return $db->lastInsertId();
}



function bifubao_get_app_counter($app_hash_id) {
	$db = bifubao_get_db(DB_MAIN);
	
	// fetch item
	$sql = "SELECT `counter` FROM `bifubao_app_info` WHERE app_hash_id = :app_hash_id";
	$arr = array(':app_hash_id' => $app_hash_id);
	$sth = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	if ($sth->execute($arr) == false) {
		$errInfo = $sth->errorInfo();
		die("pdo execute error: {$errInfo[0]}, {$errInfo[1]}, {$errInfo[2]}");
	}
	$item = $sth->fetch(PDO::FETCH_ASSOC);
	
	if (!empty($item)) {
		// increase counter
		$sql = "UPDATE `bifubao_app_info` SET counter = counter + 2
				WHERE app_hash_id = :app_hash_id ";
		$arr = array(':app_hash_id' => $app_hash_id);
		$sth = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		try {
			if ($sth->execute($arr) == false) {
				$errInfo = $sth->errorInfo();
				die("pdo execute failure: {$errInfo[0]}, {$errInfo[1]}, {$errInfo[2]}");
			}
		} catch (PDOException $e) {
			$errInfo = $sth->errorInfo();
			die("pdo execute failure: {$errInfo[0]}, {$errInfo[1]}, {$errInfo[2]}");
		}
		return $item['counter'];
	}
	
	// if empty, we insert one
	$sql = "INSERT INTO `bifubao_app_info`(`app_hash_id`, `counter`) 
			VALUES (:app_hash_id, :counter)";
	$arr = array(':app_hash_id' => $app_hash_id, ':counter' => 2/*default 1, increase 1*/);
	$sth = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	try {
		if ($sth->execute($arr) == false) {
			$errInfo = $sth->errorInfo();
			die("pdo execute failure: {$errInfo[0]}, {$errInfo[1]}, {$errInfo[2]}");
		}
	} catch (PDOException $e) {
		$errInfo = $sth->errorInfo();
		die("pdo execute failure: {$errInfo[0]}, {$errInfo[1]}, {$errInfo[2]}");
	}
	return 1;
}


function bifubao_curl_get_contents($url, $post_params=null, $timeout_sec=5) {
	global $_G;
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	// Chrome 24.0.1284.0
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.13 (KHTML, like Gecko) Chrome/24.0.1284.0 Safari/537.13");

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_TIMEOUT, $timeout_sec);

	if (substr($url, 0, 5) == "https") {
		// not verify
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	}
	
	if (!empty($post_params)) {
		curl_setopt($ch, CURLOPT_POST, 1);
		if (is_array($post_params)) {
			$post_params = http_build_query($post_params);
		}
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_params);
	}

	$r = curl_exec($ch);
	$curl_errno = curl_errno($ch);
	$curl_error = curl_error($ch);
	curl_close($ch);

	if ($curl_errno > 0) {
		die("cURL Error ($curl_errno): $curl_error, url: {$url}");
	}
	return $r;
}
