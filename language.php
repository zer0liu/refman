<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
# Main menu
# 主菜单
#
$menu = array(
    'mainmenu' => array(
	    'eng' => 'Main Menu',
		'chn' => '主菜单',
	),
    'browse' => array(
	    'eng' => 'Browse',
		'chn' => '浏览',
	),
	'search' => array(
	    'eng' => 'Search',
		'chn' => '搜索',
	),
	'add' => array(
	    'eng' => 'Add',
		'chn' => '添加',
	),
	'import' => array(
	    'eng' => 'Import',
		'chn' => '导入',
	),
	'manage' => array(
		'eng' => 'Administer',
		'chn' => '管理',
	),
	'login' => array(
	    'eng' => 'Login',
		'chn' => '登录',
	),
	'logout' => array(
	    'eng' => 'Logout',
		'chn' => '注销',
	),
	'xlang' => array(
	    'chn' => 'English',
		'eng' => '中文',
	),
);
# Buttons
# 按钮
#
$button = array(
    'browse' => array(
	    'eng' => 'Browse...',
		'chn' => '浏览...',	
	),
	'reset' => array(
	    'eng' => 'Reset',
		'chn' => '重置',
	),
    'submit' => array(
	    'eng' => 'Submit',
		'chn' => '提交',
	),

);

# Page browse result info
# 结果浏览页面
#
$result_info = array(
    'total_rec' => array(
	    'eng' => 'Total: ',
		'chn' => '总记录: ',
	),
	'pages' => array(
	    'eng' => 'Page: ',
		'chn' => '页: ',
	),
	'pre' => array(
	    'eng' => 'Previous',
		'chn' => '前一页',
	),
	'next' => array(
	    'eng' => 'Next',
		'chn' => '下一页',
	),
	'front' => array(
	    'eng' => 'Front',
		'chn' => '第一页'
	),
	'end' => array(
	    'eng' => 'End',
		'chn' => '最后一页',
	),
);

# Page titles
# 页面标题
#
$page_title = array(
    'add' => array(
	    'eng' => 'Add Reference Manually',
		'chn' => '手动添加文献',
	),
    'browse' => array(
	    'eng' => 'Browse Reference Data',
		'chn' => '浏览文献数据',
	),
	'disp_rec' => array(
	    'eng' => 'Display Reference Record',
		'chn' => '显示文献记录',	
	),
	'edit' =>array(
	    'eng' => 'Edit Reference Data',
		'chn' => '编辑文献数据',
	),
	'import' => array(
	    'eng' => 'Import Medline Data',
		'chn' => '导入Medline数据',	
	),
	'login' => array(
	    'eng' => 'Administrator Login',
		'chn' => '管理员登录',
	),
	'search' => array(
	    'eng' => 'Search Reference',
		'chn' => '搜索文献数据',
	),
	'medline_help' => array(
	    'eng' => 'MEDLINE Text Format Help',
	    'chn' => 'Medline文本格式',
	),
);

# Errors
# 错误信息
#
$error = array(
    'no_result' => array(
	    'eng' => 'No result.',
		'chn' => '没有记录',
	),
);

# Prompt 
# 提示信息
#
$prompt = array(
    'add_data_success' => array(
	    'eng' => 'Add record success! Return page add data page automaticly.',
		'chn' => '数据录入成功！自动返回录入界面。',
	),
	'contact_admin' => array(
	    'eng' => 'Please contact administrator.',
		'chn' => '请联系管理员。',
	),
	'cur_file' => array(
	    'eng' => 'Current file: ',
		'chn' => '当前文件: ',
	),
	'del_file_ok' => array(
	    'eng' => 'Attached file deleted ok!',
		'chn' => '相关文件成功删除！',
	),
	'del_file_err' => array(
	    'eng' => 'Cannot delete attached file!',
		'chn' => '无法删除相关文件！',
	),
	'del_rec_ok' => array(
	    'eng' => 'Recode deleted ok!',
		'chn' => '记录删除成功！',
	),
	'del_rec_err' => array(
	    'eng' => 'Delete record Error!',
		'chn' => '删除记录错误！',
	),
	'edit_rec_ok' => array(
	    'eng' => 'Edit record complete!',
		'chn' => '编辑记录成功！',
	),
	'import_medline_file' => array(
		'eng' => 'Import MEDLINE text file:',
		'chn' => '导入MEDLINE文本文件.',
	),
	'import_medline_text' => array(
	    'eng' => 'Import Medline text:',
	    'chn' => '导入MEDLINE文本',
	),
	'import_medline_help' => array(
	    'eng' => 'Help of Medline text format.',
	    'chn' => 'MEDLINE 格式帮助.',
	),
	'insert_rec_success' => array(
	    'eng' => 'Successfully insert records: ',
		'chn' => '成功插入记录: ',
	),
	'insert_rec_err' => array(
	    'eng' => 'No record inserted. Please check file format.',
		'chn' => '请检查文件格式.',	
	),
	'item_required' => array(
	    'eng' => '* Required filed.',
		'chn' => '* 必需项',
	),
	'login_err' => array(
	    'eng' => 'Login error! Try again!',
		'chn' => '用户名/密码错误！',
	),
	'login_ok' => array(
	    'eng' => 'Administrator login ok!',
		'chn' => '管理员登录成功!',
	),
	'no_chg_no_upload' => array(
	    'eng' => 'Don\'t change this field if the file won\'t be uploaded again.',
		'chn' => '如果不重新上传文件，不要更改。',
	),
    'optional' => array(
	    'eng' => '* Optional',
		'chn' => '* 可选，不必需',
	),
    'rec_exist' => array(
	    'eng' => 'Reference record already exists.',
		'chn' => '文献已经存在.',	
	),
        'total_rec' => array(
            'eng' => 'Total reference record: ',
            'chn' => '文献记录总数: ',
        ),
);

# Reference item
# 文献信息条目，用于编辑、添加文献记录页面
# 
$ref_item = array(
    'id' => array(
        'eng' => 'ID',
	'chn' => '编号',
    ),
    'title' => array(
	    'eng' => 'Title',
		'chn' => '标题',
	),
	'authors' => array(
	    'eng' => 'Authors',
		'chn' => '作者',
	),
	'address' => array(
	    'eng' => 'Address',
		'chn' => '地址',
	),
	'abstract' => array(
	    'eng' => 'Abstract',
		'chn' => '摘要',
	),
	'keywords' => array(
	    'eng' => 'Keywords',
		'chn' => '关键词',
	),
	'journal' => array(
	    'eng' => 'Journal',
		'chn' => '期刊',
	),
	'date' => array(
	    'eng' => 'Date (year)',
		'chn' => '日期 (年)',
	),
	'volume' => array(
	    'eng' => 'Volume',
		'chn' => '卷',
	),
	'issue' => array(
	    'eng' => 'Issue',
		'chn' => '期',
	),
	'start_page' => array(
	    'eng' => 'Start page',
		'chn' => '起始页码',
	),
	'end_page' => array(
	    'eng' => 'End page',
		'chn' => '结束页码',
	),
	'type' => array(
	    'eng' => 'Type',
		'chn' => '分类',
	),
	'pmid' => array(
	    'eng' => 'PubMed ID',
		'chn' => 'PubMed ID',
	),
	'upload' => array(
	    'eng' => 'Upload file',
		'chn' => '上传文件',
	),
	'orderby' => array(
	    'eng' => 'Order by',
		'chn' => '排序',	
	),
	'file_url' => array(
	    'eng' => 'File url',
		'chn' => '文件链接',	
	),
	'page' => array(
	    'eng' => 'Page',
		'chn' => '页码',	
	),
);

$login_item = array(
    'account' => array(
	    'eng' => 'Account',
		'chn' => '帐号',
	),
	'pass' => array(
	    'eng' => 'Password',
		'chn' => '密码',
	),
);
?>

</body>
</html>
