<?php

namespace DP\Factory;

require_once __DIR__ . "/CacheInterface.php";

use PDO;
use PDOException;

class CacheMysql implements CacheInterface
{
    protected $db;

    protected $table = 'cache_data';

    /**
     * 建構資料庫連線資訊
     *
     * @param array $setting
     */
    public function __construct(array $setting)
    {
        $host = "mysql" . 
                ":host="    . $setting["host"] .
                ";dbname="  . $setting["dbname"] . 
                ";charset=" . $setting["charset"] .
                ";port="    . $setting["port"];

        $user      = $setting["user"];
        $password  = $setting["password"];

        $options = [
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'
        ];

        try {
            $this->db = new PDO($host, $user, $password, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
    
    /**
     * 取得資料庫快取資料
     *
     * @param string $key
     * @return string|null
     */
    public function get(string $key): ?string
    {
        $sql = 'SELECT cache_value FROM ' . $this->table . 
               ' WHERE cache_key = :cache_key';

        $query = $this->db->prepare($sql);
        $query->bindValue(':cache_key', $key);
        $query->execute();
        
        $result = $query->fetch($this->db::FETCH_ASSOC);

        if (empty($result)) {
            return null;
        }
        
        return $result["cache_value"];
    }

    /**
     * 設定資料庫快取資料
     *
     * @param string $key
     * @param string $value
     * @return boolean
     */
    public function set(string $key, string $value): bool
    {
        $cacheData = $this->get($key);

        $data = [
            "cache_key"   => $key,
            "cache_value" => $value
        ];

        // 先進資料庫取資料，若資料庫有資料進行更新，若無資料則進行新增
        if ($cacheData !== null){
            $sql = 'UPDATE ' . $this->table .
                   ' SET cache_value = :cache_value
                    WHERE cache_key = :cache_key';
                
            $query = $this->db->prepare($sql);
            $query->execute($data);
        }else{
            $sql = 'INSERT INTO ' . $this->table .
            ' (cache_key, cache_value) VALUES (:cache_key, :cache_value)';

            $query = $this->db->prepare($sql);
            $query->execute($data);
        }

        // 判斷資料是否進資料庫
        if (is_null($key)){
            return false;
        }else{
            return true;
        }
    }
}
