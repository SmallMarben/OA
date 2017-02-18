<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="/Public/Home/css/base.css" />
	<link rel="stylesheet" href="/Public/Home/css/info-mgt.css" />
	<link rel="stylesheet" href="/Public/Home/css/WdatePicker.css" />
	<title>移动办公自动化系统</title>
</head>

<body>
<div class="title"><h2>收件箱</h2></div>
<div class="table-operate ue-clear">
	<a href="javascript:;" class="add">添加</a>
	<a href="javascript:;" class="del">删除</a>
	<a href="javascript:;" class="edit">编辑</a>
	<a href="javascript:;" class="count">统计</a>
	<a href="javascript:;" class="check">审核</a>
</div>
<div class="table-box">
	<table>
		<thead>
		<tr>
			<th class="num">序号</th>
			<th class="name">发件人</th>
			<th class="process">主题</th>
			<th class="node">发送时间</th>
			<th class="time">附件</th>
			<th class="time">读否？</th>
			<th class="operate">操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td class="num"><?php echo ($vo["email_id"]); ?></td>
				<td class="name"><?php echo ($vo["user_name"]); ?></td>
				<td class="process"><?php echo ($vo["email_title"]); ?></td>
				<td class="node"><?php echo (date("Y-m-d",$vo["email_addtime"])); ?></td>
				<td class="time"><?php if($vo["email_file"] != ''): ?>[<a href="<?php echo U('Email/download',array('id'=>$vo['email_id']));?>">下载</a>]<?php echo ($vo["email_truename"]); endif; ?></td>
				<td class="time"><?php if($vo["is_read"] == 1): ?>已读<?php else: ?><span style="color: red;">未读</span><?php endif; ?></td>
				<td class="operate"><a href="javascript:;" data-read="<?php echo ($vo["is_read"]); ?>" data-title="<?php echo ($vo["email_title"]); ?>" data-id="<?php echo ($vo["email_id"]); ?>">查看</a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
</div>
<div class="pagination ue-clear"></div>
</body>
<script type="text/javascript" src="/Public/Home/js/jquery.js"></script>
<script type="text/javascript" src="/Public/Home/js/common.js"></script>
<script type="text/javascript" src="/Public/Home/js/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Home/js/jquery.pagination.js"></script>
<script type="text/javascript">
	$(".select-title").on("click",function(){
		$(".select-list").hide();
		$(this).siblings($(".select-list")).show();
		return false;
	})
	$(".select-list").on("click","li",function(){
		var txt = $(this).text();
		$(this).parent($(".select-list")).siblings($(".select-title")).find("span").text(txt);
	})

	$('.pagination').pagination(100,{
		callback: function(page){
			alert(page);
		},
		display_msg: true,
		setPageNo: true
	});

	$("tbody").find("tr:odd").css("backgroundColor","#eff6fa");

	showRemind('input[type=text], textarea','placeholder');
</script>
<script src="/Public/Plugin/layer/layer.js"></script>
<script>
	//查看知识内容的插件
	$('.operate a').click(function(){
		//获取标题
		var title=$(this).attr('data-title');
		var email_id=$(this).attr('data-id');
		var url="<?php echo U('Email/showEmail');?>"+"?email_id="+email_id;
		var read=$(this).attr('data-read');
		//自定页
		layer.open({
			type: 2,
			title: title,
			shadeClose: true,
			shade: false,
			maxmin: true, //开启最大化最小化按钮
			area: ['893px', '500px'],
			content: url,
			end:function() {
				if (read == 0) {
					window.location.reload();
				}
			}
		});
	})
</script>
</html>