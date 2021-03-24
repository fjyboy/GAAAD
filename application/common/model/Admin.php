<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;


class Admin extends Model
{
    protected $readonly = ['email'];


    public function register($data)
    {
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('register')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            mailto($data['email'], '注册管理员成功', '您的账号为'.$data['username'].'<br>您的密码为'.$data['password'].'<br>请注意保管！');
            return 1;
        } else {
            return '注册失败';
        }
    }


    public function forget($data)
    {
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('forget')->check($data)) {
            return $validate->getError();
        }

        $code = mt_rand(1000, 9999);
        session('code', $code);

        mailto($data['email'], '找回密码验证码', '您好，您的验证码为' . $code.'<br>请及时输入');
        return 1;

    }

    public function reset($data)
    {
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('reset')->check($data)) {
            return $validate->getError();
        }

        $password = mt_rand(000000, 999999);

        $admininfo = $this->where('email', $data['email'])->find();

        $admininfo->password = $password;
        $result = $admininfo->save();

        $content = '恭喜您,您的密码重置成功<br>用户名:' . $admininfo['username'] . '您好<br>您的密码已重新生成为' . $password;
        mailto($data['email'], '重置密码成功', $content);
        return 1;

    }

    public function add($data)
    {
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('add')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            mailto($data['email'], '添加成功', '添加成功啦');
            return 1;
        } else {
            return '管理员添加失败';
        }
    }

    //管理员状态修改
    public function status($data)
    {
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('status')->check($data)) {
            return $validate->getError();
        }
        $adminInfo = $this->find($data['id']);
        $adminInfo->status = $data['status'];
        $result = $adminInfo->save();

        if ($result) {
            return 1;
        } else {
            return '管理员状态修改失败!';
        }
    }

    public function edit($data){
        $validate=new \app\common\validate\Admin();
        if(!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $adminInfo=$this->find($data['id']);
        if($data['oldpassword']!=$adminInfo['password']){
            return '原密码不正确';
        }

        $adminInfo->password=$data['newpassword'];
        $adminInfo->nickname=$data['nickname'];
        $result = $adminInfo->save();
        if($result){
            return 1;
        }else{
            return '编辑失败';
        }
    }
}
