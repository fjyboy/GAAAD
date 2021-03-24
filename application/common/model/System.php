<?php
/**
 * Create Time: 2021/3/22 17:01
 * Author:Liu Jiabing.
 * Email:531288693@qq.com
 */

namespace app\common\model;


use think\Model;

class System extends Model
{
    public function set($data){
        $validate=new \app\common\validate\System();
        if(!$validate->check($data)){
            return $validate->getError();
        }
        $webInfo=$this->find($data['id']);

        $webInfo->webname=$data['webname'];
        $webInfo->copyright=$data['copyright'];
        $result = $webInfo->save();
        if($result){
            return 1;
        }else{
            return '编辑失败';
        }
    }
}