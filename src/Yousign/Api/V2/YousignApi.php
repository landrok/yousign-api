<?php

declare(strict_types=1);

namespace Yousign\Api\V2;

use Yousign\Api\AbstractApi;
use Yousign\Model\V2\Factory;
use Yousign\Model\V2\File;
use Yousign\Model\V2\FileObject;
use Yousign\Model\V2\Member;
use Yousign\Model\V2\Procedure;
use Yousign\Model\V2\SignatureUi;
use Yousign\Model\V2\User;
use Yousign\Model\V2\UserCollection;
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
    public YousignClient $client;

    public function __construct(string $token, bool $production = false)
    {
        $this->client = new YousignClient($token, $production, YousignClient::API_VERSION_2);
    }

    /**
     * Post a file to the API
     */
    public function postFile(array $file): File
    {
        $response = $this->client->post(
            '/files', [
                'body' => json_encode($file)
            ]
        );

        return Factory::createFile(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Post a procedure to the API
     */
    public function postProcedure(array $procedure): Procedure
    {
        $response = $this->client->post(
            '/procedures', [
                'body' => json_encode($procedure)
            ]
        );

        return Factory::createProcedure(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Put a procedure to the API
     */
    public function putProcedure(string $id, array $procedure): Procedure
    {
        $response = $this->client->put(
            $id, [
                'body' => json_encode($procedure)
            ]
        );

        return Factory::createProcedure(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Post a member to the API
     */
    public function postMember(array $member): Member
    {
        $response = $this->client->post(
            '/members', [
                'body' => json_encode($member)
            ]
        );

        return Factory::createMember(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Post a file object to the API
     */
    public function postFileObject(array $fileObject): FileObject
    {
        $response = $this->client->post(
            '/file_objects', [
                'body' => json_encode($fileObject)
            ]
        );

        return Factory::createFileObject(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Create template for Signature-UI with the API
     */
    public function postSignatureUi(array $signatureUi): SignatureUi
    {
        $response = $this->client->post(
            '/signature_uis', [
                'body' => json_encode($signatureUi)
            ]
        );

        return Factory::createSignatureUi(
            json_decode((string) $response->getBody(), true)
        );
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
