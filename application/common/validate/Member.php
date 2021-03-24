<?php
/**
 * Create Time: 2021/3/22 13:57
 * Author:Liu Jiabing.
 * Email:531288693@qq.com
 */

namespace app\common\validate;


use think\Validate;

class Member extends Validate
{
    protected $rule=[
        'username|用户名'=>'require|unique:member',
        'password|会员密码'=>'require',
        'nickname|会员昵称'=>'require',
        'conpass|确认密码'=>'require|confirm:password',
        'email|会员邮箱'=>'require|email|unique:member',
        'oldpassword|旧密码'=>'require',
        'newpassword|旧密码'=>'require',
        'verify|验证码'=>'require|captcha'
    ];

    //管理员注册
    public function sceneAdd(){
        return $this->only(['username','password','nickname','email']);

    }

    //找回密码
    public function sceneEdit(){
        return $this->only(['oldpassword','newpassword','nickname']);
    }

    //注册
    public function sceneRegister(){


        return $this->only(['username','password','conpass','nickname','email','verify']);


    }


}