<?php
/**
 * +----------------------------------------------------------------------
 * 消息模板
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

class Template extends AbstractClass
{
    /**
     * 设置所属行业
    */
    public function set_industry($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['template_set_industry'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    }

    /**
     * 获取设置的行业信息
    */
    public function get_industry() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['template_get_industry'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        
        return $ret;
    }

    /**
     * 获取模板ID
    */
    public function get_id($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['template_get_id'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return $ret['template_id'];
    }

    /**
     * 获取模板列表
    */
    public function get_list() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['template_get_list'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        
        return $ret['template_list'];
    }
    
    /**
     * 删除模板
    */
    public function delete_industry($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['template_delete_industry'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    }

    /**
     * 发送消息模板
    */
    public function send($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['template_send_industry'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    }


    /**
     * 生成一次性订阅授权链接
    */
    public function disposable_auth_url($body) {
        if (!is_array($body)) $body = json_decode($body, true);
        $data = [
            $this->config['appid'],
            'scene' => $body['scene'] ?? '',
            'template_id' => $body['template_id'] ?? '',
            'redirect_url' => $body['redirect_url'] ? urlencode($body['redirect_url']) : '',
            'reserved' => $body['reserved'] ?? '',
        ];
        $api = $this->api['mp_domain'].Tool::str_url($this->api['api_list']['subscribemsg'], $data);

        return $api;
    }
    
    /**
     * 发送一次性订阅消息模板
    */
    public function disposable_auth_send($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['subscribe'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    }
}