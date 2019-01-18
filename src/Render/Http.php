<?php

namespace Ticklesphp\Render;

class Http
{
    protected static $_req = [];
    protected static $_resp = '';

    /**
     * 处理客户端请求，解析成应用可理解的request
     */
    public static function handleReq($req)
    {
        foreach($req as &$request){
            self::_parseMethod($request);
        }
        self::$_req = $req;
        return $req;
    }

    private static function _parseMethod(&$request)
    {
        //parse method
        [$request['controller'], $request['action']] = explode('.', $request['method']);

        if(empty($request['controller']) ||empty($request['action'])){
            throw new \Ticklesphp\Exception\LogicException("invalid_param", array('method'=>$request['method']));
        }
    }

    public static function handleResp($is=true)
    {
        return self::$_resp;
    }

    public static function success($data)
    {
        $package = self::handleSuccess($data);
        self::$_resp = $package;
    }

    private static function handleSuccess($data)
    {
        $package = [];
        //id
        if(isset(self::$_req['id'])){
            $package['id'] = self::$req['id'];
        }

        //method
        if(isset(self::$_req['method'])){
            $package['method'] = self::$req['method'];
        }
        //success
        if(is_array($data)){
            $package['success'] = $data;
        }
        //_t
        $package['_t'] = SVR_NOW;
        //_ct
        $package['_ct'] = 50;//todo

    }

    public static function error(\Exception $e)
    {
        $tmp = self::handleError($e);
        self::$_resp .= json_encode($tmp);
    }

    private static function handleError($e)
    {
        $package = [];

        //id
        if(isset(self::$_req['id'])){
            $package['id'] = self::$req['id'];
        }

        //method
        if(isset(self::$_req['method'])){
            $package['method'] = self::$req['method'];
        }

        //error
        $error['message'] = $e->getMessage();
        $error['code'] = $e->getCode();
        if(IS_MODE_DEV){
            if(!empty($data = $e->getData())){
                $error['data'] = $data;
            }
            if(!empty($echo = $e->getEcho())){
                $error['echo'] = $echo;
            }
        }

        $package['error'] = $error;

        return $package;
    }
}
