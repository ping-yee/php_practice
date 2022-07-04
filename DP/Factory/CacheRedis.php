<?php

namespace DP\Factory;

require_once __DIR__ . '/vendor/autoload.php';

use DP\Factory\CacheInterface;
use \Enqueue\Redis\RedisConnectionFactory;

class CacheRedis implements CacheInterface
{
    protected \Enqueue\Redis\RedisConnectionFactory $redisConnect;
    protected $context;

    function __construct(array $setting)
    {
        $this->redisConnect = new RedisConnectionFactory([
            "host"      => $setting["host"],
            "port"      => $setting["port"],
            "passwrod"  => $setting["password"],
            "scheme_extensions" => ['predis']
        ]);

        $this->context = $this->redisConnect->createContext();
    }

    public function get(string $key): ?string
    {
        return null;
    }

    public function set(string $key, string $value): bool
    {
        return false;
    }
}
