<?php
/**
 * +----------------------------------------------------------------------
 * 二维码
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

class Qrcode extends AbstractClass
{  
    /**
     * 创建二维码的ticket
    */
    public function create($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['qrcode'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }
    /**
     * 使用ticket去换取二维码
    */
    public function get($ticket) {
        $api = $this->api['mp_domain'].Tool::str_url($this->api['api_list']['qrcode_ticket'], [urlencode($ticket)]);
        
        return $api;
    }
}