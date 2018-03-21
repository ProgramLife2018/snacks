<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/23 0023
 * Time: 下午 9:54
 */

namespace app\api\model;



use think\Model;
//use traits\model\SoftDelete;
class BaseModel extends Model
{

//    use SoftDelete;

//    protected $hidden = ['delete_time'];
    /**
     * 返回图片地址
     * @param $value
     * @param $data
     * @return string
     */
    protected function  prefixImgUrl($value, $data){
        $finalUrl = $value;
        if($data['from'] == 1){
            $finalUrl = config('setting.img_prefix').$value;
        }
        return $finalUrl;
    }

}