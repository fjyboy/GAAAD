<?php

namespace app\common\validate;


use think\Validate;


class Admin extends Validate
{
    protected $rule=[
        'username|管理员账号'=>'require|unique:admin',
        'password|管理员密码'=>'require',
        'conpass|确认密码'=>'require|confirm:password',
        'nickname|管理员昵称'=>'require',
        'email|管理员邮箱'=>'require|email',
        'status|管理员状态'=>'require'
    ];

    //管理员注册
    public function sceneRegister(){
        return $this->only(['username','password','conpass','nickname','email'])
            ->append('email','unique:admin');


    }

    //找回密码
    public function sceneForget(){
        return $this->only(['email']);
    }

    //重置密码
    public function sceneReset(){
        return $this->only(['email']);
    }

    //管理员注册dd
    public function sceneAdd(){
        return $this->only(['username','password','conpass','nickname','email'])
        ->append('email','unique:admin');

    }

    //管理员编辑
    public function sceneEdit(){
        return $this->only(['oldpassword','newpassword','nickname']);
    }
    //管理员状态修改
    public function sceneStatus(){
        return $this->only(['status']);
    }

}