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
    const post = "post";
    const page = "page";
    const video = "video";
    const gallery = "gallery";
}
