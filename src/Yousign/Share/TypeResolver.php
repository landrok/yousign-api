<?php

declare(strict_types=1);

/*
 * This file is part of the Yousign package.
 *
 * Copyright (c) landrok at github.com/landrok
 *
 * For the full copyright and license information, please see
 * <https://github.com/landrok/yousign-api/blob/master/LICENSE>.
 */

namespace Yousign\Share;

/**
 * \Yousign\Share\TypeResolver is an abstract class for
 * resolving class names called by their short names (AS types).
 */
abstract class TypeResolver
{
    /**
     * A list of model types
     *
     * @var array
     */
    protected static $modelTypes = [
        'fileObjects'   => 'FileObjectCollection',
        'files'         => 'FileCollection',
        'group'         => 'Group',
        'members'       => 'MemberCollection',
        'notifications' => 'Notifications',
        'permissions'   => 'PermissionCollection',
        'workspaces'    => 'WorkspaceCollection',
    ];

    /**
     * Check that a type exists
     */
    public static function exists(string $name): bool
    {
        return array_key_exists(
            $name,
            self::$modelTypes
        );
    }

    /**
     * Get factory method name
     */
    public static function getFactoryMethod(string $name): string
    {
        return self::exists($name)
            ? 'create' . self::$modelTypes[$name]
            : '';
    }
}
