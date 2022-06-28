<?php 
namespace DP\Registry;

require_once './RegistryInterface.php';

use DP\Registry\RegistryInterface;

/**
 * 註冊器靜態類別
 */
class Registry implements RegistryInterface
{
    /**
     * 註冊表存放陣列
     *
     * @var array
     */
    private static $instances = [];

    /**
     * 取得註冊表內實體
     *
     * @param string $name
     * @return string|null
     */
    public static function get(string $name): ?string
    {
        if(self::has($name)) return self::$instances[$name];

        return null;
    }

    /**
     * 設定傳入實體入註冊器內
     *
     * @param string $name
     * @param object $obj
     * @return boolean
     */
    public static function set(string $name, object $obj): bool
    {
        // 判斷是否已經存在
        if(self::has($name)) return false;

        self::$instances[$name] = $obj;

        // 判斷是否有存入成功
        if (self::has($name)) return true;        
    }

    /**
     * 判斷傳入實體是否存在註冊器內
     *
     * @param string $name
     * @param object $object
     * @return boolean
     */
    public static function has(string $name): bool
    {
        if(isset(self::$instances[$name])) return true;
        return false;
    }

    /**
     * 移除註冊器內實體
     *
     * @param string $name
     * @return boolean
     */
    public static function remove(string $name): bool
    {
        unset(self::$instances[$name]);
        
        // 判斷是否還存在
        if (!self::has($name)){
            return true;
        }else{
            return false;
        };
    }
}
