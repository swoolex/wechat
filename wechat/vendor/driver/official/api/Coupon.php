<?php
/**
 * +----------------------------------------------------------------------
 * 卡券管理
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

class Coupon extends AbstractClass
{  
    /**
     * 创建卡卷
    */
    public function create($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_create'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['card_id'];
    }
    /**
     * 设置买单
    */
    public function payset($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_paycell'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }
    /**
     * 设置自助核销
    */
    public function checkset($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['selfconsumecell'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }
    /**
     * 创建二维码
    */
    public function qrcode($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_qrcode'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }
    /**
     * 创建货架
    */
    public function create_rack($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_landingpage'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }
    /**
     * 导入code
    */
    public function code_import($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['deposit'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }
    /**
     * 查询导入code数目
    */
    public function code_count($card_id) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getdepositcount'], [$this->sdk->access_token()->get()]);
        $body = [
            'card_id' => $card_id
        ];
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['count'];
    }
    /**
     * 核查code
    */
    public function code_check($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['checkcode'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }
    /**
     * 图文消息群发卡券
    */
    public function news_send($card_id) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['gethtml'], [$this->sdk->access_token()->get()]);
        $body = [
            'card_id' => $card_id
        ];
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['content'];
    }
    /**
     * 设置测试白名单
    */
    public function test_set($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['testwhitelist'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }
    /**
     * 查询Code
    */
    public function code_get($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_code_get'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }
    /**
     * 核销Code
    */
    public function code_confirm($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['consume'], [$this->sdk->access_token()->get()]);

        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }
    /**
     * Code解码
    */
    public function code_decrypt($encrypt_code) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_decrypt'], [$this->sdk->access_token()->get()]);
        $body = [
            'encrypt_code' => $encrypt_code
        ];
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['code'];
    }

    /**
     * 获取用户已领取卡券
    */
    public function user_card_list($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getcardlist'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }

    /**
     * 查看卡券详情
    */
    public function card_get($card_id) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_get'], [$this->sdk->access_token()->get()]);
        $body = [
            'card_id' => $card_id
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
     * 批量查询卡券列表
    */
    public function card_list($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_batchget'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }

    /**
     * 更改卡券信息
    */
    public function card_update($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_update'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }

    /**
     * 修改库存
    */
    public function stock_update($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['modifystock'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }

    /**
     * 更改Code
    */
    public function code_update($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_code_update'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }

    /**
     * 删除卡券
    */
    public function card_delete($card_id) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_delete'], [$this->sdk->access_token()->get()]);
        $body = [
            'card_id' => $card_id
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
     * 设置卡券失效
    */
    public function card_expire($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['unavailable'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }
    /**
     * 拉取卡券概况数据
    */
    public function card_statistics($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getcardbizuininfo'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['list'];
    }
    /**
     * 获取免费券数据
    */
    public function card_free_statistics($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getcardcardinfo'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['list'];
    }
    /**
     * 拉取会员卡概况数据
    */
    public function user_card_statistics($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getcardmembercardinfo'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['list'];
    }
    /**
     * 拉取单张会员卡数据
    */
    public function user_alone_statistics($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['getcardmembercarddetail'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['list'];
    }
    /**
     * 激活会员卡
    */
    public function card_activate($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_activate'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }
    /**
     * 设置开卡字段
    */
    public function card_field_set($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['activateuserform'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }
    /**
     * 更新会员信息
    */
    public function card_user_update($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_updateuser'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }
    /**
     * 拉取会员信息（积分查询）
    */
    public function card_user_info($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_userinfo'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }
    /**
     * 设置支付后投放卡券
    */
    public function card_pay_gift($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_paygiftcard'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }
    /**
     * 更新会议门票
    */
    public function meeting_update($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_meetingticket'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }
    /**
     * 更新电影票
    */
    public function movie_update($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_movieticket'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }
    /**
     * 更新飞机票
    */
    public function plane_update($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_boardingpass'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return true;
    }
    /**
     * 创建子商户
    */
    public function submerchant_create($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_submerchant'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }
    /**
     * 卡券开放类目查询
    */
    public function car_type_list() {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_getapplyprotocol'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, [], $ret);
            return false;
        }
        return $ret['category'];
    }
    /**
     * 更新子商户
    */
    public function submerchant_update($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_submerchant_update'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }
    /**
     * 拉取单个子商户信息
    */
    public function submerchant_get($merchant_id) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_submerchant_get'], [$this->sdk->access_token()->get()]);
        $body = [
            'merchant_id' => $merchant_id
        ];
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret['info'];
    }
    /**
     * 批量拉取子商户信息
    */
    public function submerchant_list($body) {
        $api = $this->api['api_domain'].Tool::str_url($this->api['api_list']['card_submerchant_batchget'], [$this->sdk->access_token()->get()]);
        
        $ret = Tool::txtCurl($api, $body);
        if (!$ret) return false;
        
        if (!empty($ret['errcode'])) {
            \wechat\callback\Error::handle($api, $body, $ret);
            return false;
        }
        return $ret;
    }
    
}

