<?php

/*
 * This file is part of the YousignApi package.
 *
 * Copyright (c) landrok at github.com/landrok
 *
 * For the full copyright and license information, please see
 * <https://github.com/landrok/yousign-api/blob/master/LICENSE>.
 */

namespace Yousign\Model;

use Exception;
use Yousign\Share\TypeResolver;

abstract class AbstractModel
{
    /**
     * Keep all properties values that have been set
     *
     * @var array
     */
    private $properties = [];

    /**
     * Standard setter method
     *
     * @param  string $name
     * @param  mixed  $value
     * @return $this
     */
    public function set($name, $value): self
    {
        $this->properties[$name] = $this->transform($name, $value);

        return $this;
    }

    /**
     * Affect a value to a property
     *
     * @param  mixed $value
     * @return mixed
     */
    private function transform(string $name, $value)
    {
        if (is_array($value) && TypeResolver::exists($name)) {
            $method = TypeResolver::getFactoryMethod($name);
            return Factory::$method($value);
        }

        return $value;
    }

    /**
     * Standard getter method
     *
     * @param  string $name
     * @return mixed
     */
    public function get($name)
    {
        return $this->has($name)
            ? $this->properties[$name]
            : null;
    }

    /**
     * Checks that property exists
     *
     * @param  string $name
     * @return bool
     */
    public function has($name): bool
    {
        return $this->__isset($name);
    }

    /**
     * Get a list of all properties and their values
     * as an associative array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_map(
            function($value) {
                return is_object($value)
                    ? $value->toArray()
                    : $value;
            },
            $this->properties
        );
    }

    /**
     * Get a JSON
     *
     * @param  int     $options PHP JSON options
     * @return string
     */
    public function toJson(int $options = 0): string
    {
        return (string)json_encode(
            $this->toArray(),
            $options
        );
    }

    /**
     * Magical isset method
     *
     * @param string $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->properties[$name])
            || array_key_exists($name, $this->properties);
    }

    /**
     * Magical getter method
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->get($name);
    }

    /**
     * Overloading methods
     *
     * @param  string $name
     * @param  array  $arguments
     * @return mixed
     * @throws \Exception when a called method is not defined
     */
    public function __call($name, array $arguments = [])
    {
        // Getters
        if (strpos($name, 'get') === 0) {
            $attr = lcfirst(substr($name, 3));
            return $this->get($attr);
        }

        throw new Exception(
            sprintf('Method "%s" is not defined', $name)
        );
    }
}
