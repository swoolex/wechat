<?php
/**
 * +----------------------------------------------------------------------
 * 标签管理
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

class Lable extends AbstractClass
{   
    /**
     * 新建标签类型
    */
    public function create($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['newguidetagoption'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }
    /**
     * 删除指定标签类型
    */
    public function delete($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['delguidetagoption'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }
    /**
     * 为标签添加可选值
    */
    public function add_option($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['addguidetagoption'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }
    /**
     * 获取标签和可选值
    */
    public function get() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getguidetagoption'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        return $ret['options'];
    }
    /**
     * 为客户设置标签
    */
    public function add_user($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['addguidebuyertag'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        if (isset($ret['buyer_resp'])) return $ret['buyer_resp'];
        return true;
    }
    /**
     * 查询客户标签
    */
    public function select_user($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getguidebuyertag'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['tag_values'];
    }
    /**
     * 根据标签值筛选客户
    */
    public function query_user($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['queryguidebuyerbytag'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['openid_list'];
    }
    /**
     * 删除客户标签
    */
    public function delete_user($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['delguidebuyertag'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        if (isset($ret['buyer_resp'])) return $ret['buyer_resp'];
        return true;
    }
    /**
     * 设置自定义客户信息
    */
    public function add_diy_user($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['addguidebuyerdisplaytag'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }
    /**
     * 获取自定义客户信息
    */
    public function get_diy_user($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['addguidebuyerdisplaytag'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['display_tag_list'];
    }
}