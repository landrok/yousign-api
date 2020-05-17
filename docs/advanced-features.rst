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



{
    "name": "Name of my attachment.pdf",
    "content": "JVBERi0xLjUKJb/3ov4KICA[...]VPRgo=",
    "procedure": "/procedures/XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX",

}

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
the procedure. See the steps 3, 4 ,5 in :ref:`Advanced mode`.

