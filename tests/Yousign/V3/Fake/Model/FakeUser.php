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
use Yousign\Model\V3\User;
use YousignTest\AbstractFakeModel;

final class FakeUser extends AbstractFakeModel
{
    public static function getProperties(): array
    {
        return [
            "id" => "0a12345a-ea7f-424a-a684-123456789010",
            "first_name" => "Firstname",
            "last_name" => "LastName",
            "email" => "f.lastname@domain.com",
            "phone_number" => "+33612345678",
            "locale" => "fr",
            "avatar" => "https://api-sandbox.yousign.app/users/fake",
            "job_title" => "Technical",
            "is_active" => true,
            "role" => User::ROLE_OWNER,
            "workspaces" => [
                "0" => [
                    "id" => "0a12345a-bed2-4a13-8f91-123456789010",
                ]
            ],
            "createdAt" => "2023-11-10T15:05:03+00:00",
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
