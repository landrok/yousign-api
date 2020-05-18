=================
Advanced features
=================

Here are the implementation for advanced features.


Attachment file
---------------

To add an attachment file in your procedure, simply add the type
parameter with attachment value.

In the below example, we'll see how to configure the files within a
procedure.


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

    /*
     * Step 1 - Create your procedure
     */
    $procedure = $yousign->postProcedure([
        "name"        => "My first procedure",
        "description" => "Description of my procedure with advanced mode",
        "start"       => false,
    ]);

    /*
     * Step 2 - Add a signable file
     */
    $signableFile = $yousign->postFile([
        'name'    => 'Name of my signable file.pdf',
        'content' => base64_encode(
            file_get_contents(
                '/storage_path/signable-file.pdf'
            )
        ),
        'procedure' => $procedure->getId(),
    ]);

    /*
     * Step 3 - Add an attachment file
     */
    $attachmentfile = $yousign->postFile([
        'name'    => 'Name of my attachment file.pdf',
        'content' => base64_encode(
            file_get_contents(
                '/storage_path/attachment-file.pdf'
            )
        ),
        'procedure' => $procedure->getId(),
        'type'      => 'attachment',
    ]);


    // [...] then, you can add members, file objects and start your
    // procedure


When the 3 steps are done, you can add members, file objects and start
the procedure. See the steps 3, 4 ,5 in :ref:`advanced-mode`.

________________________________________________________________________

User
----

It's necessary to highlight 2 categories of members:

- On the one hand, signers who are in your organization and who already
  have an account on the Yousign application. These participants are
  usually called **users** or **internal members**. These users are
  licensed with a paid account.

- On the other hand, signers who do not have access to the Yousign
  application. These are mainly your customers, partners, suppliers and
  so on. These participants are usually called **external members**.


Add an internal member
----------------------

Previously, we saw how to add an external member to sign a document (See
:ref: `basic-mode.basic-mode` or :ref:`advanced-mode.advanced-mode`).

In the following example, we'll see how to attach an internal member (an
user) to a procedure. You must know the user id. In this case, you don't
need to add name, phone or email.

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
     * User id
     */
    $userId = "/users/10d3730f-d056-422d-a8d1-a5252236246d";

    /*
     * Instanciate API wrapper
     */
    $yousign = new YousignApi($token, $production);

    /*
     * Step 1 - Add a signable file
     */
    $signableFile = $yousign->postFile([
        'name'    => 'Name of my signable file.pdf',
        'content' => base64_encode(
            file_get_contents(
                '/storage_path/signable-file.pdf'
            )
        ),
        'procedure' => $procedure->getId(),
    ]);

    /*
     * 2nd step : create the procedure with your internal member
     */
    $procedure = $yousign->postProcedure([
        "name"        => "My procedure",
        "description" => "Awesome! Here is the description of my procedure",
        "members"     => [
            [
                "user" => $userId,
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

________________________________________________________________________

Add an external member
----------------------

This is just a reminder on how to add an external member.
In this case, you don't need an user identifier, it's generated when the
procedure is created.

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

    /*
     * Step 1 - Add a signable file
     */
    $signableFile = $yousign->postFile([
        'name'    => 'Name of my signable file.pdf',
        'content' => base64_encode(
            file_get_contents(
                '/storage_path/signable-file.pdf'
            )
        ),
        'procedure' => $procedure->getId(),
    ]);

    /*
     * 2nd step : create the procedure with your external member
     */
    $procedure = $yousign->postProcedure([
        "name"        => "How to add an external member",
        "description" => "Simply with following information: first name, last name, email address and phone number.",
        "members"     => [
            [
                "firstname" => "John",
                "lastname"  => "Doe",
                "email"     => "john.doe@yousign.fr",
                "phone"     => "+33612345678",
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


________________________________________________________________________

Create a user
-------------



________________________________________________________________________

