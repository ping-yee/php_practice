<?php 

namespace DP\Registry;

/**
 * 註冊器介面
 */
interface RegistryInterface
{
    /**
     * 取得註冊器內容之實體
     * 
     * @return string|null
     */
    public static function get(string $name): ?string;

    /**
     * 設定註冊器內容
     *
     * @param string $name
     * @param object $obj
     * @return boolean
     */
    public static function set(string $name, object $obj): bool;
    
    /**
     * 判斷註冊器是否存在此內容
     *
     * @param string $name
     * @return boolean
     */
    public static function has(string $name): bool;
    
    /**
     * 移除註冊器內容
     *
     * @param string $name
     * @return boolean
     */
    public static function remove(string $name): bool;
}