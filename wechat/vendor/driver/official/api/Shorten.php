<?php
/**
 * +----------------------------------------------------------------------
 * 短链接托管
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

class Shorten extends AbstractClass
{  
    /**
     * 长信息转短
    */
    public function gen($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['shorten_gen'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['short_key'];
    }
    /**
     * 短信息转长
    */
    public function fetch($short_key) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['shorten_fetch'], [$this->sdk->access_token()->get()]);
        $body = [
            'short_key' => $short_key
        ];
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }
}