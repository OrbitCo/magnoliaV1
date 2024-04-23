<?php

declare(strict_types=1);

namespace Pg\Libraries\Cache;

use Symfony\Contracts\Cache\ItemInterface;

final class Manager
{
    /**
     * @var null
     */
    private static $instance = null;

    /**
     * APCu key
     *
     * @string
     */
    public const PROVIDER_APCU = 'apcu';

    /**
     * Array key
     *
     * @string
     */
    public const PROVIDER_ARRAY = 'array';

    /**
     * Filesystem key
     *
     * @string
     */
    public const PROVIDER_FILESYSTEM = 'filesystem';

    /**
     * Memcached key
     *
     * @string
     */
    public const PROVIDER_MEMCACHED = 'memcached';

    /**
     * Redis key
     *
     * @string
     */
    public const PROVIDER_REDIS = 'redis';

    /**
     * Supported adapters
     *
     * @var string[]
     */
    private $supported_adapters = [
        self::PROVIDER_APCU => '\Symfony\Component\Cache\Adapter\ApcuAdapter',
        self::PROVIDER_ARRAY => '\Symfony\Component\Cache\Adapter\ArrayAdapter',
        self::PROVIDER_FILESYSTEM => '\Symfony\Component\Cache\Adapter\FilesystemAdapter',
        self::PROVIDER_MEMCACHED => '\Symfony\Component\Cache\Adapter\MemcachedAdapter',
        self::PROVIDER_REDIS => '\Symfony\Component\Cache\Adapter\RedisAdapter'
    ];

    /**
     * Set of adapters and related memory cells
     *
     * @var array
     */
    private $adapters = [];

    /**
     * @return Manager
     */
    public static function getInstance(): ?Manager
    {
        if (Manager::$instance === null) {
            Manager::$instance = new Manager();
        }

        return Manager::$instance;
    }

    /**
     * Get cache
     *
     * @param $name
     * @param $key
     * @param $callback
     *
     * @return mixed|void
     */
    public function get($name, $key, $callback)
    {
        if (!empty($callback())) {
            $cache = $this->getAdapter($name);

            if (is_null($cache) === true) {
                return $callback();
            }

            $name_key = $this->formatKey($name, $key);

            return $cache->get($name_key, function (ItemInterface $item) use ($callback) {
                $item->expiresAfter((int) $_ENV['CACHE_LIFETIME']);

                return $callback();
            });
        }
    }

    /**
     * Set cache
     *
     * @param $name
     * @param $key
     * @param $value
     * @param $callback
     *
     * @return mixed|void
     */
    public function set($name, $key, $value, $callback)
    {
        $cache = $this->getAdapter($name);

        if (is_null($cache) === true) {
            if ($callback instanceof \Closure) {
                return $callback();
            }
        }

        $name_key = $this->formatKey($name, $key);
        $cache_item = $cache->getItem($name_key);
        if (!$cache_item->isHit()) {
            $cache_item->set($value);
            $cache->save($cache_item);
        }
    }

    /**
     * Register service
     *
     * @param string $name
     * @param string|null $adapter
     */
    public function registerService(string $name, string $adapter = null)
    {
        if (!empty($_ENV['DATA_USE_CACHE'])) {
            if (empty($adapter)) {
                $adapter = $_ENV['CACHE_ADAPTER'];
            }

            switch ($adapter) {
                case 'apcu':
                    $this->adapters[$name]['adapter'] = new $this->supported_adapters[$adapter](
                        DB_PREFIX,
                        (int) $_ENV['CACHE_LIFETIME']
                    );

                    break;
                case 'array':
                    $this->adapters[$name]['adapter'] = new $this->supported_adapters[$adapter](
                        (int) $_ENV['CACHE_LIFETIME']
                    );

                    break;
                case 'filesystem':
                    $this->adapters[$name]['adapter'] = new $this->supported_adapters[$adapter](
                        DB_PREFIX,
                        (int) $_ENV['CACHE_LIFETIME'],
                        TEMPPATH . '/cache'
                    );

                    break;
                case 'memcached':
                    $connection = 'memcached://';
                    if (!empty($_ENV['MEMCACHED_AUTH_USERNAME']) && !empty($_ENV['MEMCACHED_AUTH_PASSWORD'])) {
                        $connection .= "{$_ENV['MEMCACHED_AUTH_USERNAME']}:{$_ENV['MEMCACHED_AUTH_PASSWORD']}@";
                    }
                    $connection .= "{$_ENV['MEMCACHED_HOST']}:{$_ENV['MEMCACHED_PORT']}";
                    $client = $this->supported_adapters[$adapter]::createConnection($connection);
                    $this->adapters[$name]['adapter'] = new $this->supported_adapters[$adapter](
                        $client,
                        DB_PREFIX,
                        (int) $_ENV['CACHE_LIFETIME']
                    );

                    break;
                case 'redis':
                    $connection = 'redis://';
                    if (!empty($_ENV['REDIS_AUTH_USERNAME']) && !empty($_ENV['REDIS_AUTH_PASSWORD'])) {
                        $connection .= "{$_ENV['REDIS_AUTH_USERNAME']}:{$_ENV['REDIS_AUTH_PASSWORD']}@";
                    }
                    $connection .= "{$_ENV['REDIS_HOST']}:{$_ENV['REDIS_PORT']}";
                    $client = $this->supported_adapters[$adapter]::createConnection($connection);
                    $this->adapters[$name]['adapter'] = new $this->supported_adapters[$adapter](
                        $client,
                        DB_PREFIX,
                        (int) $_ENV['CACHE_LIFETIME']
                    );

                    break;
            }
        } else {
            $this->adapters[$name]['adapter'] = null;
        }
    }

    /**
     * Adapter
     *
     * @param string $name
     *
     * @return mixed
     */
    protected function getAdapter(string $name)
    {
        $adapter = null;
        if (!empty($this->adapters[$name])) {
            $adapter = $this->adapters[$name]['adapter'];
        }

        return $adapter;
    }

    /**
     * Get cache
     *
     * @param $name
     * @param $keys
     * @param $callback
     *
     * @return array
     */
    public function mget($name, $keys, $callback): array
    {
        if (!empty($callback)) {
            $cache = $this->getAdapter($name);

            if (is_null($cache) === true) {
                return $callback($keys);
            }

            $values = [];
            foreach ($keys as $key) {
                $name_key = $this->formatKey($name, $key);
                $values[$key] = $cache->get($name_key, function () use ($callback, $key) {
                    return current($callback([$key]));
                });
            }

            return array_values($values);
        }

        return [];
    }

    /**
     * Delete cache
     *
     * @param $name
     * @param $key
     */
    public function delete($name, $key)
    {
        $cache = $this->getAdapter($name);
        if (is_null($cache) !== true) {
            $name_key = $this->formatKey($name, $key);
            $cache->delete($name_key);
        }
    }

    /**
     * Flush cache
     *
     * @param $name
     */
    public function flush($name)
    {
        $cache = $this->getAdapter($name);
        if (is_null($cache) !== true) {
            $cache->clear();
        }
    }

    /**
     * Prune cache
     *
     * @param $name
     */
    public function prune($name)
    {
        $cache = $this->getAdapter($name);
        if (is_null($cache) !== true) {
            $cache->prune();
        }
    }

    /**
     * Format key
     *
     * @param $name
     * @param $key
     *
     * @return string
     */
    private function formatKey($name, $key): string
    {
        return "{$name}.{$key}";
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @throws \Exception
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }
}
