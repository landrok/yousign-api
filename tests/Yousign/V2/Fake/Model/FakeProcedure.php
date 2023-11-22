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

namespace YousignTest\V2\Fake\Model;

use Yousign\Model\AbstractModel;
use Yousign\Model\AbstractModelCollection;
use Yousign\Model\V2\Factory;
use YousignTest\AbstractFakeModel;

class FakeProcedure extends AbstractFakeModel
{
    public static function getProperties(): array
    {
        return [
            "id" => "/procedures/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "name" => "My first procedure",
            "description" => "Awesome! Here is the description of my first procedure",
            "createdAt" => "2018-12-01T11:49:11+01:00",
            "updatedAt" => "2018-12-01T11:49:11+01:00",
            "finishedAt" => null,
            "expiresAt" => null,
            "status" => "active",
            "creator" => null,
            "creatorFirstName" => null,
            "creatorLastName" => null,
            "workspace" => "/workspaces/XXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "template" => false,
            "ordered" => false,
            "parent" => null,
            "metadata" => [],
            "config" => [],
            "members" => [FakeMember::getProperties()],
            "subscribers" => [],
            "files" => [FakeFile::getProperties()],
            "relatedFilesEnable" => false,
            "archive" => false,
            "archiveMetadata" => [],
            "fields" => [],
            "permissions" => []
        ];
    }

    public static function getModel(): AbstractModel
    {
        return Factory::createUser(static::getProperties());
    }

    public static function getCollection(): AbstractModelCollection
    {
        return Factory::createUserCollection(static::getProperties());
    }
}
