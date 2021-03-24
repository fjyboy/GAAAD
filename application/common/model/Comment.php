<?php
/**
 * Create Time: 2021/3/22 16:29
 * Author:Liu Jiabing.
 * Email:531288693@qq.com
 */

namespace app\common\model;


use think\Model;

class Comment extends Model
{
    public function article(){
        return $this->belongsTo('Article','article_id','id');
    }


    public function member(){
        return $this->belongsTo('Member','member_id','id');
    }

    public function comm($data){
        $validate=new \app\common\validate\Comment();
        if(!$validate->scene('comm')->check($data)){
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if($result){
            return 1;
        }else{
            return '评论失败';
        }
    }
}