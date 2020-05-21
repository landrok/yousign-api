.. _advanced_mode_tutorial:

=============
Advanced mode
=============

Here is how to create a procedure in 5 steps with the advanced mode.

.. code-block:: php

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


In step 3, you may add several members.
In step 4, you may add one or more signature images for each one.
