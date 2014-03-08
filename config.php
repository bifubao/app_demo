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
$_CFG['app_hash_id'] = "318b831ebaa5e9ba9e22f30514b568fd3fe7f66f2b8c19c3c05ce33c4d8e0fdc";
// bifubao rsa private key
$_CFG['app_rsa_private_key'] = "-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCsFJxdkQBzfSeC
E5gvU6vtvtqtg0e4lPsW/QGr9ptmKwbLXxPAYatO3WhPux+pIPmt7fgbHxPZ1akH
lKIZ5jePOTviIUyrMiamWA5Vf7mCTutVk0op5gLdWQr61RAP/ItW64HLDQAhVM6z
jmOvdUBsvDvQ6uawjoFV2nN/v3qUvgqhFOMjJaF0Kg33U0ivEVMh+kK1FAy2basz
4F6eVWVq+NHa38NeY/wYTRQX0Q0SHLHncRZ1Akm62Ke5X2nwOyS3iKVbCy7vMAd7
/0LBSs8xayIsHvLab5iY8is4SfCvEXVlRPsp+mjgaLSRNLhIj8djtFBuOiD9LY1I
opl2yW4pAgMBAAECggEADnhhOcECv7NrihWpu3kWwRRGgUbD1jK49pLp/BLtuGav
2JQzLf9Ij4Ywylua6vb55/VV4rn3Sl8cKqYGB5WDYIjYj0hrkQ3TkDNhaTEnYVzP
j0+mceWEoiZltPgLtLxw3ytIq9F5DFR8WT8FBPEgLMSbZxMJuRkSqSyIf9qTLUS2
gsWwUcIYKiFX7N/Z089/O5oBkzLhCwun3Zvkq4jsIIAk9cWKyChNPcFrKz05CIO0
DCzf63J6skAVCyyd8iRR+eaRwng+nfKsg8qXJZwo1cnIgQOPOWpXfVk+JN+gIdwF
orEx8MBjtYxTABKcoe1EbOXUXfU3e4afgATNB0kXHQKBgQDXFuN+GjLEsmk5288V
y58aHQM7gIARE/jvE1tk4Dd7qz4ew2M2NZJOSndxBwUkq5fIhXmNGaKgbXsgC2D1
4092p9zhXazOVsLnOGIKtH5KK09yByMrCJ+TrDEwwW9CBNfFWL8baQdM1QVu2roe
F6t6A1ttGU2VyZzcm7Z3zJGNCwKBgQDMz4mOrqAuLX/ioxNJVzzA+z7KBJJMpr5d
xQTkljuojm43n/DXxrUXkubru7lEhzAESMsTuWAGuxi4WZr+KkQqov48EVfS0DPI
NwVGiKxyWjR661U8sgNCxH3sqZdTaNwEMBEn5aG/7pXtM8eKmrciTqMPeLY4Y3Pv
T2ZAyLtqGwKBgQDUpPRT/2KhxCDz6rRZP+4TywsfEHOMbsp00hZRLLqtsSbBEzpK
pbv3Wveq7t3O2zY8MHlzXhzBrntDuvwpHIm7LUnaJNprRKt8HOoQ21Df0uHAQf4q
1WOug1Y+dX6hLliD6rFFUBi/hPrSFbxbc9s7zYXd3l4t8Bz8nZVP6xca8QKBgErM
tSFeF3Ql++HKyx1q9e5JFCp1tvS1pSrb7KiLUaiCtDAugqhbkwHUDfAkNEqZ0OiP
qVM/zZlHtYSGfTu8Nf8YXh+T+e4tSewiZBPZkJmG5knKLuwm21gEKTVIztKQpmIF
KA7ZJ9TQDwN9eK/fR2kJLTZWUL6RW+MXrXGVnhTnAoGALsuZ7L2RXjg6wWt84hZ5
4JbRqmTjqsR+O3B6pc9rGM/FBxjWX8lq879GwBUXDex5yo1YUPphOl85uu2olzgP
Eebc78K75gI0gxByjE4XNBCawHIjbUn8Wxjj6r+EqLa0W94X7juC+BzuoldfWJZ/
cxdtvZ9AaYhzqUh3pQpdtmA=
-----END PRIVATE KEY-----";
