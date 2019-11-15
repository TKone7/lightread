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
 * @method static self DRAFT()
 * @method static self PUBLISHED()
 * @method static self DELETED()
 */
class Status extends Enum
{
    const DRAFT = 'draft';
    const PUBLISHED = 'published';
    const DELETED = 'deleted';
}

