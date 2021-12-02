<?php
/**
 * +----------------------------------------------------------------------
 * 消息回复
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

class Message_reply extends AbstractClass
{
    /**
     * 需要补充的字节长度
    */
    private $block_size = 32;

    /**
     * 获取微信交互数据
     * @todo 无
     * @author 小黄牛
     * @version v1.0.1 + 2020.07.24
     * @deprecated 暂不弃用
     * @global 无
     * @return void
    */
    public function xml(){
        # 获得数据包的信息
        $postStr =  \x\Request::raw();
        # 如果数据包内的信息不为空
        if (!empty($postStr)) {
            // 开启加密模式
            if ($this->config['token_type'] == 2) {
                $postStr = $this->decrypt($postStr);
            }
            # XML文件的解析依赖libxml库,libxml_disable_entity_loader函数,是为了安全性,防止入侵者通过协议注入XML向服务器发起攻击
            libxml_disable_entity_loader(true);
            # 把XML编译成一个Class对象
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            return $postObj;
        }
        return false;
    }

    /**
     * 输出数据到微信
     * @todo 无
     * @author 小黄牛
     * @version v1.0.1 + 2020.07.24
     * @deprecated 暂不弃用
     * @global 无
     * @param xml $xml
     * @return void
    */
    public function send($xml){
        // 开启加密模式
        if ($this->config['token_type'] == 2) {
            $encrypt = $this->encrypt($xml);
            $sTimeStamp = time();
            $sNonce = $this->getRandomStr();
            $signature = $this->getSHA1($this->config['token'], $sTimeStamp, $sNonce, $encrypt);
            //生成发送的xml
            $xml = $this->generate($encrypt, $signature, $sTimeStamp, $sNonce);
        }
        // 从容器取出请求
        $Response = \x\context\Response::get();
        // 响应到页面头部	
        $Response->header('content-type', 'text/xml');
        // 输出响应
        return $Response->end($xml);
    }

    /**
     * 对明文进行加密
     * @todo 无
     * @author 小黄牛
     * @version v1.0.1 + 2020.07.24
     * @deprecated 暂不启用
     * @global 无
     * @param string $text 需要加密的明文
     * @return string 加密后的密文
    */
    private function encrypt($text) {
        try {
            $EncodingAESKey = base64_decode($this->config['encodingaeskey'] . "=");
            //获得16位随机字符串，填充到明文之前
            $random =  $this->getRandomStr();
            $text = $random . pack("N", strlen($text)) . $text . $this->config['appid'];
            $iv = substr($EncodingAESKey, 0, 16);
            $text = $this->encode($text);
            $encrypted = openssl_encrypt($text,'AES-256-CBC',substr($EncodingAESKey, 0, 32),OPENSSL_ZERO_PADDING,$iv);
            return $encrypted;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * 对密文进行解密
     * @todo 无
     * @author 小黄牛
     * @version v1.0.1 + 2020.07.24
     * @deprecated 暂不启用
     * @global 无
     * @param string $encrypted 需要解密的密文
     * @return string 解密得到的明文
    */
    private function decrypt($encrypted) {
        if (!function_exists('openssl_decrypt')) {
            return false;
        }
        try {
            $EncodingAESKey = base64_decode($this->config['encodingaeskey'] . "=");
            $iv = substr($EncodingAESKey, 0, 16);
            $array = $this->extract($encrypted);
            if (!$array) {
                return false;
            }
            $decrypted = openssl_decrypt(base64_decode($array[1]),'AES-256-CBC', $EncodingAESKey, OPENSSL_RAW_DATA, $iv);
        } catch (\Exception $e) {
            return false;
        }
        try {
            //去除补位字符
            $result = $this->decode($decrypted);
            //去除16位随机字符串,网络字节序和AppId
            if (strlen($result) < 16) {
                return false;
            }
            $content = substr($result, 16, strlen($result));
            $len_list = unpack("N", substr($content, 0, 4));
            $xml_len = $len_list[1];
            $xml_content = substr($content, 4, $xml_len);
            $from_appid = substr($content, $xml_len + 4);
        } catch (\Exception $e) {
            return false;
        }
        if ($from_appid != $this->config['appid']) {
            return false;
        }
        return $xml_content;
    }

    /**
     * 对需要加密的明文进行填充补位
     * @todo 无
     * @author 小黄牛
     * @version v1.0.1 + 2020.07.24
     * @deprecated 暂不启用
     * @global 无
     * @param $text 需要进行填充补位操作的明文
     * @return 补齐明文字符串
    */
    private function encode($text) {
        $block_size = $this->block_size;
        $text_length = strlen($text);
        //计算需要填充的位数
        $amount_to_pad = $this->block_size - ($text_length % $this->block_size);
        if ($amount_to_pad == 0) {
            $amount_to_pad = $this->block_size;
        }
        //获得补位所用的字符
        $pad_chr = chr($amount_to_pad);
        $tmp = "";
        for ($index = 0; $index < $amount_to_pad; $index++) {
            $tmp .= $pad_chr;
        }
        return $text . $tmp;
    }
    
    /**
     * 对解密后的明文进行补位删除
     * @todo 无
     * @author 小黄牛
     * @version v1.0.1 + 2020.07.24
     * @deprecated 暂不启用
     * @global 无
     * @param decrypted 解密后的明文
     * @return 删除填充补位后的明文
    */
    private function decode($text) {

        $pad = ord(substr($text, -1));
        if ($pad < 1 || $pad > 32) {
            $pad = 0;
        }
        return substr($text, 0, (strlen($text) - $pad));
    }

    /**
     * 提取出xml数据包中的加密消息
     * @todo 无
     * @author 小黄牛
     * @version v1.0.1 + 2020.07.24
     * @deprecated 暂不启用
     * @global 无
	 * @param string $xmltext 待提取的xml字符串
	 * @return string 提取出的加密消息字符串
    */
	private function extract($xmltext) {
		try {
			$xml = new \DOMDocument();
			$xml->loadXML($xmltext);
			$array_e = $xml->getElementsByTagName('Encrypt');
			$array_a = $xml->getElementsByTagName('ToUserName');
			$encrypt = $array_e->item(0)->nodeValue;
			$tousername = $array_a->item(0)->nodeValue;
			return array(0, $encrypt, $tousername);
		} catch (\Exception $e) {
            return false;
		}
    }
    
    /**
     * 生成xml消息
     * @todo 无
     * @author 小黄牛
     * @version v1.0.1 + 2020.07.24
     * @deprecated 暂不启用
     * @global 无
	 * @param string $encrypt 加密后的消息密文
	 * @param string $signature 安全签名
	 * @param string $timestamp 时间戳
	 * @param string $nonce 随机字符串
    */
	private function generate($encrypt, $signature, $timestamp, $nonce) {
		$format = "<xml>
<Encrypt><![CDATA[%s]]></Encrypt>
<MsgSignature><![CDATA[%s]]></MsgSignature>
<TimeStamp>%s</TimeStamp>
<Nonce><![CDATA[%s]]></Nonce>
</xml>";
		return sprintf($format, $encrypt, $signature, $timestamp, $nonce);
    }
    
    /**
     * 随机生成16位字符串
     * @todo 无
     * @author 小黄牛
     * @version v1.0.1 + 2020.07.24
     * @deprecated 暂不启用
     * @global 无
     * @return string 生成的字符串
    */
    private function getRandomStr() {
        $str = "";
        $str_pol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($str_pol) - 1;
        for ($i = 0; $i < 16; $i++) {
            $str .= $str_pol[mt_rand(0, $max)];
        }
        return $str;
    }

    /**
     * 用SHA1算法生成安全签名
     * @todo 无
     * @author 小黄牛
     * @version v1.0.1 + 2020.07.24
     * @deprecated 暂不启用
     * @global 无
	 * @param string $token 票据
	 * @param string $timestamp 时间戳
	 * @param string $nonce 随机字符串
	 * @param string $encrypt 密文消息
     * @return void
    */
	private function getSHA1($token, $timestamp, $nonce, $encrypt_msg) {
		//排序
		try {
			$array = array($encrypt_msg, $token, $timestamp, $nonce);
			sort($array, SORT_STRING);
			$str = implode($array);
			return sha1($str);
		} catch (\Exception $e) {
            return false;
		}
	}
}