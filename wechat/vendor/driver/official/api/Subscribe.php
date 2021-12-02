<?php
/**
 * +----------------------------------------------------------------------
 * 订阅通知
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

class Subscribe extends AbstractClass
{   
    /**
     * 获取公众号类目
    */
    public function category() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getcategory'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        
        return $ret['data'];
    }

    /**
     * 获取类目下的公共模板
    */
    public function template($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getpubtemplatetitles'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return $ret;
    }

    /**
     * 获取模板中的关键词
    */
    public function keys($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getpubtemplatekeywords'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return $ret;
    }
    
    /**
     * 获取私有模板列表
    */
    public function template_private() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['gettemplate'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        
        return $ret['data'];
    }
    
    /**
     * 选用模板
    */
    public function create($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['addtemplate'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return $ret['priTmplId'];
    }

    /**
     * 删除模板
    */
    public function delete($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['deltemplate'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    }

    /**
     * 发送订阅通知
    */
    public function send($body) {
        if (!is_array($body)) $body = json_decode($body, true);
        
        if (isset($body['page'])) $body['page'] = urlencode($body['page']);

        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['bizsend'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    }
}