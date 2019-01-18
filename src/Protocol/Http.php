<?php

namespace Ticklesphp\Protocol;

class Http extends Abs
{
    public static function decode($params = null)
    {
        //默认不支持分包
        return [$_REQUEST];
    }

    public static function encode($data)
    {
        return json_encode($data);
    }
}
