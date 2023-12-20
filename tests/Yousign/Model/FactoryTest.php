<?php

namespace YousignTest\Model;

use Exception;
use PHPUnit\Framework\TestCase;
use Yousign\Model\Factory;

class FactoryTest extends TestCase
{
    /**
     * Valid scenarios provider
     */
    public static function getValidModels()
    {
        $fakeUser = [
            "id" => "/users/0a12345a-ea7f-424a-a684-123456789010",
            "firstname" => "Firstname",
            "lastname" => "LastName",
            "email" => "f.lastname@domain.com",
            "title" => "Technical",
            "phone" => "+33612345678",
            "status" => "activated",
            "organization" => "/organizations/0a12345a-38f9-4a2e-98da-123456789010",
            "workspaces" => [
                "0" => [
                    "id" => "/workspaces/0a12345a-bed2-4a13-8f91-123456789010",
                    "name" => "MY FIRM",
                ]
            ],
            "permission" => "ROLE_ADMIN",
            "group" => [
                "id" => "/user_groups/0a12345a-0548-1234-b914-123456789010",
                "name" => "Administrateur",
                "permissions" => [
                    "0" => "procedure_write",
                    "1" => "procedure_template_write",
                    "2" => "procedure_create_from_template",
                    "3" => "contact",
                    "4" => "sign",
                    "5" => "workspace",
                    "6" => "user",
                    "7" => "api_key",
                    "8" => "procedure_custom_field",
                    "9" => "signature_ui",
                    "10" => "certificate",
                    "11" => "archive",
                    "12" => "contact_custom_field",
                    "13" => "organization",
                ]
            ],
            "createdAt" => "2019-05-06T13:45:59+02:00",
            "updatedAt" => "2019-05-07T19:16:11+02:00",
            "deleted" => null,
            "deletedAt" => null,
            "config" => [],
            "inweboUserRequest" => null,
            "samlNameId" => null,
            "defaultSignImage" => null,
            "notifications" => [
                "procedure" => 1
            ],
            "fastSign" => null,
            "fullName" => null,
        ];

        # factory method => [ model name, model data ]
        return [
            'createUser' => [
                    'User',
                    $fakeUser
            ],
            'UserCollection' => [
                    'UserCollection',
                    [$fakeUser]
            ],
        ];
    }

    /**
     * Check that all core objects have a correct type.
     *
     * @dataProvider getValidModels
     */
    public function testValidModels($name, $data = [])
    {
        // Create empty model
        $method = 'create' . $name;
        $model  = Factory::$method();

        // Assert type
        $this->assertEquals(
            'Yousign\Model\\' . $name,
            get_class($model)
        );

        // Create populated model
        $method = 'create' . $name;
        $model  = Factory::$method($data);

        // Assert type
        $this->assertEquals(
            'Yousign\Model\\' . $name,
            get_class($model)
        );

        // Check that properties are available
        // For a collection
        if (strpos($name, 'Collection') !== false) {
            foreach ($data as $index => $attributes) {
                $this->performComparison(
                    $attributes,
                    $model->offsetGet($index)
                );
            }
        // For a model
        } else {
            $this->performComparison(
                $data,
                $model
            );
        }
    }

    private function performComparison($data, $model)
    {
        $this->assertEquals(
            $data,
            $model->toArray()
        );
        $this->assertEquals(
            json_encode($data, JSON_PRETTY_PRINT),
            $model->toJson(JSON_PRETTY_PRINT)
        );
        foreach ($data as $property => $value) {
            if (is_array($value)) {
                $this->assertEquals(
                    $value,
                    $model->toArray()[$property]
                );
            } else {
                // Getter
                $method = 'get' . ucfirst($property);
                $this->assertEquals(
                    $value,
                    $model->$method()
                );
                // Getter
                $this->assertEquals(
                    $value,
                    $model->get($property)
                );
                // Getter
                $this->assertEquals(
                    $value,
                    $model->$property
                );
            }

        }
    }

    /**
     * Scenario for a method called on a collection that
     * does have such a function.
     */
    public function testCollectionFailing()
    {
        $this->expectException(Exception::class);

        Factory::createUserCollection([])->unknownMethod();
    }

    /**
     * Scenario for a method called on a model that
     * does have such a function.
     */
    public function testModelfailing()
    {
        $this->expectException(Exception::class);

        Factory::createUser([])->unknownMethod();
    }

    /**
     * Scenario for getIterator() calls on a collection
     */
    public function testCollectionGetIterator()
    {
        $items = [
            [
                'id' => '/users/01234'
            ], [
                'id' => '/users/56789'
            ],
        ];

        $users = Factory::createUserCollection($items);

        foreach ($users->getIterator() as $index => $iter) {
            $this->assertEquals(
                $items[$index]['id'],
                $iter->getId()
            );
        }
    }
}
