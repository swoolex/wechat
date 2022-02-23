<?php
/**
 * +----------------------------------------------------------------------
 * 公共配置
 * +----------------------------------------------------------------------
 * 官网：https://www.sw-x.cn
 * +----------------------------------------------------------------------
 * 作者：小黄牛 <1731223728@qq.com>
 * +----------------------------------------------------------------------
 * 开源协议：http://www.apache.org/licenses/LICENSE-2.0
 * +----------------------------------------------------------------------
*/

return [
    // CURL 超时时间(S)
    'outtime' => 10,
    // AccessToken的 Redis名称
    'access_token_redis_name' => 'swx_access_token_',
    // AccessToken的 失效时间(S)
    'access_token_expire' => 3600,
    // 公众号自定义的配置项
    'official_account' => \wechat\config\querier\official_account::class,
    // 微信支付自定义的配置项
    'pay' => \wechat\config\querier\pay::class,
];