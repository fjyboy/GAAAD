<?php
/**
 * Create Time: 2021/3/19 17:05
 * Author:Liu Jiabing.
 * Email:531288693@qq.com
 */

namespace app\common\validate;
use think\Validate;

class Cate extends Validate
{
    protected $rule=[
        'catename|栏目名称'=>'require|unique:cate',
        'sort|排序'=>'require|number',
    ];

    public function sceneAdd(){
        return $this->only(['catename','sort']);
    }

    public function sceneSort(){
        return $this->only(['sort']);
    }

    public function sceneEdit(){
        return $this->only(['catename']);
    }
}