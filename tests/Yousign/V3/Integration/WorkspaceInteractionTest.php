<?php 

namespace YousignTest\V3\Integration;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Yousign\Api\V3\YousignApi;
use YousignTest\V3\Fake\Model\FakeWorkspace;

class WorkspaceInteractionTest extends TestCase
{
    /**
     * Making get user collection
     */
    public function testGetWorkspaceCollection(): void
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(200, [], json_encode(['data' => [FakeWorkspace::getProperties()]])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234', false);

        $response = $yousign->setClientOptions(['handler' => $handlerStack])->getWorkspaces();

        $this->assertEquals($response->toArray(), FakeWorkspace::getCollection()->toArray());
    }
}