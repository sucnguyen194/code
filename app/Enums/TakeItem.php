<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TakeItem extends Enum
{
    const index =   'index';
    const category =   'category';
    const replated =  'related';
}
