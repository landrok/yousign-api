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

final class FakeProcedureStarted extends FakeProcedure
{
    public static function getProperties(): array
    {
        return [
            "id" => "/procedures/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "name" => "My procedure",
            "description" => "Description of my procedure with advanced mode",
            "createdAt" => "2018-12-01T17:05:28+01:00",
            "updatedAt" => "2018-12-01T17:19:43+01:00",
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
}
