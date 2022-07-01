<?php

namespace DP\Factory;

require __DIR__ . "/Cache.php";

use Cache;

$setting = [];

$setting["mysql"]["host"]     = "127.0.0.1";
$setting["mysql"]["dbname"]   = "test";
$setting["mysql"]["charset"]  = "UTF8";
$setting["mysql"]["user"]     = "root";
$setting["mysql"]["password"] = "root";

$cache = new Cache($setting);

$cache->set("foo", "bar");

print($cache->get("foo"));