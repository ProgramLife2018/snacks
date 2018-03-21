<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/1 0001
 * Time: 下午 12:18
 */

namespace app\api\model;


class User extends BaseModel
{
    public function address()
    {
        return $this->hasOne('UserAddress', 'user_id', 'id');
    }

    /**
     * @param $openid
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public static function getByOpenID($openid)
    {
        $user = User::where('openid', '=', $openid)
            ->find();
        return $user;
    }



}