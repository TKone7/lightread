<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 15.11.19
 * Time: 01:35
 */

namespace domain;


use MyCLabs\Enum\Enum;
/**
 * Access enum
 * @method static self FREE()
 * @method static self PAID()
 */
class Access extends Enum
{
    const FREE = 'free';
    const PAID = 'paid';
}

