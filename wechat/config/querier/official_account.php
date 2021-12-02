<?php
/**
 * +----------------------------------------------------------------------
 * 公众号 - 账号配置 - DB查询器，返回值结构参考attribute目录下同名配置文件
 * +----------------------------------------------------------------------
 * 官网：https://www.sw-x.cn
 * +----------------------------------------------------------------------
 * 作者：小黄牛 <1731223728@qq.com>
 * +----------------------------------------------------------------------
 * 开源协议：http://www.apache.org/licenses/LICENSE-2.0
 * +----------------------------------------------------------------------
*/

namespace wechat\config\querier;
use wechat\config\querier\AbstractClass;

class official_account extends AbstractClass
{
    /**
     * 查询器入口
     * 
     * @return array
    */
    public function run() {
        // 此处用于查询Db获取动态配置项，返回给SDK代替静态配置加载
        return [];
    }
}