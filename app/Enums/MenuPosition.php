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
    const top =   'top';
    const left =   'left';
    const right = 'right';
    const bottom = 'bottom';
}
