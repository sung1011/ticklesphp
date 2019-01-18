<?php

namespace Ticklesphp\Exception;

use Ticklesphp\Exception\BaseException;

class LogicException extends BaseException
{
    public function setCodeByMessage()
    {
        if(isset(ErrorCode::$LOGIC_ERROR[$this->message])){
            $this->code = ErrorCode::$LOGIC_ERROR[$this->message];
        }else{
            $this->code = ErrorCode::UNKNOWN_ERROR;
        }
    }
}
