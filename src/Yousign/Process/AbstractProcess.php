<?php

declare(strict_types=1);

namespace Yousign\Process;

use Yousign\Api\AbstractApi;
use Yousign\Api\V2\YousignApi as V2YousignApi;
use Yousign\Api\V3\YousignApi as V3YousignApi;
use Yousign\Model\V2\Factory as V2Factory;
use Yousign\Model\V3\Factory as V3Factory;
use Yousign\Model\V2\FileCollection;
use Yousign\Model\V2\Procedure;
use Yousign\Model\V3\DocumentCollection;
use Yousign\Model\V3\SignatureRequest;
use Yousign\YousignClient;

/*
 * Basic class for a process
 */
abstract class AbstractProcess
{
    /**
     * Yousign API wrapper
     */
    protected V2YousignApi|V3YousignApi $api;

    /**
     * Files to send called
     * Specific to API V2
     */
    protected FileCollection $files;

    /**
     * Files to send called
     * Specific to API V3
     */
    protected DocumentCollection $documents;

    /**
     * Procedure to send
     * Specific to API V2
     */
    protected Procedure $procedure;

    /**
     * Signature request to send
     * Specific to API V3
     */
    protected SignatureRequest $signatureRequest;
    
    /**
     * @param  AbstractApi $api
     * @param  string $version
     */
    public function __construct(
        AbstractApi $api,
        string $version = YousignClient::API_VERSION_2
    ) {
        $this->api = $api;
        if ($version === YousignClient::API_VERSION_3) {
            $this->files = V3Factory::createDocumentCollection();
            $this->procedure = V3Factory::createSignatureRequest([]);
        } else {
            $this->files = V2Factory::createFileCollection();
            $this->procedure = V2Factory::createProcedure([]);
        }
    }

    /**
     * Add one file to the process
     */
    public function addFile(array $file): static
    {
        $this->files->add(
            V2Factory::createFile($file)
        );

        return $this;
    }

    /**
     * Add the procedure to the process
     */
    public function setProcedure(array $procedure): static
    {
        $this->procedure = V2Factory::createProcedure($procedure);

        return $this;
    }

    /**
     * Get the initial procedure before calling the API
     *  or the final result when API has been called with success
     */
    public function getProcedure(): Procedure
    {
        return $this->procedure;
    }

    /**
     * Get the initial files before calling the API
     *  or the final results when API has been called with success
     */
    public function getFiles(): FileCollection
    {
        return $this->files;
    }

    /**
     * Add one document to the process
     */
    public function addDocument(array $document): static
    {
        $this->documents->add(
            V3Factory::createDocument($document)
        );

        return $this;
    }

    /**
     * Add the signature request to the process
     */
    public function setSignatureRequest(array $signatureRequest): static
    {
        $this->signatureRequest = V3Factory::createSignatureRequest($signatureRequest);

        return $this;
    }

    /**
     * Get the initial signature request before calling the API
     *  or the final result when API has been called with success
     */
    public function getSignatureRequet(): SignatureRequest
    {
        return $this->signatureRequest;
    }

    /**
     * Get the initial documents before calling the API
     *  or the final results when API has been called with success
     */
    public function getDocuments(): DocumentCollection
    {
        return $this->documents;
    }
}
