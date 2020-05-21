==========
Quickstart
==========

This page provides short examples on how to make your first call and
retrieve your data.


.. _make_first_call_tutorial:

Making your first call
======================

In this example, we will get all users in staging mode.

.. code-block:: php

    use Yousign\YousignApi;

    /*
     * token
     */
    $token = '123456789';

    $yousign = new YousignApi($token);

    $users = $yousign->getUsers();


*$users* contains an iterable *UserCollection* object.

All API responses are converted into objects (See `api_reference`).

All of them offer *toArray()*, *toJson()* methods and getters to
access their properties.

*Collection* objects are iterable.

toArray()
---------

You can use toArray() method to dump all data as a PHP array.

.. code-block:: php

    print_r(
        $users->toArray()
    );


toJson()
--------

You can use toJson() method to serialize all data as a JSON object.

.. code-block:: php

    echo $users->toJson();


Iterate over a collection
-------------------------

You can iterate over all items of a collection.

.. code-block:: php

    foreach ($users as $user) {
        /*
         * For each User model, some methods are available
         */

        // toArray(): to get all property values
        print_r($user->toArray());

        // get + property name
        echo PHP_EOL . "User.id=" . $user->getId();

        // property (read-only)
        echo PHP_EOL . "User.id=" . $user->id;

        // Some properties are models that you can use the same way
        echo PHP_EOL . "User.Group.id=" . $user->getGroup()->getId();
        echo PHP_EOL . "User.Group.id=" . $user->group->id;

        // Some properties are collections that you can iterate
        foreach ($user->group->permissions as $index => $permission) {
            echo PHP_EOL . "User.Group.Permission.name=" . $permission->getName();
        }

        // At any level, you can call a toArray() to dump the current model
        // and its children
        echo PHP_EOL . "User.Group=\n";
        print_r($user->group->toArray());
        echo PHP_EOL . "User.Group.Permissions=\n";
        print_r($user->group->permissions->toArray());
    }
