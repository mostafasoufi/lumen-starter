<?php

namespace App\Http\Helper;

/**
 * Generate verify code.
 *
 * @return int
 */
function generate_code()
{
    return mt_rand(1000, 9000);
}