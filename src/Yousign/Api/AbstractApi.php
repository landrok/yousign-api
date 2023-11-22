<?php

declare(strict_types=1);

/*
 * This file is part of the YousignApi package.
 *
 * Copyright (c) landrok at github.com/landrok
 *
 * For the full copyright and license information, please see
 * <https://github.com/landrok/yousign-api/blob/master/LICENSE>.
 */

namespace Yousign\Api;

use Yousign\Process\BasicProcess;
use Yousign\YousignClient;

abstract class AbstractApi
{
    /**
     * Authenticated HTTP client for Yousign API
     */
    public YousignClient $client;

    abstract public function __construct(string $token, bool $production);

    /**
     * A shortcut for integration tests
     * It helps configuring low-level client options
     * 
     * @param  array<mixed>
     */
    public function setClientOptions(array $options): static
    {
        $this->client->setOptions($options);

        return $this;
    }

    /**
     * Basic mode
     */
    public function basic(): BasicProcess
    {
        return new BasicProcess($this);
    }

    public function getYousignClient(): YousignClient
    {
        return $this->client;
    }
}