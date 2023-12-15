<?php

declare(strict_types=1);

/*
 * This file is part of the Yousign package.
 *
 * Copyright (c) landrok at github.com/landrok
 *
 * For the full copyright and license information, please see
 * <https://github.com/landrok/activitypub/blob/master/LICENSE>.
 */

namespace Yousign\Model\V3;

/**
 * Factory is a factory for all V3 models. It does not send HTTP
 * requests to the API.
 *
 * It provides shortcuts methods for type instanciation and more.
 */
abstract class Factory
{
    /**
     * Factory method to create a Document model
     *
     * @param  array $attributes
     */
    public static function createDocument(array $attributes = []): Document
    {
        $item = new Document();

        foreach ($attributes as $attribute => $value) {
            $item->set($attribute, $value);
        }

        return $item;
    }

    /**
     * Factory method to create a DocumentCollection model
     *
     * @param  array $items
     */
    public static function createDocumentCollection(array $items = []): DocumentCollection
    {
        $collection = new DocumentCollection();

        foreach ($items as $item) {
            $collection->add(
                self::createDocument($item)
            );
        }

        return $collection;
    }

    /**
     * Factory method to create a SignatureRequest model
     *
     * @param  array $attributes
     */
    public static function createSignatureRequest(array $attributes = []): SignatureRequest
    {
        $item = new SignatureRequest();

        foreach ($attributes as $attribute => $value) {
            $item->set($attribute, $value);
        }

        return $item;
    }

    /**
     * Factory method to create a SignatureRequestCollection model
     *
     * @param  array $items
     */
    public static function createSignatureRequestCollection(array $items = []): SignatureRequestCollection
    {
        $collection = new SignatureRequestCollection();

        foreach ($items as $item) {
            $collection->add(
                self::createSignatureRequest($item)
            );
        }

        return $collection;
    }

    /**
     * Factory method to create a Signer model
     *
     * @param  array $attributes
     */
    public static function createSigner(array $attributes = []): Signer
    {
        $item = new Signer();

        foreach ($attributes as $attribute => $value) {
            $item->set($attribute, $value);
        }

        return $item;
    }

    /**
     * Factory method to create a SignerCollection model
     *
     * @param  array $items
     */
    public static function createSignerCollection(array $items = []): SignerCollection
    {
        $collection = new SignerCollection();

        foreach ($items as $item) {
            $collection->add(
                self::createSigner($item)
            );
        }

        return $collection;
    }

    /**
     * Factory method to create a User model
     *
     * @param  array $attributes
     */
    public static function createUser(array $attributes = []): User
    {
        $item = new User();

        foreach ($attributes as $attribute => $value) {
            $item->set($attribute, $value);
        }

        return $item;
    }

    /**
     * Factory method to create a UserCollection model
     *
     * @param  array $items
     */
    public static function createUserCollection(array $items = []): UserCollection
    {
        $collection = new UserCollection();

        foreach ($items as $item) {
            $collection->add(
                self::createUser($item)
            );
        }

        return $collection;
    }

    /**
     * Factory method to create a Workspace model
     *
     * @param  array $attributes
     */
    public static function createWorkspace(array $attributes = []): Workspace
    {
        $item = new Workspace();

        foreach ($attributes as $attribute => $value) {
            $item->set($attribute, $value);
        }

        return $item;
    }

    /**
     * Factory method to create a WorkspaceCollection model
     *
     * @param  array $items
     */
    public static function createWorkspaceCollection(array $items = []): WorkspaceCollection
    {
        $collection = new WorkspaceCollection();

        foreach ($items as $item) {
            $collection->add(
                self::createWorkspace($item)
            );
        }

        return $collection;
    }
}
