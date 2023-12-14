<?php

declare(strict_types=1);

namespace Yousign\Api\V3;

use Yousign\Api\AbstractApi;
use Yousign\Model\V3\Factory;
use Yousign\Model\V3\SignatureRequest;
use Yousign\Model\V3\SignatureRequestCollection;
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
     * @return UserCollection
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
     * 
     * @return User
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

    /**
     * Get a signature request
     *
     * @param  string $signatureRequestId
     * @return SignatureRequest
     */
    public function getSignatureRequest(string $signatureRequestId): SignatureRequest
    {
        $response = $this->client->get("/signature_requests/{$signatureRequestId}");

        return Factory::createSignatureRequest(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Get all signatures requests
     *
     * @return SignatureRequestCollection
     */
    public function getSignatureRequests(): SignatureRequestCollection
    {
        $response = $this->client->get("/signature_requests");

        return Factory::createSignatureRequestCollection(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Post a signature request
     *
     * @param  string $name
     * @param  string $deliveryMode Enum: "email", "none"
     * @param  array<mixed> $params
     * @return SignatureRequest
     */
    public function postSignatureRequest(string $name, string $deliveryMode, array $params = []): SignatureRequest
    {
        $response = $this->client->post('/signature_requests', [
            'name'          => $name,
            'delivery_mode' => $deliveryMode,
            ...$params
        ]);

        return Factory::createSignatureRequest(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Patch a signature request
     *
     * @param  array<mixed> $params
     * @return SignatureRequest
     */
    public function patchSignatureRequest($params = []): SignatureRequest
    {
        $response = $this->client->patch('/signature_requests', $params);

        return Factory::createSignatureRequest(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Delete a signature request
     *
     * @param  string $signatureRequestId
     * @return null
     */
    public function deleteSignatureRequest(string $signatureRequestId)
    {
        $this->client->delete("/signature_requests/{$signatureRequestId}");

        return null;
    }
}
