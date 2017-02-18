<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/Public/Home/css/base.css" />
	<link rel="stylesheet" href="/Public/Home/css/login.css" />
	<title>移动办公自动化系统</title>
</head>
<body>
	<div id="container">
		<div id="bd">
			<div class="login1">
                <form action="<?php echo U('loginCheck');?>" method="post">
            	<div class="login-top"><h1 class="logo"></h1></div>
                <div class="login-input">
                	<p class="user ue-clear">
                    	<label>用户名</label>
                        <input type="text" name="user_name"/>
                    </p>
                    <p class="password ue-clear">
                    	<label>密&nbsp;&nbsp;&nbsp;码</label>
                        <input type="password" name="user_pwd"/>
                    </p>
                    <p class="yzm ue-clear">
                    	<label>验证码</label>
                        <input type="text" name="yzm"/>
                        <cite><img src="<?php echo U('Public/verify');?>" width="80" height="38" style="position:relative; left:12px;" onclick="this.src='/index.php/Home/Public/verify/t/'+Math.random()"></cite>
                    </p>
                </div>
                <div class="login-btn ue-clear">
                	<a href="javascript:void(0)" class="btn mylogin">登录</a>
                    <div class="remember ue-clear">
                    	<input type="checkbox" id="remember" name="remember"/>
                        <em></em>
                        <label for="remember">记住密码</label>
                    </div>
                </div>
                </form>
            </div>

		</div>
	</div>
    <div id="ft">CopyRight&nbsp;2014&nbsp;&nbsp;版权所有&nbsp;&nbsp;uimaker.com专注于ui设计&nbsp;&nbsp;苏ICP备09003079号</div>
</body>
<script type="text/javascript" src="/Public/Home/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Home/js/common.js"></script>
<script type="text/javascript">
var height = $(window).height();
$("#container").height(height);
$("#bd").css("padding-top",height/2 - $("#bd").height()/2);

$(window).resize(function(){
	var height = $(window).height();
	$("#bd").css("padding-top",$(window).height()/2 - $("#bd").height()/2);
	$("#container").height(height);
	
});

$('#remember').focus(function(){
   $(this).blur();
});

$('#remember').click(function(e) {
	checkRemember($(this));
});

function checkRemember($this){
	if(!-[1,]){
		 if($this.prop("checked")){
			$this.parent().addClass('checked');
		}else{
			$this.parent().removeClass('checked');
		}
	}
}

//表单提交
    $(".mylogin").click(function(){
        $('form').submit();
    })
</script>
</html>