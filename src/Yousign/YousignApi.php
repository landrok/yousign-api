<?php

namespace Yousign;

use Yousign\Model\Factory;
use Yousign\Model\File;
use Yousign\Model\FileObject;
use Yousign\Model\Member;
use Yousign\Model\Procedure;
use Yousign\Model\User;
use Yousign\Model\UserCollection;
use Yousign\Process\BasicProcess;

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
class YousignApi
{
    /**
     * Authenticated HTTP client for Yousign API
     *
     * @var \Yousign\YousignClient
     */
    private $client;

    public function __construct(string $token, bool $production = false)
    {
        $this->client = new YousignClient($token, $production);
    }

    /**
     * A shortcut for integration tests
     * It helps configuring low-level client options
     *
     * @return self
     */
    public function setClientOptions(array $options): self
    {
        $this->client->setOptions($options);

        return $this;
    }

    /**
     * Post a file to the API
     *
     * @return \Yousign\Model\File
     */
    public function postFile(array $file): File
    {
        $response = $this->client->post(
            '/files', [
                'body' => json_encode($file)
            ]
        );

        return Factory::createFile(
            json_decode($response->getBody(), true)
        );
    }

    /**
     * Post a procedure to the API
     *
     * @return \Yousign\Model\Procedure
     */
    public function postProcedure(array $procedure): Procedure
    {
        $response = $this->client->post(
            '/procedures', [
                'body' => json_encode($procedure)
            ]
        );

        return Factory::createProcedure(
            json_decode($response->getBody(), true)
        );
    }

    /**
     * Put a procedure to the API
     *
     * @return \Yousign\Model\Procedure
     */
    public function putProcedure(string $id, array $procedure): Procedure
    {
        $response = $this->client->put(
            $id, [
                'body' => json_encode($procedure)
            ]
        );

        return Factory::createProcedure(
            json_decode($response->getBody(), true)
        );
    }

    /**
     * Post a member to the API
     *
     * @return \Yousign\Model\Member
     */
    public function postMember(array $member): Member
    {
        $response = $this->client->post(
            '/members', [
                'body' => json_encode($member)
            ]
        );

        return Factory::createMember(
            json_decode($response->getBody(), true)
        );
    }

    /**
     * Post a file object to the API
     *
     * @return \Yousign\Model\FileObject
     */
    public function postFileObject(array $fileObject): FileObject
    {
        $response = $this->client->post(
            '/file_objects', [
                'body' => json_encode($fileObject)
            ]
        );

        return Factory::createFileObject(
            json_decode($response->getBody(), true)
        );
    }

    /**
     * Get all users
     *
     * @return \Yousign\Model\UserCollection
     * @throws \Exception When HTTP client receive an error (4xx or 5xx)
     */
    public function getUsers(): UserCollection
    {
        $response = $this->client->get('/users');

        return Factory::createUserCollection(
            json_decode($response->getBody(), true)
        );
    }

    /**
     * Create an user
     *
     * @return \Yousign\Model\User
     */
    public function postUser(array $user): User
    {
        $response = $this->client->post(
            '/users', [
                'body' => json_encode($user)
            ]
        );

        return Factory::createUser(
            json_decode($response->getBody(), true)
        );
    }

    /**
     * Basic mode
     */
    public function basic(): BasicProcess
    {
        return new BasicProcess($this);
    }
}
