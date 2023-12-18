<?php 

namespace YousignTest\V3\Integration;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Yousign\Api\V3\YousignApi;
use YousignTest\V3\Fake\Model\FakeDocument;

class DocumentInteractionTest extends TestCase
{
    /**
     * Retrieve a signature request
     */
    public function testGetDocument(): void
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(200, [], json_encode(FakeDocument::getProperties())),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234', false);

        $response = $yousign->setClientOptions(['handler' => $handlerStack])->getDocument('1234', '1234');

        $this->assertEquals($response->toArray(), FakeDocument::getModel()->toArray());
    }

    /**
     * Retrieve all signatures requests
     */
    public function testGetDocumentCollection(): void
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(200, [], json_encode(['data' => [FakeDocument::getProperties()]])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234', false);

        $response = $yousign->setClientOptions(['handler' => $handlerStack])->getDocuments('1234');

        $this->assertEquals($response->toArray(), FakeDocument::getCollection()->toArray());
    }

    /**
     * Create a signature request
     */
    public function testPostDocument(): void
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(201, [], json_encode(FakeDocument::getProperties()))
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234');
        $filePath = dirname(__DIR__, 3) . '/samples/test-file-1.pdf';
        $file = new \SplFileInfo($filePath);

        $yousign->setClientOptions(['handler' => $handlerStack]);

        $response = $yousign->postDocument('1234', $file, 'signable_document', [
            'ordered_signers' => false,
            'reminder_settings' => [
                'interval_in_days' => 7,
                'max_occurrences' => 5,
            ],
            'timezone' => 'Europe/Paris',
            'email_custom_note' => 'Please sign these documents as soon as possible. Thanks.',
            'external_id' => '1234',
        ]);

        $this->assertEquals($response->toArray(), FakeDocument::getProperties());
    }

    /**
     * Update a signature request
     */
    public function testPatchDocument(): void
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(201, [], json_encode(FakeDocument::getProperties()))
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234');

        $yousign->setClientOptions(['handler' => $handlerStack]);

        $response = $yousign->patchDocument('1234', '1234', [
            'ordered_signers' => false,
            'reminder_settings' => [
                'interval_in_days' => 7,
                'max_occurrences' => 5,
            ],
            'timezone' => 'Europe/Paris',
            'email_custom_note' => 'Please sign these documents as soon as possible. Thanks.',
            'external_id' => '1234',
        ]);

        $this->assertEquals($response->toArray(), FakeDocument::getProperties());
    }

    /**
     * Update a signature request
     */
    public function testDeleteDocument(): void
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(204, [], null)
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234');

        $yousign->setClientOptions(['handler' => $handlerStack]);

        $response = $yousign->deleteDocument('1234', '1234');

        $this->assertNull($response);
    }
}