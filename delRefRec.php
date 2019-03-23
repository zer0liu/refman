<?php
session_start();

require_once("globalvar.php");
require_once("language.php");

if ( isset( $_SESSION['lang'] ) ) {
    $cur_lang = $_SESSION['lang'];
}

if ( isset( $_SESSION['is_admin']) && $_SESSION['is_admin'] != '') {
    $user = $_SESSION['admin'];
    $pass = $_SESSION['pass'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Logout</title>
</head>

<body>
<?php

if ( isset($_SESSION['is_admin']) && ( $_SESSION['is_admin'] != '' ) ) {
    $dblink = mysql_connect($host, $user, $pass)
		or die ('<br>无法连接数据库' . mysql_error() . '</br>');

    mysql_select_db('refman') or die('<br>' . mysql_error() . '</br>');

# 获取上传的文件名
    $sqlstr = 'SELECT file_path FROM `tbl_ref` WHERE id=' . $_GET['id'] . ';';

    $result = mysql_query($sqlstr) or die('查询数据出错。');

    $row = mysql_fetch_array($result);

    $file_path = $row['file_path'];

# 删除记录
    $sqlstr = 'DELETE FROM `tbl_ref` WHERE id=' . $_GET['id'] . ';';

    mysql_query($sqlstr) or die('<br>删除记录出错: ' . mysql_error() . '</br>');

#  echo '成功删除数据。';
    $str_output = $prompt['del_rec_ok'][$cur_lang];

#删除上传的文件
    if ($file_path != '') {
	    unlink($file_path) or die('<br>无法删除文件: ' . $file_path . ' ' . $prompt['contact_admin'][$cur_lang] . '</br>');
		
		$str_output = $str_output . "\n" . $prompt['del_file_ok'][$cur_lang];
    }

#    echo '<br>成功删除上传的文件.</br>';
    echo <<<EOS
	<script language="javascript">
	    window.alert("$str_output");
	</script >
EOS;
}
else {
    echo '<br>* ONLY admininstrator is able to erase record.</br>';
	echo '<br>* Please login first.</br>';
}

# 获取引用本页面的url，即dispData.php的url
# $headers = apache_request_headers();
#
# $referer_url = $headers['Referer'];
# $referer_url = $_SERVER["HTTP_REFERER"];

# DEBUG
echo $referer_url;

# 跳转回dispRefData.php
echo <<<EOS
<script language="javascript">

    document.location.href = "{$_SERVER["HTTP_REFERER"]}";

</script >
EOS;
?>

</body>
</html>
