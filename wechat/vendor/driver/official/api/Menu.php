<?php
/**
 * +----------------------------------------------------------------------
 * 自定义菜单
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

class Menu extends AbstractClass
{
    /**
     * 更新菜单
    */
    public function create($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['menu_create'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    }

    /**
     * 查询菜单
    */
    public function query() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['menu_query'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        
        return $ret;
    }

    /**
     * 删除菜单
    */
    public function delete() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['menu_delete'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        
        return true;
    }

    /**
     * 获取自定义菜单配置
    */
    public function get() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['menu_get'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        
        return $ret;
    }
}