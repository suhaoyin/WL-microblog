<?php
/* Smarty version 3.1.30, created on 2017-07-26 03:11:09
  from "E:\wamp\wamp64\www\Internship\7-21\Restructure\view\weibo.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5978084d08ff92_01646338',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '300016547f367101aa8857d21eae1c0282f2efab' => 
    array (
      0 => 'E:\\wamp\\wamp64\\www\\Internship\\7-21\\Restructure\\view\\weibo.html',
      1 => 1501038445,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5978084d08ff92_01646338 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>WeiBo</title>
	<!-- jquery -->
	<?php echo '<script'; ?>
 type="text/javascript" src="public/jquery-1.11.1.min.js"><?php echo '</script'; ?>
>
	<link rel="stylesheet" type="text/css" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/weibo.css">
	<link rel="stylesheet" type="text/css" href="public/css/animate.css">
	<?php echo '<script'; ?>
 type="text/javascript" src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"><?php echo '</script'; ?>
>
</head>
<body>
	<div id="box">
		<header>
			<div class="headerContent container-fluid">
				<div class="headerLogo col-xs-4">
					<a href="#"></a>
				</div>
				<ul class="col-xs-8">
					<li class="col-xs-2">首页</li>
					<li class="col-xs-2">浏览</li>
					<li class="col-xs-2">APP</li>
					<li class="col-xs-2">ART</li>
					<li class="col-xs-2">
						<a href="#login" data-toggle="modal">
							登录
						</a>
					</li>
					<li class="col-xs-2">
						<a href="#register" data-toggle="modal">
							注册
						</a>
					</li>
					
				</ul>
			</div>
		</header>	
		<div class="container">
			<div class="col-xs-8 container-left">
				<div class="row menu_box">
					<div class="portrait_box col-xs-3">
						<img class="portrait" src="<?php echo $_smarty_tpl->tpl_vars['headPic']->value;?>
" alt="">
					</div>
					<div class="col-xs-2 menu_tab">
						<a href="#tab1" data-toggle="tab">
							<span class="glyphicon glyphicon-pencil"></span>
							文字
						</a>
					</div>
					<div class="col-xs-2 menu_tab">
						<a href="#tab2" data-toggle="tab">
							<span class="glyphicon glyphicon-heart"></span>
							图文
						</a>
					</div>
					<div class="col-xs-2 menu_tab">
						<a href="#tab3" data-toggle="tab">
						<span class="glyphicon glyphicon-music"></span>
						音乐</a>
					</div>
					<div class="col-xs-2 menu_tab">
						<a href="#tab4" data-toggle="tab">
							<span class="glyphicon glyphicon-film"></span>
							视频
						</a>
					</div>
				</div>
				<form action="post_do.php" method="post">
					<!-- bootstrap定义面板内容盒子的类 tab-content -->
					<div class="tab-content">
						<!-- 第一个面板是放文字发布框 -->
						<!-- bootstrap定义选项卡内容盒子，具体的一个切换框的类是 tab-pane (panel) 
						tab-pane 特点一：默认都是隐藏的，然后需要显示则加上active类即可
								特点二：可以加动画，都加上fade类，然后给当前面板需加上in类
					-->
						<div class="tab-pane fade in active" id="tab1">
							<textarea name="weibo_content" id="short_content" class="form-control" ></textarea>
						</div>
						<!-- 第二个面板是放图文发布框 -->
						<div class="tab-pane fade" id="tab2">
							<textarea name="weibo_content" id="pic_text" class="form-control" ></textarea>
							<div class="file_style_div btn btn-info" >
							<input type="file" id="pic_file" class="file_style">选择图片
							</div>
						</div>
						
						<div class="tab-pane fade" id="tab3">
							<!--歌曲搜索框，keyup触发  -->
							<input type="text" class="form-control" onkeyup="searchMusic(this)" placeholder="请用歌名、专辑或艺术家搜索！">
							<ul class="music_list_box"></ul>
							<div class="music_preview_box"></div>	
							<div class="file_style_div btn btn-info" >
								<input type="file" id="music_file" class="file_style">
								选择本地音乐
							</div>
						</div>
						<div class="tab-pane fade" id="tab4">
							<div class="file_style_div btn btn-info" >
							<input type="file" id="video_file" class="file_style">选择视频
							</div>
						</div>
					</div>
					<input type="hidden" id="type" value="short_content">
					<input type="button" class="btn btn-info pull-right mt_20" value="发布" onclick="submit_weibo()">
				</form>
				<div class="clearfix"></div>
				<!-- 动态列表盒子start -->
				<div class="row">
					<div>
					
						<!-- 动态列表布局：
					获取已经存在的微博内容，把它们列出来
					-->
						<ul  class="list_box mt_20">
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['weibo_list']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
							<li class="clearfix">
								<div class="col-xs-2">
									<div class="img-frame hide_box">
										<div class="img-fram-top">
											<img src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value['userHeadPic'])===null||$tmp==='' ? '/Internship/7-21/smarty/public/img/6632234347536656356.jpg' : $tmp);?>
" alt="">
											<?php echo $_smarty_tpl->tpl_vars['item']->value['weibo_num'];?>

										</div>
										<div class="img-fram-mid"></div>
									</div>
									<img class="headLogo" src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value['userHeadPic'])===null||$tmp==='' ? '/Internship/7-21/smarty/public/img/6632234347536656356.jpg' : $tmp);?>
" alt="">
								</div>
								<div class="sanjiao_box"></div>
									<div class="col-xs-10 content_box">
										
										<?php if ($_smarty_tpl->tpl_vars['item']->value['type'] == 'short_content') {?>
										<div class="content_box_text">
											<?php echo $_smarty_tpl->tpl_vars['item']->value['weibo_content'];?>

										</div>
											<?php } elseif ($_smarty_tpl->tpl_vars['item']->value['type'] == 'music') {?>
												<audio src="<?php echo $_smarty_tpl->tpl_vars['item']->value['music'];?>
" controls></audio>
												<?php } elseif ($_smarty_tpl->tpl_vars['item']->value['type'] == 'pic_text') {?>
												<div class="content_box_text">
													<?php echo $_smarty_tpl->tpl_vars['item']->value['weibo_content'];?>

												</div>
												<img class="content_box_img" src="<?php echo $_smarty_tpl->tpl_vars['item']->value['pic'];?>
" alt="">
													<?php } else { ?>
													<video style="width:100%" src="<?php echo $_smarty_tpl->tpl_vars['item']->value['video'];?>
" controls></video>
										<?php }?>	
									</div>
							</li>
									<div id="comment_box">
										<div class="mananga_box">
											<?php if ($_smarty_tpl->tpl_vars['uid']->value == $_smarty_tpl->tpl_vars['item']->value['uid']) {?>	
											<a href="#edit_box" data-toggle="modal" data-weiboType="<?php echo $_smarty_tpl->tpl_vars['item']->value['type'];?>
"data-music="<?php echo $_smarty_tpl->tpl_vars['item']->value['music'];?>
"data-video="<?php echo $_smarty_tpl->tpl_vars['item']->value['video'];?>
"data-pic="<?php echo $_smarty_tpl->tpl_vars['item']->value['pic'];?>
" data-shortContent="<?php echo $_smarty_tpl->tpl_vars['item']->value['weibo_content'];?>
" class="edit_weibo">编辑</a>
											<a href="#modal_box" data-toggle="modal" class="del_weibo">删除</a>
											<?php }?>
											<a class="commont_btn" data-num="<?php echo $_smarty_tpl->tpl_vars['item']->value['num'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">评论(<span class="num_val_box"><?php echo $_smarty_tpl->tpl_vars['item']->value['num'];?>
</span>)</a>
											
										</div>
										<div class="commont_form_box hide_box">
											<textarea name=""  class="commont_texarea"  style="width:100%"></textarea>
											<input type="button" class="btn btn-default send_commont" data-id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" value="发布评论">
											<ul class="commont_list">
											
											</ul>
										</div>
									</div>
							<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

						</ul>
					</div>
				</div>
			</div>
			<div class="col-xs-4 container-right">
				<dl class="login-info">
					<dt>
						<?php if ($_smarty_tpl->tpl_vars['user_name']->value) {?>
						<b>
							Hello,<?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
!
						</b>
						<?php } else { ?>
						<b>登陆有惊喜哟！</b>
						<?php }?>
					</dt>  
					<dd>
						<a href="#upLoadHeadpic" data-toggle="modal">
							设置头像
						</a>
					</dd>
					<dd onclick="loginOut()">退出</dd>
				</dl>
			</div>
			

			
			<!-- 动态列表盒子end -->
		</div>
		<!--编辑模态框  -->
		<div class="modal fade" id="edit_box">
			<div class="modal-dialog">
				<div class="modal-content">
					<!-- 顶部 -->
					<div class="modal-header">
						编辑
					</div>
					<div class="modal-body">
						<div  class="form-group">
							
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-info" onclick="submitEditWeiBo()">
							提交
						</button>
						<button class="btn btn-default" data-dismiss="modal">
							取消
						</button>
						
					</div>
				</div>
			</div>		
		</div>
			<!-- 删除模态框模态框 -->
		<div class="modal fade" id="modal_box">
			<div class="modal-dialog">
				<div class="modal-content">
					<!-- 顶部 -->
					<div class="modal-header">删除信息</div>
					<!-- body -->
					<div class="modal-body">确定删除这条信息吗？</div>
					<!-- 底部 -->
					<div class="modal-footer">
						<button class="btn btn-info" onclick="deleteWeiBO()">确定</button>
						<button class="btn btn-default" data-dismiss="modal">取消</button>
					</div>
				</div>
			</div>
		</div>
		<!--注册模态框  -->
		<div class="modal fade" id="register">
			<div class="modal-dialog">
				<div class="modal-content">
					<!-- 顶部 -->
					<div class="modal-header">
						欢迎注册
					</div>
					<div class="modal-body">
						<div  class="form-group">
							<label for="ruser_name">Telphone</label>
							<input type="text" id="ruser_name" class="form-control" placeholder="请输入手机号码">
							<label for="ruser_pwd">Password</label>
							<input type="text" id="ruser_pwd" class="form-control" placeholder="请输入密码">
							<label for="ruser_pwdagain">Again</label>
							<input type="text" id="ruser_pwdagain" class="form-control" placeholder="请再次输入密码">
						</div>
						
					</div>
					<div class="modal-footer">
						<button class="btn btn-info" onclick="register()">
							注册
						</button>
						<button class="btn btn-default" data-dismiss="modal">
							取消
						</button>
						
					</div>
				</div>
			</div>		
		</div>
		<!--登录模态框  -->
		<div class="modal fade" id="login">
			<div class="modal-dialog">
				<div class="modal-content">
				<!-- 顶部 -->
					<div class="modal-header">
						欢迎登录
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="luser_name">Telphone</label>
							<input type="text" id="luser_name" class="form-control" placeholder="请输入手机号码">
							<label for="luser_pwd">Password</label>
							<input type="text" id="luser_pwd" class="form-control" placeholder="请输入密码">
						</div>
						
					</div>
					<div class="modal-footer">
						<button class="btn btn-info" onclick="login()">
							登录
						</button>
						<button class="btn btn-default" data-dismiss="modal">
							取消
						</button>
						
					</div>
				</div>
			</div>
		</div>
		<!--设置头像模态框  -->
		<div class="modal fade" id="upLoadHeadpic">
			<div class="modal-dialog">
				<div class="modal-content">
					<!-- 顶部 -->
					<div class="modal-header">
						设置头像
					</div>
					<div class="modal-body">
						<div class="file_style_div btn btn-info">
							<input type="file" id="headPic_file" class="file_style">
							选择图片
						</div>
						
					</div>
					<div class="modal-footer">
						<button class="btn btn-info" onclick="upLoadHeadpic()">
							上传
						</button>
						<button class="btn btn-default" data-dismiss="modal">
							取消
						</button>	
					</div>
				</div>
			</div>		
		</div>
	</div>
<?php echo '<script'; ?>
 type="text/javascript" src="public/js/weibo.js"><?php echo '</script'; ?>
>
			
</body>
</html><?php }
}
