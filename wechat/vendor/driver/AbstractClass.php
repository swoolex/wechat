<?php
/**
 * +----------------------------------------------------------------------
 * 公众号 - 账号配置 - DB查询器抽象类
 * +----------------------------------------------------------------------
 * 官网：https://www.sw-x.cn
 * +----------------------------------------------------------------------
 * 作者：小黄牛 <1731223728@qq.com>
 * +----------------------------------------------------------------------
 * 开源协议：http://www.apache.org/licenses/LICENSE-2.0
 * +----------------------------------------------------------------------
*/

namespace wechat\vendor\driver;

abstract class AbstractClass
{
    /**
     * 父类SDK实例
    */
    protected $sdk;
    /**
     * 公众号配置
    */
    protected $config = [];
    /**
     * API列表
    */
    protected $api = [];
    
    /**
     * 构造方法：修改配置驱动
     * 
     * @param Sdk $sdk
     * @param array $config
     * @param array $api
    */
    public function __construct($sdk, $config, $api) {
        $this->sdk = $sdk;
        $this->config = $config;
        $this->api = $api;
    }
}