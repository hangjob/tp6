<?php
// 应用公共文件

function getRealIP(){
    $forwarded = request()->header("x-forwarded-for");
    if($forwarded){
        $ip = explode(',',$forwarded)[0];
    }else{
        $ip = request()->ip();
    }
    return $ip;
}


/**
 * 加密
 * @param String input 加密的字符串
 * @param String key   解密的key
 * @return HexString
 * https://learnku.com/articles/8584/php-and-web-end-symmetric-encryption-transmission-jsencryptcryptojs
 */
function encrypt($str) {
    $encrypted_data = openssl_encrypt($str, 'aes-128-cbc', config('app.aeskey'), OPENSSL_RAW_DATA, config('app.aesiv'));
    return base64_encode($encrypted_data);
}


/**
 * 解密
 * @param $plain_text
 * @return int|string
 */
function decrypt($plain_text){
    $encrypt = base64_decode($plain_text);
    $decrypt = openssl_decrypt($encrypt, 'aes-128-cbc', config('app.aeskey'), OPENSSL_RAW_DATA, config('app.aesiv'));
    if($decrypt){
        parse_str($decrypt,$arr); // 将name=a&age=2 解析成数组
        krsort($arr);
        return $arr;
    }else{
        return false; // 解密失败
    }
}