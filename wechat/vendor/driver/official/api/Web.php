<?php
/**
 * +----------------------------------------------------------------------
 * 网页开发
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

class Web extends AbstractClass
{   
    /**
     * 生成网页登录授权链接
     * 
     * @param string $url 授权后重定向的回调链接地址
     * @param string $type 授权方式 base | userinfo
	 * @param string $state 自己定义的参数，具体看微信开发手册
    */
    public function login($url, $type='base', $state=1) {
        $status = 'snsapi_'.strtolower($type);
        return Tool::str_url($this->api['api_list']['snsapi'], [
            $this->config['appid'],
            urlencode($url), 
            $status, 
            $state
        ]);
    } 
    /**
     * 根据code去获取特殊access_token
     * 
     * @param string $code 授权后返回的code参数
    */
    public function token($code='') {
        if (empty($code)) {
            $param = \x\Request::get();
            $code = $param['code'];
        }

        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['snsapi_access_token'], [
            $this->config['appid'],
            $this->config['appsecret'],
            $code
        ]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        return $ret;
    } 
    /**
     * 根据refresh_token刷新特殊access_token
     * 
     * @param string $refresh_token 在token()中的更新凭据
    */
    public function reload($refresh_token) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['snsapi_update_access_token'], [
            $this->config['appid'],
            $refresh_token
        ]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        return $ret;
    }  
    /**
     * 使用特殊access_token去获取用户信息
     * 
     * @param string $token 特殊access_token
	 * @param string $open_id 用户的OpenId
    */
    public function userinfo($token, $open_id) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['snsapi_user_info'], [
            $token,
            $this->config['appid'],
            $this->config['web_lang'],
        ]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        return $ret;
    } 
}