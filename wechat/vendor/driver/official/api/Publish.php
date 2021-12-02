<?php
/**
 * +----------------------------------------------------------------------
 * 发布能力
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

class Publish extends AbstractClass
{   
    /**
     * 发布
    */
    public function submit($media_id) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['freepublish_submit'], [$this->sdk->access_token()->get()]);
        $body = [
            'media_id' => $media_id
        ];
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['publish_id'];
    }    
    /**
     * 发布状态轮询
    */
    public function get($publish_id) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['freepublish_get'], [$this->sdk->access_token()->get()]);
        $body = [
            'publish_id' => $publish_id
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
     * 删除发布
    */
    public function delete($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['freepublish_delete'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }  
    /**
     * 通过 article_id 获取已发布文章
    */
    public function get_article($article_id) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['freepublish_getarticle'], [$this->sdk->access_token()->get()]);
        $body = [
            'article_id' => $article_id
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
     * 获取成功发布列表
    */
    public function showlist() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['freepublish_batchget'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        return $ret;
    }  
}