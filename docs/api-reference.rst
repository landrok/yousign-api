.. _api_reference:

=============
API reference
=============

*Yousign\\YousignApi* offers the following methods to interact with
all domains of the REST API.

Before all examples, you must instanciate the client.

.. code-block:: php

    use Yousign\YousignApi;

    /*
     * API token
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

________________________________________________________________________

User
====

getUsers()
----------

Get all users.

Parameters
~~~~~~~~~~

*None*

Return Values
~~~~~~~~~~~~~

*Yousign\\Model\\UserCollection* See :ref:`make_first_call_tutorial`

Examples
~~~~~~~~

.. code-block:: php

    $users = $yousign->getUsers();

________________________________________________________________________

postUser(array $user)
---------------------

Create an user.

.. warning::

    This implies that each user created by this means (API) or through
    the application will be billed according to your plan.

Parameters
~~~~~~~~~~

*array* $user


Return Values
~~~~~~~~~~~~~

*Yousign\\Model\\User*


Examples
~~~~~~~~

.. code-block:: php

    $user = $yousign->postUser([
        "firstname" => "John",
        "lastname" => "Doe",
        "email" => "api@yousign.fr",
        "title" => "API teacher",
        "phone" => "+33612345678",
        "organization" => "/organizations/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX"
    ]);

________________________________________________________________________


File
====

postFile(array $file)
---------------------

Create a new file as a signable file or an attachment.

Parameters
~~~~~~~~~~

*array* See :ref:`advanced_mode_tutorial` Step 2 or
:ref:`basic_mode_tutorial` Step 1

Return Values
~~~~~~~~~~~~~

*Yousign\\Model\\File* See :ref:`advanced_mode_tutorial` Step 4

Examples
~~~~~~~~

**Create a signable file**

.. code-block:: php

    $file = $yousign->postFile(
        'name'    => 'Name of my signable file.pdf',
        'content' => base64_encode(
            file_get_contents(
                '/storage_path/filename.pdf'
            )
        ),
        // A procedure must have been created before to link
        // file to it.
        'procedure' => $procedure->getId(),
    );


**Create an attachment file**

.. code-block:: php

    $file = $yousign->postFile([
        'name'    => 'Name of my signable file.pdf',
        'content' => base64_encode(
            file_get_contents(
                '/storage_path/filename.pdf'
            )
        ),
        // A procedure must have been created before to link
        // file to it.
        'procedure' => $procedure->getId(),
        'type'      => 'attachment',
    ]);

    // /files/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
    echo $file->getId();

________________________________________________________________________

File objects
============


postFileObject(array $fileObject)
---------------------------------

Create a new signature image in a signable file.


Parameters
~~~~~~~~~~

*array* See :ref:`advanced_mode_tutorial` Step 4

Return Values
~~~~~~~~~~~~~

*Yousign\\Model\\FileObject*

Examples
~~~~~~~~

**Create a signature image**

A file and a member must have been created before (See
:ref:`advanced_mode_tutorial` Step 4)

.. code-block:: php

    $fileObject = $yousign->postFileObject(
        "file"      => $file->getId(),
        "member"    => $member->getId(),
        "position"  => "230,499,464,589",
        "page"      => 2,
        "mention"   => "Read and approved",
        "mention2"  => "Signed By John Doe"
    );

    // /file_objects/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
    echo $fileObject->getId();

    // /files/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
    echo $fileObject->getFile();

    // /members/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
    echo $fileObject->getMember()->getId();
________________________________________________________________________

Members
=======

As they are referenced by a procedure, members are created during
(:ref:`basic_mode_tutorial`) or after(:ref:`advanced_mode_tutorial`)
procedure creation.

For different types of member, see
:ref:`_advanced_features_tutorial.members`.


postMember(array $member)
-------------------------

Create a new member.

Parameters
~~~~~~~~~~

*array* See :ref:`advanced_mode_tutorial` Step 3

Return Values
~~~~~~~~~~~~~

*Yousign\\Model\\Member* See :ref:`advanced_mode_tutorial` Step 3

Examples
~~~~~~~~

**Create a member**

.. code-block:: php

    $member = $yousign->postMember([
        "firstname"     => "John",
        "lastname"      => "Doe",
        "email"         => "john.doe@yousign.fr",
        "phone"         => "+33612345678",
        "procedure"     => $procedure->getId(),
    ]);


________________________________________________________________________

Procedure
=========

postProcedure(array $procedure)
-------------------------------

Create a new procedure.

Parameters
~~~~~~~~~~

*array* See :ref:`basic_mode_tutorial` Step 2 or
:ref:`advanced_mode_tutorial` Step 1

Return Values
~~~~~~~~~~~~~

*Yousign\\Model\\Procedure* See :ref:`basic_mode_tutorial` Step 3

Examples
~~~~~~~~

**Create a procedure in advanced mode**

For more, see :ref:`advanced_mode_tutorial`.

.. code-block:: php

    $procedure = $yousign->postProcedure([
        "name"        => "My first procedure",
        "description" => "Description of my procedure with advanced mode",
        "start"       => false,
    ]);

    // /procedures/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
    echo $procedure->getId();

**Create a procedure in basic mode**

For more, see :ref:`basic_mode_tutorial`.

.. code-block:: php

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

    // /procedures/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
    echo $procedure->getId();

    foreach ($procedure->getMembers() as $member) {
        // /members/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
        echo $member->getId();
    }

    foreach ($procedure->getFiles() as $file) {
        // /files/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
        echo $file->getId();
    }

________________________________________________________________________


putProcedure(string $id, array $procedure)
------------------------------------------

Update a procedure. Start a procedure in :ref:`advanced_mode_tutorial`.

Parameters
~~~~~~~~~~

*string* A procedure identifier

*array* See :ref:`advanced_mode_tutorial` Step 5

Return Values
~~~~~~~~~~~~~

*Yousign\\Model\\Procedure*

Examples
~~~~~~~~

**Start a procedure in advanced mode**

For more, see :ref:`advanced_mode_tutorial`.

.. code-block:: php

    $procedure = $yousign->putProcedure(
        $procedure->getId(), [
        "start"       => true,
    ]);

    // /procedures/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
    echo $procedure->getId();

    foreach ($procedure->getMembers() as $member) {
        // /members/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
        echo $member->getId();
    }

    foreach ($procedure->getFiles() as $file) {
        // /files/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
        echo $file->getId();
    }

________________________________________________________________________

HTTP client options
===================

Sometimes you may need to configure low-level things like HTTP headers,
timeout, proxy options.

This Yousign API client uses Guzzle HTTP client under the scene.
You can pass an array of options once, before calling API.



After the first call to the API is made, options are immutable.

setClientOptions(array $options)
--------------------------------

Parameters
~~~~~~~~~~

*array* See http://docs.guzzlephp.org/en/stable/request-options.html

Return Values
~~~~~~~~~~~~~

*Yousign\\YousignApi*

Examples
~~~~~~~~

**Configure a proxy before creating a procedure**

For more, see :ref:`advanced_mode_tutorial`.

.. code-block:: php

    $yousign = new YousignApi($token, $production);

    // Set up a proxy
    $yousign->setClientOptions([
        'proxy' => 'tcp://localhost:8125',
    ]);

    $procedure = $yousign->postProcedure([
        "name"        => "My first procedure",
        "description" => "Description of my procedure with advanced mode",
        "start"       => false,
    ]);

