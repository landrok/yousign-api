<?php 

namespace YousignTest\V3\Integration;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Yousign\Api\V3\YousignApi;
use YousignTest\V3\Fake\Model\FakeSignatureRequest;

class SignatureRequestInteractionTest extends TestCase
{
    /**
     * Retrieve a signature request
     */
    public function testGetSignatureRequest(): void
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(200, [], json_encode(FakeSignatureRequest::getProperties())),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234', false);

        $response = $yousign->setClientOptions(['handler' => $handlerStack])->getSignatureRequest('1234');

        $this->assertEquals($response->toArray(), FakeSignatureRequest::getModel()->toArray());
    }

    /**
     * Retrieve all signatures requests
     */
    public function testGetSignatureRequestCollection(): void
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(200, [], json_encode([FakeSignatureRequest::getProperties()])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234', false);

        $response = $yousign->setClientOptions(['handler' => $handlerStack])->getSignatureRequests();

        $this->assertEquals($response->toArray(), FakeSignatureRequest::getCollection()->toArray());
    }

    /**
     * Create a signature request
     */
    public function testPostSignatureRequest(): void
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(201, [], json_encode(FakeSignatureRequest::getProperties()))
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234');

        $yousign->setClientOptions(['handler' => $handlerStack]);

        $response = $yousign->postSignatureRequest('A Signature Request', 'email', [
            'ordered_signers' => false,
            'reminder_settings' => [
                'interval_in_days' => 7,
                'max_occurrences' => 5,
            ],
            'timezone' => 'Europe/Paris',
            'email_custom_note' => 'Please sign these documents as soon as possible. Thanks.',
            'external_id' => '1234',
        ]);

        $this->assertEquals($response->toArray(), FakeSignatureRequest::getProperties());
    }

    /**
     * Update a signature request
     */
    public function testPatchSignatureRequest(): void
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(201, [], json_encode(FakeSignatureRequest::getProperties()))
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234');

        $yousign->setClientOptions(['handler' => $handlerStack]);

        $response = $yousign->patchSignatureRequest([
            'ordered_signers' => false,
            'reminder_settings' => [
                'interval_in_days' => 7,
                'max_occurrences' => 5,
            ],
            'timezone' => 'Europe/Paris',
            'email_custom_note' => 'Please sign these documents as soon as possible. Thanks.',
            'external_id' => '1234',
        ]);

        $this->assertEquals($response->toArray(), FakeSignatureRequest::getProperties());
    }

    /**
     * Update a signature request
     */
    public function testDeleteSignatureRequest(): void
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(204, [], null)
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234');

        $yousign->setClientOptions(['handler' => $handlerStack]);

        $response = $yousign->deleteSignatureRequest('1234');

        $this->assertNull($response);
    }
}