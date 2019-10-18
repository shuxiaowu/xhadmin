<?php

return [
	'nocheck'			=> ['/admin/Login/verify','/admin/Login/index','/admin/Index/index','/admin/Index/main','/admin/Login/out','/admin/Upload/editorupload','/admin/Upload/uploadImages','/admin/FormData/index','/admin/FormData/add','/admin/FormData/update','/admin/FormData/delete','/admin/FormData/view','/admin/Content/getextends'], //不进行校验权限的地址
	'backupDir'			=> './backup',  //数据库备份文件位置
	'upload_dir'		=> '/uploads',  //上传文件路径后面不用加反斜杠
	'content_menu_status' => true,   //文章管理左侧菜单默认展开状态 true 展开 false 不展开
];
