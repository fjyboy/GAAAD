<?php

namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{


    public function login(){
        return view();
    }

    //登录校验
    public function loginCheck(){
        $username=input('post.username');
        $password=input('post.password');

        empty($username)&&$this->error('用户名不能为空');
        empty($password)&&$this->error('密码不能为空');

        $db = model('admin');
        $result=$db->where(array('username'=>$username,'status'=>1))->find();
        $result || $this->error('该管理员账号不存在或被禁用');
        $result['password'] != $password && $this->error('用户名或密码错误');
        //更改登录ip和登录时间
        //$ip=get_client_ip();
        $db ->where(array('id'=>$result['id']))
            ->setField('update_time',time());

        $adminInfo=[
            'nickName'=>$result['nickname'],
            'rootId'=>$result['id'],
            'is_super'=>$result['is_super']
        ];

        session('adminInfo', $adminInfo);

        $this->success('登录成功', url('admin/Home/index'));
    }

    //注册界面
    public function index(){
        return view();
    }
    //注册界面
    public function register(){
        if(request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'conpass'=>input('post.conpass'),
                'nickname'=>input('post.nickname'),
                'email'=>input('post.email')
            ];
            $result=model('Admin')->register($data);
            if($result == 1) {

                $this->success('注册成功',url('admin/index/login'));

            }else{
                $this->error($result);
            }
        }
        return view();
    }
    //找回密码
    public function forget(){
        if(request()->isAjax()){
            $data=[
                'email'=>input('post.email')
            ];
            $isExist=\db('admin')->where('email',$data['email'])->find();
            $isExist|| $this->error('该邮箱不存在或未注册');

            $result=model('Admin')->forget($data);
            if($result == 1){
                $this->success('验证码发送成功');
            }else{
                $this->error('验证码发送失败');
            }
        }
        return view();
    }


    //重置密码
    public function reset(){
        if(request()->isAjax()){
            $data=[
                'code'=>input('post.code'),
                'email'=>input('post.email')
            ];
            session('code')==$data['code']|| $this->error('验证码错误');
            $result=model('Admin')->reset($data);

            if($result == 1){
                $this->success('密码重置成功，密码已发送至您的邮箱',url('admin/index/login'));
            }else{
                $this->error('密码重置失败');
            }
        }
        return view();
    }
}



