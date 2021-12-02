<?php
/**
 * +----------------------------------------------------------------------
 * 群发任务管理
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

class Masstask extends AbstractClass
{   
    /**
     * 添加群发任务
    */
    public function create($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['addguidemassendjob'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['task_result'];
    } 
    /**
     * 获取群发任务列表
    */
    public function showlist($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getguidemassendjoblist'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    } 
    /**
     * 获取指定群发任务信息
    */
    public function details($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getguidemassendjob'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['job'];
    } 
    /**
     * 修改群发任务
    */
    public function update($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['updateguidemassendjob'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    } 
    /**
     * 取消群发任务
    */
    public function cancel($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['cancelguidemassendjob'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    } 
}