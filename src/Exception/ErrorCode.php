<?php

namespace Ticklesphp\Exception;

class ErrorCode
{

    const UNKNOWN_ERROR = 1;
/**
     * 逻辑异常
     *
     * @var array
     */
    public static $LOGIC_ERROR = array(
        'invalid_param' => '1000', // 参数异常
        'session_error' => '1001', // session错误
        'connection_url_miss' => '10002', // connection的url配置丢失
        'common_config_miss' => '10003', // common.php 中缺少配置
        'section_config_miss' => '10004', // sections.php 中缺少配置
        'auth_failed' => '10005', // 授权失败
        'network_error' => '10006', // 网络错误，服务内部通信错误
        'class_not_found'=> '10007',//class未找到
        'method_not_found'=> '10008',//method未找到
    );

}
