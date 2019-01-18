<?php

/**
 * 返回参数中的指定key的值
 * @param array     param     参数
 * @param string    key       键
 * @param string    type      数据类型
 * @param boll      require   是否必须
 * @param mixed     def       默认值
 */
function getParam($params, $key, $type = null, $require = true, $default = null) {
    if(!is_null($default)){
        return $default;
    }
    return $params[$key];
}

