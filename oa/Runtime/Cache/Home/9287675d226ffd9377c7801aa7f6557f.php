<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/Home/css/base.css" />
<link rel="stylesheet" href="/Public/Home/css/info-reg.css" />
<title>移动办公自动化系统</title>
</head>

<body>
<div class="title"><h2>添加员工</h2></div>
<form action="" method="post">
	<div class="main">
	    <p class="short-input ue-clear">
	    	<label>姓名：</label>
	        <input type="text" name="user_name" placeholder="员工姓名" />
	    </p>
	    <div class="short-input select ue-clear">
	    	<label>所属部门：</label>
	        <div class="select-wrap">
	        	<select name="dept_id">
					<option value="<?php echo ($vo["dept_id"]); ?>">-请选择部门-</option>
					<?php if(is_array($dept)): $i = 0; $__LIST__ = $dept;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["dept_id"]); ?>"><?php echo ($vo["dept_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
	        </div>
	    </div>
	    <p class="short-input ue-clear">
	    	<label>性别：</label>
			<input type="radio" name="user_sex" value="男" style="float: none;" checked>男
			<input type="radio" name="user_sex" value="女" style="float: none;">女
	    </p>

		<p class="short-input ue-clear">
			<label>生日：</label>
			<input type="text" name="user_birth" id="btime" placeholder="生日" />
		</p>
		<p class="short-input ue-clear">
			<label>年龄：</label>
			<input type="text" id='age' name="user_age" placeholder="年龄" size="4"/>
		</p>
		<p class="short-input ue-clear">
			<label>电话：</label>
			<input type="text" name="user_tel" placeholder="手机" />
		</p>
		<p class="short-input ue-clear">
			<label>邮箱：</label>
			<input type="text" name="user_email" placeholder="邮箱" />
		</p>
		<p class="short-input ue-clear">
			<label>密码：</label>
			<input type="password" name="user_pwd" placeholder="登录密码" />
		</p>
		<p class="short-input ue-clear">
			<label>重复密码：</label>
			<input type="password" name="re_user_pwd" placeholder="重复登录密码" />
		</p>
	</div>
	<div class="btn ue-clear">
		<a href="javascript:;" class="confirm">确定</a>
	    <a href="javascript:;" class="clear">清空内容</a>
	</div>
</form>
</body>
<script type="text/javascript" src="/Public/Home/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Home/js/common.js"></script>
<script type="text/javascript" src="/Public/Home/js/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Plugin/laydate/laydate.js"></script>
<script>
	function getAge() {
		var birthObj = document.getElementById('btime');
		var birthDate=birthObj.value;
		var birthYear=birthDate.substr(0,4);
		var date=new Date();
		var year=date.getFullYear();
		var age=year-birthYear+1;
		var ageObj=document.getElementById('age');
		ageObj.value=age;
	}
	;!function(){
		laydate.skin('molv')
		laydate({
			elem: '#btime',
			choose: getAge
		})
	}();
</script>
<script type="text/javascript">
$(".select-title").on("click",function(){
	$(".select-list").toggle();
	return false;
});
$(".select-list").on("click","li",function(){
	var txt = $(this).text();
	$(".select-title").find("span").text(txt);
});


showRemind('input[type=text], textarea','placeholder');
//点击确定，表单提交
$('.confirm').click(function(){
	$('form').submit();
})

//点击清空内容，重置表单项
$('.clear').click(function(){
	//reset为js的方法不是 所以得把jquery对象转换为js对象
	$('form')[0].reset();
})
</script>
</html>