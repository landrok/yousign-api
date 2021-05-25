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

use Exception;
use IteratorAggregate;
use SplDoublyLinkedList;

/*
 * @implements \IteratorAggregate<int, AbstractModel>
 *
 * @method int count()
 */
abstract class AbstractModelCollection implements IteratorAggregate
{
    /**
     * @var \SplDoublyLinkedList
     *
     * Internal stack
     */
    protected $stack;

    final public function __construct()
    {
        $this->stack = new SplDoublyLinkedList();
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
    public function getIterator(): SplDoublyLinkedList
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
        $this->stack->rewind();

        foreach ($this->stack as $index => $value) {
            $stack[] = $value->toArray();
        }

        return $stack;
    }

    /**
     * Overloading methods
     *
     * @return mixed
     */
    public function __call(string $name, array $arguments = [])
    {
        if (method_exists($this->stack, $name)) {
            return $this->stack->$name(...$arguments);
        }

        throw new Exception(
            sprintf('Method "%s" is not defined', $name)
        );
    }
}
