<?php
/**
 * +----------------------------------------------------------------------
 * 微信支付 - V2 - 工具类
 * +----------------------------------------------------------------------
 * 官网：https://www.sw-x.cn
 * +----------------------------------------------------------------------
 * 作者：小黄牛 <1731223728@qq.com>
 * +----------------------------------------------------------------------
 * 开源协议：http://www.apache.org/licenses/LICENSE-2.0
 * +----------------------------------------------------------------------
*/
namespace wechat\vendor\Tool;

class PayV2
{
    /**
     * 将数组转化为xml
     * 
     * @param array $array 转换的数组
     * @return xml
    */
    public static function array_to_xml($array){
        $xml = "<xml>";
        foreach ($array as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }

    /**
     * 获取xml里面数据，转换成array
     * 
     * @param xml $xml
     * @return void
    */
	public static function xml_to_array($xml){ 
        $obj = simplexml_load_string($xml,"SimpleXMLElement", LIBXML_NOCDATA);
        return json_decode(json_encode($obj),true);
    } 
    
    /**
     * 生成签名, $KEY就是支付key
     * 
     * @param array $params
     * @param string $key
     * @return void 签名
    */
    public static function make_sign($params, $key){
		//签名步骤一：按字典序排序数组参数 
		ksort($params); 
		$string = self::to_url_params($params); //参数进行拼接key=value&k=v 
		//签名步骤二：在string后加入KEY 
		$string = $string . "&key=".$key; 
		//签名步骤三：MD5加密 
		$string = md5($string); 
		//签名步骤四：所有字符转为大写 
		$result = strtoupper($string); 
		return $result; 
    }
    
    /**
     * 将参数拼接为url: key=value&key=value
     * 
     * @param array $params
     * @return string 
    */
	public static function to_url_params($params) {
		$string = ''; 
		if( !empty($params) ){ 
			$array = array(); 
			foreach( $params as $key => $value ){ 
				$array[] = strtolower($key).'='.$value; 
			}
			$string = implode("&",$array);
		} 
		return $string; 
	} 
    
    /**
     * 随机字符串
     * @return int
    */
    public static function nonce_str() {
        return (string) rand(10000, 99999) . time();
    }
}