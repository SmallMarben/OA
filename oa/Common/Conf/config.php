<?php
return array(
	//'配置项'=>'配置值'
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'oa',          // 数据库名
    'DB_USER'               =>  'secret',      // 用户名
    'DB_PWD'                =>  'secret',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'oa_',    // 数据库表前缀
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8

    //加载应用级别的自定义函数库文件 如果有多个文件 用文件名逗号隔开 文件不用带后缀
    'LOAD_EXT_FILE'=>'tree',

    // 配置文件增加设置
 'USER_AUTH_ON' => true,      //是否需要认证
 'USER_AUTH_TYPE' =>1,      //认证类型
 'USER_AUTH_KEY' => 'authId',      //认证识别号
 'REQUIRE_AUTH_MODULE' => '',       // 需要认证模块
 'NOT_AUTH_MODULE' => 'Index',    //无需认证模块
// USER_AUTH_GATEWAY 认证网关
// RBAC_DB_DSN  数据库连接DSN
 'RBAC_ROLE_TABLE' => 'oa_role',    //角色表名称
 'RBAC_USER_TABLE' => 'oa_role_user',    //用户表和角色表的关系表名称
 'RBAC_ACCESS_TABLE'=>'oa_access',    // 权限表名称
 'RBAC_NODE_TABLE' =>'oa_node',     //节点表名称
 'ADMIN_AUTH_KEY'=>'admin',
);
