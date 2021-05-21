.. title:: Yousign API client in PHP

================================
Yousign API client Documentation
================================

|build-status| |coverage|

**Yousign API client** is a wrapper for the Yousign API v2 in PHP.

Its purpose is to use this API without having to write the HTTP calls
yourself and to retrieve the returned data through an object model.

As all features are implemented, it aims to be a full-featured client.

.. code-block:: php

    use Yousign\YousignApi;

    /*
     * token
     */
    $token = '123456789';

    $yousign = new YousignApi($token);

    $users = $yousign->getUsers();

    foreach ($users as $user) {
        echo $user->getId();
    }


User Guide
==========

.. toctree::
    :maxdepth: 3

    overview
    quickstart
    basic-mode
    advanced-mode
    advanced-features
    api-reference

________________________________________________________________________

.. |build-status| image:: https://api.travis-ci.com/landrok/yousign-api.svg?branch=master
    :alt: Build status
    :target: https://travis-ci.com/landrok/yousign-api

.. |coverage| image:: https://api.codeclimate.com/v1/badges/cad81750c32c5346ac6b/test_coverage
    :alt: Test coverage
    :target: https://codeclimate.com/github/landrok/yousign-api/test_coverage

