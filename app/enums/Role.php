<?php

namespace App\enums;

enum Role: string
{
    case SUPER_ADMINISTRATOR = 'superadministrator';
    case ADMINISTRATOR = 'administrator';

    case EDITOR = 'editor';

    case USER = 'user';
}
