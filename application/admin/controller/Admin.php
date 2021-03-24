<?php

namespace app\admin\controller;

use think\Controller;

class Admin extends Controller
{

    public function list(){

        $admins=model('Admin')->order('create_time','desc')->paginate(4);
        $viewData=[
            'admins'=>$admins
        ];
        $this->assign($viewData);
        return view();
    }

    public function add(){
        if(request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'conpass'=>input('post.conpass'),
                'nickname'=>input('post.nickname'),
                'email'=>input('post.email')
            ];
            $result=model('Admin')->add($data);
            if($result == 1) {

                $this->success('添加成功',url('admin/admin/list'));

            }else{
                $this->error($result);
            }
        }
        return view();


    }


    //管理员编辑
    public function edit(){
        if(request()->isAjax()){
            $data=[
                'id'=>input('post.id'),
                'oldpassword'=>input('post.oldpassword'),
                'newpassword'=>input('post.newpassword'),
                'nickname'=>input('post.nickname'),
            ];
            $result=model('Admin')->edit($data);
            if($result==1){
                $this->success('编辑成功',url('admin/admin/list'));
            }else{
                $this->error($result);
            }
        }
        $adminInfo=model('Admin')->find(input('id'));
        $viewData=[
            'adminInfo'=>$adminInfo
        ];
        $this->assign($viewData);

        return view();

    }

    //管理员删除
    public function delete(){
        $adminInfo=model('Admin')->find(input('post.id'));
        $result=$adminInfo->delete();
        if($result){
            $this->success('管理员删除成功',url('admin/member/list'));
        }else{
            $this->error('管理员删除失败');
        }
    }

    //状态修改
    public function status(){

        $data=[
            'id'=>input('post.id'),
            'status'=>input('post.status')?0:1,
        ];
        $result=model('Admin')->status($data);
        if($result==1){
            $this->success('操作成功','admin/admin/list');
        }else{
            $this->error($result);
        }


    }
}
