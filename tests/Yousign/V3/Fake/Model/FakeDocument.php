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

namespace YousignTest\V3\Fake\Model;

use Yousign\Model\AbstractModel;
use Yousign\Model\AbstractModelCollection;
use Yousign\Model\V3\Factory;
use YousignTest\AbstractFakeModel;

final class FakeDocument extends AbstractFakeModel
{
    public static function getProperties(): array
    {
        return [
            'id' => 'ddbde82b-03f2-4a39-9d51-a2476da2cdd2',
            'filename' => 'dummy.pdf',
            'nature' => 'signable_document',
            'content_type' => 'application/pdf',
            'sha256' => '3df79d34abbca99308e79cb94461c1893582604d68329a41fd4bec1885e6adb4',
            'is_protected' => false,
            'is_signed' => false,
            'created_at' => '2023-12-14T23:01:39+00:00',
            'total_pages' => 1,
            'is_locked' => false,
            'initials' => null,
            'total_anchors' => 0
        ];
    }

    public static function getModel(): AbstractModel
    {
        return Factory::createUser(static::getProperties());
    }

    public static function getCollection(): AbstractModelCollection
    {
        return Factory::createUserCollection(['data' => [static::getProperties()]]);
    }
}
