<?php
/**
 * +----------------------------------------------------------------------
 * 微信开发支持
 * +----------------------------------------------------------------------
 * 官网：https://www.sw-x.cn
 * +----------------------------------------------------------------------
 * 作者：小黄牛 <1731223728@qq.com>
 * +----------------------------------------------------------------------
 * 开源协议：http://www.apache.org/licenses/LICENSE-2.0
 * +----------------------------------------------------------------------
*/
namespace wechat;

class Wechat
{
    /**
     * 使用的配置驱动
    */
    private $driver = 'default';
    /**
     * API配置
    */
    private $config = [];
    
    /**
     * 构造方法：修改配置驱动
     * 
     * @param string $driver
    */
    public function __construct($driver='default') {
        $this->driver = $driver;
    }

    /**
     * 修改配置驱动
     * 
     * @param string $driver
    */
    public function driver($driver) {
        $this->driver = $driver;
        return $this;
    }

    /**
     * 修改配置项
     * 
     * @param array $config
    */
    public function set($config) {
        $this->config = array_merge($this->config, $config);
        return $this;
    }

    /**
     * 公众号开发实例
    */
    public function official() {
        $path = EXTEND_PATH.'wechat'.DS.'config'.DS;
        $api_file = $path.'api'.DS.'official_account.php';
        $config_file = $path.'attribute'.DS.'official_account.php';

        if (!file_exists($api_file)) {
            throw new \Exception("Missing file ：".$api_file);
            return false;
        }
        if (!file_exists($config_file)) {
            throw new \Exception("Missing file ：".$config_file);
            return false;
        }
        
        $api = require $api_file;

        $array = require $config_file;
        $client_config = require $path.'config.php';
        $querier = (new $client_config['official_account'])->run();
        if (!empty($querier)) {
            $array = $querier;
        }

        $config = [];
        foreach ($array as $v) {
            if ($v['driver'] == $this->driver) {
                $config = $v;
                break;
            }
        }
        if (empty($config)) {
            throw new \Exception("Configuration driver ：".$this->driver.' Undefined');
            return false;
        }
        $this->config = array_merge($config, $this->config);
        
        return new \wechat\vendor\driver\official\Sdk($this->config, $api);
    }
}