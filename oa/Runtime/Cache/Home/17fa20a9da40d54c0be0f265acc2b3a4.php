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
<div class="title"><h2>部门管理</h2></div>
<div class="table-operate ue-clear">
    <a href="javascript:;" class="add">添加</a>
    <a href="javascript:;" class="del">删除</a>
    <a href="javascript:;" class="edit">编辑</a>
    <a href="<?php echo U('tongji');?>" class="count">统计</a>
    <a href="javascript:;" class="check">审核</a>
</div>
<div class="table-box">
    <table>
        <thead>
        <tr>
            <th class="num">序号</th>
            <th class="name">部门</th>
            <th class="process">所属部门</th>
            <th class="node">排序</th>
            <th class="time">备注</th>
            <th class="operate">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td class="num"><?php echo ($vo["dept_id"]); ?></td>
                <td class="name" style="padding-left:<?php echo ($vo['level']*20); ?>px;"><?php echo ($vo["dept_name"]); ?></td>
                <td class="process"><?php echo ($vo["deptName"]); ?></td>
                <td class="node"><?php echo ($vo["dept_sort"]); ?></td>
                <td class="time"><?php echo (msubstr($vo["dept_remark"],0,18)); ?></td>
                <td class="operate"><a href="javascript:;" data-title="<?php echo ($vo["dept_name"]); ?>" data-parent="<?php echo ($vo["deptName"]); ?>" data-content="<?php echo ($vo["dept_remark"]); ?>">查看</a></td>
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
    //
    $('.operate a').click(function(){
        var title = $(this).attr('data-title');
        var parentName = $(this).attr('data-parent');
        var content = $(this).attr('data-content');
        var truecontent = "<p>部门名称："+title+"<br><br>上级部门："+parentName+"<br><br>"+content+"</p>";
        //自定页
        layer.open({
            type: 1,
            title:title + '详细信息',
            skin: 'layui-layer-demo', //样式类名
            closeBtn: 0, //不显示关闭按钮
            anim: 2,
            shadeClose: true, //开启遮罩关闭
            content: truecontent,
            area: ['350px', '180px']
        });
    })
</script>
</html>