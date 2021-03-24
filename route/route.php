<?php

//Admin默认界面
Route::group('admin',function (){

    //管理员默认登录界面
    Route::rule('/','admin/index/login','get|post');


    //管理员注册界面
    Route::rule('register','admin/index/register','get|post');
    //管理员找回密码界面
    Route::rule('forget','admin/index/forget','get|post');
    //管理员重置密码
    Route::rule('reset','admin/index/reset','post');
    //管理员主界面
    Route::rule('index','admin/home/index','get|post');
    //管理员登出
    Route::rule('loginout','admin/home/loginout','post');
    //管理员栏目列表
    Route::rule('catelist','admin/cate/list','get');
    //管理员栏目添加
    Route::rule('cateadd','admin/cate/add','get|post');
    //管理员栏目排序
    Route::rule('catesort','admin/cate/sort','get|post');
    //管理员栏目编辑
    Route::rule('cateedit/[:id]','admin/cate/edit','get|post');
    //管理员栏目删除
    Route::rule('catedelete','admin/cate/delete','get|post');

    //管理员文章添加
    Route::rule('articleadd','admin/article/add','get|post');
    //管理员文章列表
    Route::rule('articlelist','admin/article/list','get|post');
    //管理员文章列表
    Route::rule('articletop','admin/article/top','get|post');
    //管理员文章编辑
    Route::rule('articleedit/[:id]','admin/article/edit','get|post');
    //管理员文章删除
    Route::rule('articledelete','admin/article/delete','get|post');

    //管理员成员添加
    Route::rule('memberadd','admin/member/add','get|post');
    //管理员成员列表
    Route::rule('memberlist','admin/member/list','get|post');
    //管理员成员添加
    Route::rule('memberedit/[:id]','admin/member/edit','get|post');
    //管理员成员列表
    Route::rule('memberdelete','admin/member/delete','get|post');


    //管理员管理添加
    Route::rule('adminadd','admin/admin/add','get|post');
    //管理员管理列表
    Route::rule('adminlist','admin/admin/list','get|post');
    //管理员管理列表
    Route::rule('adminstatus','admin/admin/status','get|post');
    //管理员管理添加
    Route::rule('adminedit/[:id]','admin/admin/edit','get|post');
    //管理员管理列表
    Route::rule('admindelete','admin/admin/delete','get|post');



    //评论管理
    Route::rule('comment','admin/comment/list','get|post');

    //评论管理
    Route::rule('systemset','admin/system/set','get|post');
});


    Route::rule('cate/[:id]','index/index/index','get');
    Route::rule('/','index/index/index','get');
    Route::rule('article-<id>','index/article/info','get');
    Route::rule('register','index/index/register','get|post');
    Route::rule('loginCheck','index/index/loginCheck','post');
    //会员登出
    Route::rule('loginout','index/index/loginout','get|post');

    Route::rule('comm','index/article/comm','post');

    Route::rule('search/:keyword','index/index/search','get|post');
;
