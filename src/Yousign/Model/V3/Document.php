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
 * Document handles document data
 * 
 * @param string $id
 * @param string $filename
 * @param string $nature
 * @param string $content_type
 * @param string $sha256
 * @param bool $is_protected
 * @param bool $is_signed
 * @param \DateTime $created_at
 * @param int $total_pages
 * @param bool $is_locked
 * @param DocumentInitials $initials
 * @param int $total_anchors
 */
class Document extends AbstractModel
{
    public string $version = YousignClient::API_VERSION_3;
}
