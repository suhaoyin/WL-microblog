<?php
/* Smarty version 3.1.30, created on 2017-07-26 03:05:27
  from "E:\wamp\wamp64\www\Internship\7-21\Restructure\view\longArt.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_597806f7ab6a55_79797788',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '97007d03c9ca6190870f4e5fa44264b7a1ebfa9f' => 
    array (
      0 => 'E:\\wamp\\wamp64\\www\\Internship\\7-21\\Restructure\\view\\longArt.html',
      1 => 1501038271,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_597806f7ab6a55_79797788 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<?php echo '<script'; ?>
 src="public/js/jquery-1.11.1.min.js"><?php echo '</script'; ?>
>

</head>
<body>
	微博列表
	<form action="index.php?action=save" method="post">

		<textarea name="weibo_content" id="baiduEditor"  style="height:280px"></textarea>
		<!-- 配置文件 -->
		<input type="submit" value="发布"></form>
	<?php echo '<script'; ?>
 type="text/javascript" src="public/library/ueditor/ueditor.config.js"><?php echo '</script'; ?>
>

	<?php echo '<script'; ?>
 type="text/javascript" src="public/library/ueditor/ueditor.all.min.js"><?php echo '</script'; ?>
>

	<!-- 实例化编辑器 -->
	<?php echo '<script'; ?>
 type="text/javascript">UE.getEditor("baiduEditor")<?php echo '</script'; ?>
>

</body>
</html><?php }
}
