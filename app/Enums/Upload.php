<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Upload extends Enum
{
    const logo =   1;
    const background =   2;
    const favicon = 3;
    const image = 4;
    const thumbnail = 5;
    const og_image = 6;
    const avatar = 7;
}
