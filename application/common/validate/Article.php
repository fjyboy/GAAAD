<?php
/**
 * Create Time: 2021/3/22 13:57
 * Author:Liu Jiabing.
 * Email:531288693@qq.com
 */

namespace app\common\validate;


use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'title|文章标题' => 'require',
        'desc|文章概要' => 'require',
        'tags|文章标签' => 'require',
        'content|文章内容' => 'require',
        'is_top|是否推荐' => 'require',
        'cate_id|所属导航id' => 'require'
    ];

    //文章添加
    public function sceneAdd()
    {
        return $this->only(['title', 'desc', 'tags', 'content', 'cate_id'])
            ->append('title','unique:article');
    }
    //文章添加
    public function sceneTop()
    {
        return $this->only(['is_top']);
    }

    public function sceneEdit()
    {
        return $this->only(['title', 'desc', 'tags', 'content', 'cate_id','is_top']);
    }


}