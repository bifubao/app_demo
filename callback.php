<?php
/**
 * callback example
 * 
 * @author PanZhibiao
 * @copyright bifubao.com
 * @since 2014-03
 */
define('IN_BIFUBAO', 1);
require_once dirname(__FILE__).'/common.php';

// var_dump($_POST);exit;
if (empty($_POST['_request_check_']) || empty($_POST['_signature_']) || 
    empty($_POST['_request_id_'])) {
  echo "invalid request_check or signature or request_id";exit;
}

// rsa public key
//$bifubao_pubkey = "-----BEGIN PUBLIC KEY-----
//MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqUSnx8dqJ0UC0jvFTEdL
//gde7BSmKi8GzDnxvu/AMQw7TG3pRKAAKQJRYUSqpgMyOwUSrv3yfu3gBJwufjWJz
//Kgtm8D9TOoYnZMJm4x5Lv9/EpYEg0zrAsmU/6rZJ9mYRaNPrt811Thju0/19fa77
//XnsQ78UmvV4zCePkKAArO70SsU/hf1SinDX//t0a3/UOk0DhKoJZpzjb5mb+dcXM
//GOJKpAONDGDK2UE1W67HmIG72b/R/G8CAFYbw4MGCjb0/Ee6obcAGK3Cj1JcuHjH
//NzymBH0NuDvyz7fJuTg9Eplnh1blNeCJoG/vv7VLZNKetTMTx+H2X534RUQ4XheX
//4QIDAQAB
//-----END PUBLIC KEY-----";
$bifubao_pubkey = "-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAvfE1kBFrPjBY8qMNSBsK
kaxFr4L10rJf6TUtpctmotuvZJtX4JDVFEBNRAQD+VNr2av+QZ72EyJu5Cq39AUP
LGOV8XPOigiVvj52dpRJi7zfKYSzlZIJnAHHa9im7PuiDTbgJpAPzlBKrUr1l5T7
E/RtYrkbLyAL3mJhsBnP2WW4Yta94mK6bY2SWA7FTU4BSQaiH8PGixpKE75QjTjW
vii4QHRIORJLHS6VS6RPMqrtHoP3qtJszRLfV/gBju5lIGJyBKVpzxLcItcxoz8F
mYmOQEyUb7Lyp8+FLOInY3xXDPDz7leYVemqgEmWk+1Aiz+TOsTQU4NxzsFNAJNa
SwIDAQAB
-----END PUBLIC KEY-----";
$pubkey_id = openssl_pkey_get_public($bifubao_pubkey);
// get signature
$signature = base64_decode($_POST['_signature_']);
// verify
if (openssl_verify(bifubao_make_sign_data($_POST), $signature, 
                   $pubkey_id, OPENSSL_ALGO_SHA512) !== 1) {
  echo "openssl_verify failure";exit;
}


//
// verify ok
// do something...
// 本请求需要快速响应，如有复杂业务操作，建议先将数据保存至队列表中，由后续作业完成业务处理
//
bifubao_save_callback_to_db($_POST['_request_id_'], $_POST['content_type'], $_POST['content']);


//
// finally, we output '_request_check_'
// 服务端会检测此值，一致则认为正常响应，已接收
//
echo $_POST['_request_check_'];
exit;


// // write test log 
// $fp = fopen(dirname(__FILE__).'/callback.log', 'a');
// if (!$fp) { exit; }
// fwrite($fp, date('Y-m-d H:i:s')."\t".$_POST['_request_id_']."\t".$_POST['_request_check_']."\n");
// fclose($fp);

