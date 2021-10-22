<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProductType extends Enum
{
    const product   =   'product';
    const video     =   'video';
    const gallery   = 'gallery';
}
