<?php
/**
 * Create Time: 2021/3/23 9:21
 * Author:Liu Jiabing.
 * Email:531288693@qq.com
 */

namespace app\index\controller;


use think\Controller;

class Base extends  Controller
{
    public function initialize(){
        $cates=model('Cate')->order('sort','asc')->select();
        $webInfo=model('System')->find();
        $topArticles=model('Article')->where('is_top',1)->order('create_time','desc')->limit(10)->select();
        $viewData=[
            'cates'=>$cates,
            'webInfo'=>$webInfo,
            'topArticles'=>$topArticles
        ];
        $this->view->share($viewData);
    }
}