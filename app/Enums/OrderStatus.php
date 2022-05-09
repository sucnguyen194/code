<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OrderStatus extends Enum
{
    const canceled = 0;
    const completed = 1;
    const pending = 2;
    const error = 3;
    const confirming = 4;
}
