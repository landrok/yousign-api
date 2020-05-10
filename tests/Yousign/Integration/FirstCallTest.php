<?php

namespace YousignTest\Integration;

use Exception;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use YousignTest\DataHelper;
use Yousign\YousignApi;

class FirstCallTest extends TestCase
{
    /**
     * Making first call helper method
     */
    public function firstCallSuccess($production = false)
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(200, [], json_encode([DataHelper::getFakeUser()])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234', $production);
        return $yousign->setClientOptions([
            'handler' => $handlerStack
        ])->getUsers();

    }

    /**
     * Making first call on staging environment
     */
    public function testFirstCallSuccessStaging()
    {
        $users = $this->firstCallSuccess(false);

        // Assert type
        $this->assertEquals(
            [DataHelper::getFakeUser()],
            $users->toArray()
        );
    }

    /**
     * Making first call on production environment
     */
    public function testFirstCallSuccessProduction()
    {
        $users = $this->firstCallSuccess(true);

        // Assert type
        $this->assertEquals(
            [DataHelper::getFakeUser()],
            $users->toArray()
        );
    }

    /**
     * Failures provider
     */
    public function getFailures()
    {
        // Create a mock handler
        $bases = [
            'Request error' => function () {
                return new MockHandler([
                    new RequestException(
                        'Error Communicating with Server',
                        new Request('GET', '/users')
                    )
                ]);
            },
            'Transfer error' => function () {
                return new MockHandler([
                    new TransferException(
                        'Transfer error'
                    )
                ]);
            },
        ];

        $scenarios = [];

        foreach ($bases as $name => $base) {
            $scenarios["Production - $name"] = [$base(), true];
            $scenarios["Staging - $name"] = [$base(), false];
        }

        return $scenarios;
    }

    /**
     * Failures testing
     *
     * @dataProvider getFailures()
     */
    public function testFailures($mock, $production)
    {
        $this->expectException(Exception::class);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234', $production);

        $yousign->setClientOptions([
            'handler' => $handlerStack
        ])->getUsers();
    }
}
