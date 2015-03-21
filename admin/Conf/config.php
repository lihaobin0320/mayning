<?php
return array(
	//'配置项'=>'配置值'
		// 定义数据库连接信息
		'DB_TYPE'=> 'mysql', // 指定数据库是 mysql
		'DB_HOST'=> '122.0.115.14',
		'DB_NAME'=>'a0520164842', // 数据库名
		'DB_USER'=>'a0520164842',
		'DB_PWD'=>'a0520164842', //您的数据库连接密码
		'DB_PORT'=>'3306',
		
		// 定义数据库连接信息
		/* 'DB_TYPE'=> 'mysql', // 指定数据库是 mysql
		'DB_HOST'=> 'localhost',
		'DB_NAME'=>'mycms', // 数据库名
		'DB_USER'=>'mycms',
		'DB_PWD'=>'mycms', //您的数据库连接密码
		'DB_PORT'=>'3306', */
		'DB_PREFIX'=>'',//数据表前缀（与数据库myapp 中的表t_users 对应）
		'DISPATCH_ON'=> true, // 该参数设置是否启用 Dispatcher 功能。
		'URL_MODEL' => 2,
		'LOG_RECORD' => true, // 开启日志记录
		'LOG_LEVEL'  =>'EMERG,ALERT,CRIT,ERR,WARN,INFO,DEBUG', // 只记录EMERG ALERT CRIT ERR 错误
		
		//邮件配置
       'THINK_EMAIL' => array(
       'SMTP_HOST'   => 'smtp.163.com', //SMTP服务器
       'SMTP_PORT'   => '25', //SMTP服务器端口
       'SMTP_USER'   => 'xuxq131421@163.com', //SMTP服务器用户名
       'SMTP_PASS'   => 'xu198986', //SMTP服务器密码
       'FROM_EMAIL'  => 'xuxq131421@163.com', //发件人EMAIL
       'FROM_NAME'   => 'Mayning', //发件人名称
       'REPLY_EMAIL' => '', //回复EMAIL（留空则为发件人EMAIL）
       'REPLY_NAME'  => '', //回复名称（留空则为发件人名称）
    	), 
		
);
?>