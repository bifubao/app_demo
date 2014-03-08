<?php
/**
 * common include file
*
* @author PanZhibiao
* @copyright bifubao.com
* @since 2014-03
*/
if(!defined('IN_BIFUBAO')) {
	exit('Access Denied');
}

// system root
ini_set('include_path', dirname(__FILE__) . DIRECTORY_SEPARATOR);
date_default_timezone_set('Asia/Shanghai');
require_once 'config.php';
require_once 'function_bifubao.php';