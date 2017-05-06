<?php
// +----------------------------------------------------------------------
// | EncryptTask.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Tasks\Test;

use Phalcon\Cli\Task;
use limx\phalcon\Cli\Color;

class EncryptTask extends Task
{
    public function mainAction()
    {
        echo Color::head('Help:'), PHP_EOL;
        echo Color::colorize('  PHP加密测试'), PHP_EOL, PHP_EOL;

        echo Color::head('Usage:'), PHP_EOL;
        echo Color::colorize('  php run Test\\\\Encrypt [action]', Color::FG_GREEN), PHP_EOL, PHP_EOL;

        echo Color::head('Actions:'), PHP_EOL;
        echo Color::colorize('  rsa         RSA加密测试', Color::FG_GREEN), PHP_EOL;
        echo Color::colorize('  aes         AES加密测试', Color::FG_GREEN), PHP_EOL;
    }

    public function aesAction()
    {
        // $data = 'phpbest';
        // echo openssl_random_pseudo_bytes(32);
        // $key = 'oScGU3fj8m/tDCyvsbEhwI91M1FcwvQqWuFpPoDHlFk='; //echo base64_encode(openssl_random_pseudo_bytes(32));
        // $iv = openssl_random_pseudo_bytes(16); //echo base64_encode(openssl_random_pseudo_bytes(16));
        // echo '内容: ' . $data . "\n";
        //
        // $encrypted = openssl_encrypt($data, 'aes-256-cbc', base64_decode($key), OPENSSL_RAW_DATA, $iv);
        // echo '加密: ' . base64_encode($encrypted) . "\n";
        //
        // // $encrypted = base64_decode('To3QFfvGJNm84KbKG1PLzA==');
        // $decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', base64_decode($key), OPENSSL_RAW_DATA, $iv);
        // echo '解密: ' . $decrypted . "\n";
    }

    public function rsaAction()
    {
        $file = ROOT_PATH . '/data/rsa/test/helloworld.php';
        $this->encrypt($file);
        $file = ROOT_PATH . '/data/rsa/test/encrypted.php';
        $this->decrypt($file);
    }

    private function decrypt($file)
    {
        $public_key = file_get_contents(ROOT_PATH . '/data/rsa/rsa_public_key.pem');
        $msg = file_get_contents($file);
        $msg = json_decode($msg);
        $result = '';
        foreach ($msg as $item) {
            // 公钥解密
            openssl_public_decrypt(base64_decode($item), $decrypted, $public_key);
            $result .= $decrypted;
        }
        $result = base64_decode($result);
        // 存储解密文件
        file_put_contents(ROOT_PATH . '/data/rsa/test/decrypted.php', $result);
    }

    private function encrypt($file)
    {
        $private_key = file_get_contents(ROOT_PATH . '/data/rsa/rsa_private_key.pem');

        $msg = file_get_contents($file);
        $msg = base64_encode($msg);
        $len = strlen($msg);
        $step = 110;
        $result = [];
        for ($i = 0; $i < $len;) {
            $input = substr($msg, $i, $step);
            $private_key = openssl_pkey_get_private($private_key);
            // 私钥加密
            $ret = openssl_private_encrypt($input, $encrypted, $private_key);

            if (!$ret || empty($encrypted)) {
                echo "fail to encrypt file md5";
                return;
            }
            // 存储加密文件
            $encrypted = base64_encode($encrypted);
            $result[] = $encrypted;
            $i += $step;
        }
        file_put_contents(ROOT_PATH . '/data/rsa/test/encrypted.php', json_encode($result));
    }
}