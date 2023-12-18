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

final class FakeWorkspace extends AbstractFakeModel
{
    public static function getProperties(): array
    {
        return [
            "id" => "c623b8b5-b11a-4212-b967-04bc8c6cce89",
            "name" => "MY WORKSPACE",
            "created_at" => "2023-11-10T15:05:03+00:00",
            "updated_at" => "2023-11-10T15:11:09+00:00",
            "users" => [
                [
                    "id" => "383b5e0b-6da4-49e5-91a2-3a3ac0a6d65d"
                ]
            ]
        ];
    }

    public static function getModel(): AbstractModel
    {
        return Factory::createWorkspace(static::getProperties());
    }

    public static function getCollection(): AbstractModelCollection
    {
        return Factory::createWorkspaceCollection(['data' => [static::getProperties()]]);
    }
}
