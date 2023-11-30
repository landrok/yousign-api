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

use Yousign\Model\AbstractModel;

/*
 * @implements \IteratorAggregate<int, AbstractModel>
 *
 * @method int count()
 */
abstract class AbstractModelCollection implements \IteratorAggregate
{
    /**
     * @var \SplDoublyLinkedList
     */
    protected \SplDoublyLinkedList $stack;

    final public function __construct()
    {
        $this->stack = new \SplDoublyLinkedList();
    }

    /**
     * Add a new model to the collection
     */
    public function add(AbstractModel $model): self
    {
        $this->stack->push($model);

        return $this;
    }
    
    /**
     * @return \SplDoublyLinkedList
     */
    public function getIterator(): \SplDoublyLinkedList
    {
        return $this->stack;
    }

    /**
     * Get a list of all properties and their values
     * as an associative array.
     *
     * @return array<mixed>
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

        throw new \Exception(
            sprintf('Method "%s" is not defined', $name)
        );
    }
}
