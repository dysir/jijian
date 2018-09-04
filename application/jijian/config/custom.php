<?php

if(defined('CONFIGPATH'))
{
    if(file_exists(CONFIGPATH."/custom.php") )
    {
        include CONFIGPATH."/custom.php";
    }
}
if(ENVIRONMENT == "production")
{
	$config['menu_config'] = array(
		array(
			'url'=>"/",
			'name'=>"推荐阅读"
		),
	);


}else{
	$config['menu_config'] = array(
		array(
			'url'=>"/",
			'name'=>"推荐阅读"
		),
		// array(
		// 	'url'=>"http://note.bd.com",
		// 	'name'=>"学习笔记"
		// ),
		// array(
		// 	'name'=>'开源项目',
		// 	'list'=>array(
		// 		array(
		// 			'url'=>"http://note.bd.com/admin/",
		// 			'name'=>"后台管理系统_文档",
		// 			'property'=>"target='_blank'"
		// 		),
		// 		array(
		// 			'url'=>"http://super.bd.com/",
		// 			'name'=>"后台管理系统_测试地址",
		// 			'property'=>"target='_blank'"
		// 		),
		// 	)
		// ),
		// array(
		// 	'url'=>"http://ouapi.com",
		// 	'name'=>"实用工具"
		// ),
	);
	// $config['article_url'] = "http://zhaike.bd.com";
	// $config['note_url'] = "http://note.bd.com";
}
$config['version_number'] = 'dev';
//站名
$config['title'] = "编程笔记";

$config['seo'] = array(
		'default'=>array(
				'keywords'=>"编程,文章,教程,分享,编程,笔记,手册,IT,资讯",
				'description'=>"最简单最容易理解的编程教程，编程技术文章分享，IT资讯"
			),
		//控制器
		'home'=>array(
				//方法名或自定义
				'index'=>array(
						'keywords'=>"编程,文章,分享,IT,资讯",
						'description'=>"编程技术文章分享，IT资讯"
					)
			),	
	);
//所有数据缓存key 不包括模板缓存
$config['cache_key'] = array(
		'article_key'=>'json_article',
		'temp_key'=>'json_temp',
		'topic_key'=>"json_topic",
		'article_topic_key'=>"json_article_topic",
		'note_key'=>"json_note",
	);

$config['cache_key_time'] = 1800;//秒