<?php

namespace DP\Factory;

require_once __DIR__ . "/CacheFactory.php";

use DP\Factory\CacheFactory;
use Exception;

$setting = [];

$setting["mysql"]["host"]     = "serivce_DB";
$setting["mysql"]["dbname"]   = "testdb";
$setting["mysql"]["charset"]  = "utf8mb4";
$setting["mysql"]["port"]     = "3306";
$setting["mysql"]["user"]     = "root";
$setting["mysql"]["password"] = "root";

try {
    $mysql = CacheFactory::createCacheDriver('mysql', $setting);
} catch (Exception $e) {
    print_r($e->getMessage());
}

$mysql->set("foo", "bar");
$mysql->set("foo2", "bar2");

$mysqlResult = $mysql->get("foo2");

var_dump($mysqlResult);

$setting["redis"]["host"]     = "redis_master";
$setting["redis"]["port"]     = "6379";
$setting["redis"]["password"] = "queue";

try {
    $redis = CacheFactory::createCacheDriver('redis', $setting);
} catch (Exception $e) {
    print_r($e->getMessage());
}

$redis->set("foo", "bar");
$redis->set("foo2", "bar2");

$redisResult = $redis->get("foo2");

var_dump($redisResult);