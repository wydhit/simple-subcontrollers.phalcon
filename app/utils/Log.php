<?php
// +----------------------------------------------------------------------
// | Log.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Utils;

use limx\phalcon\Logger;

class Log
{
    /** 日志目录 */
    const DIR = null;

    /** 文件名 */
    const FILE_NAME = "logger.log";

    /** 日志类型 */
    const TYPE = "file";

    /**
     * @desc   获取日志类实例
     * @author limx
     * @return mixed
     */
    public static function logger()
    {
        return Logger::getInstance(static::TYPE, static::FILE_NAME, static::DIR);
    }

    /**
     * @desc   Sends/Writes messages to the file log
     * @author limx
     * @param  mixed      $type
     * @param  mixed      $message
     * @param  array|null $context
     * @return mixed
     */
    public static function log($type, $message = null, array $context = null)
    {
        $logger = static::logger();
        return $logger->log($type, $message, $context);
    }

    /**
     * @desc   Starts a transaction
     * @author limx
     * @return mixed
     */
    public static function begin()
    {
        $logger = static::logger();
        return $logger->begin();
    }

    /**
     * @desc   Commits the internal transaction
     * @author limx
     * @return mixed
     */
    public static function commit()
    {
        $logger = static::logger();
        return $logger->commit();
    }

    /**
     * @desc   Rollbacks the internal transaction
     * @author limx
     * @return mixed
     */
    public static function rollback()
    {
        $logger = static::logger();
        return $logger->rollback();
    }

    /**
     * @desc   Sends/Writes a debug message to the log
     * @author limx
     * @param  string $message
     * @param  array  $context
     * @return mixed
     */
    public static function debug($message, array $context = null)
    {
        $logger = static::logger();
        return $logger->debug($message, $context);
    }

    /**
     * @desc   Sends/Writes an error message to the log
     * @author limx
     * @param  string $message
     * @param  array  $context
     * @return mixed
     */
    public static function error($message, array $context = null)
    {
        $logger = static::logger();
        return $logger->error($message, $context);
    }

    /**
     * @desc   Sends/Writes an info message to the log
     * @author limx
     * @param  string $message
     * @param  array  $context
     * @return mixed
     */
    public static function info($message, array $context = null)
    {
        $logger = static::logger();
        return $logger->info($message, $context);
    }

    /**
     * @desc   Sends/Writes a notice message to the log
     * @author limx
     * @param  string     $message
     * @param  array|null $context
     * @return mixed
     */
    public static function notice($message, array $context = null)
    {
        $logger = static::logger();
        return $logger->notice($message, $context);
    }

    /**
     * @desc   Sends/Writes a warning message to the log
     * @author limx
     * @param  string     $message
     * @param  array|null $context
     * @return mixed
     */
    public static function warning($message, array $context = null)
    {
        $logger = static::logger();
        return $logger->warning($message, $context);
    }

    /**
     * @desc   Sends/Writes an alert message to the log
     * @author limx
     * @param  string     $message
     * @param  array|null $context
     * @return mixed
     */
    public static function alert($message, array $context = null)
    {
        $logger = static::logger();
        return $logger->alert($message, $context);
    }

    /**
     * @desc   Sends/Writes an emergency message to the log
     * @author limx
     * @param  string     $message
     * @param  array|null $context
     * @return mixed
     */
    public static function emergency($message, array $context = null)
    {
        $logger = static::logger();
        return $logger->emergency($message, $context);
    }


}