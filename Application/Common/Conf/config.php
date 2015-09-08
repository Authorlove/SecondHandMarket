<?php
return array(
	//'配置项'=>'配置值'
	/* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'secondhand',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'   			=> '3306', // 端口

    "UPLOAD_GOODS_PICS_CONFIG"           => array(
    	'maxSize' => 3145728, 
		'rootPath' => './Public/',
		'savePath' => './Uploads/',
		'saveName' => array('uniqid',''),
		'exts' => array('jpg','gif','png','jpeg'),
		'autoSub' => true,
		'subName' => "user".$_SESSION["uid"]."_goods",
    	),
    // "BIG_PIC_SIZE" => 500,
    "THUMB_PIC_WIDTH" => 250,
    "THUMB_PIC_HEIGHT" => 190,  
    "PIC_PATH_PREFIX"  =>  '/Public/Uploads/',

     "UPLOAD_USER_PICS_CONFIG" => array(
        'maxSize' => 3145728, 
        'rootPath' => './Public/',
        'savePath' => './Uploads/',
        'saveName' => array('uniqid',''),
        'exts' => array('jpg','gif','png','jpeg'),
        'autoSub' => true,
        'subName' => "user".$_SESSION["uid"]."_head",
        ),
    // "BIG_PIC_SIZE" => 500,
    "THUMB_USER_PIC_WIDTH" => 100,
    "THUMB_USER_PIC_HEIGHT" => 100,  
);