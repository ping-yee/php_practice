<?php

namespace DP\Registry;

use PDO;
use PDOException;

class UserPdo
{
    /**
     * DB連線資訊
     *
     * @var string
     */
    public string $mysqlDsn;
    
    /**
     * 使用者帳號
     *
     * @var string
     */
    public string $mysqlUser;

    /**
     * 使用者密碼
     *
     * @var string
     */
    public string $mysqlPass;

    /**
     * Pdo實體
     *
     * @var object
     */
    public object $pdo;

    /**
     * 在物件初始化時將 PDO 實體建構出來
     *
     * @param string $mysqlDsn
     * @param string $mysqlUser
     * @param string $mysqlPass
     */
    public function __construct(string $mysqlDsn = "mysql:dbname=testdb;host=localhost;port=3306", string $mysqlUser = "root", string $mysqlPass = "root")
    {
        $this->setPdo($mysqlDsn, $mysqlUser, $mysqlPass);
    }

    /**
     * 設定PDO實體
     *
     * @param string $mysqlDsn
     * @param string $mysqlUser
     * @param string $mysqlPass
     * @return void
     */
    public function setPdo(string $mysqlDsn, string $mysqlUser, string $mysqlPass): void
    {
        $this->mysqlDsn  = $mysqlDsn;
        $this->mysqlUser = $mysqlUser;
        $this->mysqlPass = $mysqlPass;

        $options = [
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'
        ];

        try {
            $this->pdo = new PDO($mysqlDsn, $mysqlUser, $mysqlPass, $options);
            $this->pdo->exec('SET CHARACTER SET utf8mb4');
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    /**
     * 取得 PDO 實體
     *
     * @return object|null
     */
    public function getPdo(): ?object
    {
        return $this->pdo;
    }
}



