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

namespace Yousign\Model;

use Yousign\Model\V2\Factory as V2Factory;
use Yousign\Model\V3\Factory as V3Factory;
use Yousign\Share\TypeResolver;
use Yousign\YousignClient;

abstract class AbstractModel
{
    /**
     * Keep all properties values that have been set
     *
     * @var array<mixed>
     */
    private $properties = [];
    
    /**
     * Set default version of Model to v2
     */
    protected string $version = YousignClient::API_VERSION_2;

    /**
     * Standard setter method
     *
     * @param  string  $name
     * @param  mixed  $value
     */
    public function set(string $name, mixed $value): self
    {
        $this->properties[$name] = $this->transform($name, $value);

        return $this;
    }

    /**
     * Affect a value to a property
     *
     * @param  string $name
     * @return mixed $value
     */
    private function transform(string $name, mixed $value): mixed
    {
        if (is_array($value) && TypeResolver::exists($name)) {
            $method = TypeResolver::getFactoryMethod($name);

            if ($this->version === YousignClient::API_VERSION_3) {
                return V3Factory::$method($value);
            } else {
                return V2Factory::$method($value);
            }
        }

        return $value;
    }

    /**
     * Standard getter method
     */
    public function get(string $name): mixed
    {
        return $this->has($name)
            ? $this->properties[$name]
            : null;
    }

    /**
     * Checks that property exists
     */
    public function has(string $name): bool
    {
        return $this->__isset($name);
    }

    /**
     * Get a list of all properties and their values
     * as an associative array.
     *
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return array_map(
            static function($value) {
                return $value instanceof AbstractModel
                    || $value instanceof AbstractModelCollection
                    ? $value->toArray()
                    : $value;
            },
            $this->properties
        );
    }

    /**
     * Get a JSON
     *
     * @param int $options PHP JSON options
     */
    public function toJson(int $options = 0): string
    {
        return (string) json_encode(
            $this->toArray(),
            $options
        );
    }

    /**
     * Magical isset method
     */
    public function __isset(string $name): bool
    {
        return isset($this->properties[$name])
            || array_key_exists($name, $this->properties);
    }

    /**
     * Magical getter method
     *
     * @return mixed
     */
    public function __get(string $name)
    {
        return $this->get($name);
    }

    /**
     * Overloading methods
     *
     * @return mixed
     * @throws \Exception when a called method is not defined
     */
    public function __call(string $name, array $arguments = [])
    {
        // Getters
        if (strpos($name, 'get') === 0) {
            $attr = lcfirst(substr($name, 3));
            return $this->get($attr);
        }

        throw new \Exception(
            sprintf('Method "%s" is not defined', $name)
        );
    }
}
