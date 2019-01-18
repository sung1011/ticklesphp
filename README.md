# ticklesphp
[![Scrutinizer Build](https://img.shields.io/scrutinizer/build/g/filp/whoops.svg)]()
[![Latest Unstable Version](https://poser.pugx.org/topthink/framework/v/unstable)](https://packagist.org/packages/topthink/framework)

##### a constantly stir php framework !

## todo:
- [x] composer 
- [x] protocol 
- [x] formatter 
- [x] controller 
- [ ] exception
    - [x] base
    - [x] formatter
    - [x] logic
    - [x] errorcode
    - [x] lang
    - [x] data
    - [x] code
    - [x] message
    - [ ] error trace
- [x] common/functions (全局方法)
- [ ] server
    - [x] 分包处理:过个请求, 失败不回滚 [done]
    - [ ] batch:多个请求, 失败回滚
- [ ] hook
- [ ] db
    - [ ] mongodb
    - [ ] mysql?
- [ ] model
- [ ] cache
    - [ ] redis
    - [ ] yac
- [ ] conf
    - [ ] filecache
    - [ ] filecache模板化
- [ ] platform
    - [ ] dev
    - [ ] test
- [ ] log
    - [ ] game
    - [ ] error
    - [ ] phpfpm
    - [ ] cron (task)
- [ ] socket
    - [ ] rpc(分布式支持)
- [ ] task
    - [ ] php
    - [ ] python
    - [ ] bash
- [ ] cron
- [ ] test
    - [ ] phpunit
- [ ] demo
- [ ] 重构
    - [ ] 易用性
    - [ ] 易部署
- [ ] tool
    - [ ] 配置更新方案
    - [ ] 清理cache
    - [ ] debug
    - [ ] xhprof
    - [ ] stress test
    - [ ] snap
    - [ ] git make tag
- [ ] doc
    - [ ] 接口文档(自动化生成)
    - [ ] schema数据结构文档(自动化生成)


## 说明
start: 2017.3.5

## 框架结构

## 运行

## 配置

## demo

## 坑
- [x] different with new self() && new static()

## 数据结构
### jsonrpc
#### request
```json
{
    "id":"request_id_xxx",
    "method":"User.get",
    "params":{
        "rid":"rid_xxx"
    },
}
```

#### response ( success )
```json
{
    "id":"request_id_xxx",
    "method":"User.get",
    "success":{
        "d":{
            "user":{
                "name":"xxx",
            }
        }
    },
    "data":{
        "user":{
            "age":"xxx",
            "sex":"xxx"
        }
    },
    "_t":1488961871,
    "_ct":5
}
```

#### response ( error )
```json
{
    "id":"request_id_xxx",
    "method":"User.get",
    "error":{
        "message":"user not exist",
        "code":"10001",
        "data":{
            "msg":"user not exist by rid rid_xxx"
        },
        "lang":"用户不存在"
    }
}
```
