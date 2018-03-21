<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/23 0023
 * Time: 上午 11:33
 */

namespace app\api\validate;


use think\Validate;

class TestValidate extends Validate
{
    protected $rule = [
        'name' => 'require|max:10',
        'email' =>'email'
    ];

}