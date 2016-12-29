<?php
return array(

 'DEFAULT_MODULE'     => 'Admin',
 'DEFAULT_CONTROLLER'=>'User',//默认控制器
 'URL_MODEL'				=> 1,
 'DEFAULT_ACTION'   =>  'signin',
    //'配置项'=>'配置值'
   'SHOW_PAGE_TRACE'=>false,
     /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/img',
        '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
        '__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
        
    
    // 'TMPL_ACTION_ERROR'     =>  'Public:dispatch_jump', // 默认错误跳转对应的模板文件
    // 'TMPL_ACTION_SUCCESS'   =>  'Public:dispatch_jump', // 默认成功跳转对应的模板文件
	)

	
 
);