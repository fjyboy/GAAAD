<?php

namespace app\admin\controller;

use think\Controller;

class Cate extends Controller
{
    public function list(){

        $cates=model('Cate')->order('sort','asc')->paginate(5);
        $viewData=[
            'cates'=>$cates
        ];
        $this->assign($viewData);
        return view();
    }

    //栏目添加
    public function add(){
        if(request()->isAjax()){
            $data=[

                'catename'=>input('post.catename'),
                'sort'=>input('post.sort')
            ];
            $result=model('Cate')->add($data);
            if($result == 1) {

                $this->success('添加成功',url('admin/cate/list'));

            }else{
                $this->error($result);
            }
        }
        return view();

    }

    //栏目排序
    public function sort(){

        $data=[
            'id'=>input('post.id'),
            'sort'=>input('post.sort')
        ];
        $result=model('Cate')->sort($data);

        if($result == 1) {
            $this->success('排序成功',url('admin/cate/list'));
        }else{
            $this->error($result);
        }



    }

    //栏目编辑
    public function edit(){
        if(request()->isAjax()){
            $data=[
                'id'=>input('post.id'),
                'catename'=>input('post.catename')
            ];
            $result=model('Cate')->edit($data);
            if($result==1){
                $this->success('编辑成功',url('admin/cate/list'));
            }else{
                $this->error($result);
            }
        }
        $cateInfo=model('Cate')->find(input('id'));
        $viewData=[
            'cateInfo'=>$cateInfo
        ];
        $this->assign($viewData);

        return view();

    }

    //栏目编辑
    public function delete(){
        $cateInfo=model('Cate')->with('article,article.comments')->find(input('post.id'));
        foreach ($cateInfo['article']as $k=>$v){
            $v->together('comments')->delete();
        }
        $result=$cateInfo->together('article')->delete();
        if($result){
            $this->success('栏目删除成功',url('admin/cate/list'));
        }else{
            $this->error('栏目删除失败');
        }
    }


}
