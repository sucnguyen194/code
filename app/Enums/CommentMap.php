<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CommentMap extends Enum
{
    const products  =   'products';
    const posts     =   'posts';
}
