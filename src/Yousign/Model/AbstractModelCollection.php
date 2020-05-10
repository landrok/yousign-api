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
use IteratorAggregate;
use SplStack;

/*
 * @implements \IteratorAggregate<int, AbstractModel>
 */
abstract class AbstractModelCollection implements IteratorAggregate
{
    /**
     * @var \SplStack
     *
     * Internal stack
     */
    protected $stack;

    final public function __construct()
    {
        $this->stack = new SplStack();
    }

    /**
     * Add a new model to the collection
     */
    public function add(AbstractModel $model): self
    {
        $this->stack->push($model);

        return $this;
    }

    /*
     * @return \SplStack<int, AbstractModel>
     */
    public function getIterator(): SplStack
    {
        return $this->stack;
    }

    /**
     * Get a list of all properties and their values
     * as an associative array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $stack = [];

        foreach ($this->stack as $index => $value) {
            $stack[$index] = $value->toArray();
        }

        return array_reverse($stack);
    }

    /**
     * Overloading methods
     *
     * @param  string $name
     * @param  array  $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this->stack, $name)) {
            return $this->stack->$name(...$arguments);
        }

        throw new Exception(
            sprintf('Method "%s" is not defined', $name)
        );
    }
}
