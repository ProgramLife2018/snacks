<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/23 0023
 * Time: 下午 9:52
 */

namespace app\api\model;

use think\Db;
use think\Exception;
use think\Model;

class Banner extends BaseModel
{
    protected $hidden = ['id'];
    public function items(){
        return $this->hasMany('BannerItem','banner_id','id');
    }
//    protected $table = 'category';
    public static function getBannerById($id)
    {
        $banner = self::with(['items','items.img'])->find($id);
        return $banner;
//        $result=Db::query('select * from banner_item WHERE banner_id=?',[$id]);
//        $result = Db::table('banner_item')->where('banner_id','=',$id)->select();
        //表达式、数组法、闭包
       /*$result = Db::table('banner_item')
            ->where(function($query) use ($id){
            $query->where('banner_id','=',$id);
        })->select();
        return $result;*/
    }

}