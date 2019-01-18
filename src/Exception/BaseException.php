<?php

namespace Ticklesphp\Exception;

abstract class BaseException extends \Exception
{
    protected $data;

    protected $echo;

    public function __construct($message, $data = [], $echo = null)
    {
        //message
        $this->message = $message;

        //data
        $this->data = $data;

        //code
        $this->setCodeByMessage();

        //lang
        $this->echo = $echo;

    }

    abstract function setCodeByMessage();

    public function getData()
    {
        return $this->data;
    }

    public function getEcho()
    {
        return $this->echo;
    }
}
