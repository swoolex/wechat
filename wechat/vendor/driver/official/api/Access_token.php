<?php
/**
 * +----------------------------------------------------------------------
 * 普通AccessToken管理类
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

class Access_Token extends AbstractClass
{
    /**
     * 公共配置
    */
    private $client_config;

    /**
     * 获取
    */
    public function get() {
        return $this->cache();
    }

    /**
     * 清除
    */
    public function clear() {
        $this->client_config = require EXTEND_PATH.'wechat'.DS.'config'.DS.'config.php';
        
        $lock = $this->config['driver'].'_'.$this->client_config['access_token_redis_name'].'lock';
        $one = $this->config['driver'].'_'.$this->client_config['access_token_redis_name'].'one';
        $two = $this->config['driver'].'_'.$this->client_config['access_token_redis_name'].'two';

        $Redis = new \x\Redis();
        $Redis->del($lock);
        $Redis->del($one);
        $Redis->del($two);
        $Redis->return();

        return true;
    }

    /**
     * 读取缓存
    */
    private function cache() {
        $this->client_config = require EXTEND_PATH.'wechat'.DS.'config'.DS.'config.php';
        
        $lock = $this->config['driver'].'_'.$this->client_config['access_token_redis_name'].'lock';
        $one = $this->config['driver'].'_'.$this->client_config['access_token_redis_name'].'one';
        $two = $this->config['driver'].'_'.$this->client_config['access_token_redis_name'].'two';

        $Redis = new \x\Redis();
        // 在更新中
        if ($Redis->get($lock) == 1) {
            $arr = $Redis->hgetall($two);
            if (empty($arr['access_token'])) {
                return $this->update($lock, $one, $two, false, $Redis);
            }
            if ($arr['out_time'] < time()) {
                return $this->update($lock, $one, $two, false, $Redis);
            }
            $Redis->return();
            return $arr['access_token'];
        }
        // 读取最新的
        $arr = $Redis->hgetall($one);

        if (empty($arr['access_token'])) {
            return $this->update($lock, $one, $two, false, $Redis);
        }
        if ($arr['out_time'] < time()) {
            return $this->update($lock, $one, $two, true, $Redis);
        }
        $Redis->return();
        return $arr['access_token'];
    }

    /**
     * 更新
    */
    private function update($lock, $one, $two, $status, $Redis) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['access_token'], [
            $this->config['appid'],
            $this->config['appsecret'],
        ]);
        $ret = Tool::txtCurl($api);
        if (!$ret) {
            \wechat\callback\Error::handle($api, [], [
                'msg' => 'AccessToken请求失败'
            ]);
            return false;
        }
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        if ($status === true) {
            $arr = $Redis->hgetall($one);
            $Redis->hmset($two, $arr);
            $Redis->set($lock, 1);
        }
        $data = [
            'access_token' => $ret['access_token'],
            'out_time' => (time()+$this->client_config['access_token_expire'])
        ];
        $res = $Redis->hmset($one, $data);
        if ($status === true) {
            $Redis->set($lock, 0);
        }
        $Redis->return();
        if (!$res) {
            \wechat\callback\Error::handle($api, [], [
                'msg' => 'Redis更新失败'
            ]);
            return false;
        }
        return $ret['access_token'];
    }
}