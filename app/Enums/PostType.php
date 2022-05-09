<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PostType extends Enum
{
    const post = 1;
    const page = 2;
    const video = 3;
    const gallery = 4;
    const recruitment = 5;
}
