<?php
/**
 * +----------------------------------------------------------------------
 * 客户管理
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

class Customer extends AbstractClass
{   
    /**
     * 为顾问分配客户
    */
    public function guide_add_user($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['addguidebuyerrelation'], [$this->sdk->access_token()->get()]);

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
     * 为顾问移除客户
    */
    public function guide_delete_user($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['delguidebuyerrelation'], [$this->sdk->access_token()->get()]);

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
     * 获取顾问的客户列表
    */
    public function guide_list_user($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getguidebuyerrelationlist'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }
    /**
     * 为客户更换顾问
    */
    public function user_update_guide($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['rebindguideacctforbuyer'], [$this->sdk->access_token()->get()]);

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
     * 修改客户昵称
    */
    public function user_update_nick($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['updateguidebuyerrelation'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }
    /**
     * 查询客户所属顾问
    */
    public function user_select_guide($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getguidebuyerrelationbybuyer'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }
    /**
     * 查询指定顾问和客户的关系
    */
    public function user_join_guide($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getguidebuyerrelation'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }
}