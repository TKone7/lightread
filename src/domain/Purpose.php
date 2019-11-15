<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 15.11.19
 * Time: 13:58
 */

namespace domain;


use MyCLabs\Enum\Enum;
/**
 * Purpose enum
 * @method static self DONATION()
 * @method static self READ()
 */
class Purpose extends Enum
{
    const DONATION = 'donation';
    const READ = 'read';
}

