<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/3 0003
 * Time: 上午 10:09
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\TokenException;
use think\Controller;
use app\api\service\Token as TokenService;
use app\api\model\Order as OrderModel;
use app\api\service\Order as OrderService;
use app\api\service\Token;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\OrderPlace;
use app\api\validate\PagingParameter;
use app\lib\exception\OrderException;
use app\lib\exception\SuccessMessage;


class Order extends BaseController
{
    //用户在选择商品后，向API提交包含它所选择商品的相关信息
    //API在接受到信息后，需要检查订单相关商品的库存量
    //有库存，把订单数据存入数据库中= 下单成功了，返回客户端消息，告诉客户端可以支付了
//    调用我们的支付接口，进行支付
//    还需要再次进行库存量检测
//    服务器这边就可以调用微信的支付接口进行支付
//    微信会返回给我们一个支付的结果（异步）
//    成功：也需要进行库存量的检查
//    成功：进行库存量的扣除

    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder'],
        'checkPrimaryScope' => ['only' => 'getDetail,getSummaryByUser'],
        'checkSuperScope' => ['only' => 'delivery,getSummary']
    ];

    /*protected function checkExclusiveScope()
    {
        $scope = TokenService::getCurrentTokenVar('scope');
        if ($scope) {
            if ($scope == ScopeEnum::User) {
                return true;
            } else {
                throw new ForbiddenException();
            }
        } else {
            throw new TokenException();
        }

    }*/

    public function placeOrder()
    {
        (new OrderPlace())->goCheck();
        $products = input('post.products/a');
        $uid = TokenService::getCurrentUid();
        $order = new OrderService();
        $status = $order->place($uid, $products);
        return $status;
    }

    public function getSummaryByUser($page = 1, $size = 15)
    {
        (new PagingParameter())->goCheck();
        $uid = Token::getCurrentUid();
        $pagingOrders = OrderModel::getSummaryByUser($uid, $page, $size);
        if ($pagingOrders->isEmpty())
        {
            return [
                'current_page' => $pagingOrders->getCurrentPage(),
                'data' => []
            ];
        }
//        $collection = collection($pagingOrders->items());
//        $data = $collection->hidden(['snap_items', 'snap_address'])
//            ->toArray();
        $data = $pagingOrders->hidden(['snap_items', 'snap_address','prepay_id'])
            ->toArray();
        return [
//            'current_page' => $pagingOrders->currentPage(),
            'current_page' => $pagingOrders->getCurrentPage(),
            'data' => $data
        ];

    }

    /**
     * 获取订单详情
     * @param $id
     * @return $this
     * @throws OrderException
     * @throws \app\lib\exception\ParameterException
     */
    public function getDetail($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $orderDetail = OrderModel::get($id);
        if (!$orderDetail)
        {
            throw new OrderException();
        }
        return $orderDetail
            ->hidden(['prepay_id']);
    }


    public function deleteOrder()
    {

    }


}
