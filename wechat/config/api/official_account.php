<?php
/**
 * +----------------------------------------------------------------------
 * 公众号 - 开发配置
 * +----------------------------------------------------------------------
 * 官网：https://www.sw-x.cn
 * +----------------------------------------------------------------------
 * 作者：小黄牛 <1731223728@qq.com>
 * +----------------------------------------------------------------------
 * 开源协议：http://www.apache.org/licenses/LICENSE-2.0
 * +----------------------------------------------------------------------
*/

return [
    // 微信公众号接口域名
    'api_domain' => 'https://api.weixin.qq.com',
    'mp_domain' => 'https://mp.weixin.qq.com',
    // 接口列表（%s% 为参数占位符）
    'api_list' => [
        // 获取普通access_token
        'access_token' => '/cgi-bin/token?grant_type=client_credential&appid=%s%&secret=%s%',
        // 获取微信服务器IP地址
        'get_api_domain_ip' => '/cgi-bin/get_api_domain_ip?access_token=%s%',
        // 网络检测
        'check' => '/cgi-bin/callback/check?access_token=%s%',

        // 清空api的调用quota
        'clear_quota' => '/cgi-bin/clear_quota?access_token=%s%',
        // 查询openAPI调用quota
        'get_quota' => '/cgi-bin/openapi/quota/get?access_token=%s%',
        // 查询rid信息
        'get_rid' => '/cgi-bin/openapi/rid/get?access_token=%s%',
        
        // 创建菜单
        'menu_create' => '/cgi-bin/menu/create?access_token=%s%',
        // 查询菜单
        'menu_query' => '/cgi-bin/get_current_selfmenu_info?access_token=%s%',
        // 删除菜单
        'menu_delete' => '/cgi-bin/menu/delete?access_token=%s%',
        // 获取菜单
        'menu_get' => '/cgi-bin/menu/get?access_token=%s%',

        // 消息模板-设置所属行业
        'template_set_industry' => '/cgi-bin/template/api_set_industry?access_token=%s%',
        // 消息模板-获取设置的行业信息
        'template_get_industry' => '/cgi-bin/template/get_industry?access_token=%s%',
        // 消息模板-获取模板ID
        'template_get_id' => '/cgi-bin/template/api_add_template?access_token=%s%',
        // 消息模板-获取模板列表
        'template_get_list' => '/cgi-bin/template/get_all_private_template?access_token=%s%',
        // 消息模板-删除模板
        'template_delete_industry' => '/cgi-bin/template/del_private_template?access_token=%s%',
        // 消息模板-发送消息模板
        'template_send_industry' => '/cgi-bin/message/template/send?access_token=%s%',

        // 一次性订阅授权连接【mp】
        'subscribemsg' => '/mp/subscribemsg?action=get_confirm&appid=%s%&scene=%s%&template_id=%s%&redirect_url=%s%&reserved=%s%#wechat_redirect',
        // 推送订阅模板消息给一次性授权用户
        'subscribe' => '/cgi-bin/message/template/subscribe?access_token=%s%',


        // 订阅通知-选用模板
        'addtemplate' => '/wxaapi/newtmpl/addtemplate?access_token=%s%',
        // 订阅通知-删除模板
        'deltemplate' => '/wxaapi/newtmpl/deltemplate?access_token=%s%',
        // 订阅通知-获取公众号类目
        'getcategory' => '/wxaapi/newtmpl/getcategory?access_token=%s%',
        // 获取类目下的公共模板
        'getpubtemplatetitles' => '/wxaapi/newtmpl/getpubtemplatetitles?access_token=%s%',
        // 订阅通知-获取模板中的关键词
        'getpubtemplatekeywords' => '/wxaapi/newtmpl/getpubtemplatekeywords?access_token=%s%',
        // 获取私有模板列表
        'gettemplate' => '/wxaapi/newtmpl/gettemplate?access_token=%s%',
        // 发送订阅通知
        'bizsend' => '/cgi-bin/message/subscribe/bizsend?access_token=%s%',

        // 添加客服帐号
        'kfaccount_add' => '/customservice/kfaccount/add?access_token=%s%',
        // 修改客服帐号
        'kfaccount_update' => '/customservice/kfaccount/update?access_token=%s%',
        // 删除客服帐号
        'kfaccount_del' => '/customservice/kfaccount/del?access_token=%s%',
        // 设置客服帐号的头像
        'kfaccount_uploadheadimg' => '/customservice/kfaccount/uploadheadimg?access_token=%s%&kf_account=%s%',
        // 获取所有客服账号
        'getkflist' => '/cgi-bin/customservice/getkflist?access_token=%s%',
        // 获取所有客服账号-在线
        'getonlinekflist' => '/cgi-bin/customservice/getonlinekflist?access_token=%s%',
        // 发消息
        'kfaccount_send' => '/cgi-bin/message/custom/send?access_token=%s%',
        // 客服输入状态
        'kfaccount_typing' => '/cgi-bin/message/custom/typing?access_token=%s%',
        // 创建会话
        'kfsession_create' => '/customservice/kfsession/create?access_token=%s%',
        // 关闭会话
        'kfsession_close' => '/customservice/kfsession/close?access_token=%s%',
        // 获取客户会话状态
        'kfsession_getsession' => '/customservice/kfsession/getsession?access_token=%s%&openid=%s%',
        // 获取客服会话列表
        'kfsession_getsessionlist' => '/customservice/kfsession/getsessionlist?access_token=%s%&kf_account=%s%',
        // 获取未接入会话列表
        'kfsession_getwaitcase' => '/customservice/kfsession/getwaitcase?access_token=%s%',
        // 获取聊天记录
        'kfsession_getmsglist' => '/customservice/msgrecord/getmsglist?access_token=%s%',

        // 添加顾问
        'addguideacct' => '/cgi-bin/guide/addguideacct?access_token=%s%',
        // 获取顾问信息
        'getguideacct' => '/cgi-bin/guide/getguideacct?access_token=%s%',
        // 修改顾问的昵称或头像
        'updateguideacct' => '/cgi-bin/guide/updateguideacct?access_token=%s%',
        // 删除顾问
        'delguideacct' => '/cgi-bin/guide/delguideacct?access_token=%s%',
        // 获取服务号顾问列表
        'getguideacctlist' => '/cgi-bin/guide/getguideacctlist?access_token=%s%',
        // 生成顾问二维码
        'guidecreateqrcode' => '/cgi-bin/guide/guidecreateqrcode?access_token=%s%',
        // 获取顾问聊天记录
        'getguidebuyerchatrecord' => '/cgi-bin/guide/getguidebuyerchatrecord?access_token=%s%',
        // 设置快捷回复与关注自动回复
        'setguideconfig' => '/cgi-bin/guide/setguideconfig?access_token=%s%',
        // 获取快捷回复与关注自动回复
        'getguideconfig' => '/cgi-bin/guide/getguideconfig?access_token=%s%',
        // 设置敏感词与离线自动回复
        'setguideacctconfig' => '/cgi-bin/guide/setguideacctconfig?access_token=%s%',
        // 获取离线自动回复与敏感词
        'getguideacctconfig' => '/cgi-bin/guide/getguideacctconfig?access_token=%s%',
        // 允许微信用户复制小程序页面路径
        'pushshowwxapathmenu' => '/cgi-bin/guide/pushshowwxapathmenu?access_token=%s%',
        // 新建顾问分组
        'newguidegroup' => '/cgi-bin/guide/newguidegroup?access_token=%s%',
        // 获取服务号下所有顾问分组的列表
        'getguidegrouplist' => '/cgi-bin/guide/getguidegrouplist?access_token=%s%',
        // 获取指定顾问分组信息
        'getgroupinfo' => '/cgi-bin/guide/getgroupinfo?access_token=%s%',
        // 分组内添加顾问
        'addguide2guidegroup' => '/cgi-bin/guide/addguide2guidegroup?access_token=%s%',
        // 分组内删除顾问
        'delguide2guidegroup' => '/cgi-bin/guide/delguide2guidegroup?access_token=%s%',
        // 获取顾问所在分组
        'getgroupbyguide' => '/cgi-bin/guide/getgroupbyguide?access_token=%s%',
        // 删除指定顾问分组
        'delguidegroup' => '/cgi-bin/guide/delguidegroup?access_token=%s%',
        
        // 为顾问分配客户
        'addguidebuyerrelation' => '/cgi-bin/guide/addguidebuyerrelation?access_token=%s%',
        // 为顾问移除客户
        'delguidebuyerrelation' => '/cgi-bin/guide/delguidebuyerrelation?access_token=%s%',
        // 获取顾问的客户列表
        'getguidebuyerrelationlist' => '/cgi-bin/guide/getguidebuyerrelationlist?access_token=%s%',
        // 为客户更换顾问
        'rebindguideacctforbuyer' => '/cgi-bin/guide/rebindguideacctforbuyer?access_token=%s%',
        // 修改客户昵称
        'updateguidebuyerrelation' => '/cgi-bin/guide/updateguidebuyerrelation?access_token=%s%',
        // 查询客户所属顾问
        'getguidebuyerrelationbybuyer' => '/cgi-bin/guide/getguidebuyerrelationbybuyer?access_token=%s%',
        // 查询指定顾问和客户的关系
        'getguidebuyerrelation' => '/cgi-bin/guide/getguidebuyerrelation?access_token=%s%',
        
        // 新建可查询的标签类型
        'newguidetagoption' => '/cgi-bin/guide/newguidetagoption?access_token=%s%',
        // 删除指定标签类型
        'delguidetagoption' => '/cgi-bin/guide/delguidetagoption?access_token=%s%',
        // 为标签添加可选值
        'addguidetagoption' => '/cgi-bin/guide/addguidetagoption?access_token=%s%',
        // 获取标签和可选值
        'getguidetagoption' => '/cgi-bin/guide/getguidetagoption?access_token=%s%',
        // 为客户设置标签
        'addguidebuyertag' => '/cgi-bin/guide/addguidebuyertag?access_token=%s%',
        // 查询客户标签
        'getguidebuyertag' => '/cgi-bin/guide/getguidebuyertag?access_token=%s%',
        // 根据标签值筛选客户
        'queryguidebuyerbytag' => '/cgi-bin/guide/queryguidebuyerbytag?access_token=%s%',
        // 删除客户标签
        'delguidebuyertag' => '/cgi-bin/guide/delguidebuyertag?access_token=%s%',
        // 设置自定义客户信息
        'addguidebuyerdisplaytag' => '/cgi-bin/guide/addguidebuyerdisplaytag?access_token=%s%',
        // 获取自定义客户信息
        'getguidebuyerdisplaytag' => '/cgi-bin/guide/getguidebuyerdisplaytag?access_token=%s%',
        
        // 添加小程序卡片素材
        'setguidecardmaterial' => '/cgi-bin/guide/setguidecardmaterial?access_token=%s%',
        // 查询小程序卡片素材
        'getguidecardmaterial' => '/cgi-bin/guide/getguidecardmaterial?access_token=%s%',
        // 删除小程序卡片素材
        'delguidecardmaterial' => '/cgi-bin/guide/delguidecardmaterial?access_token=%s%',
        // 添加图片素材
        'setguideimagematerial' => '/cgi-bin/guide/setguideimagematerial?access_token=%s%',
        // 查询图片素材
        'getguideimagematerial' => '/cgi-bin/guide/getguideimagematerial?access_token=%s%',
        // 删除图片素材
        'delguideimagematerial' => '/cgi-bin/guide/delguideimagematerial?access_token=%s%',
        // 添加文字素材
        'setguidewordmaterial' => '/cgi-bin/guide/setguidewordmaterial?access_token=%s%',
        // 查询文字素材
        'getguidewordmaterial' => '/cgi-bin/guide/getguidewordmaterial?access_token=%s%',
        // 删除文字素材
        'delguidewordmaterial' => '/cgi-bin/guide/delguidewordmaterial?access_token=%s%',
        
        // 添加群发任务
        'addguidemassendjob' => '/cgi-bin/guide/addguidemassendjob?access_token=%s%',
        // 获取群发任务列表
        'getguidemassendjoblist' => '/cgi-bin/guide/getguidemassendjoblist?access_token=%s%',
        // 获取指定群发任务信息
        'getguidemassendjob' => '/cgi-bin/guide/getguidemassendjob?access_token=%s%',
        // 修改群发任务
        'updateguidemassendjob' => '/cgi-bin/guide/updateguidemassendjob?access_token=%s%',
        // 取消群发任务
        'cancelguidemassendjob' => '/cgi-bin/guide/cancelguidemassendjob?access_token=%s%',

        // 点击授权的生成链接 state参数虽然为可选，但还是建议必填
        'snsapi' => 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s%&redirect_uri=%s%&response_type=code&scope=%s%&state=%s%#wechat_redirect',
        // 用授权后获得code去换取特殊的Access_Token
        'snsapi_access_token' => '/sns/oauth2/access_token?appid=%s%&secret=%s%&code=%s%&grant_type=authorization_code',
        // 使用refresh_token更新特殊的Access_Token
        'snsapi_update_access_token' => '/sns/oauth2/refresh_token?appid=%s%&grant_type=refresh_token&refresh_token=%s%',
        // 使用特殊的Access_Token去获取用户信息
        'snsapi_user_info' => '/sns/userinfo?access_token=%s%&openid=%s%&lang=%s%',

        // 新增临时素材
        'media_upload' => '/cgi-bin/media/upload?access_token=%s%&type=%s%',
        // 获取临时素材
        'media_get' => '/cgi-bin/media/get?access_token=%s%&media_id=%s%',
        // 高清语音素材获取
        'media_jssdk_get' => '/cgi-bin/media/get/jssdk?access_token=%s%&media_id=%s%',
        // 新增永久素材
        'upload_material' => '/cgi-bin/material/add_material?access_token=%s%&type=%s%',
        // 获取永久素材
        'get_material' => '/cgi-bin/material/get_material?access_token=%s%',
        // 删除永久素材
        'del_material' => '/cgi-bin/material/del_material?access_token=%s%',
        // 上传小图片
        'uploadimg' => '/cgi-bin/media/uploadimg?access_token=%s%',
        // 新增永久图文素材
        'add_news' => '/cgi-bin/material/add_news?access_token=%s%',
        // 修改永久图文素材
        'update_news' => '/cgi-bin/material/update_news?access_token=%s%',
        // 获取素材总数
        'get_materialcount' => '/cgi-bin/material/get_materialcount?access_token=%s%',
        // 获取素材列表
        'batchget_material' => '/cgi-bin/material/batchget_material?access_token=%s%',

        // 新建草稿
        'draft_add' => '/cgi-bin/draft/add?access_token=%s%',
        // 获取草稿
        'draft_get' => '/cgi-bin/draft/get?access_token=%s%',
        // 删除草稿
        'draft_delete' => '/cgi-bin/draft/delete?access_token=%s%',
        // 修改草稿
        'draft_update' => '/cgi-bin/draft/update?access_token=%s%',
        // 获取草稿总数
        'draft_count' => '/cgi-bin/draft/count?access_token=%s%',
        // 获取草稿列表
        'draft_batchget' => '/cgi-bin/draft/batchget?access_token=%s%',

        // 发布接口
        'freepublish_submit' => '/cgi-bin/freepublish/submit?access_token=%s%',
        // 发布状态轮询接口
        'freepublish_get' => '/cgi-bin/freepublish/get?access_token=%s%',
        // 删除发布
        'freepublish_delete' => '/cgi-bin/freepublish/delete?access_token=%s%',
        // 通过 article_id 获取已发布文章
        'freepublish_getarticle' => '/cgi-bin/freepublish/getarticle?access_token=%s%',
        // 获取成功发布列表
        'freepublish_batchget' => '/cgi-bin/freepublish/batchget?access_token=%s%',

        // 创建标签
        'tags_create' => '/cgi-bin/tags/create?access_token=%s%',
        // 获取公众号已创建的标签
        'tags_get' => '/cgi-bin/tags/get?access_token=%s%',
        // 编辑标签
        'tags_update' => '/cgi-bin/tags/update?access_token=%s%',
        // 删除标签
        'tags_delete' => '/cgi-bin/tags/delete?access_token=%s%',
        // 获取标签下粉丝列表
        'user_tag_get' => '/cgi-bin/user/tag/get?access_token=%s%',
        // 批量为用户打标签
        'batchtagging' => '/cgi-bin/tags/members/batchtagging?access_token=%s%',
        // 批量为用户取消标签
        'batchuntagging' => '/cgi-bin/tags/members/batchuntagging?access_token=%s%',
        // 获取用户身上的标签列表
        'tags_getidlist' => '/cgi-bin/tags/getidlist?access_token=%s%',
        // 通过OpenID设置用户备注名
        'remarks' => '/cgi-bin/user/info/updateremark?access_token=%s%',
        // 通过OpenID来获取用户基本信息（包括UnionID机制）
        'basic' => '/cgi-bin/user/info?access_token=%s%&openid=%s%',
        // 通过OpenId获取用户列表
        'user_list' => '/cgi-bin/user/get?access_token=%s%&next_openid=%s%',
        // 获取公众号的黑名单列表
        'getblacklist' => '/cgi-bin/tags/members/getblacklist?access_token=%s%',
        // 拉黑用户
        'batchblacklist' => '/cgi-bin/tags/members/batchblacklist?access_token=%s%',
        // 取消拉黑用户
        'batchunblacklist' => '/cgi-bin/tags/members/batchunblacklist?access_token=%s%',

        // 创建二维码的ticket
        'qrcode' => '/cgi-bin/qrcode/create?access_token=%s%',
        // 使用ticket去换取二维码
        'qrcode_ticket' => '/cgi-bin/showqrcode?ticket=%s%',
        
        // 长信息转短
        'shorten_gen' => '/cgi-bin/shorten/gen?access_token=%s%',
        // 短信息转长
        'shorten_fetch' => '/cgi-bin/shorten/fetch?access_token=%s%',
        
        // 创建卡卷
        'card_create' => '/card/create?access_token=%s%',
        // 设置买单
        'card_paycell' => '/card/paycell/set?access_token=%s%',
        // 设置自助核销
        'selfconsumecell' => '/card/selfconsumecell/set?access_token=%s%',
        // 创建二维码接口
        'card_qrcode' => '/card/qrcode/create?access_token=%s%',
        // 创建货架
        'card_landingpage' => '/card/landingpage/create?access_token=%s%',
        // 导入code
        'deposit' => '/card/code/deposit?access_token=%s%',
        // 查询导入code数目
        'getdepositcount' => '/card/code/getdepositcount?access_token=%s%',
        // 核查code
        'checkcode' => '/card/code/checkcode?access_token=%s%',
        // 图文消息群发卡券
        'gethtml' => '/card/mpnews/gethtml?access_token=%s%',
        // 设置测试白名单
        'testwhitelist' => '/card/testwhitelist/set?access_token=%s%',
        // 查询Code
        'card_code_get' => '/card/code/get?access_token=%s%',
        // 核销Code
        'consume' => '/card/code/consume?access_token=%s%',
        //  Code解码
        'card_decrypt' => '/card/code/decrypt?access_token=%s%',
        // 获取用户已领取卡券
        'getcardlist' => '/card/user/getcardlist?access_token=%s%',
        // 查看卡券详情
        'card_get' => '/card/get?access_token=%s%',
        // 批量查询卡券列表
        'card_batchget' => '/card/batchget?access_token=%s%',
        // 更改卡券信息
        'card_update' => '/card/update?access_token=%s%',
        // 修改库存
        'modifystock' => '/card/modifystock?access_token=%s%',
        // 更改Code
        'card_code_update' => '/card/code/update?access_token=%s%',
        // 删除卡券
        'card_delete' => '/card/delete?access_token=%s%',
        // 设置卡券失效
        'unavailable' => '/card/code/unavailable?access_token=%s%',
        // 拉取卡券概况数据
        'getcardbizuininfo' => '/datacube/getcardbizuininfo?access_token=%s%',
        // 获取免费券数据
        'getcardcardinfo' => '/datacube/getcardcardinfo?access_token=%s%',
        // 拉取会员卡概况数据
        'getcardmembercardinfo' => '/datacube/getcardmembercardinfo?access_token=%s%',
        // 拉取单张会员卡数据
        'getcardmembercarddetail' => '/datacube/getcardmembercarddetail?access_token=%s%',
        // 激活会员卡
        'card_activate' => '/card/membercard/activate?access_token=%s%',
        // 设置开卡字段
        'activateuserform' => '/card/membercard/activateuserform/set?access_token=%s%',
        // 更新会员信息
        'card_updateuser' => '/card/membercard/updateuser?access_token=%s%',
        // 拉取会员信息（积分查询）
        'card_userinfo' => '/card/membercard/userinfo/get?access_token=%s%',
        // 设置支付后投放卡券
        'card_paygiftcard' => '/card/paygiftcard/add?access_token=%s%',
        // 更新会议门票
        'card_meetingticket' => '/card/meetingticket/updateuser?access_token=%s%',
        // 更新电影票
        'card_movieticket' => '/card/movieticket/updateuser?access_token=%s%',
        // 更新飞机票
        'card_boardingpass' => '/card/boardingpass/checkin?access_token=%s%',
        // 创建子商户
        'card_submerchant' => '/card/submerchant/submit?access_token=%s%',
        // 卡券开放类目查询
        'card_getapplyprotocol' => '/card/getapplyprotocol?access_token=%s%',
        // 更新子商户
        'card_submerchant_update' => '/card/submerchant/update?access_token=%s%',
        // 拉取单个子商户信息
        'card_submerchant_get' => '/card/submerchant/get?access_token=%s%',
        // 批量拉取子商户信息
        'card_submerchant_batchget' => '/card/submerchant/batchget?access_token=%s%',

        // 创建门店
        'addpoi' => '/cgi-bin/poi/addpoi?access_token=%s%',
        // 查询门店
        'getpoi' => '/cgi-bin/poi/getpoi?access_token=%s%',
        // 查询门店列表
        'getpoilist' => '/cgi-bin/poi/getpoilist?access_token=%s%',
        // 修改门店服务信息
        'updatepoi' => '/cgi-bin/poi/updatepoi?access_token=%s%',
        // 删除门店
        'delpoi' => '/cgi-bin/poi/delpoi?access_token=%s%',
        // 门店类目表
        'getwxcategory' => '/cgi-bin/poi/getwxcategory?access_token=%s%',

        // 申请二维码
        'applycode' => '/intp/marketcode/applycode?access_token=%s%',
        // 查询二维码申请单
        'applycodequery' => '/intp/marketcode/applycodequery?access_token=%s%',
        // 下载二维码包
        'applycodedownload' => '/intp/marketcode/applycodedownload?access_token=%s%',
        // 激活二维码
        'codeactive' => '/intp/marketcode/codeactive?access_token=%s%',
        // 查询二维码激活状态
        'codeactivequery' => '/intp/marketcode/codeactivequery?access_token=%s%',
        // code_ticket换code
        'tickettocode' => '/intp/marketcode/tickettocode?access_token=%s%',
    ]
];