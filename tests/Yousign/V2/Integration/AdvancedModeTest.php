<?php

namespace YousignTest\V2\Integration;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Yousign\Api\V2\YousignApi;
use YousignTest\V2\Fake\Model\FakeFileCreated;
use YousignTest\V2\Fake\Model\FakeFileObject;
use YousignTest\V2\Fake\Model\FakeMember;
use YousignTest\V2\Fake\Model\FakeProcedureCreated;
use YousignTest\V2\Fake\Model\FakeProcedureStarted;

class AdvancedModeTest extends TestCase
{
    /**
     * Making a successfull call
     */
    public function testSuccess()
    {
        // Create a mock handler
        $mock = new MockHandler([
            new Response(201, [], json_encode(FakeProcedureCreated::getProperties())),
            new Response(201, [], json_encode(FakeFileCreated::getProperties())),
            new Response(201, [], json_encode(FakeMember::getProperties())),
            new Response(201, [], json_encode(FakeFileObject::getProperties())),
            new Response(201, [], json_encode(FakeProcedureStarted::getProperties())),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $yousign = new YousignApi('1234', false);

        $yousign
            ->setClientOptions([
                'handler' => $handlerStack
        ]);

        /*
         * Step 1 - Create your procedure
         */
        $procedure = $yousign->postProcedure([
            "name"        => "My first procedure",
            "description" => "Description of my procedure with advanced mode",
            "start"       => false,
        ]);

        // Test step 1
        $this->assertEquals(
            FakeProcedureCreated::getProperties(),
            $procedure->toArray()
        );

        /*
         * Step 2 - Add the files
         */
        $file = $yousign->postFile([
            'name'    => 'Name of my signable file.pdf',
            'content' => base64_encode(
                file_get_contents(
                    dirname(__DIR__, 3) . '/samples/test-file-1.pdf'
                )
            ),
            'procedure' => $procedure->getId(),
        ]);

        /*
         * Step 3 - Add the members
         */
        $member = $yousign->postMember([
            "firstname"     => "John",
            "lastname"      => "Doe",
            "email"         => "john.doe@yousign.fr",
            "phone"         => "+33612345678",
            "procedure"     => $procedure->getId(),
        ]);


        /*
         * Step 4 - Add the signature images
         */
        $fileObject = $yousign->postFileObject([
            "file"      => $file->getId(),
            "member"    => $member->getId(),
            "position"  => "230,499,464,589",
            "page"      => 2,
            "mention"   => "Read and approved",
            "mention2"  => "Signed By John Doe"
        ]);

         /*
          * Step 5 - Start the procedure
          */
        $procedure = $yousign->putProcedure(
            $procedure->getId(), [
                "start" => true,
            ]
        );

        // test file
        $this->assertEquals(
            FakeFileCreated::getProperties(),
            $file->toArray()
        );

        // test member
        $this->assertEquals(
            FakeMember::getProperties(),
            $member->toArray()
        );

        // test file object
        $this->assertEquals(
            FakeFileObject::getProperties(),
            $fileObject->toArray()
        );

        // test procedure after being started
        $this->assertEquals(
            FakeProcedureStarted::getProperties(),
            $procedure->toArray()
        );
    }
}
