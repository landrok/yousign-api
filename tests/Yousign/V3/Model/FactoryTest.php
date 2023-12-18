<?php

namespace YousignTest\V3\Model;

use PHPUnit\Framework\TestCase;
use Yousign\Model\V3\Factory;
use YousignTest\V3\Fake\Model\FakeUser;

class FactoryTest extends TestCase
{
    /**
     * Valid scenarios provider
     */
    public static function getValidModels()
    {
        # factory method => [ model name, model data ]
        return [
            'UserCollection' => [
                'UserCollection',
                ['data' => FakeUser::getCollection()->toArray()]
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
        $this->assertEquals('Yousign\Model\V3\\' . $name, get_class($model));

        // Create populated model
        $method = 'create' . $name;
        $model  = Factory::$method($data);

        // Assert type
        $this->assertEquals('Yousign\Model\V3\\' . $name, get_class($model));

        // Check that properties are available
        // For a collection
        if (strpos($name, 'Collection') !== false) {
            foreach ($data['data'] as $index => $attributes) {
                $this->performComparison($attributes, $model->offsetGet($index));
            }
        // For a model
        } else {
            $this->performComparison($data, $model);
        }
    }

    private function performComparison($data, $model)
    {
        $this->assertEquals($data, $model->toArray());
        $this->assertEquals(json_encode($data, JSON_PRETTY_PRINT), $model->toJson(JSON_PRETTY_PRINT));
        foreach ($data as $property => $value) {
            if (is_array($value)) {
                $this->assertEquals($value, $model->toArray()[$property]);
            } else {
                // Getter
                $method = 'get' . ucfirst($property);
                $this->assertEquals($value, $model->$method());
                // Getter
                $this->assertEquals($value, $model->get($property));
                // Getter
                $this->assertEquals($value, $model->$property);
            }

        }
    }

    /**
     * Scenario for a method called on a collection that
     * does have such a function.
     */
    public function testCollectionFailing()
    {
        $this->expectException(\Exception::class);

        Factory::createUserCollection([])->unknownMethod();
    }

    /**
     * Scenario for a method called on a model that
     * does have such a function.
     */
    public function testModelfailing()
    {
        $this->expectException(\Exception::class);

        Factory::createUser([])->unknownMethod();
    }

    /**
     * Scenario for getIterator() calls on a collection
     */
    public function testCollectionGetIterator()
    {
        $items = [
            'data' => [
                ['id' => '/users/01234'],
                ['id' => '/users/56789'],
            ]
        ];

        $users = Factory::createUserCollection($items);

        foreach ($users->getIterator() as $index => $iter) {
            $this->assertEquals($items['data'][$index]['id'], $iter->getId());
        }
    }
}
