<?php
/**
 * Create Time: 2021/3/19 17:15
 * Author:Liu Jiabing.
 * Email:531288693@qq.com
 */

namespace app\common\model;


use think\Model;

class Cate extends Model
{
    public function add($data){
        $validate=new \app\common\validate\Cate();
        if(!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $result =$this->allowField(true)->save($data);
        if($result){
            return 1;
        }else{
            return '栏目添加失败!';
        }

        return view();
    }


    public function sort($data){
        $validate=new \app\common\validate\Cate();
        if(!$validate->scene('sort')->check($data)){
            return $validate->getError();
        }

        $cateInfo =$this->find($data['id']);
        $cateInfo->sort=$data['sort'];
        $result = $cateInfo->save();
        if($result){
            return 1;
        }else{
            return '排序失败!';
        }

        return view();
    }


    public function edit($data){
        $validate=new \app\common\validate\Cate();
        if(!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $cateInfo=$this->find($data['id']);
        $cateInfo->catename=$data['catename'];
        $result = $cateInfo->save();
        if($result){
            return 1;
        }else{
            return '编辑失败';
        }
    }

    public function article(){
        return $this->hasMany('Article','cate_id','id');
    }

}