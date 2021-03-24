<?php

namespace app\admin\controller;

use think\Controller;

class Home extends Controller
{
    public function index(){



        return view();
    }

    public function loginout(){
        session(null);
        if(session('?$adminInfo.rootId')){
            $this->error('退出失败');
        }else{
            $this->success('退出成功','admin/index/login');
        }
    }
}
