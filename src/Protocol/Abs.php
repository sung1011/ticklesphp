<?php

namespace Ticklesphp\Protocol;

abstract class Abs
{
    abstract static function decode($params);

    abstract static function encode($data);
}
