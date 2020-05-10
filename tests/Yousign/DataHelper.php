<?php

namespace YousignTest;

abstract class DataHelper
{
    /**
     * Provide a fake user
     */
    public static function getFakeUser(): array
    {
        return [
            "id" => "/users/0a12345a-ea7f-424a-a684-123456789010",
            "firstname" => "Firstname",
            "lastname" => "LastName",
            "email" => "f.lastname@domain.com",
            "title" => "Technical",
            "phone" => "+33612345678",
            "status" => "activated",
            "organization" => "/organizations/0a12345a-38f9-4a2e-98da-123456789010",
            "workspaces" => [
                "0" => [
                    "id" => "/workspaces/0a12345a-bed2-4a13-8f91-123456789010",
                    "name" => "MY FIRM",
                ]
            ],
            "permission" => "ROLE_ADMIN",
            "group" => [
                "id" => "/user_groups/0a12345a-0548-1234-b914-123456789010",
                "name" => "Administrateur",
                "permissions" => [
                    "0" => "procedure_write",
                    "1" => "procedure_template_write",
                    "2" => "procedure_create_from_template",
                    "3" => "contact",
                    "4" => "sign",
                    "5" => "workspace",
                    "6" => "user",
                    "7" => "api_key",
                    "8" => "procedure_custom_field",
                    "9" => "signature_ui",
                    "10" => "certificate",
                    "11" => "archive",
                    "12" => "contact_custom_field",
                    "13" => "organization",
                ]
            ],
            "createdAt" => "2019-05-06T13:45:59+02:00",
            "updatedAt" => "2019-05-07T19:16:11+02:00",
            "deleted" => null,
            "deletedAt" => null,
            "config" => [],
            "inweboUserRequest" => null,
            "samlNameId" => null,
            "defaultSignImage" => null,
            "notifications" => [
                "procedure" => 1
            ],
            "fastSign" => null,
            "fullName" => null,
        ];
    }

   /**
     * Provide a fake created file
     */
    public static function getFakeCreatedFile(): array
    {
        return [
            "id" => "/files/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "name" => "The best name for my file.pdf",
            "type" => "signable",
            "contentType" => "application/pdf",
            "description" => null,
            "createdAt" => "2018-12-01T11:36:20+01:00",
            "updatedAt" => "2018-12-01T11:36:20+01:00",
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
     * Provide a fake created procedure
     */
    public static function getFakeCreatedProcedure(): array
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
    }
}
