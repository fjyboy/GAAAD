<?php
/**
 * Create Time: 2021/3/23 14:20
 * Author:Liu Jiabing.
 * Email:531288693@qq.com
 */

namespace app\common\validate;


use think\Validate;

class Comment extends Validate
{

    protected $rule=[
        'content|文章内容' => 'require'
    ];




}