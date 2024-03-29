<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/2 0002
 *
 * Time: 下午 2:28
 */

namespace app\api\controller\v1;




use app\api\controller\BaseController;
use app\api\model\User as UserModel;
use app\api\service\Token as TokenService;
use app\api\validate\AddressNew;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\TokenException;
use app\lib\exception\UserException;
use think\Controller;

class Address extends BaseController
{
    protected $beforeActionList = [
//        'first'=>['only' => 'second']
          'checkPrimaryScope' => ['only' => 'createOrUpdateAddress']
    ];


   /* protected function first(){
        echo 'first'."<br/>";
    }

    public function second(){
        echo 'second';
    }*/

    public function createOrUpdateAddress(){
        $valiadate = new AddressNew();
        $valiadate->goCheck();
//        (new AddressNew())->goCheck();

        $uid = TokenService::getCurrentUid();
        $user = UserModel::get($uid);
        if(!$user){
            throw new UserException();
        }
        $dataArray = $valiadate->getDataByRule(input('post.'));
        $userAddress = $user->address;
        if(!$userAddress){
            $user->address()->save($dataArray);
        }else{
            $user->address->save($dataArray);
        }
//        return $user;
//        return 'success';
        return json(new SuccessMessage(),201);
    }

}
