<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/17 0017
 * Time: 上午 10:21
 */

namespace app\api\controller\v1;


use app\api\model\Banner as BannerModel;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\BannerMissException;
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
        /* $data = [
             'id' => $id
         ];
         $validate = new IDMustBePositiveInt();
         $result = $validate->batch()->check($data);
         if($result){

         }else{

         }*/
//        print_r($validate->getError());
        (new IDMustBePositiveInt())->goCheck();
//        $banner = BannerModel::with(['items','items.img'])->find($id);
        $banner = BannerModel::getBannerById($id);
//        $banner->hidden(['update_time','delete_time']);
        if (!$banner) {
//            throw new Exception('内部错误');
            throw new BannerMissException();
        }
//        $c  = config('setting.img_prefix');
        return $banner;
//        return $data;
//         return json($banner);
    }
}