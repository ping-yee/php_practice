<?php

namespace DP\Factory;

interface CacheInterface 
{
    
    /**
     * 設定快取傳入 key 與 value
     *
     * @param string $key
     * @param string $value
     * @return boolean
     */
    public function set(string $key, string $value): bool;
    
    /**
     * 透過 key 取得快取之 value
     *
     * @param string $key
     * @return string|null
     */
    public function get(string $key): ?string;
}