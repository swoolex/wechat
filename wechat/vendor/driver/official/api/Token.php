<?php
/**
 * +----------------------------------------------------------------------
 * Token校验
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

class Token extends AbstractClass
{
    /**
     * 处理
    */
    public function check() {
        $param = \x\Request::get();
        # 获得微信发送过来的加密签名
		$signature = $param["signature"];
		# 时间戳
		$timestamp = $param["timestamp"];
		# 随机数
		$nonce = $param["nonce"];
        
		# Token + 时间戳 + 随机数 = 组合成数组
		$tmpArr = [$this->config['token'], $timestamp, $nonce];
		# 对数组进行升序重新排序
		sort($tmpArr, SORT_STRING);
		# 把数组for拼接成字符串
		$tmpStr = implode( $tmpArr );
		# 进行sha1加密
        $tmpStr = sha1( $tmpStr );
        
		# 接收微信向你服务器发送过来的随机字符串
        $echoStr = $param["echostr"];
		# 最后与微信发送过来的加密签名进行对比，成功返回随机字符串给微信,告诉它认证通过了
		if( $tmpStr == $signature && $echoStr) {
            // 从容器取出请求
            $Response = \x\context\Response::get();
            // 响应到页面头部	
            $Response->header('content-type', 'text');
            // 输出响应
            return $Response->end($echoStr);
        }
        return false;
    }
}