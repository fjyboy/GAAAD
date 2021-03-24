<?php
/**
 * Create Time: 2021/3/22 9:13
 * Author:Liu Jiabing.
 * Email:531288693@qq.com
 */

namespace app\common\model;
use think\Model;

class Article extends Model
{

    public function add($data){
        $validate=new \app\common\validate\Article();
        if(!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $result=$this->allowField(true)->save($data);
        if($result){
            return 1;
        }else{
            return '文章添加失败!';
        }
    }

    public function top($data){
        $validate=new \app\common\validate\Article();
        if(!$validate->scene('top')->check($data)){
            return $validate->getError();
        }
        $articleInfo=$this->find($data['id']);
        $articleInfo->is_top=$data['is_top'];
        $result=$articleInfo->save();

        if($result){
            return 1;
        }else{
            return '文章推荐失败!';
        }
    }


    public function edit($data){
        $validate=new \app\common\validate\Article();
        if(!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $articleInfo=$this->find($data['id']);
        $articleInfo->title=$data['title'];
        $articleInfo->tags=$data['tags'];
        $articleInfo->is_top=$data['is_top'];
        $articleInfo->desc=$data['desc'];
        $articleInfo->cate_id=$data['cate_id'];
        $articleInfo->content=$data['content'];
        $result = $articleInfo->save();
        if($result){
            return 1;
        }else{
            return '编辑失败';
        }
    }



    //栏目关联
    public function cate(){
       return $this->belongsTo('Cate','cate_id','id');
    }

    //栏目关联
    public function comments(){
        return $this->hasMany('Comment','article_id','id');
    }
}