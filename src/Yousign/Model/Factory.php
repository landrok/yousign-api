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

namespace Yousign\Model;

/**
 * \Yousign\Factory is a factory for all models. It does not send HTTP
 * requests to the API.
 *
 * It provides shortcuts methods for type instanciation and more.
 */
abstract class Factory
{
    /**
     * Factory method to create a File model
     *
     * @param  array $attributes
     */
    public static function createFile(array $attributes = []): File
    {
        $item = new File();

        foreach ($attributes as $attribute => $value) {
            $item->set($attribute, $value);
        }

        return $item;
    }

    /**
     * Factory method to create a FileCollection model
     *
     * @param  array $items
     */
    public static function createFileCollection(array $items = []): FileCollection
    {
        $collection = new FileCollection();

        foreach ($items as $item) {
            $collection->add(
                self::createFile($item)
            );
        }

        return $collection;
    }

    /**
     * Factory method to create a FileObject model
     *
     * @param  array $attributes
     */
    public static function createFileObject(array $attributes = []): FileObject
    {
        $item = new FileObject();

        foreach ($attributes as $attribute => $value) {
            $item->set($attribute, $value);
        }

        return $item;
    }

    /**
     * Factory method to create a FileObjectCollection model
     *
     * @param  array $items
     */
    public static function createFileObjectCollection(array $items = []): FileObjectCollection
    {
        $collection = new FileObjectCollection();

        foreach ($items as $item) {
            $collection->add(
                self::createFileObject($item)
            );
        }

        return $collection;
    }

    /**
     * Factory method to create a Member model
     *
     * @param  array $attributes
     */
    public static function createMember(array $attributes = []): Member
    {
        $item = new Member();

        foreach ($attributes as $attribute => $value) {
            $item->set($attribute, $value);
        }

        return $item;
    }

    /**
     * Factory method to create a MemberCollection model
     *
     * @param  array $items
     */
    public static function createMemberCollection(array $items = []): MemberCollection
    {
        $collection = new MemberCollection();

        foreach ($items as $item) {
            $collection->add(
                self::createMember($item)
            );
        }

        return $collection;
    }

    /**
     * Factory method to create a Procedure model
     *
     * @param  array $attributes
     */
    public static function createProcedure(array $attributes = []): Procedure
    {
        $item = new Procedure();

        foreach ($attributes as $attribute => $value) {
            $item->set($attribute, $value);
        }

        return $item;
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

    /**
     * Factory method to create a Group model
     *
     * @param  array $attributes
     */
    public static function createGroup(array $attributes = []): Group
    {
        $item = new Group();

        foreach ($attributes as $attribute => $value) {
            $item->set($attribute, $value);
        }

        return $item;
    }

    /**
     * Factory method to create a Permission model
     *
     * @param  array $attributes
     */
    public static function createPermission(array $attributes = []): Permission
    {
        $item = new Permission();

        foreach ($attributes as $attribute => $value) {
            $item->set($attribute, $value);
        }

        return $item;
    }

    /**
     * Factory method to create a PermissionCollection model
     *
     * @param  array<string> $items
     */
    public static function createPermissionCollection(array $items = []): PermissionCollection
    {
        $collection = new PermissionCollection();

        foreach ($items as $item) {
            $collection->add(
                self::createPermission([
                    'name' => $item
                ])
            );
        }

        return $collection;
    }

    /**
     * Factory method to create a Notifications model
     *
     * @param  array $attributes
     */
    public static function createNotifications(array $attributes = []): Notifications
    {
        $item = new Notifications();

        foreach ($attributes as $attribute => $value) {
            $item->set($attribute, $value);
        }

        return $item;
    }

    /**
     * Factory method to create a SignatureUi model
     *
     * @param array $attributes
     */
    public static function createSignatureUi(array $attributes = []): SignatureUi
    {
        $item = new SignatureUi();

        foreach ($attributes as $attribute => $value) {
            $item->set($attribute, $value);
        }

        return $item;
    }
}
