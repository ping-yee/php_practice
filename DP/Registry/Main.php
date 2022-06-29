<?php

namespace DP\Registry;

require_once './Registry.php';
require_once './UserPdo.php';

$pdo = new UserPdo();

Registry::set('pdo', $pdo);

Registry::get();

Registry::get('pdo');
