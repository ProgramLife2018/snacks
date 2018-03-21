<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/17 0017
 * Time: 上午 10:21
 */

namespace app\api\controller\v2 ;


use think\Exception;

class Banner
{
    /**
     * @param $id
     * @return string
     * @throws \think\Exception
     */
    public function getBanner($id)
    {
        return 'This is V2 Version';
    }
}