<?php

namespace app\admin\controller;

use think\Controller;

class Member extends Controller
{
    public function list(){

        $members=model('Member')->order('create_time','desc')->paginate(5);
        $viewData=[
            'members'=>$members
        ];
        $this->assign($viewData);
        return view();
    }

    public function add(){
        if(request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'nickname'=>input('post.nickname'),
                'email'=>input('post.email')
            ];
            $result=model('Member')->add($data);
            if($result == 1) {

                $this->success('添加成功',url('admin/member/list'));

            }else{
                $this->error($result);
            }
        }
        return view();


    }


    //会员编辑
    public function edit(){
        if(request()->isAjax()){
            $data=[
                'id'=>input('post.id'),
                'oldpassword'=>input('post.oldpassword'),
                'newpassword'=>input('post.newpassword'),
                'nickname'=>input('post.nickname'),

            ];
            $result=model('Member')->edit($data);
            if($result==1){
                $this->success('编辑成功',url('admin/member/list'));
            }else{
                $this->error($result);
            }
        }
        $memberInfo=model('Member')->find(input('id'));
        $viewData=[
            'memberInfo'=>$memberInfo
        ];
        $this->assign($viewData);

        return view();

    }

    //会员删除
    public function delete(){
        $cateInfo=model('Member')->with('comments')->find(input('post.id'));
        $result=$cateInfo->together('comments')->delete();
        if($result){
            $this->success('会员删除成功',url('admin/member/list'));
        }else{
            $this->error('会员删除失败');
        }
    }
}
