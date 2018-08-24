<?php

namespace App\Services;

use Illuminate\Contracts\Config\Repository;

/**
 *
 */
class ConfigStatusService
{
    /**
     * @var Repository
     */
    protected $config;

    /**
     * ConfigStatusService constructor.
     * @param Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * @param array $keys
     *
     * @return array|null
     */
    public function get(array $keys = null)
    {
        return $this->config->get($keys);
    }
}
