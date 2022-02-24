<?php
/**
 * +----------------------------------------------------------------------
 * 一键下单
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

class Payment extends AbstractClass
{
    /**
     * 回调地址
    */
    private $notify_url = null;
    /**
     * 支付回调，抛出内容
    */
    private $FAIL = ['return_code'=>'FAIL', 'return_msg'=>'ERROR'];
    private $SUCCESS = ['return_code'=>'SUCCESS', 'return_msg'=>'OK'];

    /**
     * 设置回调地址
     * 
     * @param string $url
     * @return this
    */
    public function notify_url($url) {
        $this->notify_url = $url;
        return $this;
    }

    /**
     * 小程序/JSAPI
     *
     * @param string $openid
     * @param float $money 金额(元)
     * @param mixed $order_sn 订单号
     * @param mixed $body 商品描述
     * @param array $more 微信文档中更多的参数支持
     * @return void
    */
    public function jsapi($openid, $money, $order_sn, $body='订单支付', $more=[]) {
        $request = \x\context\Request::get();

        if (isset($more['notify_url'])) unset($more['notify_url']);
        if (isset($more['time_expire'])) {
            $time_expire = $more['time_expire'];
            unset($more['time_expire']);
        } else {
            $time_expire = date("YmdHis", time() + 3600);
        }

        $notify_url = !empty($this->notify_url) ? $this->notify_url : $this->config['notify_url'];
        if (!$notify_url) {
            return '回调地址不能为空';
        }
        $post = [];
        $post['appid'] = $this->config['appid'];
        $post['body'] = $body;
        $post['mch_id'] = $this->config['mch_id'];
        $post['nonce_str'] = PayV2::nonce_str();
        $post['notify_url'] = $notify_url;
        $post['openid'] = $openid;
        $post['out_trade_no'] = $order_sn;
        $post['spbill_create_ip'] = $request->server['remote_addr'];
        $post['total_fee'] = intval($money*100);
        $post['time_expire'] = $time_expire;
        $post['trade_type'] = 'JSAPI';
        $post = array_merge($post, $more); // 合并更多参数
        $post['sign'] = PayV2::make_sign($post, $this->config['pay_key']);
        $post_xml = PayV2::array_to_xml($post);

        $xml = Tool::xmlCurl($this->api['api_domain'].$this->api['api_list']['payment'], $post_xml);
        $res = PayV2::xml_to_array($xml);

        if ($res['return_code'] != 'SUCCESS' || !empty($res['err_code_des'])) {
            if (!empty($res['err_code_des'])) {
                return $res['err_code_des'];
            } else if (!empty($res['return_msg'])) {
                return $res['return_msg'];
            }
            return '暂不支持支付，请稍后重试';
        }

        $time = time();
        $data = [];
        $data['appId'] = $this->config['appid'];
        $data['timeStamp'] = (string)$time;
        $data['nonceStr'] = $post['nonce_str'];
        $data['signType'] = 'MD5';
        $data['package'] = 'prepay_id='.$res['prepay_id'];
        $data['paySign'] = PayV2::make_sign($data, $this->config['pay_key']);
        $data['prepay_id'] = $res['prepay_id'];
        return $data;
    }

    /**
     * H5
     *
     * @param float $money 金额(元)
     * @param mixed $order_sn 订单号
     * @param mixed $body 商品描述
     * @param array $more 微信文档中更多的参数支持
     * @return void
    */
    public function web($money, $order_sn, $body='订单支付', $more=[]) {
        $request = \x\context\Request::get();

        if (isset($more['notify_url'])) unset($more['notify_url']);
        if (isset($more['time_expire'])) {
            $time_expire = $more['time_expire'];
            unset($more['time_expire']);
        } else {
            $time_expire = date("YmdHis", time() + 3600);
        }
        if (isset($more['scene_info'])) {
            $scene_info = $more['scene_info'];
            unset($more['scene_info']);
        } else {
            $scene_info = '{"h5_info":{"type":"Wap","wap_url":"","wap_name":"'.$body.'"}}';
        }
        
        $notify_url = !empty($this->notify_url) ? $this->notify_url : $this->config['notify_url'];
        if (!$notify_url) {
            return '回调地址不能为空';
        }
        $post = [];
        $post['appid'] = $this->config['appid'];
        $post['body'] = $body;
        $post['mch_id'] = $this->config['mch_id'];
        $post['nonce_str'] = PayV2::nonce_str();
        $post['notify_url'] = $notify_url;
        $post['out_trade_no'] = $order_sn;
        $post['spbill_create_ip'] = $request->server['remote_addr'];
        $post['total_fee'] = intval($money*100);
        $post['time_expire'] = $time_expire;
        $post['trade_type'] = 'MWEB';
        $post['scene_info'] = $scene_info;
        $post = array_merge($post, $more); // 合并更多参数
        $post['sign'] = PayV2::make_sign($post, $this->config['pay_key']);
        $post_xml = PayV2::array_to_xml($post);

        $xml = Tool::xmlCurl($this->api['api_domain'].$this->api['api_list']['payment'], $post_xml);
        $res = PayV2::xml_to_array($xml);

        if ($res['return_code'] != 'SUCCESS' || !empty($res['err_code_des'])) {
            if (!empty($res['err_code_des'])) {
                return $res['err_code_des'];
            } else if (!empty($res['return_msg'])) {
                return $res['return_msg'];
            }
            return '暂不支持支付，请稍后重试';
        }

        $data = [];
        $data['prepay_id'] = $res['prepay_id'];
        $data['h5_pay_url'] = $res['mweb_url'];
        return $data;
    }
    
    /**
     * APP
     *
     * @param float $money 金额(元)
     * @param mixed $order_sn 订单号
     * @param mixed $body 商品描述
     * @param array $more 微信文档中更多的参数支持
     * @return void
    */
    public function app($money, $order_sn, $body='订单支付', $more=[]) {
        $request = \x\context\Request::get();

        if (isset($more['notify_url'])) unset($more['notify_url']);
        if (isset($more['time_expire'])) {
            $time_expire = $more['time_expire'];
            unset($more['time_expire']);
        } else {
            $time_expire = date("YmdHis", time() + 3600);
        }
        
        $notify_url = !empty($this->notify_url) ? $this->notify_url : $this->config['notify_url'];
        if (!$notify_url) {
            return '回调地址不能为空';
        }
        $post = [];
        $post['appid'] = $this->config['appid'];
        $post['body'] = $body;
        $post['mch_id'] = $this->config['mch_id'];
        $post['nonce_str'] = PayV2::nonce_str();
        $post['notify_url'] = $notify_url;
        $post['out_trade_no'] = $order_sn;
        $post['spbill_create_ip'] = $request->server['remote_addr'];
        $post['total_fee'] = intval($money*100);
        $post['time_expire'] = $time_expire;
        $post['trade_type'] = 'APP';
        $post = array_merge($post, $more); // 合并更多参数
        $post['sign'] = PayV2::make_sign($post, $this->config['pay_key']);
        $post_xml = PayV2::array_to_xml($post);

        $xml = Tool::xmlCurl($this->api['api_domain'].$this->api['api_list']['payment'], $post_xml);
        $res = PayV2::xml_to_array($xml);
        
        if ($res['return_code'] != 'SUCCESS' || !empty($res['err_code_des'])) {
            if (!empty($res['err_code_des'])) {
                return $res['err_code_des'];
            } else if (!empty($res['return_msg'])) {
                return $res['return_msg'];
            }
            return '暂不支持支付，请稍后重试';
        }

        $time = time();
        $data = [];
        $data['prepayid'] = $res['prepay_id'];
        $data['appid'] = $this->config['appid'];
        $data['partnerid'] = $this->config['mch_id'];
        $data['package'] = 'Sign=WXPay';
        $data['noncestr'] = $post['nonce_str'];
        $data['timestamp'] = (string)$time;
        $data['sign'] = PayV2::make_sign($data, $this->config['pay_key']);
        return $data;
    }

    /**
     * 二维码（模式一）
     * 
     * @param $money 订单金额
     * @param $order_sn 订单号
     * @param $product_id 商品ID
     * @return void
    */
	public function qrcode($money, $order_sn, $product_id, $more=[]){
        $request = \x\context\Request::get();

        if (isset($more['notify_url'])) unset($more['notify_url']);
        if (isset($more['time_expire'])) {
            $time_expire = $more['time_expire'];
            unset($more['time_expire']);
        } else {
            $time_expire = date("YmdHis", time() + 3600);
        }
        $notify_url = !empty($this->notify_url) ? $this->notify_url : $this->config['notify_url'];
        if (!$notify_url) {
            return '回调地址不能为空';
        }

        $post = [];
        $post['appid'] = $this->config['appid'];
        $post['mch_id'] = $this->config['mch_id']; 
        $post['nonce_str'] = PayV2::nonce_str();
        $post['product_id'] = $product_id; 
        $post['time_stamp'] = time(); 
        $post = array_merge($post, $more); // 合并更多参数
        $post['sign'] = PayV2::make_sign($post, $this->config['pay_key']);
        
        $data = [];
        $data['code_url'] = Tool::str_url($this->api['api_list']['qrcode2'], [
            $post['appid'],
            $post['mch_id'],
            $post['nonce_str'],
            $post['product_id'],
            $post['time_stamp'],
            $post['sign']
        ]);
        return $data;
    }

    /**
     * 二维码（模式二）
     * 
     * @param $money 订单金额
     * @param $order_sn 订单号
     * @param $body 支付标题
     * @return void
    */
	public function qrcode2($money, $order_sn, $body='订单支付', $more=[]){
        $request = \x\context\Request::get();

        if (isset($more['notify_url'])) unset($more['notify_url']);
        if (isset($more['time_expire'])) {
            $time_expire = $more['time_expire'];
            unset($more['time_expire']);
        } else {
            $time_expire = date("YmdHis", time() + 3600);
        }
        $notify_url = !empty($this->notify_url) ? $this->notify_url : $this->config['notify_url'];
        if (!$notify_url) {
            return '回调地址不能为空';
        }

        $post = [];
        $post['appid'] = $this->config['appid'];
        $post['body'] = $body;
        $post['mch_id'] =$this->config['mch_id']; 
        $post['nonce_str'] = PayV2::nonce_str();
        $post['notify_url'] = $notify_url; 
        $post['out_trade_no'] = $order_sn; 
        $post['spbill_create_ip'] = $request->server['remote_addr'];
        $post['total_fee'] = intval($money*100);
        $post['trade_type'] = 'NATIVE';
        $post = array_merge($post, $more); // 合并更多参数
        $post['sign'] = PayV2::make_sign($post, $this->config['pay_key']);
        $post_xml = PayV2::array_to_xml($post);

        $xml = Tool::xmlCurl($this->api['api_domain'].$this->api['api_list']['payment'], $post_xml);
        $res = PayV2::xml_to_array($xml);

        if ($res['return_code'] != 'SUCCESS' || !empty($res['err_code_des'])) {
            if (!empty($res['err_code_des'])) {
                return $res['err_code_des'];
            } else if (!empty($res['return_msg'])) {
                return $res['return_msg'];
            }
            return '暂不支持支付，请稍后重试';
        }
        $data = [];
        $data['prepay_id'] = $res['prepay_id'];
        $data['code_url'] = $res['code_url'];
        return $data;
    }

    /**
     * 支付回调签名校验
     * 
     * @param array|xml $param 
     * @return xml|true
    */
    public function verify($param) {
        if (!is_array($param)) {
            $param = PayV2::xml_to_array($param);
        }
        if (
            isset($param['transaction_id']) == false || 
            isset($param['sign']) == false || 
            isset($param['return_code']) == false
        ) {
            return PayV2::array_to_xml($this->FAIL);
        }

        if (
            $param['return_code'] != 'SUCCESS' || 
            $param['result_code'] != 'SUCCESS'
        ) {
            return PayV2::array_to_xml($this->FAIL);
        }

        $sign = $param['sign'];
        unset($param['sign']);

        if ($sign != PayV2::make_sign($param, $this->config['pay_key'])) {
            return PayV2::array_to_xml(array_merge($this->FAIL, ['return_msg'=>'签名校验不通过']));
        }

        return true;
    }

    /**
     * 获取支付回调成功时的XML内容
     * 
     * @return xml
    */
    public function success() {
        return PayV2::array_to_xml($this->SUCCESS);
    }

    /**
     * 短链接转换
     * 
     * @param string $url
     * @return string
    */
    public function shorturl($url) {
        $post = [];
        $post['appid'] = $this->config['appid'];
        $post['mch_id'] = $this->config['mch_id'];
        $post['long_url'] = $url;
        $post['nonce_str'] = PayV2::nonce_str();
        $post['sign_type'] = 'MD5';
        $post['sign'] = PayV2::make_sign($post, $this->config['pay_key']);
        $post_xml = PayV2::array_to_xml($post);

        $xml = Tool::xmlCurl($this->api['api_domain'].$this->api['api_list']['shorturl'], $post_xml);
        $res = PayV2::xml_to_array($xml);
        
        if ($res['return_code'] != 'SUCCESS' || !empty($res['err_code_des'])) {
            if (!empty($res['err_code_des'])) {
                return $res['err_code_des'];
            } else if (!empty($res['return_msg'])) {
                return $res['return_msg'];
            }
            return '暂不支持，请稍后重试';
        }

        $time = time();
        $data = [];
        $data['short_url'] = $res['short_url'];
        return $data;
    }
}