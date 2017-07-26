<?php 
// 微博操作数据库的类

// 子类
// 继承 extends
// 特点：1、继承的父类也会自动执行构造函数
// 		2、无需再写这一个相同类集合的方法
//  注意：由于weibo类继承了PdoClass，继承也会触发构造函数，所以在weibo类进行实例化时，
//        也需要输入父类pdoClass中构造函数的参数
class  weibo  extends pdoClass { //在入口文件中，就已经引入init初始化文件，所以在使用所有的子类时，均可以直接继承父类

        /**
    * 获取微博内容的方法
    * @return [array] [之前的微博内容]
    */
    function getContent()
    {
        // mysql查询语法 ：select * from 表名 order by 字段  asc/desc
        // 排序 默认 asc 从小到大 升
        // 排序 默认 desc 从大到小 降
        // 预处理方法
        // 参数：sql语句
        // 返回值：结果集
        $list_all=$this->select("select * from weibo_detailed order by id desc");
        // 遍历所有微博,然后一个个去评论表找
        foreach ($list_all as $key => $value) {
            // 数量查询
            // SELECT count(*) FROM `weibo_commont` WHERE `weibo_id`=50 
            
            // 修改数组增加一个键：评论的数量
            $list_all[$key]['num'] =$this->getCommontCountByWid($value['id']);
            $list_all[$key]['weibo_num']=$this->getWeiBoCount($value['uid']);
            
        }
        return 	$list_all;

    }

    //获得某id微博数
    function getWeiBoCount($uid){
        // echo "SELECT count(*) num  FROM  weibo_detailed WHERE uid=$uid";
        // exit();
        $this->find("SELECT count(*) num  FROM  weibo_detailed WHERE uid=$uid ");
        return $info['num'];
    }


        /**
    * 获取微博评论数量
    * @param  int $weibo_id 微博ID
    * @return int          微博的数量
    */
    function getCommontCountByWid($weibo_id){
        // 返回值是结果集
        $this->select("SELECT count(*) num  FROM  weibo_comment WHERE weibo_id=$weibo_id ");
        return $info['num'];
    }

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


    //获得最新三条微博
    public function getLastInfo($uid)
    {
        $sql ="select * from weibo_detailed where uid=$uid order by id desc  limit 3";
        return $this->select($sql); 
    }

}


?>