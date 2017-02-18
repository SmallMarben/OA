<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/Public/Home/css/base.css" />
<link rel="stylesheet" href="/Public/Home/css/info-reg.css" />
<title>移动办公自动化系统</title>
</head>

<body>
<div class="title"><h2>写信</h2></div>
<form action="" method="post" enctype="multipart/form-data">
	<div class="main">
	    <p class="short-input ue-clear">
	    	<label>标题：</label>
	        <input type="text" name="email_title" placeholder="标题" />
	    </p>
	    <div class="short-input select ue-clear">
	    	<label>收件人：</label>
			<div class="select-wrap">
				<select id="dept" name="dept_id">
					<option value="0">-请选择部门-</option>
					<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["dept_id"]); ?>" style="padding-left: <?php echo ($vo[level]*15); ?>px;"><?php echo ($vo["dept_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</div>
			<div class="select-wrap">
				<select id="user" name="receive_id">
					<option value="0">-请选择员工-</option>
				</select>
			</div>
	    </div>

	    <p class="short-input ue-clear">
	    	<label>附件：</label>
	        <input type="file" name="email_file"  />
	    </p>
	    <p class="short-input ue-clear">
	    	<label>内容：</label>
	        <textarea placeholder="备注" name="email_content"></textarea>
	    </p>
	</div>
	<div class="btn ue-clear">
		<a href="javascript:;" class="confirm">发送</a>
	    <a href="javascript:;" class="clear">清空内容</a>
	</div>
</form>
</body>
<script type="text/javascript" src="/Public/Home/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Home/js/common.js"></script>
<script type="text/javascript" src="/Public/Home/js/WdatePicker.js"></script>
<script type="text/javascript">
	//ajax请求部门下的员工
	$(function(){
		//表示页面中的dom节点加载完毕,要执行的代码
		//为dept绑定切换事件
		$('#dept').change(function(){
			//获取当前部门的dept_id
			//表示当前绑定事件的对象
			var dept_id=$(this).val();//实际上就是找到当前部门的dept_id
			//发送ajax请求
			var url="<?php echo U('Email/ajax_get_user');?>";
			$.get(url,{did:dept_id},function(data){
				var str='<option value="0">-请选择员工-</option>';
				for(var i=0;i<data.length;i++){
					str+='<option value="'+data[i].user_id+'">'+data[i].user_name+'</option>';
				}
				$('#user').html(str);
			},'json');

		})
	})




	//end
$(".select-title").on("click",function(){
	$(".select-list").toggle();
	return false;
});
$(".select-list").on("click","li",function(){
	var txt = $(this).text();
	$(".select-title").find("span").text(txt);
});
//点击确定，表单提交
$('.confirm').click(function(){
	$('form').submit();
})

//点击清空内容，重置表单项
$('.clear').click(function(){
	//reset为js的方法不是 所以得把jquery对象转换为js对象
	$('form')[0].reset();
})

showRemind('input[type=text], textarea','placeholder');
</script>
</html>