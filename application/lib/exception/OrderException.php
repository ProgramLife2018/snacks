<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/3 0003
 * Time: 下午 8:45
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = 404;
    public $msg = '订单不存在，请检查ID';
    public $errorCode = 80000;
}