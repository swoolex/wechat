<?php
/**
 * +----------------------------------------------------------------------
 * 顾问
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

class Guideacct extends AbstractClass
{   
    /**
     * 添加顾问
    */
    public function create($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['addguideacct'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    }   
    /**
     * 获取顾问信息
    */
    public function get($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getguideacct'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return $ret;
    }
    /**
     * 修改顾问信息
    */
    public function update($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['updateguideacct'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    }   
    /**
     * 删除顾问
    */
    public function delete($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['delguideacct'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    }  
    /**
     * 获取服务号顾问列表
    */
    public function showlist($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getguideacctlist'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return $ret;
    }  
    /**
     * 生成顾问二维码
    */
    public function qrcode($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['guidecreateqrcode'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return $ret['qrcode_url'];
    } 
    /**
     * 获取顾问聊天记录
    */
    public function chat_record($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getguidebuyerchatrecord'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return $ret;
    } 
    /**
     * 设置快捷回复与关注自动回复
    */
    public function set_config($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['setguideconfig'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    }  
    /**
     * 获取快捷回复与关注自动回复
    */
    public function get_config($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getguideconfig'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return $ret;
    }  
    /**
     * 设置敏感词与离线自动回复
    */
    public function set_word($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['setguideacctconfig'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    }
    /**
     * 获取敏感词与离线自动回复
    */
    public function get_word() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getguideacctconfig'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        
        return $ret;
    } 
    /**
     * 允许微信用户复制小程序页面路径
    */
    public function copy_path($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['pushshowwxapathmenu'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    } 
    /**
     * 新建顾问分组
    */
    public function group_create($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['newguidegroup'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return $ret['group_id'];
    } 
    /**
     * 获取服务号下所有顾问分组的列表
    */
    public function group_list() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getguidegrouplist'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        
        return $ret['group_list'];
    }
    /**
     * 获取顾问分组信息
    */
    public function group_page($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getgroupinfo'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return $ret;
    } 
    /**
     * 分组内添加顾问
    */
    public function group_add_guide($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['addguide2guidegroup'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    } 
    /**
     * 分组内删除顾问
    */
    public function group_delete_guide($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['delguide2guidegroup'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    } 
    /**
     * 获取顾问所在分组
    */
    public function guide_select_group($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getgroupbyguide'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return $ret['group_id_list'];
    } 
    /**
     * 删除顾问分组
    */
    public function group_delete($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['delguidegroup'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    } 
    
}
