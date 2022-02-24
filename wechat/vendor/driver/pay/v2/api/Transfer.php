<?php
/**
 * +----------------------------------------------------------------------
 * 零钱相关
 * +----------------------------------------------------------------------
 * 官网：https://www.sw-x.cn
 * +----------------------------------------------------------------------
 * 作者：小黄牛 <1731223728@qq.com>
 * +----------------------------------------------------------------------
 * 开源协议：http://www.apache.org/licenses/LICENSE-2.0
 * +----------------------------------------------------------------------
*/
namespace wechat\vendor\driver\pay\v2\api;
use wechat\vendor\driver\AbstractClass;
use wechat\vendor\Tool;
use wechat\vendor\Tool\PayV2;

class Transfer extends AbstractClass
{
    /**
     * 证书
    */
    private $ssl_cert = null;
    private $ssl_key = null;

    /**
     * 设置证书地址
     * 
     * @param string $path
     * @return this
    */
    public function ssl_cert($path) {
        $this->ssl_cert = $path;
        return $this;
    }
    public function ssl_key($path) {
        $this->ssl_key = $path;
        return $this;
    }

    /**
     * 付款
     * 
     * @param string $openid OpenID
     * @param float $money 付款金额（元）
     * @param string $order_sn 商户订单号
     * @param string $check_name 校验用户姓名选项
     * @param string $desc 付款备注
     * @param array $more 更多接口参数
     * @return false|string|array
    */
    public function handle($openid, $money, $order_sn, $check_name='NO_CHECK', $desc='企业付款', $more=[]) {
        $ssl_cert = !empty($this->ssl_cert) ? $this->ssl_cert : $this->config['ssl_cert'];
        if (!$ssl_cert) return 'ssl_cert证书地址为空';
        $ssl_key = !empty($this->ssl_key) ? $this->ssl_key : $this->config['ssl_key'];
        if (!$ssl_key) return 'ssl_key证书地址为空';

        $post = [];
        $post['mch_appid'] = $this->config['appid'];
        $post['mchid'] = $this->config['mch_id'];
        $post['nonce_str'] = PayV2::nonce_str();
        $post['partner_trade_no'] = $order_sn;
        $post['openid'] = $openid;
        $post['check_name'] = $check_name;
        $post['amount'] = intval($money*100);
        $post['desc'] = $desc;
        $post = array_merge($post, $more); // 合并更多参数
        $post['sign'] = PayV2::make_sign($post, $this->config['pay_key']);
        $post_xml = PayV2::array_to_xml($post);

        $xml = Tool::xmlCurl($this->api['api_domain'].$this->api['api_list']['transfers'], $post_xml, $ssl_cert, $ssl_key);
        $res = PayV2::xml_to_array($xml);

        if ($res['return_code'] != 'SUCCESS' || !empty($res['err_code_des'])) {
            if (!empty($res['err_code_des'])) {
                return $res['err_code_des'];
            } else if (!empty($res['return_msg'])) {
                return $res['return_msg'];
            }
            return '暂不支持，请稍后重试';
        }

        return $res;
    }
    
    /**
     * 付款
     * 
     * @param string $partner_trade_no 商户订单号
     * @return false|string|array
    */
    public function query($partner_trade_no) {
        $ssl_cert = !empty($this->ssl_cert) ? $this->ssl_cert : $this->config['ssl_cert'];
        if (!$ssl_cert) return 'ssl_cert证书地址为空';
        $ssl_key = !empty($this->ssl_key) ? $this->ssl_key : $this->config['ssl_key'];
        if (!$ssl_key) return 'ssl_key证书地址为空';

        $post = [];
        $post['appid'] = $this->config['appid'];
        $post['mch_id'] = $this->config['mch_id'];
        $post['nonce_str'] = PayV2::nonce_str();
        $post['partner_trade_no'] = $partner_trade_no;
        $post['sign'] = PayV2::make_sign($post, $this->config['pay_key']);
        $post_xml = PayV2::array_to_xml($post);

        $xml = Tool::xmlCurl($this->api['api_domain'].$this->api['api_list']['gettransferinfo'], $post_xml, $ssl_cert, $ssl_key);
        $res = PayV2::xml_to_array($xml);

        if ($res['return_code'] != 'SUCCESS' || !empty($res['err_code_des'])) {
            if (!empty($res['err_code_des'])) {
                return $res['err_code_des'];
            } else if (!empty($res['return_msg'])) {
                return $res['return_msg'];
            }
            return '暂不支持，请稍后重试';
        }

        return $res;
    }

}