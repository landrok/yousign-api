Yousign API client
==================

[![Build Status](https://api.travis-ci.com/landrok/yousign-api.svg?branch=master)](https://travis-ci.com/landrok/yousign-api)
[![Maintainability](https://api.codeclimate.com/v1/badges/cad81750c32c5346ac6b/maintainability)](https://codeclimate.com/github/landrok/yousign-api/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/cad81750c32c5346ac6b/test_coverage)](https://codeclimate.com/github/landrok/yousign-api/test_coverage)

Yousign API client is a wrapper for the Yousign API v3 and v2 in PHP.

Its purpose is to use this API without having to write the HTTP calls
yourself and then to retrieve the returned data through an object model.

If you still want to make HTTP calls to check the API responses, this is
possible thanks to the low-level calls.

All the API calls are wrapped into an object model. All features and models
are not implemented yet, but feel free to contribute. For more information
you can see the [Roadmap](#roadmap).

[See the full documentation](https://yousign-api.readthedocs.io/) or
an overview below.

Table of contents
=================

- [Requirements](#requirements)
- [Install](#install)
- [Quick start](#quick-start)
- [Create a Signature Request in v3](#create-a-signature-request-in-v3)
- [Create a Procedure in v2](#create-a-procedure-in-v2)
- [Roadmap](#roadmap)

________________________________________________________________________

Requirements
------------

- PHP 7.4+
- A Yousign API token

________________________________________________________________________

Install
-------

```sh
composer require landrok/yousign-api
```

________________________________________________________________________

Quick start
-----------

Fetch all users from Yousign API v3.

```php
use Yousign\Api\V3\YousignApi;

/*
 * token
 */
$token = '123456789';

/*
 * Production mode
 */
$production = false;

$yousign = new YousignApi($token, $production);

$users = $yousign->getUsers();
```

Fetch all users from Yousign API v2.

```php
use Yousign\Api\V2\YousignApi;

/*
 * token
 */
$token = '123456789';

/*
 * Production mode
 */
$production = false;

$yousign = new YousignApi($token, $production);

$users = $yousign->getUsers();
```

________________________________________________________________________

Create a Signature Request in v3
--------------------------------

Let's create your first signature procedure in basic mode.

In this example, we will accomplish this mode with low-level
features.

```php
use Yousign\YousignApi;

$token = '123456789';
$production = false;

$yousign = new YousignApi($token, $production);

/*
 * 1 Step - Create the SR
 */
$signatureRequest = $yousign->postSignatureRequest('New Signature Request', 'email');

/*
 * 2 Step - Add Documents
 */
$document = new \SplFileInfo('/path/to/file');
$yousign->postDocument($signatureRequest->id, $document, 'signable_document');

/*
 * 3 Step - Add a Signer
 */
$yousign->postSigner(
    $signatureRequest->id,
    'John',
    'Doe',
    'john.doe@yousign.fr',
    'fr',
    'electronic_signature',
    '+33612345678',
    [
        'signature_authentication_mode' => 'no_otp',
        'redirect_urls'                 => [
            'success' => "https://exemple.com/signature?event=signing_complete",
            'error'   => "https://exemple.com/signature?event=signing_error",
        ]
    ]
);

/*
 * 4 Step - Activate the SR
 */
$signatureRequest = $yousign->activateSignatureRequest($signatureRequest->id);
```
________________________________________________________________________

Create a procedure in v2
------------------------

Here is how to create a procedure in 5 steps with the advanced mode.

```php
use Yousign\YousignApi;

$token = '123456789';
$production = false;

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

________________________________________________________________________

Roadmap
-------

Models integration progress:

- [x] Signature Request
- [x] Document
- [x] Signer
- [ ] Approver
- [ ] Follower
- [ ] Audit Trail
- [ ] Metadata

Models integration progress: 

- [x] CRUD on Signature Request
- [x] Activate Signature Request
- [x] CRUD on Document
- [x] CRUD on Signer
- [ ] CRUD on Approver
- [ ] CRUD on Follower
- [ ] Get Audit Trail
- [ ] CRUD on Metadata

Others

- [ ] Add properties to v3 models classes to have IDE auto completion
- [ ] Update the documentation with v3 examples

More
----

- See the [full documentation](https://developers.yousign.com/)

- Create an account and an API token on
  [Yousign Sandbox sign-up](https://staging-auth.yousign.com/pre-signup)

- Official Yousign [Postman Collections](https://www.postman.com/yousign)

- To discuss new features, make feedback or simply to share ideas, you
  can contact me on Mastodon at
  [https://cybre.space/@landrok](https://cybre.space/@landrok)
