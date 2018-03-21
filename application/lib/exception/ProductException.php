<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/28 0028
 * Time: 下午 7:06
 */

namespace app\lib\exception;


class ProductException extends BaseException
{
    public $code = 400;
    public $msg = '指定商品不存在，请检查商品ID';
    public $errorCode = 30000;
}