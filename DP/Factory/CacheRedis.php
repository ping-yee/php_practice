<?php

namespace DP\Factory;

require_once __DIR__ . '/vendor/autoload.php';

use \Predis\Client;

class CacheRedis implements CacheInterface
{
    private Client $client;

    function __construct(array $setting)
    {
        $this->client = new Client([
            "scheme" => 'tcp',
            "host"   => $setting["host"],
            "port"   => $setting["port"],
        ],
        [
            'parameters' => [
                'password' => $setting["password"]
            ],
        ]);
    }

    public function get(string $key): ?string
    {
        $value = $this->client->get($key);

        return $value;
    }
    public function set(string $key, string $value): bool
    {
        $this->client->set($key, $value);

        if (is_null($this->get($key))) return false;

        return true;
    }
}
