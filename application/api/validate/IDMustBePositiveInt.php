<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/23 0023
 * Time: 下午 9:39
 */

namespace app\api\validate;


class IDMustBePositiveInt extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger',
//        'num' => 'in:1,2,3'
    ];
    protected $message = [
        'id'=>'id必须是正整数'
    ];

}