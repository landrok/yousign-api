<?php

namespace YousignTest;

/*
 * Emulate responses in advanced mode
 */
abstract class AdvancedModeDataHelper
{
    /**
     * Provide a fake procedure with started = false
     */
    public static function getFakeNonStartedCreatedProcedure(): array
    {
        return [
            "id" => "/procedures/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "name" => "My procedure",
            "description" => "Description of my procedure with advanced mode",
            "createdAt" => "2018-12-01T13:41:43+01:00",
            "updatedAt" => "2018-12-01T13:41:43+01:00",
            "finishedAt" => null,
            "expiresAt" => null,
            "status" => "draft",
            "creator" => null,
            "creatorFirstName" => null,
            "creatorLastName" => null,
            "workspace" => "/workspaces/XXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "template" => false,
            "ordered" => false,
            "parent" => null,
            "metadata" => [],
            "config" => [],
            "members" => [],
            "subscribers" => [],
            "files" => [],
            "relatedFilesEnable" => false,
            "archive" => false,
            "archiveMetadata" => [],
            "fields" => [],
            "permissions" => []
        ];
    }

   /**
     * Provide a fake created file
     */
    public static function getFakeCreatedFile(): array
    {
        return [
            "id" => "/files/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "name" => "Name of my signable file.pdf",
            "type" => "signable",
            "contentType" => "application/pdf",
            "description" => null,
            "createdAt" => "2018-12-01T13:47:01+01:00",
            "updatedAt" => "2018-12-01T13:47:01+01:00",
            "sha256" => "bb57ae2b2ca6ad0133a699350d1a6f6c8cdfde3cf872cf526585d306e4675cc2",
            "metadata" => [],
            "workspace" => "/workspaces/XXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "creator" => null,
            "protected" => false,
            "position" => 0,
            "parent" => null
        ];
    }

   /**
     * Provide a fake created member
     */
    public static function getFakeCreatedMember(): array
    {
        return [
            "id" => "/members/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "user" => null,
            "type" => "signer",
            "firstname" => "John",
            "lastname" => "Doe",
            "email" => "john.doe@yousign.fr",
            "phone" => "+33612345678",
            "position" => 1,
            "createdAt" => "2018-12-01T14:01:53+01:00",
            "updatedAt" => "2018-12-01T14:01:53+01:00",
            "finishedAt" => null,
            "status" => "pending",
            "fileObjects" => [],
            "procedure" => "/procedures/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "comment" => null,
            "notificationsEmail" => [],
            "operationLevel" => "custom",
            "operationCustomModes" => [
                "sms"
            ],
            "operationModeSmsConfig" => null,
            "parent" => null
        ];
    }

   /**
     * Provide a fake created file object
     */
    public static function getFakeCreatedFileObject(): array
    {
        return [
            "id" => "/file_objects/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "file" => "/files/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "page" => 2,
            "position" => "230,499,464,589",
            "fieldName" => null,
            "mention" => "Read and approved",
            "mention2" => "Signed By John Doe",
            "createdAt" => "2018-12-01T17:18:27+01:00",
            "updatedAt" => "2018-12-01T17:18:27+01:00",
            "member" => [
                "id" => "/members/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
                "user" => null,
                "type" => "signer",
                "firstname" => "John",
                "lastname" => "Doe",
                "email" => "john.doe@yousign.fr",
                "phone" => "+33612345678",
                "position" => 1,
                "createdAt" => "2018-12-01T17:07:40+01:00",
                "updatedAt" => "2018-12-01T17:07:40+01:00",
                "finishedAt" => null,
                "status" => "pending",
                "comment" => null,
                "parent" => null,
                "reason" => "Signed by Yousign"
            ],
            "parent" => null
        ];
    }

   /**
     * Provide a fake started procedure
     */
    public static function getFakeStartedProcedure(): array
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
                    "createdAt" => "2018-12-01T17:07:40+01:00",
                    "updatedAt" => "2018-12-01T17:07:40+01:00",
                    "finishedAt" => null,
                    "status" => "pending",
                    "fileObjects" => [
                        [
                            "id" => "/file_objects/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
                            "file" => [
                                "id" => "/files/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
                                "name" => "Name of my signable file.pdf",
                                "type" => "signable",
                                "contentType" => "application/pdf",
                                "description" => null,
                                "createdAt" => "2018-12-01T17:07:07+01:00",
                                "updatedAt" => "2018-12-01T17:07:07+01:00",
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
                            "mention2" => "Signed By John Doe",
                            "createdAt" => "2018-12-01T17:18:27+01:00",
                            "updatedAt" => "2018-12-01T17:18:27+01:00",
                            "parent" => null
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
                    "name" => "Name of my signable file.pdf",
                    "type" => "signable",
                    "contentType" => "application/pdf",
                    "description" => null,
                    "createdAt" => "2018-12-01T17:07:07+01:00",
                    "updatedAt" => "2018-12-01T17:07:07+01:00",
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
    }
}
