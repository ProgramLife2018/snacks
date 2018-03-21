<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/27 0027
 * Time: 下午 5:10
 */

namespace app\api\model;



class Image extends BaseModel
{
    protected $hidden = ['id','from','updata_time','delete_time'];

    public function getUrlAttr($value,$data){
        return $this->prefixImgUrl($value,$data);
    }
}