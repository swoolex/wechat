<?php
/**
 * +----------------------------------------------------------------------
 * 工具类
 * +----------------------------------------------------------------------
 * 官网：https://www.sw-x.cn
 * +----------------------------------------------------------------------
 * 作者：小黄牛 <1731223728@qq.com>
 * +----------------------------------------------------------------------
 * 开源协议：http://www.apache.org/licenses/LICENSE-2.0
 * +----------------------------------------------------------------------
*/
namespace wechat\vendor;

class Tool
{
    /**
     * URL参数拼接植入
     * 
     * @param string $url
     * @param array $array
     * @return string
    */
    public static function str_url($url, $array){
        # 循环替换占位内容
        foreach ($array as $v){
            $url = preg_replace('/%s%/', $v, $url, 1);
        }
        return $url;
    }

    /**
     * 发送文件包
     * 
     * @param string $url
     * @param array $data
     * @return void
    */
    public static function fileCurl($url, $data, $body=[]) {
        $client_config = require EXTEND_PATH.'wechat'.DS.'config'.DS.'config.php';
        $client_timeout = $client_config['outtime'];
        $httpClient = new \x\Client();
        $res = $httpClient->http()
                ->domain($url)
                ->set([
                    'timeout' => $client_timeout, 
                    'keep_alive' => false,
                ])
                ->setHeaders([
                    'Host' => 'localhost',
                    'User-Agent' => 'Chrome/49.0.2587.3',
                ])
                ->addFile($data['path'], $data['name'])
                ->body($body)
                ->post();
        if (!$res) {
            \wechat\callback\Error::handle($api, $data, [
                'msg' => 'Client请求失败'
            ]);
            return false;
        }
        return json_decode($res, true);
    }

    /**
     * 发送普通包
     * 
     * @param string $url
     * @param array $data
     * @return void
    */
    public static function txtCurl($url, $data=null) {
        $client_config = require EXTEND_PATH.'wechat'.DS.'config'.DS.'config.php';
        $client_timeout = $client_config['outtime'];

        $body = $data;
        if (is_array($body)) {
            $body = json_encode($body, JSON_UNESCAPED_UNICODE);
        }
        $httpClient = new \x\Client();
        $client = $httpClient->http()
                ->domain($url)
                ->set([
                    'timeout' => $client_timeout, 
                    'keep_alive' => false,
                ])
                ->setHeaders([
                    'Host' => 'localhost',
                    'User-Agent' => 'Chrome/49.0.2587.3',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml',
                    'Accept-Encoding' => 'gzip',
                ]);
        if (!empty($body)) {
            $client->body($body);
        }      
        if ($body) {
            $res = $client->post();
        } else {
            $res = $client->get();
        }
        if (!$res) {
            \wechat\callback\Error::handle($api, $data, [
                'msg' => 'Client请求失败'
            ]);
            return false;
        }
        return json_decode($res, true);
    }
    
    /**
     * 发送XML
     * 
     * @param string $url
     * @param xml $data
     * @return void
    */
    public static function xmlCurl($url, $data=[], $ssl_cert=false, $ssl_key=false) {
        $client_config = require EXTEND_PATH.'wechat'.DS.'config'.DS.'config.php';
        $client_timeout = $client_config['outtime'];

        $set = [
            'timeout' => $client_timeout, 
            'keep_alive' => false,
        ];
        if ($ssl_cert) $set['ssl_cert_file'] = $ssl_cert;
        if ($ssl_key) $set['ssl_key_file'] = $ssl_key;

        $httpClient = new \x\Client();
        $client = $httpClient->http()
                ->domain($url)
                ->body($data)
                ->set($set);

        if ($data) {
            $body = $client->post();
        } else {
            $body = $client->get();
        }
        if (!$body) {
            return false;
        }
        return $body;
    }

    
}