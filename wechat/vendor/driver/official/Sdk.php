<?php
/**
 * +----------------------------------------------------------------------
 * 公众号开发实例
 * +----------------------------------------------------------------------
 * 官网：https://www.sw-x.cn
 * +----------------------------------------------------------------------
 * 作者：小黄牛 <1731223728@qq.com>
 * +----------------------------------------------------------------------
 * 开源协议：http://www.apache.org/licenses/LICENSE-2.0
 * +----------------------------------------------------------------------
*/
namespace wechat\vendor\driver\official;

class Sdk
{
    /**
     * 公众号配置
    */
    private $config = [];
    /**
     * API列表
    */
    private $api = [];
    
    /**
     * 构造方法：修改配置驱动
     * 
     * @param array $config
     * @param array $api
    */
    public function __construct($config, $api) {
        $this->config = $config;
        $this->api = $api;
    }

    /**
     * SQL构造器注入
     * @todo 无
     * @author 小黄牛
     * @version v1.0.1 + 2020.05.29
     * @deprecated 暂不启用
     * @global 无
     * @return void
    */
    public function __call($name, $arguments=[]) {
        $class = '\wechat\vendor\driver\official\api\\'.ucfirst($name);
        return new $class($this, $this->config, $this->api);
    }
}