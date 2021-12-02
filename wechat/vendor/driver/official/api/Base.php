<?php
/**
 * +----------------------------------------------------------------------
 * 基础接口
 * +----------------------------------------------------------------------
 * 官网：https://www.sw-x.cn
 * +----------------------------------------------------------------------
 * 作者：小黄牛 <1731223728@qq.com>
 * +----------------------------------------------------------------------
 * 开源协议：http://www.apache.org/licenses/LICENSE-2.0
 * +----------------------------------------------------------------------
*/
namespace wechat\vendor\driver\official\api;
use wechat\vendor\driver\AbstractClass;
use wechat\vendor\Tool;

class Base extends AbstractClass
{
    /**
     * 查询rid
    */
    public function get_rid($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['get_rid'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (empty($ret['request'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['request'];
    }

    /**
     * 查询openAPI调用quota
    */
    public function get_quota($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['get_quota'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (empty($ret['quota'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['quota'];
    }

    /**
     * 清空api的调用quota
    */
    public function clear_quota() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['clear_quota'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, [
            'appid' => $this->config['appid']
        ]);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        return true;
    }

    /**
     * 网络检测
    */
    public function ping($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['check'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (isset($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        return $ret;
    }

    /**
     * 获取微信服务器IP地址
    */
    public function get_domain_ip() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['get_api_domain_ip'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (empty($ret['ip_list'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        return $ret['ip_list'];
    }
}