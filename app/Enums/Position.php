<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Position extends Enum
{
    const Slider = 1;
    const Banner = 2;
    const Logo = 3;
    const Partner = 4;
    const Idol = 5;
}
