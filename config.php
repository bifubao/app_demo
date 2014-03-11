<?php
/**
 * Config - API
 * 
 * @author PanZhibiao
 * @copyright bifubao.com
 * @since 2014-03
 */
if(!defined('IN_BIFUBAO')) {
	exit('Access Denied');
}

// main db
define("DB_MAIN", 'db_main');

// init
$_CFG = array();
$_CFG['api_version'] = "v00001";  // api version
$_CFG['api_host']    = "https://api.bifubao.com/{$_CFG['api_version']}";
// DB_MAIN_M01
$_CFG[DB_MAIN] = array(
		'dsn' => 'mysql:host=10.0.1.254;port=3306;dbname=BifubaoDemoDB',
		'username' => 'writeuser',
		'password' => 'GhbaRSPt4NBGu2Sd',
		'options'  => array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		)
);

// bifubao app_hash_id
$_CFG['app_hash_id'] = "4e589c175d6a483562e1c50f54351250367d4253ed146d411dbe612eb63b52d3";
// bifubao rsa private key
$_CFG['app_rsa_private_key'] = "-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDUoRth9cZtSOx+
7MWFCRJAXSZAOA9kDzJ65yuc6KpkwKKR1yS416yGlYfbgABAcUv8D8O4/NgjaFA2
m84SQaCYalmCD8cxuq2n0KIEM8z/9U/SqMIg71GKdFKePJDUpEsdwgJ8UwQq1dAb
z3j3VJcp7+JxlsCSWkwJz31Uc74OxU81TAji0hZPPBhb4zEdGCfhTjGfrVaBVbSv
AdyFcBjDpDxx7LRH1Ao1TchGIxlb+ekisQhaeIEmuYP2JH/gPr+W7XEaVuXwfDTn
McCEDi2a9tRX29e1TWnUZPos8H++2pqjQx5T10+S+Y4nW329JL7Jx1dNbOxP6ntT
FcyfPM8lAgMBAAECggEAbUgcPb3G7RYkzps8bUKbSc9WQH1Pk7qn1DkJ1kxSfxPu
ugwcSJA4kLc7qxnfhz9zsSodCu+Q2qnbSCXNxN5L/unx9QHM/AcZB34YNxa0jvzy
uK+ZjrnRa9qbN86jFVcXcETtaB52rtlTa2e3oU6tnpU3CfBUKyQTnpswq/4MuaPI
xIc2xy+ZU6SJG4RAxbZ5zV0j2x8iTAk1u0MupNemEo7xCr0pxJid1nJlHpMS6KXZ
BEWl8yU6qorj7J9rgbNOKoPSba3rhtYRAfyTxRDi1EaZagVllqA96LDp0yFp9t+T
aszaJOSdjKEXuBcouN6kEv40ljt7nNY5+Lm4v3qUZQKBgQD6Zx3LkAyYaWNHrNEB
WpPbOdO0RDESn6l3ARYauzeZB24yVnXsr2AFezwj3Xj9/vJowm36n01l4/kLkVG6
Lq5CTPMTDadpfZqUpuk3mfRDqB8C0zouBfx9lLsytR3ncZrhpPfdsmcBh2b82dZL
7iH/4/wZEj6fSAciWFxqsu3ezwKBgQDZYdbAHvkEit13632Pn1FrVnXCuRsMAMbh
tHNBYCJE0PmVFKkBirV/xldySQfaQvZT0JDsoi1lRiE16v71kRrmJMo6SVVBDfH5
sNLgeOm4qNvVb2PiGAixgbX/GgqCaSkeAXYSpK+S4vl+1S+jxFRfgHUU/R/FNiUB
/qAbpkEPywKBgG6CMaET+qsM37bTKw5Y5iX7GFZXPf0FH6oYfaPgegH8SILIq5SA
NXVV1M3TQUF/UYYwQI853NOZz+BuCs6LKXazNRd0kCy7NQxjuUtDk4yEVuNNS0Di
fXMCv7b6Pa9V8M+imY1q3ZDMLARtMukhuDmRaUG7To3HIPbkXizsuJP7AoGASM9j
faAiKipU+bivqq5jN/+Sm/EiJQgRlUG6pPgNIl2Yax2rae/K0Qxe99GMRsfM98/Q
6uF7MQOnVgbq9NdwWguSjKlJW+vO06ItT7BQIGC2mSuhGfaQ2tumWNahFIMimYFF
ygLNJ/bMOHYxabn1xLMjBC+wN37mMF/XwssR2bcCgYEAzDHa2JcmEfZngYXqFID0
upEybl1tPFfxjAukBuCuG4Y8wdyCqHxIrU42rhJEbw4Db/zyD4/i3dilyuN7mhk8
6Ekaty5YiG7y3yKjQlkim4DWCc5YBSLmCSKnbnKViEnqlCw4x0+2HjYLalORwYyH
Dtrdb07S7MpHL04pohQ7H94=
-----END PRIVATE KEY-----";
