<?php

namespace YousignTest;

abstract class DataHelper
{
    /**
     * Provide a fake created user
     */
    public static function getFakeCreatedUser(): array
    {
        return json_decode('{
    "id": "/users/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
    "firstname": "John",
    "lastname": "Doe",
    "email": "api@yousign.fr",
    "title": "API teacher",
    "phone": "+33612345678",
    "status": "not_activated",
    "organization": "/organizations/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
    "workspaces": [
        {
            "id": "/workspaces/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "name": "Acme"
        }
    ],
    "permission": "ROLE_MANAGER",
    "group": {
        "id": "/user_groups/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
        "name": "Gestionnaire",
        "permissions": [
            "procedure_write",
            "procedure_template_write",
            "procedure_create_from_template",
            "contact",
            "archive"
        ]
    },
    "createdAt": "2018-12-03T07:33:01+01:00",
    "updatedAt": "2018-12-03T07:33:01+01:00",
    "deleted": false,
    "deletedAt": null,
    "config": [],
    "inweboUserRequest": null,
    "samlNameId": null,
    "defaultSignImage": null,
    "notifications": {
        "procedure": true
    },
    "fastSign": false,
    "fullName": "John Doe"
}', true);

    }
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
                    "createdAt"   => "2018-12-01T11:36:20+01:00",
                    "updatedAt"   => "2018-12-01T11:49:11+01:00",
                    "sha256"      => "bb57ae2b2ca6ad0133a699350d1a6f6c8cdfde3cf872cf526585d306e4675cc2",
                    "metadata"    => [],
                    "workspace"   => "/workspaces/XXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
                    "creator"     => null,
                    "protected"   => false,
                    "position"    => 0,
                    "parent"      => null
                ]
            ],
            "relatedFilesEnable" => false,
            "archive" => false,
            "archiveMetadata" => [],
            "fields" => [],
            "permissions" => []
        ];
    }

    public static function getFakeCreatedUi(): array
    {
        return [
            "id"                      => "/signature_uis/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "name"                    => "My first template for Signature-UI",
            "description"             => "Here is the Signature-UI template for Yousign Developers.",
            "enableHeaderBar"         => true,
            "enableHeaderBarSignAs"   => true,
            "enableSidebar"           => true,
            "enableMemberList"        => true,
            "enableDocumentList"      => true,
            "enableDocumentDownload"  => true,
            "enableActivities"        => true,
            "authenticationPopup"     => true,
            "enableRefuseComment"     => true,
            "defaultZoom"             => 100,
            "logo"                    => "data:image/png;base64,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",
            "defaultLanguage"         => "en",
            "signImageTypesAvailable" => [
                "name",
                "draw"
            ],
            "languages"               => [
                "fr",
                "en",
                "es",
                "de",
                "it",
                "pt",
                "nl"
            ],
            "labels"                  => [
                [
                    "id"        => "/signature_ui_labels/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
                    "name"      => "NAME OF THE LABEL",
                    "languages" => [
                        "en" => "Label en",
                        "fr" => "Label fr"
                    ],
                    "creator"   => null,
                    "createdAt" => "2018-12-07T07:34:22+01:00",
                    "updatedAt" => "2018-12-07T07:34:22+01:00"
                ]
            ],
            "fonts"                   => [
                "Roboto",
                "Lato"
            ],
            "style"                   => "Just a CSS string for customize all of our iFrame.",
            "redirectCancel"          => [
                "url"    => "https://example.com?cancel=1",
                "target" => "_top",
                "auto"   => false
            ],
            "redirectError"           => [
                "url"    => "https://example.com?error=1",
                "target" => "_blank",
                "auto"   => true
            ],
            "redirectSuccess"           => [
                "url"    => "https://example.com?success=1",
                "target" => "_parent",
                "auto"   => true
            ],
            "workspace"               => "/workspaces/XXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "creator"                 => null,
            "createdAt"               => "2018-12-07T07:34:22+01:00",
            "updatedAt"               => "2018-12-07T07:34:22+01:00"
        ];
    }
}
