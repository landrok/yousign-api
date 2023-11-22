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

final class FakeUser extends AbstractFakeModel
{
    public static function getProperties(): array
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

    public static function getModel(): AbstractModel
    {
        return Factory::createUser(static::getProperties());
    }

    public static function getCollection(): AbstractModelCollection
    {
        return Factory::createUserCollection(static::getProperties());
    }
}
