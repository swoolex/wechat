<?php
/**
 * +----------------------------------------------------------------------
 * 微信支付 - v2 - 开发配置
 * +----------------------------------------------------------------------
 * 官网：https://www.sw-x.cn
 * +----------------------------------------------------------------------
 * 作者：小黄牛 <1731223728@qq.com>
 * +----------------------------------------------------------------------
 * 开源协议：http://www.apache.org/licenses/LICENSE-2.0
 * +----------------------------------------------------------------------
*/

return [
    // 接口域名
    'api_domain' => 'https://api.mch.weixin.qq.com',
    // 接口列表（%s% 为参数占位符）
    'api_list' => [
        // 一键下单地址
        'payment' => '/pay/unifiedorder',
        // 二维码下单（模式1）链接地址
        'qrcode2' => 'weixin://wxpay/bizpayurl?appid=%s%&mch_id=%s%&nonce_str=%s%&product_id=%s%&time_stamp=%s%&sign=%s%',
        // 查询订单
        'orderquery' => '/pay/orderquery',
        // 关闭订单
        'closeorder' => '/pay/closeorder',
        // 撤销订单
        'reverse' => '/secapi/pay/reverse',
        // 申请退款
        'refund' => '/secapi/pay/refund',
        // 查询退款
        'refundquery' => '/pay/refundquery',
        // 转换短链接
        'shorturl' => '/tools/shorturl',
        // 付款到零钱
        'transfers' => '/mmpaymkttransfers/promotion/transfers',
        // 付款到零钱-记录查询
        'gettransferinfo' => '/mmpaymkttransfers/gettransferinfo',
    ]
];

