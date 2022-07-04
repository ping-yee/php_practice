<?php

namespace DP\Factory;

use DP\Factory\CacheMysql;
use DP\Factory\CacheRedis;
use Exception;
/**
 * 快取工廠，使用 Singleton design
 * 工廠設計模式 => 透過傳入值， new 出相應的 instance
 */
class CacheFactory
{
    /**
     * 建構方法，直接呼叫 createCacheDriver 方法
     *
     * @param string $type
     * @param array $setting
     */
    public function __construct(string $type, array $setting)
    {
        return self::createCacheDriver($type, $setting);
    }

    /**
     * 透過傳入類別判斷實體化哪個 Driver
     *
     * @param string $type
     * @param array $setting
     * @return object|null
     */
    public static function createCacheDriver(string $type, array $setting): ?object
    {
        $setting = $setting[$type];

        $className = 'Cache' . ucfirst(strtolower($type));
        $classFilePath = __DIR__ . '/' . $className . '.php';

        if(file_exists($classFilePath)) {
            require_once $classFilePath;
            
            return new $className($setting);
        }else {
            throw new Exception("建構 " . $className . " 類別時發生錯誤，請重新再試");
        }
    }
}
