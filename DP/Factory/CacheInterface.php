<?php

namespace DP\Factory;

interface CacheInterface 
{
    public function set(string $field, string $value): bool;
    
    public function get(string $field): ?string;
}