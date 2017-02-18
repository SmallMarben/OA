<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/Public/Home/css/base.css" />
  <link rel="stylesheet" type="text/css" href="/Public/Home/css/jquery.dialog.css" />
  <link rel="stylesheet" href="/Public/Home/css/index.css" />
  <title>移动办公自动化系统</title>
</head>

<body>
<div id="container">
  <div id="hd">
    <div class="hd-wrap ue-clear">
      <div class="top-light"></div>
      <h1 class="logo"></h1>
      <div class="login-info ue-clear">
        <div class="welcome ue-clear"><?php if(empty($_SESSION['user'])): ?><a href="<?php echo U('Login/login');?>" class="user-name">请登录</a><?php else: ?><a href="javascript:;" class="user-name"><?php echo ($_SESSION['user']['user_name']); ?></a><?php endif; ?></div>
        <div class="login-msg ue-clear"> <a href="<?php echo U('Email/receive');?>" class="msg-txt" target="content">消息</a> <a href="<?php echo U('Email/receive');?>" class="msg-num" target="content">0</a> </div>
      </div>
      <div class="toolbar ue-clear"> <a href="<?php echo U(Index/index);?>" class="home-btn">首页</a> <a href="javascript:;" class="quit-btn exit"></a> </div>
    </div>
  </div>
  <div id="bd">
    <div class="wrap ue-clear">l
      <div class="sidebar">
        <h2 class="sidebar-header">
          <p>功能导航</p>
        </h2>
        <ul class="nav">
          <li class="office current">
            <div class="nav-header"><a href="javascript:;" date-src="home.html" class="ue-clear"><span>日常办公</span><i class="icon"></i></a></div>
          </li>
          <li class="gongwen">
            <div class="nav-header"><a href="javascript:;" class="ue-clear"><span>公文管理</span><i class="icon"></i></a></div>
            <ul class="subnav">
              <li><a href="javascript:;" date-src="<?php echo U('Doc/index');?>">公文管理</a></li>
              <li><a href="javascript:;" date-src="<?php echo U('Doc/add');?>">添加公文</a></li>
            </ul>
          </li>
          <li class="nav-info">
            <div class="nav-header"><a href="javascript:;" class="ue-clear"><span>员工管理</span><i class="icon"></i></a></div>
            <ul class="subnav">
              <li><a href="javascript:;" date-src="<?php echo U('User/index');?>">员工管理</a></li>
              <li><a href="javascript:;" date-src="<?php echo U('User/add');?>">添加员工</a></li>
            </ul>
          </li>
          <li class="konwledge">
            <div class="nav-header"><a href="javascript:;" class="ue-clear"><span>知识管理</span><i class="icon"></i></a></div>
            <ul class="subnav">
              <li><a href="javascript:;" date-src="<?php echo U('knowledge/index');?>">知识列表</a></li>
              <li><a href="javascript:;" date-src="<?php echo U('knowledge/add');?>">添加知识</a></li>
            </ul>
          </li>
          <li class="agency">
            <div class="nav-header"><a href="javascript:;" class="ue-clear"><span>部门管理</span><i class="icon"></i></a></div>
            <ul class="subnav">
              <li><a href="javascript:;" date-src="<?php echo U('Dept/index');?>">部门管理</a></li>
              <li><a href="javascript:;" date-src="<?php echo U('Dept/add');?>">添加部门</a></li>
            </ul>
          </li>
          <li class="email">
            <div class="nav-header"><a href="javascript:;" class="ue-clear"><span>邮件管理</span><i class="icon"></i></a></div>
            <ul class="subnav">
              <li><a href="javascript:;" date-src="<?php echo U('Email/add');?>">写信</a></li>
              <li><a href="javascript:;" date-src="<?php echo U('Email/send');?>">发件箱</a></li>
              <li><a href="javascript:;" date-src="<?php echo U('Email/receive');?>">收件箱</a></li>
            </ul>
          </li>
          <li class="system">
            <div class="nav-header"><a href="javascript:;" class="ue-clear"><span>系统管理</span><i class="icon"></i></a></div>
          </li>
        </ul>
      </div>
      <div class="content">
        <iframe name="content" src="/index.php/Home/Index/home" id="iframe" width="100%" height="100%" frameborder="0"></iframe>
      </div>
    </div>
  </div>
  <div id="ft" class="ue-clear">
    <div class="ft-left"> <span>中国移动</span> <em>Office&nbsp;System</em> </div>
    <div class="ft-right"> <span>Automation</span> <em>V2.0&nbsp;2014</em> </div>
  </div>
</div>
<div class="exitDialog">
  <div class="dialog-content">
    <div class="ui-dialog-icon"></div>
    <div class="ui-dialog-text">
      <p class="dialog-content">你确定要退出系统？</p>
      <p class="tips">如果是请点击“确定”，否则点“取消”</p>
      <div class="buttons">
        <input type="button" class="button long2 ok" value="确定" />
        <input type="button" class="button long2 normal" value="取消" />
      </div>
    </div>
  </div>
</div>
</body>
<script type="text/javascript" src="/Public/Home/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Home/js/common.js"></script>
<script type="text/javascript" src="/Public/Home/js/core.js"></script>
<script type="text/javascript" src="/Public/Home/js/jquery.dialog.js"></script>
<script type="text/javascript" src="/Public/Home/js/index.js"></script>
<script>
  function getEmail() {
    $.get("<?php echo U('Email/checkEmail');?>",{},function(data){
       $('.msg-num').text(data);
    },'text');
  }

 /* $(function(){
    getEmail();
  })*/
  setInterval('getEmail()',1000);

  $('.exitDialog input[type=button]').click(function(e) {
    $('.exitDialog').Dialog('close');

    if($(this).hasClass('ok')){
      window.location.href = "<?php echo U('Login/logout');?>";
    }
  });
</script>
</html>