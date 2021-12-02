<?php
/**
 * +----------------------------------------------------------------------
 * 客服消息
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

class Kefu extends AbstractClass
{   
    /**
     * 添加客服帐号
    */
    public function account_add($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['kfaccount_add'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    }
    /**
     * 修改客服帐号
    */
    public function account_update($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['kfaccount_update'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    }
    /**
     * 删除客服帐号
    */
    public function account_delete($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['kfaccount_del'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    }
    /**
     * 设置客服帐号的头像
    */
    public function uploadheadimg($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['kfaccount_del'], [$this->sdk->access_token()->get(), $body['kf_account']]);

        $ret = Tool::fileCurl($api, [
            'path' => $body['img_file'],
            'name' => 'file'
        ]);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    }
    /**
     * 获取所有客服账号
    */
    public function account_list() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getkflist'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        
        return $ret['kf_list'];
    }
    /**
     * 获取所有客服账号-在线
    */
    public function account_online_list() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getonlinekflist'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        
        return $ret['kf_online_list'];
    }
    
    /**
     * 发消息
    */
    public function account_send($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['kfaccount_send'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    }
    /**
     * 客服输入状态
    */
    public function account_typing($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['kfaccount_typing'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    }
    /**
     * 创建会话
    */
    public function session_create($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['kfsession_create'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    }
    /**
     * 关闭会话
    */
    public function session_close($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['kfsession_close'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    }
    /**
     * 获取客户会话状态
    */
    public function session_status($openid) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['kfsession_getsession'], [$this->sdk->access_token()->get(), $openid]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        
        return $ret;
    }
    /**
     * 获取客服会话列表
    */
    public function session_list($kf_account) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['kfsession_getsessionlist'], [$this->sdk->access_token()->get(), $kf_account]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        
        return $ret['sessionlist'];
    }
    /**
     * 获取未接入会话列表
    */
    public function session_wait_list() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['kfsession_getwaitcase'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        
        return $ret;
    }
    /**
     * 获取聊天记录
    */
    public function session_msg_list($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['kfsession_getmsglist'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return $ret;
    }
}