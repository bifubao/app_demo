<?php
/**
 * pay redirect example
*
* @author PanZhibiao
* @copyright bifubao.com
* @since 2014-03
*/
define('IN_BIFUBAO', 1);
require_once dirname(__FILE__).'/common.php';

//
// 请求参数，请自行获取，示例直接赋值变量，仅供参考
//

// varchar(64)
$external_order_id = time();  // 本系统的订单号，这里使用时间戳代替，订单ID必须唯一
// varchar(64)
$external_info = "";          // 其他补充信息

// 订单价格
$price_btc = 0;       // 单位：btc。比特币定价，若使用人民币定价，请置为零。范围：[0.0001, 20000000]
$price_cny = 100.99;  // 单位：元。人民币定价，若使用比特币定价，请置为零。范围：[1, 1000000000]

// 显示内容
$display_name = "这是我的第一个测试订单";
$display_desc = "这是我的第一个测试订单，希望能给我赚很多比特币。内容请不要带有URL字符，会被过滤掉。";

// 订单收到付款后的回调通知URL地址，必须是外网能够直接访问。varchar(128)
// 若回调URL为空，则币付宝服务端不会发出回调通知
$external_callback_url = "http://10.0.1.254/app_demo/callback.php";
// 订单成功重定向地址，若携带次参数，订单成功后会重定向到此URL。varchar(128)
$external_redirect_url = "https://www.bifubao.com";


// 请求参数
$params = array(
	'external_order_id' => $external_order_id,
	'external_info'     => $external_info,
	'price_btc'         => $price_btc,
	'price_cny'         => $price_cny,
	'display_name'      => $display_name,
	'display_desc'      => $display_desc,
	'external_callback_url' => $external_callback_url,
	'external_redirect_url' => $external_redirect_url,
);

// 全局参数
$sign_algo = "sha1"; // enom("sha1", "sha512");
$params['_sign_algo_']   = $sign_algo;  // default is 'sha512'
$params['_time_']        = time();
$params['_app_hash_id_'] = $_CFG['app_hash_id'];
$params['_counter_']     = bifubao_get_app_counter($_CFG['app_hash_id']);

// sign
$sign_data = bifubao_make_sign_data($params);
$pkeyid    = openssl_pkey_get_private($_CFG['app_rsa_private_key']);
if (openssl_sign($sign_data, $signature, $pkeyid, $sign_algo) == false) {
	die("openssl_sign failure");
}
// put signature
$params['_signature_'] = base64_encode($signature);

// http post
$api_return_json = bifubao_curl_get_contents($_CFG['api_host'].'/order/createexternal/', 
										$params, 30/*timeout seconds*/);
$api_result = json_decode($api_return_json, 1);
if (!isset($api_result['error_no']) || $api_result['error_no'] > 0) {
	die("api call failure, error_no: {$api_result['error_no']}, error_msg: {$api_result['error_msg']}");
}

// redirect to bifubao payment page
$pay_page_url = 'https://www.bifubao.com/pay?order_hash_id='.$api_result['result']['order_hash_id'];
header('Location: '.$pay_page_url);
exit;




// var_dump($api_result);exit;
/*
array(4) {
  ["error_no"]=>
  int(0)
  ["error_msg"]=>
  string(0) ""
  ["result"]=>
  array(28) {
    ["order_id"]=>
    string(3) "161"
    ["order_hash_id"]=>
    string(64) "7383ec9ad99e7f1af2ab7d65ac61841f64d2b719b135756008fd4e28036eec5b"
    ["order_type"]=>
    string(3) "200"
    ["handle_status"]=>
    string(3) "100"
    ["user_id"]=>
    string(2) "17"
    ["external_order_id"]=>
    string(10) "1394274397"
    ["external_callback_url"]=>
    string(39) "http://10.0.1.254/app_demo/callback.php"
    ["external_redirect_url"]=>
    NULL
    ["external_info"]=>
    string(0) ""
    ["seller_hint"]=>
    string(0) ""
    ["product_id"]=>
    string(2) "-1"
    ["display_name"]=>
    string(33) "这是我的第一个测试订单"
    ["display_desc"]=>
    string(123) "这是我的第一个测试订单，希望能给我赚很多比特币。内容请不要带有URL字符，会被过滤掉。"
    ["price_btc"]=>
    string(1) "0"
    ["price_cny"]=>
    string(5) "10099"
    ["pay_user_id"]=>
    string(2) "-1"
    ["pay_btc"]=>
    string(7) "2711140"
    ["ratio_btc2cny"]=>
    string(6) "372500"
    ["onchain_receive_btc_address"]=>
    string(34) "1CBou4b71aWM6TexP9VnbL3krVeNU7tVPf"
    ["onchain_leave_message"]=>
    string(0) ""
    ["onchain_notify_phone"]=>
    string(0) ""
    ["onchain_notify_email"]=>
    string(0) ""
    ["onchain_btc_deposit_id"]=>
    string(2) "-1"
    ["offchain_btc_transfer_request_id"]=>
    string(2) "-1"
    ["offchain_leave_message"]=>
    string(0) ""
    ["order_receipt_id"]=>
    string(12) "009531813360"
    ["creation_time"]=>
    string(19) "2014-03-08 10:26:38"
    ["last_modify_time"]=>
    string(19) "2014-03-08 10:26:38"
  }
  ["exec_time"]=>
  string(6) "0.6832"
}
 */

