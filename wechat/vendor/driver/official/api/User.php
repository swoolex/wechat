<?php
/**
 * +----------------------------------------------------------------------
 * 用户管理
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

class User extends AbstractClass
{  
    /**
     * 创建标签
    */
    public function tag_create($name) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['tags_create'], [$this->sdk->access_token()->get()]);
        $body = [
            'tag' => [
                'name' => $name
            ]
        ];
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['tag'];
    }   

    /**
     * 获取公众号已创建的标签
    */
    public function tag_get() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['tags_get'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        return $ret['tags'];
    }   

    /**
     * 编辑标签
    */
    public function tag_update($data) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['tags_update'], [$this->sdk->access_token()->get()]);
        $body = [
            'tag' => $data
        ];
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }  

    /**
     * 删除标签
    */
    public function tag_delete($id) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['tags_delete'], [$this->sdk->access_token()->get()]);
        $body = [
            'tag' => [
                'id' => $id
            ]
        ];
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }   

    /**
     * 获取标签下粉丝列表
    */
    public function tag_user($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['user_tag_get'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    } 
    /**
     * 批量为用户打标签
    */
    public function user_add_tag($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['batchtagging'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    } 
    /**
     * 批量为用户取消标签
    */
    public function user_delete_tag($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['batchuntagging'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    } 
    /**
     * 获取用户身上的标签列表
    */
    public function user_get_tag($openid) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['tags_getidlist'], [$this->sdk->access_token()->get()]);
        $body = [
            'openid' => $openid
        ];
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['tagid_list'];
    } 
    
    /**
     * 通过OpenID设置用户备注名
    */
    public function update_remark($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['remarks'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    } 
    
    /**
     * 通过OpenID来获取用户基本信息
    */
    public function userinfo($openid, $lang='zh_CN') {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['basic'], [$this->sdk->access_token()->get(), $openid, $lang]);
        
        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        return $ret;
    }

    /**
     * 通过OpenId获取用户列表
    */
    public function showlist($next_openid='') {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['user_list'], [$this->sdk->access_token()->get(), $next_openid]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        return $ret;
    }

    /**
     * 获取公众号的黑名单列表
    */
    public function blacklist($begin_openid='') {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getblacklist'], [$this->sdk->access_token()->get()]);
        $body = [
            'begin_openid' => $begin_openid
        ];
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }

    /**
     * 拉黑用户
    */
    public function batch_black($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['batchblacklist'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }

    /**
     * 取消拉黑用户
    */
    public function cancel_black($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['batchunblacklist'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }
}