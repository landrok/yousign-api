<?php

declare(strict_types=1);

/*
 * This file is part of the Yousign package.
 *
 * Copyright (c) landrok at github.com/landrok
 *
 * For the full copyright and license information, please see
 * <https://github.com/landrok/yousign-api/blob/master/LICENSE>.
 */

namespace Yousign\Model;

/**
 * \Yousign\Model\Procedure handles procedure data
 *
 * @property string $id                 Ex: /procedures/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
 * @property string $description
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $finishedAt
 * @property string $expiresAt
 * @property string $status
 * @property string $creator
 * @property string $creatorFirstName
 * @property string $creatorLastName
 * @property string $workspace          ie: /workspaces/XXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
 * @property bool   $template
 * @property bool   $ordered
 * @property string $parent
 * @property array  $metadata
 * @property array  $config
 * @property MemberCollection  $members

            "members" => [
                [
                    "id" => "/members/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
                    "user" => null,
                    "type" => "signer",
                    "firstname" => "John",
                    "lastname" => "Doe",
                    "email" => "john.doe@yousign.fr",
                    "phone" => "+33612345678",
                    "position" => 1,
                    "createdAt" => "2018-12-01T11:49:11+01:00",
                    "updatedAt" => "2018-12-01T11:49:11+01:00",
                    "finishedAt" => null,
                    "status" => "pending",
                    "fileObjects" => [
                        [
                            "id" => "/file_objects/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
                            "file" => [
                                "id" => "/files/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
                                "name" => "The best name for my file.pdf",
                                "type" => "signable",
                                "contentType" => "application/pdf",
                                "description" => null,
                                "createdAt" => "2018-12-01T11 =>36 =>20+01 =>00",
                                "updatedAt" => "2018-12-01T11 =>49 =>11+01 =>00",
                                "sha256" => "bb57ae2b2ca6ad0133a699350d1a6f6c8cdfde3cf872cf526585d306e4675cc2",
                                "metadata" => [],
                                "workspace" => "/workspaces/XXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
                                "creator" => null,
                                "protected" => false,
                                "position" => 0,
                                "parent" => null
                            ],
                            "page" => 2,
                            "position" => "230,499,464,589",
                            "fieldName" => null,
                            "mention" => "Read and approved",
                            "mention2" => "Signed by John Doe",
                            "createdAt" => "2018-12-01T11:49:11+01:00",
                            "updatedAt" => "2018-12-01T11:49:11+01:00",
                            "parent" => null,
                            "reason" => "Signed by Yousign"
                        ]
                    ],
                    "comment" => null,
                    "notificationsEmail" => [],
                    "operationLevel" => "custom",
                    "operationCustomModes" => [
                        "sms"
                        ],
                    "operationModeSmsConfig" => null,
                    "parent" => null
                ]
            ],
            "subscribers" => [],
            "files" => [
                [
                    "id" => "/files/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
                    "name" => "The best name for my file.pdf",
                    "type" => "signable",
                    "contentType" => "application/pdf",
                    "description" => null,
                    "createdAt" => "2018-12-01T11:36:20+01:00",
                    "updatedAt" => "2018-12-01T11:49:11+01:00",
                    "sha256" => "bb57ae2b2ca6ad0133a699350d1a6f6c8cdfde3cf872cf526585d306e4675cc2",
                    "metadata" => [],
                    "workspace" => "/workspaces/XXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
                    "creator" => null,
                    "protected" => false,
                    "position" => 0,
                    "parent" => null
                ]
            ],
            "relatedFilesEnable" => false,
            "archive" => false,
            "archiveMetadata" => [],
            "fields" => [],
            "permissions" => []
        ];
 */
class Procedure extends AbstractModel
{
}
