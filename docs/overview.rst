========
Overview
========

All API calls are wrapped into an object model.

If you still want to make HTTP calls to check the API responses, this is
possible thanks to the low-level calls.

It provides an API wrapper (*Yousign\\YousignApi*) and some shortcut
methods for basic and advanced modes.

Requirements
============

- PHP 7.4+
- Before using this library, you have to create your account on
  `Yousign platform <https://staging-auth.yousign.com/pre-signup>`_ to
  get an API token before using this library.

Install
=======

.. code-block:: console

    composer require landrok/yousign-api


Production & staging environments
=================================

*YousignApi* accepts 2 parameters:

- *string*  *$token* is the bearer token

- *bool*    *$production*

    - *false* is the default value, for staging environment. Requests
        are sent to https://staging-api.yousign.com/

    - *true* for production environment. Requests are sent to
      https://api.yousign.com/


Staging environment
-------------------

.. code-block:: php

    use Yousign\YousignApi;

    /*
     * token
     */
    $token = '123456789';

    /*
     * production flag
     */
    $production = false;

    $yousign = new YousignApi($token, $production);


Production environment
----------------------

.. code-block:: php

    use Yousign\YousignApi;

    /*
     * token
     */
    $token = '123456789';

    /*
     * production flag
     */
    $production = true;

    $yousign = new YousignApi($token, $production);


Contributing
============

All subsequent types (Member, Procedure, File, FileObject, etc...) are implemented too.

- `Contribute on Github <https://github.com/landrok/yousign-api>`_

- To discuss new features, make feedback or simply to share ideas, you
  can contact me on Mastodon at
  `https://cybre.space/@landrok <https://cybre.space/@landrok>`_

Yousign API manual
==================

`Official Yousign API manual <https://dev.yousign.com/?version=latest>`_
