Yousign API client
==================

[![Build Status](https://api.travis-ci.org/landrok/yousign-api.svg?branch=master)](https://travis-ci.org/landrok/yousign-api)
[![Maintainability](https://api.codeclimate.com/v1/badges/cad81750c32c5346ac6b/maintainability)](https://codeclimate.com/github/landrok/yousign-api/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/cad81750c32c5346ac6b/test_coverage)](https://codeclimate.com/github/landrok/yousign-api/test_coverage)

Yousign API client is a wrapper for the Yousign API v2 in PHP.

Its purpose is to use this API without having to write the HTTP calls
yourself and to exploit the data returned through an object model.

If you still want to make HTTP calls to check the API responses, this is
possible thanks to the low-level calls.

It provides several layers:

- A low-level API client (Yousign\YousignClient)
- An API wrapper (Yousign\YousignApi)
    - A wrapper for the basic procedure
    - A wrapper for the extended procedure

As all the API calls are wrapped into an object model, it aims to be a
full-featured client.

All subsequent types (Member, Procedure, File, etc...) are implemented
too.

[See the full documentation](https://landrok.github.io/yousign-api) or
an overview below.

Table of contents
=================

- [Requirements](#requirements)
- [Install](#install)
- [Quick start](#quick-start)
- [Basic mode](#basic-mode)
- [Advanced mode](#advanced-mode)

________________________________________________________________________

Requirements
------------

- PHP 7.1+
- You have to create your account on Yousign platform to get an API
token before using this library.

________________________________________________________________________

Install
-------

```sh
composer require landrok/yousign-api
```

________________________________________________________________________

Quick start
-----------

In this example, we will get all users in staging mode.

```php
use Yousign\YousignApi;

/*
 * token
 */
$token = '123456789';

$yousign = new YousignApi($token);

$users = $yousign->getUsers();

```

Good news, your token is available.


________________________________________________________________________

Responses and data
------------------

All API responses are converted into objects that are iterable when it's
a collection (ie a list of users) or an item (an user itself).

### Dump data

You can use toArray() method to dump all data as a PHP array.

```php

print_r(
    $users->toArray()
);

```

### Iterate over a list

You can iterate over all items of a collection.

```php

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

```
________________________________________________________________________

Basic Mode
----------

Let's create your first signature procedure in basic mode.

In this example, we will accomplish this mode with low-level
features.

```php
use Yousign\YousignApi;

/*
 * Token
 */
$token = '123456789';

/*
 * Production mode
 */
$production = false;

/*
 * Instanciate API wrapper
 */
$yousign = new YousignApi($token, $production);

/*
 * 1st step : send a file
 */
$file = $yousign->postFile([
    'name'    => 'My filename.pdf',
    'content' => base64_encode(
        file_get_contents(
            dirname(__DIR__, 2) . '/tests/samples/test-file-1.pdf'
        )
    )
]);

/*
 * 2nd step : create the procedure
 */
$procedure = $yousign->postProcedure([
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
                    "file" => $file->getId(),
                    "page" => 2,
                    "position" => "230,499,464,589",
                    "mention" => "Read and approved",
                    "mention2" => "Signed by John Doe"
                ]
            ]
        ]
    ]
]);

// toJson() supports all PHP json_encode flags
echo $procedure->toJson(JSON_PRETTY_PRINT);
```

When the procedure is created, you can retrieve all the data with the
getters or dump all data with `toJson()` and `toArray()` methods.

It would output something like:

```json
{
    "id": "\/procedures\/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
    "name": "My first procedure",
    "description": "Awesome! Here is the description of my first procedure",
    "createdAt": "2018-12-01T11:49:11+01:00",
    "updatedAt": "2018-12-01T11:49:11+01:00",
    "finishedAt": null,
    "expiresAt": null,
    "status": "active",
    "creator": null,
    "creatorFirstName": null,
    "creatorLastName": null,
    "workspace": "\/workspaces\/XXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
    "template": false,
    "ordered": false,
    "parent": null,
    "metadata": [],
    "config": [],
    "members": [
        {
            "id": "\/members\/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "user": null,
            "type": "signer",
            "firstname": "John",
            "lastname": "Doe",
            "email": "john.doe@yousign.fr",
            "phone": "+33612345678",
            "position": 1,
            "createdAt": "2018-12-01T11:49:11+01:00",
            "updatedAt": "2018-12-01T11:49:11+01:00",
            "finishedAt": null,
            "status": "pending",
            "fileObjects": [
                {
                    "id": "\/file_objects\/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
                    "file": {
                        "id": "\/files\/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
                        "name": "The best name for my file.pdf",
                        "type": "signable",
                        "contentType": "application\/pdf",
                        "description": null,
                        "createdAt": "2018-12-01T11:36:20+01:00",
                        "updatedAt": "2018-12-01T11:49:11+01:00",
                        "sha256": "bb57ae2b2ca6ad0133a699350d1a6f6c8cdfde3cf872cf526585d306e4675cc2",
                        "metadata": [],
                        "workspace": "\/workspaces\/XXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
                        "creator": null,
                        "protected": false,
                        "position": 0,
                        "parent": null
                    },
                    "page": 2,
                    "position": "230,499,464,589",
                    "fieldName": null,
                    "mention": "Read and approved",
                    "mention2": "Signed by John Doe",
                    "createdAt": "2018-12-01T11:49:11+01:00",
                    "updatedAt": "2018-12-01T11:49:11+01:00",
                    "parent": null,
                    "reason": "Signed by Yousign"
                }
            ],
            "comment": null,
            "notificationsEmail": [],
            "operationLevel": "custom",
            "operationCustomModes": [
                "sms"
            ],
            "operationModeSmsConfig": null,
            "parent": null
        }
    ],
    "subscribers": [],
    "files": [
        {
            "id": "\/files\/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "name": "My filename.pdf",
            "type": "signable",
            "contentType": "application\/pdf",
            "description": null,
            "createdAt": "2018-12-01T11:36:20+01:00",
            "updatedAt": "2018-12-01T11:49:11+01:00",
            "sha256": "bb57ae2b2ca6ad0133a699350d1a6f6c8cdfde3cf872cf526585d306e4675cc2",
            "metadata": [],
            "workspace": "\/workspaces\/XXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "creator": null,
            "protected": false,
            "position": 0,
            "parent": null
        }
    ],
    "relatedFilesEnable": false,
    "archive": false,
    "archiveMetadata": [],
    "fields": [],
    "permissions": []
}
```
________________________________________________________________________

Advanced Mode
-------------

Here is how to create a procedure in 5 steps with the advanced mode.

```
use Yousign\YousignApi;

/*
 * Token
 */
$token = '123456789';

/*
 * Production mode
 */
$production = false;

/*
 * Instanciate API wrapper
 */
$yousign = new YousignApi($token, $production);

/*
 * Step 1 - Create your procedure
 */
$procedure = $yousign->postProcedure([
    "name"        => "My first procedure",
    "description" => "Description of my procedure with advanced mode",
    "start"       => false,
]);

/*
 * Step 2 - Add the files
 */
$file = $yousign->postFile([
    'name'    => 'Name of my signable file.pdf',
    'content' => base64_encode(
        file_get_contents(
            dirname(__DIR__, 2) . '/tests/samples/test-file-1.pdf'
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


echo $procedure->toJson(JSON_PRETTY_PRINT);
```

In step 3, you may add several members.
In step 4, you may add one or more signature images for each one.
=======
________________________________________________________________________

Basic Mode
----------

Let's create your first signature procedure in basic mode.

All API calls are made behind the scene. Before calling the API, given
parameters are validated.

```php
use Yousign\YousignApi;

$yousign = new YousignApi('1234', false);
$process = $yousign
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
```

Note that the file attribute is not set in `fileObjects` as it's
automatically added during the process.

Until `execute()` method is called, nothing is sent to the API.

When the procedure is created, you can retrieve all the data with the
`getProcedure()` method.

```php
echo $process->getProcedure()->toJson(JSON_PRETTY_PRINT);

```

would output something like:

```
{
    "id": "/procedures/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
    "name": "My first procedure",
    "description": "Awesome! Here is the description of my first procedure",
    "createdAt": "2018-12-01T11:49:11+01:00",
    "updatedAt": "2018-12-01T11:49:11+01:00",
    "finishedAt": null,
    "expiresAt": null,
    "status": "active",
    "creator": null,
    "creatorFirstName": null,
    "creatorLastName": null,
    "workspace": "/workspaces/XXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
    "template": false,
    "ordered": false,
    "parent": null,
    "metadata": [],
    "config": [],
    "members": [
        {
            "id": "/members/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "user": null,
            "type": "signer",
            "firstname": "John",
            "lastname": "Doe",
            "email": "john.doe@yousign.fr",
            "phone": "+33612345678",
            "position": 1,
            "createdAt": "2018-12-01T11:49:11+01:00",
            "updatedAt": "2018-12-01T11:49:11+01:00",
            "finishedAt": null,
            "status": "pending",
            "fileObjects": [
                {
                    "id": "/file_objects/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
                    "file": {
                        "id": "/files/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
                        "name": "The best name for my file.pdf",
                        "type": "signable",
                        "contentType": "application/pdf",
                        "description": null,
                        "createdAt": "2018-12-01T11:36:20+01:00",
                        "updatedAt": "2018-12-01T11:49:11+01:00",
                        "sha256": "bb57ae2b2ca6ad0133a699350d1a6f6c8cdfde3cf872cf526585d306e4675cc2",
                        "metadata": [],
                        "workspace": "/workspaces/XXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
                        "creator": null,
                        "protected": false,
                        "position": 0,
                        "parent": null
                    },
                    "page": 2,
                    "position": "230,499,464,589",
                    "fieldName": null,
                    "mention": "Read and approved",
                    "mention2": "Signed by John Doe",
                    "createdAt": "2018-12-01T11:49:11+01:00",
                    "updatedAt": "2018-12-01T11:49:11+01:00",
                    "parent": null,
                    "reason": "Signed by Yousign"
                }
            ],
            "comment": null,
            "notificationsEmail": [],
            "operationLevel": "custom",
            "operationCustomModes": [
                "sms"
            ],
            "operationModeSmsConfig": null,
            "parent": null
        }
    ],
    "subscribers": [],
    "files": [
        {
            "id": "/files/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "name": "The best name for my file.pdf",
            "type": "signable",
            "contentType": "application/pdf",
            "description": null,
            "createdAt": "2018-12-01T11:36:20+01:00",
            "updatedAt": "2018-12-01T11:49:11+01:00",
            "sha256": "bb57ae2b2ca6ad0133a699350d1a6f6c8cdfde3cf872cf526585d306e4675cc2",
            "metadata": [],
            "workspace": "/workspaces/XXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",
            "creator": null,
            "protected": false,
            "position": 0,
            "parent": null
        }
    ],
    "relatedFilesEnable": false,
    "archive": false,
    "archiveMetadata": [],
    "fields": [],
    "permissions": []
}
```
________________________________________________________________________

More
----

- [See the full documentation](https://landrok.github.io/yousign-api/)

- To discuss new features, make feedback or simply to share ideas, you
  can contact me on Mastodon at
  [https://cybre.space/@landrok](https://cybre.space/@landrok)

- Create an account and an API token on
  [Yousign Sandbox sign-up](https://staging-auth.yousign.com/pre-signup)

- [Official API manual](https://dev.yousign.com/?version=latest)

