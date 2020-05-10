<?php

/*
 * This file is part of the Yousign package.
 *
 * Copyright (c) landrok at github.com/landrok
 *
 * For the full copyright and license information, please see
 * <https://github.com/landrok/activitypub/blob/master/LICENSE>.
 */

namespace Yousign\Model;

use Exception;

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
     * @return \Yousign\Model\File
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
     * @return \Yousign\Model\FileCollection
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
     * @return \Yousign\Model\FileObject
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
     * @return \Yousign\Model\FileObjectCollection
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
     * @return \Yousign\Model\Member
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
     * @return \Yousign\Model\MemberCollection
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
     * @return \Yousign\Model\Procedure
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
     * @return \Yousign\Model\User
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
     * @return \Yousign\Model\UserCollection
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
     * @return \Yousign\Model\Workspace
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
     * @return \Yousign\Model\WorkspaceCollection
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
     * @return \Yousign\Model\Group
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
     * @return \Yousign\Model\Permission
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
     * @param  string[] $items
     * @return \Yousign\Model\PermissionCollection
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
     * @return \Yousign\Model\Notifications
     */
    public static function createNotifications(array $attributes = []): Notifications
    {
        $item = new Notifications();

        foreach ($attributes as $attribute => $value) {
            $item->set($attribute, $value);
        }

        return $item;
    }
}
