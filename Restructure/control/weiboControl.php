<?php
//继承pdoClass  方便执行SQL语句
class  weiboControl extends baseControl{
	//微博列表
	public function index()
	{
		// 类引入smarty
		// 全局变量,由于在index中，weiboClass.php在变量$smarty后面被引用，所以在weiboClass.php中将被视为去全局变量
        //$this->model('weibo')  引入并实例化 模型 weibo.php
        $weibo_list = $this->model('weibo')->getContent();
        // 将$weibo_list传给模版
        // echo $weibo_list;
        // exit();
        $this->assign("weibo_list",$weibo_list);
        $this->display('weibo.html');
        // 开启会话
        session_start();
        // 判断用户是否有登录
        if ($_SESSION['uid']>0) {
            //有登陆则将用户名传给模板
           $this->assign("user_name",$_SESSION['user_name']);
           $this->assign("uid",$_SESSION['uid']);
        }
        if (!empty($_SESSION['headPic'])) {
           $this->assign("headPic",$_SESSION['headPic']);
        }
        else{
           $this->assign("headPic","public/img/6632234347536656356.jpg");
        }
        //指定weibo.html为模版
        $this->display("weibo.html");
	}

	public function save()
	{
		global $pdo;

		$pdo->addInfo("weibo_detailed",array("weibo_content"=>$_POST['weibo_content']));
	}


	public function getLastInfo()
	{
		 // weibo数据库操作子类引入
		 require_once 'model/weibo.php';

		 $weibo_model = new weibo("mysql:dbhost=localhost;dbname=mweibo;charset=utf8","root","",true);

		$weibo_list=  $weibo_model->getLastInfo($_POST['uid']);
		// var_dump($weibo_list);
		echo json_encode($weibo_list);
	}
}

?>