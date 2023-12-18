<?php

declare(strict_types=1);

namespace Yousign\Api\V3;

use Yousign\Api\AbstractApi;
use Yousign\Model\V3\Document;
use Yousign\Model\V3\DocumentCollection;
use Yousign\Model\V3\Factory;
use Yousign\Model\V3\SignatureRequest;
use Yousign\Model\V3\SignatureRequestCollection;
use Yousign\Model\V3\Signer;
use Yousign\Model\V3\SignerCollection;
use Yousign\Model\V3\UserCollection;
use Yousign\YousignClient;

/*
 * API wrapper
 *
 * Usage
 * -----
 *
 * - Get all users (ie Making first call)
 *
 * $token = '123456789';
 * $yousign = new YousignApi($token, $production = false);
 * print_r( $yousign->getUsers() ); // Return a UserCollection model
 */
final class YousignApi extends AbstractApi
{
    /**
     * Authenticated HTTP client for Yousign API
     */
    protected YousignClient $client;

    public function __construct(string $token, bool $production = false)
    {
        $this->client = new YousignClient($token, $production, YousignClient::API_VERSION_3);
    }

    /**
     * Get a document in a signature request
     *
     * @param  string $signatureRequestId
     * @param  string $documentId
     * @return Document
     */
    public function getDocument(string $signatureRequestId, string $documentId): Document
    {
        $response = $this->client->get("signature_requests/{$signatureRequestId}/documents/{$documentId}");

        return Factory::createDocument(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Get all signature request documents
     *
     * @param  string $signatureRequestId
     * @return DocumentCollection
     */
    public function getDocuments(string $signatureRequestId): DocumentCollection
    {
        $response = $this->client->get("signature_requests/{$signatureRequestId}/documents");

        return Factory::createDocumentCollection(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Post a document in a signature request
     *
     * @param  string $signatureRequestId
     * @param  \SplFileInfo $file
     * @param  string $nature Enum: "signable_document", "attachment"
     * @param  array<mixed> $params
     * @return Document
     */
    public function postDocument(string $signatureRequestId, \SplFileInfo $file, string $nature, array $params = []): Document
    {
        $response = $this->client->postFile("signature_requests/{$signatureRequestId}", [
            'file'   => $file,
            'nature' => $nature,
            ...$params
        ]);

        return Factory::createDocument(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Patch a document in a signature request
     * 
     * @param  string $signatureRequestId
     * @param  string $documentId
     * @param  array<mixed> $params
     * @return Document
     */
    public function patchDocument(string $signatureRequestId, string $documentId, array $params = []): Document
    {
        $response = $this->client->patch("signature_requests/{$signatureRequestId}/documents/{$documentId}", $params);

        return Factory::createDocument(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Delete a document in a signature request
     *
     * @param  string $signatureRequestId
     * @param  string $documentId
     * @return null
     */
    public function deleteDocument(string $signatureRequestId, string $documentId)
    {
        $this->client->delete("signature_requests/{$signatureRequestId}/documents/{$documentId}");

        return null;
    }

    /**
     * Get a signature request
     *
     * @param  string $signatureRequestId
     * @return SignatureRequest
     */
    public function getSignatureRequest(string $signatureRequestId): SignatureRequest
    {
        $response = $this->client->get("signature_requests/{$signatureRequestId}");

        return Factory::createSignatureRequest(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Get all signatures requests
     *
     * @return SignatureRequestCollection
     */
    public function getSignatureRequests(): SignatureRequestCollection
    {
        $response = $this->client->get('signature_requests');

        return Factory::createSignatureRequestCollection(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Post a signature request
     *
     * @param  string $name
     * @param  string $deliveryMode Enum: "email", "none"
     * @param  array<mixed> $params
     * @return SignatureRequest
     */
    public function postSignatureRequest(string $name, string $deliveryMode, array $params = []): SignatureRequest
    {
        $response = $this->client->post('signature_requests', [
            'name'          => $name,
            'delivery_mode' => $deliveryMode,
            ...$params
        ]);

        return Factory::createSignatureRequest(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Patch a signature request
     *
     * @param  array<mixed> $params
     * @return SignatureRequest
     */
    public function patchSignatureRequest(array $params = []): SignatureRequest
    {
        $response = $this->client->patch('signature_requests', $params);

        return Factory::createSignatureRequest(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Delete a signature request
     *
     * @param  string $signatureRequestId
     * @return null
     */
    public function deleteSignatureRequest(string $signatureRequestId)
    {
        $this->client->delete("signature_requests/{$signatureRequestId}");

        return null;
    }

    /**
     * Get a signer in a signature request
     *
     * @param  string $signatureRequestId
     * @param  string $signerId
     * @return Signer
     */
    public function getSigner(string $signatureRequestId, string $signerId): Signer
    {
        $response = $this->client->get("signature_requests/{$signatureRequestId}/signers/{$signerId}");

        return Factory::createSigner(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Get all signature request signers
     *
     * @param  string $signatureRequestId
     * @return SignerCollection
     */
    public function getSigners(string $signatureRequestId): SignerCollection
    {
        $response = $this->client->get("signature_requests/{$signatureRequestId}/signers");

        return Factory::createSignerCollection(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Post a signer in a signature request
     *
     * @param  string $signatureRequestId
     * @param  string $first_name
     * @param  string $last_name
     * @param  string $email
     * @param  string $phone_number E.164 format
     * @param  string $locale
     * @param  string $signature_level Enum: "electronic_signature",
     *                                       "advanced_electronic_signature",
     *                                       "electronic_signature_with_qualified_certificate",
     *                                       "qualified_electronic_signature",
     *                                       "qualified_electronic_signature_mode_1"
     * @param  array<mixed> $params
     * @return Signer
     */
    public function postSigner(
        string $signatureRequestId,
        string $first_name,
        string $last_name,
        string $email,
        string $phone_number,
        string $locale,
        string $signature_level,
        array $params = []
    ): Signer
    {
        $response = $this->client->post("signature_requests/{$signatureRequestId}", [
            'info'            => [
                'first_name'   => $first_name,
                'last_name'    => $last_name,
                'email'        => $email,
                'phone_number' => $phone_number,
                'locale'       => $locale,
            ],
            'signature_level' => $signature_level,
            ...$params
        ]);

        return Factory::createSigner(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Patch a signer in a signature request
     * 
     * @param  string $signatureRequestId
     * @param  string $signerId
     * @param  array<mixed> $params
     * @return Signer
     */
    public function patchSigner(string $signatureRequestId, string $signerId, array $params = []): Signer
    {
        $response = $this->client->patch("signature_requests/{$signatureRequestId}/signers/{$signerId}", $params);

        return Factory::createSigner(
            json_decode((string) $response->getBody(), true)
        );
    }

    /**
     * Delete a signer in a signature request
     *
     * @param  string $signatureRequestId
     * @param  string $signerId
     * @return null
     */
    public function deleteSigner(string $signatureRequestId, string $signerId)
    {
        $this->client->delete("signature_requests/{$signatureRequestId}/signers/{$signerId}");

        return null;
    }

    /**
     * Get all users
     *
     * @return UserCollection
     * @throws \Exception When HTTP client receive an error (4xx or 5xx)
     */
    public function getUsers(): UserCollection
    {
        $response = $this->client->get('users');

        return Factory::createUserCollection(
            json_decode((string) $response->getBody(), true)
        );
    }
}