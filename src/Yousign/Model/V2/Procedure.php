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

namespace Yousign\Model\V2;

use Yousign\Model\AbstractModel;

/**
 * Procedure handles procedure data
 *
 * @property string $id
 * @property string $description
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $finishedAt
 * @property string $expiresAt
 * @property string $status
 * @property string $creator
 * @property string $creatorFirstName
 * @property string $creatorLastName
 * @property string $workspace
 * @property bool $template
 * @property bool $ordered
 * @property string $parent
 * @property array $metadata
 * @property array $config
 * @property MemberCollection $members
 */
class Procedure extends AbstractModel
{
}
