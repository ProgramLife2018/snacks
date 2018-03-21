<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/26 0026
 * Time: 下午 11:41
 */

namespace app\api\model;


use think\Model;

class BannerItem extends BaseModel
{
    protected $hidden = ['id','img_id','banner_id','update_time','delete_time'];
    public function img(){
        return $this->belongsTo('Image','img_id','id');
    }

}