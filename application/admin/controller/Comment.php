<?php

namespace app\admin\controller;

use think\Controller;

class Comment extends Controller
{
    public function list(){

        $comments=model('Comment')->with('article,member')->order('create_time','desc')->paginate(4);
        $viewData=[
            'comments'=>$comments
        ];
        $this->assign($viewData);
        return view();

    }

    //会员删除
    public function delete(){
        $commentInfo=model('Comment')->find(input('post.id'));
        $result=$commentInfo->delete();
        if($result){
            $this->success('评论删除成功',url('admin/comment/list'));
        }else{
            $this->error('评论删除失败');
        }
    }




}
