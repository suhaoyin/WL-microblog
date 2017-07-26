<?php
    //入口文件
    //屏蔽notice提醒
    // 引入weiboClass.php
    require_once 'init.php';
    $baseControl = new baseControl();
    //每次前端请求都会请求index.php文件，入口文件每次都会将baseControl实例化，并调用run方法
    $baseControl ->run();
?>