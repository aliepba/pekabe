<?php

namespace App\Enums;

use Illuminate\Support\Facades\Config;
use MyCLabs\Enum\Enum;

class SiJKT extends Enum
{
    public static function URL()
    {
        return Config::get('sijkt.url');
    }

    public static function NUMBER()
    {
        return Config::get('sijkt.number');
    }

    public static function KEY()
    {
        return Config::get('sijkt.key');
    }

    public static function API(){
        return Config::get('sijkt.api');
    }
}