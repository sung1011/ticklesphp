<?php

namespace Ticklesphp\Server;

use Ticklesphp\Exception\LogicException;

class Api implements Iserver
{
    public function run($req)
    {
        $controller = getParam($req, 'controller', 'string', true);
        $action     = getParam($req, 'action', 'string', true);
        $params     = getParam($req, 'params', 'array', false, array());

        return $this->_handler($controller, $action, $params);
    }

    private function _handler($controller, $action, $params)
    {
        //todo APP_NS 必须设定 需要解决依赖
        $class = APP_NS . '\\controller\\' . $controller;
        //chk class
        if(!class_exists($class)){
            throw new LogicException('class_not_found');
        }
        //chk method
        if(!method_exists($class, $action)){
            throw new LogicException('method_not_found');
        }
        //run
        $instance = new $class;
        return $instance->$action();
    }
}
