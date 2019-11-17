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
 * @method static self PAYMENT()
 * @method static self WITHDRAWAL()
 */
class InvPurpose extends Enum
{
    const PAYMENT = 'payment';
    const WITHDRAWAL = 'withdrawal';
}

