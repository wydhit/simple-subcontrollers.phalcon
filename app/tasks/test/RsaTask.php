<?php
// +----------------------------------------------------------------------
// | Demo [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lmx0536.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <http://www.lmx0536.cn>
// +----------------------------------------------------------------------
// | Date: 2017/2/1 Time: 下午9:11
// +----------------------------------------------------------------------
namespace MyApp\Tasks\Test;

use Phalcon\Cli\Task;

class RsaTask extends Task
{
    public function mainAction()
    {
        $file = BASE_PATH . '/data/rsa/test/helloworld.php';
        $private_key = file_get_contents(BASE_PATH . '/data/rsa/rsa_private_key.pem');

        $msg = file_get_contents($file);
        $private_key = openssl_pkey_get_private($private_key);
        // 私钥加密
        $ret = openssl_private_encrypt($msg, $encrypted, $private_key);

        if (!$ret || empty($encrypted)) {
            echo "fail to encrypt file md5";
        }
        // 存储加密文件
        $encrypted = base64_encode($encrypted);
        file_put_contents(BASE_PATH . '/data/rsa/test/encrypted.php', $encrypted);

        $public_key = file_get_contents(BASE_PATH . '/data/rsa/rsa_public_key.pem');
        $file = BASE_PATH . '/data/rsa/test/encrypted.php';
        $msg = file_get_contents($file);
        // 公钥解密
        openssl_public_decrypt(base64_decode($msg), $decrypted, $public_key);
        // 存储解密文件
        file_put_contents(BASE_PATH . '/data/rsa/test/decrypted.php', $decrypted);

    }
}