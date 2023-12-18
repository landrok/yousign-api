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

namespace Yousign\Model\V3;

use Yousign\Model\AbstractModelCollection;
use Yousign\YousignClient;

/**
 * UserCollection handles a pool of user data
 */
class UserCollection extends AbstractModelCollection
{
    public string $version = YousignClient::API_VERSION_3;
}