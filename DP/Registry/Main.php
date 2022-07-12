<?php

namespace DP\Registry;

require_once './Registry.php';
require_once './UserPdo.php';

$pdo = new UserPdo();

// Set pdo object in registry
Registry::set('pdo', $pdo);

print_r(Registry::get('pdo'));

print_r(Registry::show());

Registry::remove('pdo');

var_dump(Registry::get('pdo'));
