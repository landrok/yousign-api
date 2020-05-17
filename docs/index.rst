.. title:: Yousign API client in PHP

================================
Yousign API client Documentation
================================

|build-status| |coverage|

**Yousign API client** is a wrapper for the Yousign API v2 in PHP.

Its purpose is to use this API without having to write the HTTP calls
yourself and to retrieve returned data through an object model.

If you still want to make HTTP calls to check the API responses, this is
possible thanks to the low-level calls.

It provides an API wrapper (*Yousign\\YousignApi*) and some shortcut
methods for basic and advanced modes.

As all features are implemented ,it aims to be a full-featured client.

All API calls are wrapped into an object model and all subsequent types
(Member, Procedure, File, FileObject, etc...) are implemented too.

User Guide
==========

.. toctree::
    :maxdepth: 3

    quickstart
    basic-mode
    advanced-mode
    advanced-features

________________________________________________________________________


More
----

- `Contribute on Github <https://github.com/landrok/yousign-api>`_

- To discuss new features, make feedback or simply to share ideas, you
  can contact me on Mastodon at
  `https://cybre.space/@landrok <https://cybre.space/@landrok>`_

- Create an account and an API token on
  `Yousign Sandbox sign-up <https://staging-auth.yousign.com/pre-signup>`_

- `Official API manual <https://dev.yousign.com/?version=latest>`_


.. |build-status| image:: https://api.travis-ci.org/landrok/yousign-api.svg?branch=master
    :alt: Build status
    :target: https://travis-ci.org/landrok/yousign-api

.. |coverage| image:: https://api.codeclimate.com/v1/badges/cad81750c32c5346ac6b/test_coverage
    :alt: Test coverage
    :target: https://codeclimate.com/github/landrok/yousign-api/test_coverage

