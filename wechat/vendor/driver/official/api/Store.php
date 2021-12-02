<?php
/**
 * +----------------------------------------------------------------------
 * 门店管理
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

class Store extends AbstractClass
{   
    /**
     * 创建门店
    */
    public function create($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['addpoi'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return $ret['poi_id'];
    }   
    /**
     * 查询门店
    */
    public function get($poi_id) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getpoi'], [$this->sdk->access_token()->get()]);
        $body = [
            'poi_id' => $poi_id
        ];
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return $ret['business']['base_info'];
    }  
    /**
     * 查询门店列表
    */
    public function showlist($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getpoilist'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return $ret;
    }
    /**
     * 修改门店服务信息
    */
    public function update($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['updatepoi'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    } 
    /**
     * 删除门店
    */
    public function delete($poi_id) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['delpoi'], [$this->sdk->access_token()->get()]);
        $body = [
            'poi_id' => $poi_id
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
     * 门店类目表
    */
    public function category() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getwxcategory'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        
        return $ret['category_list'];
    }  
}