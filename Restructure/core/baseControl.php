<?php
    //baseControl作为其他控制器的父类
    //为子控制器 提供 实例化model对象方法，展示视图，为视图传输数据等方法

    //将smarty变量定义为私有，防止子类改变它
    class baseControl{
        private $smarty;

        //定义构造函数
        function __construct()
        {
            $this->smarty = new Smarty();
            //设置默认视图位置
            $this->smarty->template_dir="view";
        }

        // 为子类实例化模型对象
        public function model($model_name)
        {
            require_once "model/$model_name.php";
            return new $model_name("mysql:dbhost=localhost;dbname=mweibo;charset=utf8","root","");   
        }

        // smarty 方法
        public function display($html)
        {
            $this->smarty->display($html);
        }

        public function assign($name,$value)
        {
            $this->smarty->assign($name,$value);
        }

        // 入口文件调用
        public function run()
        {
            // 在此将control引入，从而可以直接在control中直接继承 baseControl
            // 为了可以引入不同的控制器，在前端API中，加多一个参数 control,以实现if else的效果，从而引入不同的控制器，并实例化。
            
            // 由于index.php是入口文件，当conrtol和action均没有值的时候，无法执行weiboClass中的index方法
            // 所以需要判断control是否为空，当为空时，将变量$control赋一个默认值weiboClass
            if (empty($_REQUEST['control'])) {
                $control = "weiboControl";
            }else{
                 $control = $_REQUEST['control'];
            }
            require_once "control/$control.php";
            $weibo  = new $control();
            //action参数，实现调用不同控制器中的不同方法
            if (!empty($_REQUEST['action'])) {
                $action = $_REQUEST['action'];
                $weibo ->$action();
            }else{
                // index 是显示微博主页的方法，默认显示
                $weibo ->index();
            }

        }
    }
?>