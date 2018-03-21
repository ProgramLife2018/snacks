<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/25 0025
 * Time: 下午 10:27
 */

namespace app\lib\exception;



class ParameterException extends BaseException
{
    public $code = 400;
    public $msg = '参数错误';
    public $errorCode = 10000;
}