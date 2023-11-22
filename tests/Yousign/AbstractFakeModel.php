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

namespace YousignTest;

use Yousign\Model\AbstractModel;
use Yousign\Model\AbstractModelCollection;

abstract class AbstractFakeModel
{

    /**
     * @return array<mixed>
     */
    abstract public static function getProperties(): array;

    abstract public static function getModel(): AbstractModel;

    abstract public static function getCollection(): AbstractModelCollection;

}
