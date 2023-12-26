<?php 

namespace YousignTest\V3\Integration;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Yousign\Api\V3\YousignApi;
use YousignTest\V3\Fake\Model\FakeSigner;

class SignerInteractionTest extends TestCase
{
    /**
     * Retrieve a signature request
     */
    public function testGetSigner(): void
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(200, [], json_encode(FakeSigner::getProperties())),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234', false);

        $response = $yousign->setClientOptions(['handler' => $handlerStack])->getSigner('1234', '1234');

        $this->assertEquals($response->toArray(), FakeSigner::getModel()->toArray());
    }

    /**
     * Retrieve all signatures requests
     */
    public function testGetSignerCollection(): void
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(200, [], json_encode(['data' => [FakeSigner::getProperties()]])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234', false);

        $response = $yousign->setClientOptions(['handler' => $handlerStack])->getSigners('1234');

        $this->assertEquals($response->toArray(), FakeSigner::getCollection()->toArray());
    }

    /**
     * Create a signature request
     */
    public function testPostSigner(): void
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(201, [], json_encode(FakeSigner::getProperties()))
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234');

        $yousign->setClientOptions(['handler' => $handlerStack]);

        $response = $yousign->postSigner(
            '1234',
            'Firstname',
            'Lastname',
            '+33123456789',
            'signer@email.com',
            'fr',
            'electronic_signature',
            [
                'signature_authentication_mode' => 'no_otp'
            ]
        );

        $this->assertEquals($response->toArray(), FakeSigner::getProperties());
    }

    /**
     * Update a signature request
     */
    public function testPatchSigner(): void
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(201, [], json_encode(FakeSigner::getProperties()))
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234');

        $yousign->setClientOptions(['handler' => $handlerStack]);

        $response = $yousign->patchSigner('1234', '1234', [
            'ordered_signers' => false,
            'reminder_settings' => [
                'interval_in_days' => 7,
                'max_occurrences' => 5,
            ],
            'timezone' => 'Europe/Paris',
            'email_custom_note' => 'Please sign these documents as soon as possible. Thanks.',
            'external_id' => '1234',
        ]);

        $this->assertEquals($response->toArray(), FakeSigner::getProperties());
    }

    /**
     * Update a signature request
     */
    public function testDeleteSigner(): void
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(204, [], null)
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234');

        $yousign->setClientOptions(['handler' => $handlerStack]);

        $response = $yousign->deleteSigner('1234', '1234');

        $this->assertNull($response);
    }
}