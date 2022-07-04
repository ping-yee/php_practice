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
    $cache = new CacheFactory('mysql', $setting);
} catch (Exception $e) {
    print_r($e->getMessage());
}

$cache->set("foo", "bar");

print($cache->get("foo"));