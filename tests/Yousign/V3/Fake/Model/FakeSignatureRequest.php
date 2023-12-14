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
use YousignTest\AbstractFakeModel;

final class FakeSignatureRequest extends AbstractFakeModel
{
    public static function getProperties(): array
    {
        return [
            'id' => '0a12345a-ea7f-424a-a684-123456789010',
            'status' => 'ongoing',
            'name' => 'A Signature Request',
            'delivery_mode' => 'email',
            'created_at' => '2023-11-10T15:05:03+00:00',
            'ordered_signers' => false,
            'timezone' => 'Europe/Paris',
            'email_custom_note' => 'Please sign these documents as soon as possible. Thanks.',
            'expiration_date' => '2024-06-14T21:59:00+00:00',
            'source' => 'public_api',
            'signers' => [],
            'approvers' => [],
            'documents' => [],
            'sender' => null,
            'external_id' => '1234',
            'branding_id' => null,
            'custom_experience_id' => null,
            'signers_allowed_to_decline' => false,
            'workspace_id' => 'c623b8b5-b11a-4212-b967-04bc8c6cce89',
            'email_notification' => [
                'sender' => [
                    'type' => 'organization',
                    'custom_name' => null
                ]
            ],
        ];
    }

    public static function getModel(): AbstractModel
    {
        return Factory::createUser(static::getProperties());
    }

    public static function getCollection(): AbstractModelCollection
    {
        return Factory::createUserCollection([static::getProperties()]);
    }
}
