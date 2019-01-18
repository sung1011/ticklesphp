<?php

namespace Ticklesphp;

use Ticklesphp\Exception\LogicException;

class Application
{
    public static $protocol;
    public static $render;
    public static $server;
    public $req = [];//框架解析后的request数据
    public $resp = [];//框架处理后的response数据

    private static $instance = null;

    //protocal class name map
    protected $protocol_maps = [
        '_default' => '\Ticklesphp\Protocol\Http',
        'http' => '\Ticklesphp\Protocol\Http',
        // cron
        // json
        // cli(task?)
        // ...
    ];

    //req render class name map
    protected $render_maps = [
        '_default' => '\Ticklesphp\Render\Http',
        'http' => '\Ticklesphp\Render\Http',
    ];

    //server map
    protected $server_maps = [
        '_default' => '\Ticklesphp\server\Api',
        'http' => '\Ticklesphp\server\Api',
    ];

    //run mode
    protected $run_mod = 'api';

    //shutdown callback -- key: name, ele1: obj, ele2: callback
    protected $shutdownCallbacks = [];

    public static function &getInstance()
    {
        if(self::$instance == null){
            self::$instance = new static();
        }
        return self::$instance;
    }
    /**
     * run by mod
     *
     * @param string $mod mode
     */
    public function run($mod)
    {
        if(isset($mod)){
            $this->run_mod = $mod;
        }else{
            $this->run_mod = '_default';
        }
        $this->input_params = $_GET;//todo just apply to http, so need adjust

        $this->_beforeRun();

        $this->doMaps();

        $this->handlerReq();

        $this->_afterRun();
    }

    /**
     * do map by run mode
     */
    protected function doMaps()
    {
        self::$protocol = $this->protocol_maps[$this->run_mod];
        self::$render = $this->render_maps[$this->run_mod];
        self::$server = $this->server_maps[$this->run_mod];
    }

    /**
     * handler request
     */
    protected function handlerReq()
    {
        try{
            //req data
            $requests = call_user_func([self::$protocol, 'decode'], $this->input_params);
            //req data format
            $this->req = call_user_func([self::$render, 'handleReq'], $requests);

            //分包处理
            foreach($this->req as $req){
                $this->_beforePackage();
                $server = new self::$server();
                $this->resp = $server->run($req);

                $this->_afterPackage();
            }
        }catch(\Exception $e){
            call_user_func_array([self::$render, 'error'], [$e]);
            //todo format error
            //todo error log
        }
        //resp data format
        $responses = call_user_func(array(self::$render ,'handleResp'));
        //resp data output
        echo call_user_func([self::$protocol, 'encode'], $responses);
    }

    /**
     * before run
     */
    protected function _beforeRun()
    {
        //nothing
    }

    /**
     * after run
     */
    protected function _afterRun()
    {
        //call shutdown funcs
        $this->callShutDownCallbacks();
    }

    /**
     * 单包处理后任务
     */
    protected function _afterPackage()
    {
    }

    /**
     * 单包处理前任务
     */
    protected function _beforePackage()
    {
    }

    /**
     * regist shutdown callback
     *
     * @param string $name name
     * @param string $callback callback
     * @param string $obj callback's class
     */
    protected function registShutdownCallback($name, $callback, $obj=null) {
        if(!isset($this->shutdownCallBacks[$name])){
            $this->shutdownCallBacks[$name] = $obj==null ? $callback : [$obj, $callback];
        }
    }

    /**
     * exec shutdowncallbacks
     */
    protected function callShutDownCallbacks()
    {
        return array_map('call_user_func', $this->shutdownCallbacks);
    }
}
