<?php

declare(strict_types=1);

namespace Yousign\Api\V3;

use Yousign\Api\AbstractApi;
use Yousign\Model\V3\Factory;
use Yousign\Model\V3\User;
use Yousign\Model\V3\UserCollection;
use Yousign\YousignClient;

/*
 * API wrapper
 *
 * Usage
 * -----
 *
 * - Get all users (ie Making first call)
 *
 * $token = '123456789';
 * $yousign = new YousignApi($token, $production = false);
 * print_r( $yousign->getUsers() ); // Return a UserCollection model
 */
final class YousignApi extends AbstractApi
{
    /**
     * Authenticated HTTP client for Yousign API
     */
    protected YousignClient $client;

    public function __construct(string $token, bool $production = false)
    {
        $this->client = new YousignClient($token, $production, YousignClient::API_VERSION_3);
    }

    /**
     * Get all users
     *
     * @throws \Exception When HTTP client receive an error (4xx or 5xx)
     */
    public function getUsers(): UserCollection
    {
        $response = $this->client->get('/users');

        return Factory::createUserCollection(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Create an user
     */
    public function postUser(array $user): User
    {
        $response = $this->client->post(
            '/users', [
                'body' => json_encode($user)
            ]
        );

        return Factory::createUser(
            json_decode((string) $response->getBody(), true)
        );
    }
}
