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
 * User handles user data
 * 
 * @property string $id in the uuid format
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone_number
 * @property string $locale
 * @property string $avatar
 * @property string $job_title
 * @property bool $is_active
 * @property string $role
 * @property \DateTime $created_at
 * @property WorkspaceCollection $workspaces
 */
class User extends AbstractModel
{

    public string $version = YousignClient::API_VERSION_3;

    public const ROLE_OWNER = 'owner';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_MEMBER = 'member';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getRoleValues()
    {
        return [
            self::ROLE_OWNER,
            self::ROLE_ADMIN,
            self::ROLE_MEMBER,
        ];
    }
}
