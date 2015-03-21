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
		
);
?>