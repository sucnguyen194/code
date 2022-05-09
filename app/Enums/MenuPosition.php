<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class MenuPosition extends Enum
{
    const top = 1;
    const home = 2;
    const left = 3;
    const right = 4;
    const bottom = 5;
}
