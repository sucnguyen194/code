<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CategoryType extends Enum
{
    const category = 1;
    const post = 2;
    const product = 3;
    const recruitment = 4;
}
