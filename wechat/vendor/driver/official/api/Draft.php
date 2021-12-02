<?php
/**
 * +----------------------------------------------------------------------
 * 草稿箱
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

class Draft extends AbstractClass
{   
    /**
     * 新建草稿
    */
    public function create($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['draft_add'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['media_id'];
    }  
    /**
     * 获取草稿
    */
    public function get($media_id) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['draft_get'], [$this->sdk->access_token()->get()]);
        $body = [
            'media_id' => $media_id
        ];
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['news_item'];
    }   
    /**
     * 删除草稿
    */
    public function delete($media_id) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['draft_delete'], [$this->sdk->access_token()->get()]);
        $body = [
            'media_id' => $media_id
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
     * 修改草稿
    */
    public function update($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['draft_update'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    } 
    /**
     * 获取草稿总数
    */
    public function count() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['draft_count'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['total_count'];
    }  
    /**
     * 获取草稿列表
    */
    public function showlist() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['draft_batchget'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    } 
    
    

}