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

/**
 * \Yousign\Model\PermissionCollection handles a pool of permission data
 */
class PermissionCollection extends AbstractModelCollection
{
    /**
     * Override because permissions are strings
     *
     * @return array
     */
    public function toArray(): array
    {
        $stack = [];

        foreach ($this->stack as $index => $value) {
            $stack[] = current($value->toArray());
        }

        return $stack;
    }
}
