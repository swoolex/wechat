<?php
/**
 * +----------------------------------------------------------------------
 * 订单相关
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

class Order extends AbstractClass
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
     * 查询订单
     * 
     * @param string $transaction_id 微信单号
     * @param string $out_trade_no 商户单号
     * @return false|string|array
    */
    public function query($transaction_id=null, $out_trade_no=null) {
        if (!$transaction_id && !$out_trade_no) {
            return false;
        }
        $post = [];
        $post['appid'] = $this->config['appid'];
        $post['mch_id'] = $this->config['mch_id'];
        if ($transaction_id) {
            $post['transaction_id'] = $transaction_id;
        } else {
            $post['out_trade_no'] = $out_trade_no;
        }
        $post['nonce_str'] = PayV2::nonce_str();
        $post['sign_type'] = 'MD5';
        $post['sign'] = PayV2::make_sign($post, $this->config['pay_key']);
        $post_xml = PayV2::array_to_xml($post);

        $xml = Tool::xmlCurl($this->api['api_domain'].$this->api['api_list']['orderquery'], $post_xml);
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
     * 关闭订单
     * 
     * @param string $out_trade_no 商户单号
     * @return string|true
    */
    public function close($out_trade_no) {
        $post = [];
        $post['appid'] = $this->config['appid'];
        $post['mch_id'] = $this->config['mch_id'];
        $post['out_trade_no'] = $out_trade_no;
        $post['nonce_str'] = PayV2::nonce_str();
        $post['sign_type'] = 'MD5';
        $post['sign'] = PayV2::make_sign($post, $this->config['pay_key']);
        $post_xml = PayV2::array_to_xml($post);

        $xml = Tool::xmlCurl($this->api['api_domain'].$this->api['api_list']['closeorder'], $post_xml);
        $res = PayV2::xml_to_array($xml);

        if ($res['return_code'] != 'SUCCESS' || !empty($res['err_code_des'])) {
            if (!empty($res['err_code_des'])) {
                return $res['err_code_des'];
            } else if (!empty($res['return_msg'])) {
                return $res['return_msg'];
            }
            return '暂不支持，请稍后重试';
        }

        return true;
    }

    /**
     * 撤销订单
     * 
     * @param string $transaction_id 微信单号
     * @param string $out_trade_no 商户单号
     * @return false|string|array
    */
    public function reverse($transaction_id=null, $out_trade_no=null) {
        $ssl_cert = !empty($this->ssl_cert) ? $this->ssl_cert : $this->config['ssl_cert'];
        if (!$ssl_cert) return 'ssl_cert证书地址为空';
        $ssl_key = !empty($this->ssl_key) ? $this->ssl_key : $this->config['ssl_key'];
        if (!$ssl_key) return 'ssl_key证书地址为空';

        $post = [];
        $post['appid'] = $this->config['appid'];
        $post['mch_id'] = $this->config['mch_id'];
        if ($transaction_id) {
            $post['transaction_id'] = $transaction_id;
        } else {
            $post['out_trade_no'] = $out_trade_no;
        }
        $post['nonce_str'] = PayV2::nonce_str();
        $post['sign_type'] = 'MD5';
        $post['sign'] = PayV2::make_sign($post, $this->config['pay_key']);
        $post_xml = PayV2::array_to_xml($post);

        $xml = Tool::xmlCurl($this->api['api_domain'].$this->api['api_list']['reverse'], $post_xml, $ssl_cert, $ssl_key);
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
     * 申请退款
     * 
     * @param string $out_refund_no 商户退款单号
     * @param string $total_fee 订单金额（元）
     * @param string $refund_fee 退款金额（元）
     * @param string $out_trade_no 商户单号
     * @param string $transaction_id 微信单号
     * @param array $more 更多接口参数
     * @return false|string|array
    */
    public function refund($out_refund_no, $total_fee, $refund_fee, $out_trade_no=null, $transaction_id=null, $more=[]) {
        $ssl_cert = !empty($this->ssl_cert) ? $this->ssl_cert : $this->config['ssl_cert'];
        if (!$ssl_cert) return 'ssl_cert证书地址为空';
        $ssl_key = !empty($this->ssl_key) ? $this->ssl_key : $this->config['ssl_key'];
        if (!$ssl_key) return 'ssl_key证书地址为空';

        $post = [];
        $post['appid'] = $this->config['appid'];
        $post['mch_id'] = $this->config['mch_id'];
        if ($transaction_id) {
            $post['transaction_id'] = $transaction_id;
        } else {
            $post['out_trade_no'] = $out_trade_no;
        }
        $post['out_refund_no'] = $out_refund_no;
        $post['total_fee'] = intval($total_fee*100);
        $post['refund_fee'] = intval($refund_fee*100);
        $post['nonce_str'] = PayV2::nonce_str();
        $post['sign_type'] = 'MD5';
        $post = array_merge($post, $more); // 合并更多参数
        $post['sign'] = PayV2::make_sign($post, $this->config['pay_key']);
        $post_xml = PayV2::array_to_xml($post);

        $xml = Tool::xmlCurl($this->api['api_domain'].$this->api['api_list']['refund'], $post_xml, $ssl_cert, $ssl_key);
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
     * 退款查询
     * 
     * @param string $out_refund_no 商户退款单号
     * @param string $out_trade_no 商户单号
     * @param string $transaction_id 微信单号
     * @param string $refund_id 微信退款单号
     * @return false|string|array
    */
    public function refund_query($out_refund_no=null, $out_trade_no=null, $transaction_id=null, $refund_id=null) {
        $post = [];
        $post['appid'] = $this->config['appid'];
        $post['mch_id'] = $this->config['mch_id'];
        if ($out_refund_no) {
            $post['out_refund_no'] = $out_refund_no;
        } else if ($transaction_id) {
            $post['transaction_id'] = $transaction_id;
        } else if ($out_trade_no) {
            $post['out_trade_no'] = $out_trade_no;
        } else if ($refund_id) {
            $post['refund_id'] = $refund_id;
        }
        $post['nonce_str'] = PayV2::nonce_str();
        $post['sign_type'] = 'MD5';
        $post['sign'] = PayV2::make_sign($post, $this->config['pay_key']);
        $post_xml = PayV2::array_to_xml($post);

        $xml = Tool::xmlCurl($this->api['api_domain'].$this->api['api_list']['refundquery'], $post_xml);
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