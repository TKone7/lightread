<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 15.11.19
 * Time: 01:12
 */

namespace domain;

use MyCLabs\Enum\Enum;
/**
 * Status enum
 * @method static self OPEN()
 * @method static self SETTLED()
 * @method static self CANCELED()
 * @method static self ACCEPTED()
 */
class InvStatus extends Enum
{
    const OPEN = 'open';
    const SETTLED = 'settled';
    const CANCELED = 'caceled';
    const ACCEPTED = 'accepted';

}

