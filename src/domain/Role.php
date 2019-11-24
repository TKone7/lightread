<?php

namespace domain;

use MyCLabs\Enum\Enum;
/**
 * Status enum
 * @method static self ADMIN()
 * @method static self USER()
 */
class Role extends Enum
{
    const ADMIN = 'admin';
    const USER = 'user';
}
