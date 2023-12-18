<?php

declare(strict_types=1);

/*
 * This file is part of the Yousign package.
 *
 * Copyright (c) landrok at github.com/landrok
 *
 * For the full copyright and license information, please see
 * <https://github.com/landrok/yousign-api/blob/master/LICENSE>.
 */

namespace Yousign\Model\V3;

use Yousign\Model\AbstractModel;
use Yousign\YousignClient;

/**
 * Workspace handles user data
 * 
 * @property string $id
 * @property string $name
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 */
class Workspace extends AbstractModel
{
    public string $version = YousignClient::API_VERSION_3;
}
