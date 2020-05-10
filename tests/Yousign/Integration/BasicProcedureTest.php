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

class BasicProcedureTest extends TestCase
{
    /**
     * Test that there is at least one file before execute
     * a basic procedure
     */
    public function testFailureOnMissingFile()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage(
            "There must be at least one file to execute a procedure."
        );

        $yousign = new YousignApi('1234', false);

        $yousign->basic()->execute();
    }

    /**
     * Test that all files have a name attribute
     */
    public function testFailureOnMissingFileName()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage(
            "Given file must have a 'name' attribute."
        );

        $yousign = new YousignApi('1234', false);

        $yousign->basic()
                ->addFile([
                    'content' => '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',
                ])
                ->execute();
    }


    /**
     * Test that procedure contains at least one member
     * a basic procedure
     */
    public function testFailureOnMissingProcedureMember()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage(
            "There must be at least one member to execute a procedure."
        );

        $yousign = new YousignApi('1234', false);

        $yousign->basic()
                ->addFile([
                    'name'    => 'Filename.pdf',
                    'content' => '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',
                ])
                ->execute();
    }

    /**
     * Making a successfull call
     */
    public function testSuccess()
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(201, [], json_encode(DataHelper::getFakeCreatedFile())),
            new Response(201, [], json_encode(DataHelper::getFakeCreatedProcedure())),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234', false);
        $process = $yousign
                ->setClientOptions([
                    'handler' => $handlerStack
                ])
                ->basic()
                ->addFile([
                    'name'    => 'Filename.pdf',
                    'content' => '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',
                ])
                ->setProcedure([
                    "name"        => "My first procedure",
                    "description" => "Awesome! Here is the description of my first procedure",
                    "members"     => [
                        [
                            "firstname" => "John",
                            "lastname" => "Doe",
                            "email" => "john.doe@yousign.fr",
                            "phone" => "+33612345678",
                            "fileObjects" => [
                                [
                                    "page" => 2,
                                    "position" => "230,499,464,589",
                                    "mention" => "Read and approved",
                                    "mention2" => "Signed by John Doe"
                                ]
                            ]
                        ]
                    ]
                ])
                ->execute();

        // test files
        $this->assertEquals(
            DataHelper::getFakeCreatedFile(),
            $process->getFiles()->toArray()[0]
        );

        // test procedure
        $this->assertEquals(
            DataHelper::getFakeCreatedProcedure(),
            $process->getProcedure()->toArray()
        );
    }
}
