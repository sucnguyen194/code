<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static true()
 * @method static static false()
 */
final class Activation extends Enum  implements LocalizedEnum
{
    const true =   1;
    const false =   0;

    public $html;
    public function __construct($enumValue)
    {
        parent::__construct($enumValue);
        $this->html = static::getHtml($enumValue);
    }

    public static function getHtml($value): string
    {
        return '<i>'.$value.'</i>';
    }
//    public static function parseDatabase($value)
//    {
//        return (int) $value;
//    }
}
