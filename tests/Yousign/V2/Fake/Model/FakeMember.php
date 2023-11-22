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

final class FakeMember extends AbstractFakeModel
{
    public static function getProperties(): array
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
            "operationCustomModes" => ["sms"],
            "operationModeSmsConfig" => null,
            "parent" => null
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
