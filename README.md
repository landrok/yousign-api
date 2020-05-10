Yousign API client
==================

[![Build Status](https://travis-ci.org/landrok/yousign-api.svg?branch=master)](https://travis-ci.org/landrok/yousign-api)
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

- PHP7+
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


More
----

- [See the full documentation](https://landrok.github.io/yousign-api/)

- To discuss new features, make feedback or simply to share ideas, you
  can contact me on Mastodon at
  [https://cybre.space/@landrok](https://cybre.space/@landrok)

- Create an account and an API token on
  [Yousign Sandbox sign-up](https://staging-auth.yousign.com/pre-signup)

- [Official API manual](https://dev.yousign.com/?version=latest)

