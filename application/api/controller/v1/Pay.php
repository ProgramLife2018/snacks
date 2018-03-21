<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/4 0004
 * Time: 下午 1:02
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\service\Pay as PayService;
use app\api\service\WxNotify;
use app\api\validate\IDMustBePositiveInt;
use think\Controller;

class Pay extends BaseController
{
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'getPreOrder']
    ];

    public function getPreOrder($id = '')
    {
        (new IDMustBePositiveInt())->goCheck();
        $pay = new PayService($id);
        return $pay->pay();
    }

    public function redirectNotify()
    {
        $notify = new WxNotify();
        $notify->handle();
    }

    public function receiveNotify()
    {
//        通知频率为15/15/30/180/1800/1800/1800/1800/3600,单位:秒
//        1.检查库存量，超卖
//        2.更新这个订单的status状态
//        3.减库存
//        如果成功处理,我们返回微信成功处理的信息。否则，我们需要返回没有成功处理。

//        特点：post:xml格式；不会携带参数
        /*$notify = new WxNotify();
        $notify->handle();*/

        //做转发处理，微信对碰到?后面的参数会自动过滤掉，所以我们这里把微信返回的参数，转化到另外一个A方法（把问号后面的参数一起带过去），然后在A方法里在调试
        $xmlData = file_get_contents('php://input');
        $result = curl_post_raw('http:/zerg.cn/api/v1/pay/re_notify?XDEBUG_SESSION_START=13285',
            $xmlData);
    }
}