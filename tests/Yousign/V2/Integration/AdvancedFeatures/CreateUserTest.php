<?php

namespace YousignTest\V2\Integration\AdvancedFeatures;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Yousign\Api\V2\YousignApi;
use YousignTest\V2\Fake\Model\FakeUser;

class CreateUserTest extends TestCase
{
    /**
     * Create user
     */
    public function testSuccess()
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(201, [], json_encode(FakeUser::getProperties()), true)
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234');

        $yousign
            ->setClientOptions([
                'handler' => $handlerStack
        ]);

        $user = $yousign->postUser([
            "firstname" => "John",
            "lastname" => "Doe",
            "email" => "api@yousign.fr",
            "title" => "API teacher",
            "phone" => "+33612345678",
            "organization" => "/organizations/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX"
        ]);

        $this->assertEquals(
            FakeUser::getProperties(),
            $user->toArray()
        );
    }
}
