<?php
/**
 * Create Time: 2021/3/22 13:55
 * Author:Liu Jiabing.
 * Email:531288693@qq.com
 */

namespace app\common\model;


use think\Model;

class Member extends Model
{
    protected $readonly=['username','email'];


    public function add($data){
        $validate=new \app\common\validate\Member();
        if(!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if($result){

            return 1;
        }else{
            return '注册失败';
        }
    }

    public function edit($data){
        $validate=new \app\common\validate\Member();
        if(!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $memberInfo=$this->find($data['id']);
        if($data['oldpassword']!=$memberInfo['password']){
            return '原密码不正确';
        }

        $memberInfo->password=$data['newpassword'];
        $memberInfo->nickname=$data['nickname'];
        $result = $memberInfo->save();
        if($result){
            return 1;
        }else{
            return '编辑失败';
        }
    }

    public function comments(){
        return $this->hasMany('Comment','member_id','id');
    }

    public function register($data)
    {
        $validate = new \app\common\validate\Member();
        if (!$validate->scene('register')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {

            return 1;
        } else {
            return '注册失败';
        }
    }
}