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
 * @param string $status
 * @param string $name
 * @param string $delivery_mode
 * @param \DateTime $created_at
 * @param bool $ordered_signers
 * @param string $timezone
 * @param string $email_custom_note
 * @param \DateTime $expiration_date
 * @param string $source
 * @param SignerCollection $signers
 * @param ApproverCollection $approvers
 * @param DocumentCollection $documents
 * @param SenderCollection $sender
 * @param string $external_id
 * @param string $branding_id
 * @param string $custom_experience_id
 * @param bool $signers_allowed_to_decline
 * @param string $workspace_id
 * @param Notification $email_notification
 */
class SignatureRequest extends AbstractModel
{
    public string $version = YousignClient::API_VERSION_3;
}
