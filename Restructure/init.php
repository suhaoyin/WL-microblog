<?php
    //初始化index，用于引入文件
    // 初始化文件的操作
    error_reporting(~E_NOTICE);

    // 引入smarty
    require_once 'core\library/smarty/Smarty.class.php';


    // 引入pdo
    require_once 'core\pdoClass.php';



    // 引入父类控制器

    require_once 'core\baseControl.php';
?>