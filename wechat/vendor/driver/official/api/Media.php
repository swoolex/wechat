<?php
/**
 * +----------------------------------------------------------------------
 * 素材管理
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

class Media extends AbstractClass
{   
    /**
     * 新增临时素材
    */
    public function upload($type, $media) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['media_upload'], [$this->sdk->access_token()->get(), $type]);

        $ret = Tool::fileCurl($api, [
            'path' => $media,
            'name' => 'media'
        ]);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [
                'type' => $type,
                'media' => $media
            ], $ret);
            return false;
        }
        return $ret;
    } 
    /**
     * 获取临时素材
    */
    public function get($media_id) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['media_get'], [$this->sdk->access_token()->get(), $media_id]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return $api;

        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [
                'media_id' => $media_id
            ], $ret);
            return false;
        }

        return $ret;
    } 
    /**
     * 高清语音素材获取
    */
    public function voice_get($media_id) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['media_jssdk_get'], [$this->sdk->access_token()->get(), $media_id]);
        return $api;
    } 
    /**
     * 新增永久素材
    */
    public function forever_upload($type, $media, $body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['upload_material'], [$this->sdk->access_token()->get(), $type]);
        if (is_array($body)) $body = json_encode($body, JSON_UNESCAPED_UNICODE);
        $ret = Tool::fileCurl($api, [
            'path' => $media,
            'name' => 'media'
        ], [
            'description' => $body
        ]);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [
                'type' => $type,
                'media' => $media,
                'description' => $body
            ], $ret);
            return false;
        }
        return $ret;
    } 
    /**
     * 获取永久素材
    */
    public function forever_get($media_id) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['get_material'], [$this->sdk->access_token()->get(), $media_id]);

        $ret = Tool::txtCurl($api, [
            'media_id' => $media_id
        ]);
        if (!$ret) return $api;

        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [
                'media_id' => $media_id
            ], $ret);
            return false;
        }

        return $ret;
    } 
    /**
     * 删除永久素材
    */
    public function forever_delete($media_id) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['del_material'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, [
            'media_id' => $media_id
        ]);
        if (!$ret) return false;

        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [
                'media_id' => $media_id
            ], $ret);
            return false;
        }

        return true;
    } 
    
    /**
     * 上传小图片
    */
    public function uploadimg($media) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['uploadimg'], [$this->sdk->access_token()->get()]);
        $ret = Tool::fileCurl($api, [
            'path' => $media,
            'name' => 'media'
        ]);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [
                'media' => $media,
            ], $ret);
            return false;
        }
        return $ret['url'];
    } 

    /**
     * 新增永久图文素材
    */
    public function news_create($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['add_news'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;

        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }

        return $ret['media_id'];
    } 

    /**
     * 修改永久图文素材
    */
    public function news_update($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['update_news'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;

        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }

        return true;
    }

    /**
     * 获取素材总数
    */
    public function count() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['get_materialcount'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api);
        if (!$ret) return false;

        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }

        return $ret;
    } 

    /**
     * 获取素材列表
    */
    public function showlist($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['batchget_material'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;

        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }

        return true;
    }
}