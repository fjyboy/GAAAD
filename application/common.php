<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//发送邮件
function mailto($to,$title,$content){

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.qq.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '2277259173@qq.com';                     //SMTP username
        $mail->Password   = 'rwckdvolnpovebeb';                               //SMTP password
        $mail->SMTPSecure = 'ssl';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->CharSet    ='utf-8';
        //Recipients
        $mail->setFrom('2277259173@qq.com', 'fjy');
        $mail->addAddress($to);     //Add a recipient
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $title;
        $mail->Body    = $content;


         $mail->send();

    } catch (Exception $e) {
        exception($mail->ErrorInfo,1001);
    }
}

function replace($data){
    return str_replace('span','a',$data);
}

function strToArray($data){
    return explode('|',$data);
}