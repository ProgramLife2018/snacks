<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/15 0015
 * Time: 下午 5:36
 */

namespace app\simple\controller;
use think\Exception;
use think\Request;

class Test
{
    public function test(){
        echo 'test';
    }

    public function app($a=1,$b=2){
      /*  $a=$_REQUEST['a'];
        $b=$_REQUEST['b'];*/
//        print_r($_REQUEST);
        try{
            1/0;
        }catch(Exception $ex){
//            throw $ex;
            $err = [
                'error_code' => 1001,
                'msg' => $ex->getMessage()
            ];
            return json($err,400);
        }
        echo $a;
        echo "<br/>";
        echo $b;
        $c = $a + $b;
        echo "<br/>";
        echo $c;
    }


    public function abc($array){
        foreach($array as $key => $value){

        }
    }
}