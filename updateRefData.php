<?php
session_start();
/*-------------------------------------------------------------------
 * Filename:	updateRefData.php
 * Description: 添加文献数据
	updateRefData?cmd=add	    --	插入新数据
	updateRefData?cmd=modify    --	修改数据
 * Author:	zeroliu
 * Version:
    * 0.2   2007-12-7: enhanced user management
-------------------------------------------------------------------*/
require_once("globalvar.php");
require_once("language.php");

if ( isset( $_SESSION['lang'] ) ) {
    $cur_lang = $_SESSION['lang'];
}

if ( isset( $_SESSION['is_admin'] ) && $_SESSION['is_admin'] != '' ) {
    $user = $_SESSION['admin'];
    $pass = $_SESSION['pass'];
}
?>
<html>

<head>
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>RefMan: Add data</title>
<link rel=stylesheet href="./images/style.css">
</head>

<body>
<?php

$data_valid = TRUE;

# 上传文件 ----------------------------------------------------------
$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_';

if ($_FILES['ref_file']['name'] != '') {	//如果有上传文件
	$file_path_info = pathinfo($_FILES['ref_file']['name']);	// 解析文件扩展名
        # 随机文件名前缀，长度为3个字符
        $chars_len = strlen($chars) - 1;
        mt_srand((double)microtime() * 1000000);
        for ($i = 0; $i<3; $i++)
        {
            $prefix .= $chars[mt_rand(0, $chars_len)];
        } 
	# 用当前的系统时间(秒)作为文件名
	if ($_POST['subject'] == 'default') {	//如果是"默认", 只写入"./articles/default"文件夹
		$file_dest = $file_upload_dir . 'default/' . $prefix . '_' . time() . '.' . $file_path_info['extension'];
	}
	else {	//生成保存文件的文件路径
		$file_dest = $file_upload_dir . $subject_dir[$_POST['subject']]['base'] . $subject_dir[$_POST['subject']][$_POST['subject_1']]. $prefix . '_' .  time() . '.' . $file_path_info['extension'];
	}

	move_uploaded_file($_FILES['ref_file']['tmp_name'], $file_dest) or die('<br>File upload ERROR! 请上传正确格式的文件</br>');
}

# 写入数据库 --------------------------------------------------------

# 连接数据库
$curlink = mysql_connect($host, $user, $pass)
	or die ('<br>无法连接数据库' . mysql_error() . '</br>');

# echo '<br>成功连接数据库</br>';

mysql_select_db('refman') or die('<br>' . mysql_error() . '</br>');

/* ================================================================
* 判断记录是否存在
*/
if ( $_GET['cmd'] == 'add' ) {
    $sqlstr = "SELECT id FROM `tbl_ref` WHERE pmid='{$_POST['ref_pmid']}'";
	
	$result = mysql_query($sqlstr) or die('<br>' . mysql_error() . '</br>');

	if ( mysql_num_rows($result) != 0 ) {
// Display an alert
echo <<<EOS
            <script language="javascript">
                window.alert("{$prompt['rec_exist'][$cur_lang]}");
            </script >
EOS;
            return;
	}
}

/* ================================================================
* 插入/更新操作
*/

if ($_GET['cmd'] == 'add') {
	$sqlstr = 'INSERT INTO tbl_ref SET';
}
elseif ($_GET['cmd'] == 'modify') {
	$sqlstr = 'UPDATE tbl_ref SET';
}

if (get_magic_quotes_gpc() == 0) {	# magic_quotes_gpc
    if ($_POST['ref_title']) 
	    $sqlstr = $sqlstr . ' title=\'' . addslashes($_POST['ref_title']) . '\',';
    if ($_POST['ref_authors']) 
	    $sqlstr = $sqlstr . ' authors = \'' . addslashes($_POST['ref_authors']) . '\',';
    if ($_POST['ref_address']) 
	    $sqlstr = $sqlstr . ' address =\'' . addslashes($_POST['ref_address']) . '\',';
    if ($_POST['ref_abstract']) 
	    $sqlstr = $sqlstr . ' abstract = \'' . addslashes($_POST['ref_abstract']) . '\',';
    if ($_POST['ref_keywords']) 
	    $sqlstr = $sqlstr . ' keywords = \'' . addslashes($_POST['ref_keywords']) . '\',';
    if ($_POST['ref_journal']) 
	    $sqlstr = $sqlstr . ' journal = \'' . addslashes($_POST['ref_journal']) . '\',';
    if ($_POST['ref_date']) 
	    $sqlstr = $sqlstr . ' pub_year = \'' . $_POST['ref_date'] . '\',';
    if ($_POST['ref_volume']) 
	    $sqlstr = $sqlstr . ' volume = \'' . $_POST['ref_volume'] . '\',';
    if ($_POST['ref_issue']) 
	    $sqlstr = $sqlstr . ' issue = \'' . $_POST['ref_issue'] . '\',';
    if ($_POST['ref_startpage']) 
	    $sqlstr = $sqlstr . ' page_start = \'' . $_POST['ref_startpage'] . '\',';
    if ($_POST['ref_endpage']) 
	    $sqlstr = $sqlstr . ' page_end = \'' . $_POST['ref_endpage'] . '\',';
    if ($_POST['ref_pmid']) 
	    $sqlstr = $sqlstr . ' pmid = \'' . $_POST['ref_pmid'] . '\',';
    $sqlstr = $sqlstr . ' update_date = now()';
    if ($_FILES['ref_file']['name'] != '') {	// 如果有上传文件
	    $sqlstr = $sqlstr . ', file_path = \'' . $file_dest . '\'';
    }
}
else {
    if ($_POST['ref_title']) 
	    $sqlstr = $sqlstr . ' title=\'' . $_POST['ref_title'] . '\',';
    if ($_POST['ref_authors']) 
	    $sqlstr = $sqlstr . ' authors = \'' . $_POST['ref_authors'] . '\',';
    if ($_POST['ref_address']) 
	    $sqlstr = $sqlstr . ' address =\'' . $_POST['ref_address'] . '\',';
    if ($_POST['ref_abstract']) 
	    $sqlstr = $sqlstr . ' abstract = \'' . $_POST['ref_abstract'] . '\',';
    if ($_POST['ref_keywords']) 
	    $sqlstr = $sqlstr . ' keywords = \'' . $_POST['ref_keywords'] . '\',';
    if ($_POST['ref_journal']) 
	    $sqlstr = $sqlstr . ' journal = \'' . $_POST['ref_journal'] . '\',';
    if ($_POST['ref_date']) 
	    $sqlstr = $sqlstr . ' pub_year = \'' . $_POST['ref_date'] . '\',';
    if ($_POST['ref_volume']) 
	    $sqlstr = $sqlstr . ' volume = \'' . $_POST['ref_volume'] . '\',';
    if ($_POST['ref_issue']) 
	    $sqlstr = $sqlstr . ' issue = \'' . $_POST['ref_issue'] . '\',';
    if ($_POST['ref_startpage']) 
	    $sqlstr = $sqlstr . ' page_start = \'' . $_POST['ref_startpage'] . '\',';
    if ($_POST['ref_endpage']) 
	    $sqlstr = $sqlstr . ' page_end = \'' . $_POST['ref_endpage'] . '\',';
    if ($_POST['ref_pmid']) 
	    $sqlstr = $sqlstr . ' pmid = \'' . $_POST['ref_pmid'] . '\',';
    $sqlstr = $sqlstr . ' update_date = now()';
    if ($_FILES['ref_file']['name'] != '') {	// 如果有上传文件
	    $sqlstr = $sqlstr . ', file_path = \'' . $file_dest . '\'';
    }
}

if ($_GET['cmd'] == 'modify') {	//为修改记录模式, 加上id
	$sqlstr = $sqlstr . ' WHERE id=' . $_POST['ref_id'];
}

$sqlstr = $sqlstr . ';';

$result = mysql_query($sqlstr) or die('<br>写入数据错误' . mysql_error() . '</br>');

# 消息提示
# 添加成功
#
echo <<<EOS
<script language="javascript">
	window.alert("{$prompt['edit_rec_ok'][$cur_lang]}");
</script >
EOS;

# 页面跳转
#
if ( $_GET['cmd'] == 'add') {
echo <<<EOS
        <script language="javascript">
            document.location.href = "addRefData.php";
		</script >
EOS;
}
elseif ( $_GET['cmd'] == 'modify') {
echo <<<EOS
        <script language="javascript">
            document.location.href = "{$_POST['parent_url']}";
		</script >
EOS;
}
else {
echo <<<EOS
        <script language="javascript">
            document.location.href = "cover.php";
		</script >
EOS;
}
?>
</body>
</html>
