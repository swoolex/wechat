<?php
/**
 * +----------------------------------------------------------------------
 * 一物一码
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

class Thingyard extends AbstractClass
{   
    /**
     * 申请二维码
    */
    public function apply($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['applycode'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return $ret['application_id'];
    }  
    /**
     * 查询二维码申请单
    */
    public function apply_get($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['applycodequery'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return $ret;
    } 
    /**
     * 下载二维码包
    */
    public function download($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['applycodedownload'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }

        $decrypted = openssl_decrypt(base64_decode($ret['buffer']), 'AES-128-CBC', $this->config['thingyard_key'], OPENSSL_CIPHER_AES_128_CBC, $this->config['thingyard_key']);
        $result = $this->decode($decrypted);

        return $result;
    }
    /**
     * 激活二维码
    */
    public function active($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['codeactive'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return true;
    } 
    /**
     * 查询二维码激活状态
    */
    public function active_query($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['codeactivequery'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return $ret;
    }  
    /**
     * code_ticket换code
    */
    public function code_ticket($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['tickettocode'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        
        return $ret;
    }    

    // 解密补位删除
    private function decode($text) {
		$pad = ord(substr($text, -1));
		if ($pad < 1 || $pad > 32) $pad = 0;
		return substr($text, 0, (strlen($text) - $pad));
	}
}