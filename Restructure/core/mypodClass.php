<?php
    class pdoClass{
        //定义属性需要有修饰符  public private
        //定义link属性，在构造行数中接受new PDO 实例，以便提供给方法使用
        protected $link ;
        //
        public function __construct($dsn,$dbuser,$dbpwd)
        {
            //使用构造函数 进行数据库的连接
            try{
                $this->link = new PDO($dsn,$dbuser,$dbpwd);
            }catch(PDOException $e){
                echo $e->messages();
            }
        }
        
        //数据库操作 创建（Create）、更新（Update）、读取（Retrieve）和删除（Delete）
 /*       
        //执行一条操作
        public function exec($sql)
        {
            return $this->link->exec($sql);
        }
        //查询一条记录
        public function fetch($sql)
        {
            $pdoStatus = $this->link-prepare($sql);
            $pdoStatus->execute();
            return $pdoStatus->fetch();
        }
        //查询多条记录
        public function fetchAll($sql)
        {
            $pdoStatus = $this->link-prepare($sql);
            $pdoStatus->execute();
            return $pdoStatus->fetchAll();
        }
*/
        //对于上面的函数封装，我更加希望直接得到对数据库进行增删查改的自由方法
        //对数据库进行添加操作

        //数据库添加数据方法
        /*
            param: table 数据表 , insertStr 
        */
        public function add($table)
        {
            
        }
    }

?>