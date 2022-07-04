<?php

namespace DP\Factory;

require_once __DIR__ . "/Cache.php";

use DP\Factory\Cache;

$setting = [];

$setting["host"]     = "serivce_DB";
$setting["dbname"]   = "testdb";
$setting["charset"]  = "utf8mb4";
$setting["user"]     = "root";
$setting["password"] = "root";

$cache = new Cache($setting);

$cache->set("foo", "bar");

print($cache->get("foo"));