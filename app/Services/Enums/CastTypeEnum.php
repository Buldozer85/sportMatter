<?php

declare(strict_types=1);

namespace App\Services\Enums;

use App\enums\Role;

enum CastTypeEnum
{
    public const STRING = 'string';
    public const INTEGER = 'integer';
    public const FLOAT = 'float';
    public const DOUBLE = 'double';
    public const DECIMAL = 'decimal';
    public const BOOLEAN = 'boolean';
    public const DATE = 'date';
    public const DATETIME = 'dateTime';
    public const JSON = 'json';

    public const HASHED = 'hashed';

    public const ROLE = Role::class;
}
