<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class SupportType extends Enum
{
    const support =   1;
    const customer =   2;
    const question =  3;
}
