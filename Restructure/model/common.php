<?php

error_reporting(~E_NOTICE);
//公共函数库
// 拓展维护

// 在全局中开启会话
session_start();

/**
 * 添加微博内容的方法
 * @param array $new_content   新的微博内容
 * @param array $old_content_a 之前的微博内容
 */
function setContent($new_content,$old_content_a)
{
	$weibo_content = $new_content['weibo_content'];
	$pic = $new_content['pic'];
	$type = $new_content['type'];
	$music = $new_content['music'];
	$video = $new_content['video'];
	$userHeadPic=$new_content['userHeadPic'];
	$create_time = time();
	// uid值从session会话中获取
	$uid=(int)$_SESSION['uid'];
	$pdo_object = connect_mysql();

  	// mysql添加
  	// 添加语法：insert into 表名 (字段1,字段2,字段3) values (整型值1,'字符串1')
  	$inesrt_sql = "insert into weibo_detailed(weibo_content,pic,create_time,type,music,video,userHeadPic,uid) values('$weibo_content','$pic',$create_time,'$type','$music','$video','$userHeadPic','$uid')";

// 执行一条语句
  	$pdo_object->exec($inesrt_sql);

  	return  array(
  		'code'=>$pdo_object->errorCode(),
		'info'=> $pdo_object->errorInfo()
	);
}
 
/**
 * 获取微博内容的方法
 * @return [array] [之前的微博内容]
 */
function getContent()
{
	
	// mysql查询语法 ：select * from 表名 order by 字段  asc/desc
	// 排序 默认 asc 从小到大 升
	// 排序 默认 desc 从大到小 降
	$pdo = connect_mysql();
	// 预处理方法
	// 参数：sql语句
	// 返回值：结果集
	 
	$pstate = $pdo->prepare("select * from weibo_detailed order by id desc");
	// 预处理好的语句进行执行
	$pstate->execute();

	// 获取所有的数据
	$list_all = $pstate->fetchAll();

	// 遍历所有微博,然后一个个去评论表找
	foreach ($list_all as $key => $value) {
		// 数量查询
		// SELECT count(*) FROM `weibo_commont` WHERE `weibo_id`=50 
	 	
	 	// 修改数组增加一个键：评论的数量
	 	$list_all[$key]['num'] =getCommontCountByWid($value['id']);
		$list_all[$key]['weibo_num']=getWeiBoCount($value['uid']);
		
	}
	return 	$list_all;

}
//获得某id微博数
function getWeiBoCount($uid){
	$pdo = connect_mysql();
	// echo "SELECT count(*) num  FROM  weibo_detailed WHERE uid=$uid";
	// exit();
	$pdostate = $pdo->prepare("SELECT count(*) num  FROM  weibo_detailed WHERE uid=$uid ");
	$pdostate->execute();
	$info =  $pdostate->fetch();
	 return $info['num'];
}

/**
 * 获取微博评论数量
 * @param  int $weibo_id 微博ID
 * @return int          微博的数量
 */
function getCommontCountByWid($weibo_id){
	$pdo = connect_mysql();

	// 返回值是结果集
	$pdostate = $pdo->prepare("SELECT count(*) num  FROM  weibo_comment WHERE weibo_id=$weibo_id ");

	// 执行
	$pdostate->execute();
	$info =  $pdostate->fetch();
	 return $info['num'];
}

/**
 * 获取指定微博的评论列表
 * @param  int $weibo_id 微博ID
 * @return [type]           [description]
 */
function getCommontByWid($weibo_id)
{
	$pdo = connect_mysql();
	// 返回值是结果集
	// SELECT * FROM table1,table2 WHERE table1.id=table2.id;
	$pdostate = $pdo->prepare("select * from weibo_comment join weibo_user on uid = weibo_user.id where weibo_id=$weibo_id");
	// echo "select * from weibo_comment join weibo_user on uid = weibo_user.id where weibo_id=$weibo_id";
	// 执行
	$pdostate->execute();

	return $pdostate->fetchAll();
}

/**
 * 删除一条信息
 * @param  string $table 表名
 * @param  int $id    主键ID
 * @return int        受影响的行数
 */
function deleteInfo($table,$id)
{
	$pdo = connect_mysql();
	$uid = $_SESSION['uid'];
	// mysql删除语法
	// delete from 表名 where 列名=值 
	$delete_sql = "delete from $table where id= $id and uid=$uid";
	// echo $delete_sql;
	// $pdo-prepare()
	$pdostate= $pdo->exec($delete_sql);
	return $pdostate;
	// return $pdostate->rowCount();
}
/*
	param 表名，数据库列名及值数组
	return 
*/

function addInfo($table,$addData=array()){
	//处理$_post中多余的变量type
	unset($addData['type']);
	//实例化一个PDO对象
	$pdo = connect_mysql();
	//使用implode函数处理addData，得到需要插入到数据库表中的列名
	$col_str =  implode(',',array_keys($addData));
	//获取所有值所组成的新数组
	$val_str = '';
	$val_data =  array_values($addData);
	$comma = '';//定义逗号并赋值为空
	//进行循环拼接
	foreach ($val_data as $key => $value) {
		//判断$val_str数组中的值是string还是int，选择是否加‘’单引号
		if ( is_string( $value)) {
			//在前面值前面添加逗号进行拼接，由于$comma默认为空，所以第一次是不会有逗号
			$val_str.=$comma."'".$value."'";
		}else {
			$val_str.= $comma.$value;
		}
		$comma = ",";//在第一次循环对comma进行赋值
	}
	//执行对数据库操作语句
	// echo "insert into $table($col_str)values($val_str)";
	$pdo->exec("insert into $table($col_str)values($val_str)");
	// echo $NUM;
	//返回受影响行数的id
	// echo $pdo->lastInsertId();
	return $pdo->lastInsertId();	
}

// 匹配用户登录

function getInfo($table){
	 $pdo = connect_mysql();
	//执行对数据库操作语句
	// echo "select * form $table($col_str)values($val_str)";
	$user_name =$_POST['user_name'];
	$user_pwd = $_POST['user_pwd'];
	$pdostate=$pdo->prepare("select * from $table where user_name='$user_name'and user_pwd='$user_pwd'");
	// echo "select * from $table where user_name='$user_name'and user_pwd='$user_pwd'";
	$pdostate->execute();
	return $pdostate->fetch();	
}

//设置头像
function fitHeadPic(){
	 $pdo = connect_mysql();
	//执行对数据库操作语句
	$id =$_SESSION['uid'];
	$user_HeadPic = $_POST['headPic'];
	$pdo->exec("UPDATE weibo_detailed SET userHeadPic='$user_HeadPic' WHERE uid='$id'");
	$pdostate=$pdo->exec("UPDATE weibo_user SET user_HeadPic='$user_HeadPic' WHERE id='$id'");
	return $pdostate;
}

//删除微博
function deleteWeiBo(){
	$pdo = connect_mysql();
	$id=$_POST['id'];
	$uid = $_SESSION['uid'];
	$pdo->exec("delete from weibo_comment where weibo_id= $id");
	// 先查询，确保数据库存在该数据，并且可以删除该文件、
	$prepareState=$pdo->prepare("select pic,music,video from weibo_detailed where id= $id and uid=$uid");
	$prepareState->execute();
	$selectState = $prepareState->fetch();
	// print_r($selectState['pic']);
	// print_r($selectState['music']);
	// print_r($selectState['video']);
	// exit();
	if (!empty($selectState['pic'])) {
		unlink($selectState['pic']);	
	}elseif (!empty($selectState['video'])) {
		unlink($selectState['video']);
	}elseif(!empty($selectState['music'])){
		unlink($selectState['music']);
	};
	$delete_sql = "delete from weibo_detailed where id= $id and uid=$uid";
	// echo $delete_sql;
	// exit();
	$pdostate= $pdo->exec($delete_sql);
	return $pdostate;
}
//更新微博内容操作
function update($table,$setStr,$wheStr){
	$pdo = connect_mysql();
	// 对传过来的值，进行拼接
	$set = '';
	$whe = '';
	$comma = '';
	$Comma = '';
	foreach ($setStr as $key => $value) {
		//判断$setstr数组中的值是string还是int，选择是否加‘’单引号
		$set.=$comma.$key.'=';
		if ( is_string( $value)) {
			//在前面值前面添加逗号进行拼接，由于$comma默认为空，所以第一次是不会有逗号
			$set.="'".$value."'";
		}else {
			$set.= $value;
		}
		$comma = ",";//在第一次循环对comma进行赋值
	}
	foreach ($wheStr as $key => $value) {
		//判断$setstr数组中的值是string还是int，选择是否加‘’单引号
		$whe.=$Comma.$key.'=';
		if ( is_string( $value)) {
			//在前面值前面添加逗号进行拼接，由于$comma默认为空，所以第一次是不会有逗号
			$whe.="'".$value."'";
		}else {
			$whe.= $value;
		}
		$Comma = ",";//在第一次循环对comma进行赋值
	}
	// echo "UPDATE $table SET $set WHERE $whe";
	// exit();
	return	$pdo->exec("UPDATE $table SET $set WHERE $whe");
}

function connect_mysql()
{
	// PDO类实例化
	// 什么是类 抽象
	// 什么是对象 $pdo_object 具体
	// 数据库的类型:dbhost=数据库的地址;dbname=数据库的名称
	$dsn="mysql:dbhost=localhost;dbname=mweibo;charset=utf8";
	$db_user="root";
	$db_pwd="";
	return new PDO($dsn,$db_user,$db_pwd);
}
?>

