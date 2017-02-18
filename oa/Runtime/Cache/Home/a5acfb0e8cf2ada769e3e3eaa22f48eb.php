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
<div class="title"><h2>信息管理</h2></div>
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
            <th width="5%">序号</th>
            <th width="8%">发布人</th>
            <th width="18%">标题</th>
            <th width="20%">附件</th>
            <th>图片</th>
            <th width="10%">发布时间</th>
            <th width="20%">描述</th>
            <th width="10%">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($vo["kl_id"]); ?></td>
                <td><?php echo ($vo["user_name"]); ?></td>
                <td><?php echo ($vo["kl_title"]); ?></td>
                <td><?php if($vo["kl_filepath"] != ''): ?>[<a href="<?php echo U('Knowledge/download',array('id'=>$vo['kl_id']));?>">下载</a>]<?php echo ($vo["kl_truename"]); endif; ?></td>
                <td><?php if($vo["kl_pic"] != ''): ?><img src="/Public/Uploads/<?php echo (thumb($vo["kl_pic"])); ?>"><?php endif; ?></td>
                <td><?php echo (date('Y-m-d',$vo["kl_addtime"])); ?></td>
                <td><?php echo (msubstr($vo["kl_description"],0,10)); ?></td>
                <td class="read"><a href="javascript:;" data-id="<?php echo ($vo["kl_id"]); ?>" data-title="<?php echo ($vo["kl_title"]); ?>">查看</a></td>
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
    $('.read a').click(function(){
        //获取标题
        var title=$(this).attr('data-title');
        var kl_id=$(this).attr('data-id');
        var url="<?php echo U('Knowledge/showkl');?>"+"?kl_id="+kl_id;
        //自定页
        layer.open({
            type: 2,
            title: title,
            shadeClose: true,
            shade: false,
            maxmin: true, //开启最大化最小化按钮
            area: ['893px', '500px'],
            content: url
        });
    })
</script>
</html>