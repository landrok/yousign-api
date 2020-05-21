.. _basic_mode_tutorial:

==========
Basic mode
==========

Let's create your first signature procedure in basic mode.

In this example, we will accomplish this mode with low-level
features.

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
     * 1st step : send a file
     */
    $file = $yousign->postFile([
        'name'    => 'My filename.pdf',
        'content' => base64_encode(
            file_get_contents(
                '/my_storage_path/test-file-1.pdf'
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

When the procedure is created, you can retrieve all the data with the
getters or dump all data with *toJson()* and *toArray()* methods.

It would output something like:

.. code-block:: JSON

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


If you want to create your signature procedure in basic mode with a more
high-level feature, see this manual (Coming soon).
