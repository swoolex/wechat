<?php
/**
 * +----------------------------------------------------------------------
 * 客服素材管理
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

class Material extends AbstractClass
{   
    /**
     * 添加小程序卡片素材
    */
    public function mini_create($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['setguidecardmaterial'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    } 
    /**
     * 查询小程序卡片素材
    */
    public function mini_get($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getguidecardmaterial'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['card_list'];
    }
    /**
     * 删除小程序卡片素材
    */
    public function mini_delete($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['delguidecardmaterial'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }
    /**
     * 添加图片素材
    */
    public function image_create($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['setguideimagematerial'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }
    /**
     * 查询图片素材
    */
    public function image_get($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getguideimagematerial'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }
    /**
     * 删除图片素材
    */
    public function image_delete($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['delguideimagematerial'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }
    /**
     * 添加文字素材
    */
    public function text_create($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['setguidewordmaterial'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }
    /**
     * 查询文字素材
    */
    public function text_get($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getguidewordmaterial'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }
    /**
     * 删除文字素材
    */
    public function text_delete($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['delguidewordmaterial'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }
}