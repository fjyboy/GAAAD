<?php
namespace app\index\controller;

use think\Controller;

class Index extends Base
{
    public function index()
    {
        $catename='';
        $where=[];
        if(input('?id')){
            $where=[
              'cate_id'=>input('id')
            ];
            $catename=model('Cate')->where('id',input('id'))->value('catename');
        }
        $articles=model('Article')->where($where)->order('create_time','desc')->paginate(5);

        $viewData=[
            'articles'=>$articles,
            'catename'=>$catename
        ];
        $this->assign($viewData);
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
                'email'=>input('post.email'),
                'verify'=>input('post.verify')
            ];
            $result=model('Member')->register($data);
            if($result == 1) {

                $this->success('注册成功',url('index/index/login'));

            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //登录校验
    public function loginCheck(){
        $username=input('post.username');
        $password=input('post.password');

        empty($username)&&$this->error('用户名不能为空');
        empty($password)&&$this->error('密码不能为空');

        $db = model('member');
        $result=$db->where(array('username'=>$username))->find();
        $result || $this->error('账号不存在');
        $result['password'] != $password && $this->error('用户名或密码错误');



        $memberInfo=[
            'id'=>$result['id'],
            'nickname'=>$result['nickname'],

        ];
        session('memberInfo', $memberInfo);

        unset($verify);
        $this->success('登录成功', url('index/index/index'));
    }

    public function loginout(){
        session(null);
        if(session('?$memberInfo.id')){
            $this->error('退出失败');
        }else{
            $this->success('退出成功','index/index/login');
        }
    }

    public function search(){
        $where[]=['title','like','%'.input('keyword').'%'];
        $catename=input('keyword');
        $articles=model('Article')->where($where)->order('create_time','desc')->paginate(5);
        $viewData=[
            'articles'=>$articles,
            'catename'=>$catename
        ];
        $this->assign($viewData);

        return view('index');
    }

    public function login(){
        return view();
    }
}
