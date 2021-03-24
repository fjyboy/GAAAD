<?php

namespace app\admin\controller;

use think\Controller;

class System extends Controller
{
    public function set(){

        if(request()->isAjax()){
            $data=[
                'id'=>input('post.id'),
                'webname'=>input('post.webname'),
                'copyright'=>input('post.copyright'),

            ];
            $result=model('System')->set($data);
            if($result == 1) {
                $this->success('更新成功',url('admin/home/index'));
            }else{
                $this->error($result);
            }
        }
        $webInto=model('System')->find();
        $viewData=[
          "webInfo"=>$webInto
        ];
        $this->assign($viewData);
        return view();
    }
}
