<?php
/**
 * Create Time: 2021/3/22 17:01
 * Author:Liu Jiabing.
 * Email:531288693@qq.com
 */

namespace app\common\validate;


use think\Validate;

class System extends Validate
{
    protected $rule=[
        'webname|用户名'=>'require',
        'copyright|会员密码'=>'require',

    ];

}