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

class FakeFileObject extends AbstractFakeModel
{
    public static function getProperties(): array
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
            "member" => FakeMember::getProperties(),
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
