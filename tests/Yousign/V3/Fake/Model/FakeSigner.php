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

final class FakeSigner extends AbstractFakeModel
{
    public static function getProperties(): array
    {
        return [
            'id' => 'd25d1a1c-c037-45ff-b952-49d6387b20bb',
            'info' => [
                'first_name' => 'Firstname',
                'last_name' => 'Lastname',
                'email' => 'signer@email.com',
                'phone_number' => '+33730000000',
                'locale' => 'fr'
            ],
            'status' => 'initiated',
            'signature_link' => null,
            'signature_link_expiration_date' => null,
            'signature_image_preview' => 'https://api-sandbox.yousign.app/signature_requests/1788b68d-18f5-4c92-9b75-d4c4e8f08970/recipients/d25d1a1c-c037-45ff-b952-49d6387b20bb/preview.c827e6bf4110e5b91be082e3b4ea0204106ee7f9.svg',
            'fields' => null,
            'signature_level' => 'electronic_signature',
            'signature_authentication_mode' => 'no_otp',
            'redirect_urls' => [
                'success' => null,
                'error' => null
            ],
            'custom_text' => [
                'request_subject' => null,
                'request_body' => null,
                'reminder_subject' => null,
                'reminder_body' => null
            ],
            'delivery_mode' => null
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
