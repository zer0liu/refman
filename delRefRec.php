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
		or die ('<br>�޷��������ݿ�' . mysql_error() . '</br>');

    mysql_select_db('refman') or die('<br>' . mysql_error() . '</br>');

# ��ȡ�ϴ����ļ���
    $sqlstr = 'SELECT file_path FROM `tbl_ref` WHERE id=' . $_GET['id'] . ';';

    $result = mysql_query($sqlstr) or die('��ѯ���ݳ���');

    $row = mysql_fetch_array($result);

    $file_path = $row['file_path'];

# ɾ����¼
    $sqlstr = 'DELETE FROM `tbl_ref` WHERE id=' . $_GET['id'] . ';';

    mysql_query($sqlstr) or die('<br>ɾ����¼����: ' . mysql_error() . '</br>');

#  echo '�ɹ�ɾ�����ݡ�';
    $str_output = $prompt['del_rec_ok'][$cur_lang];

#ɾ���ϴ����ļ�
    if ($file_path != '') {
	    unlink($file_path) or die('<br>�޷�ɾ���ļ�: ' . $file_path . ' ' . $prompt['contact_admin'][$cur_lang] . '</br>');
		
		$str_output = $str_output . "\n" . $prompt['del_file_ok'][$cur_lang];
    }

#    echo '<br>�ɹ�ɾ���ϴ����ļ�.</br>';
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

# ��ȡ���ñ�ҳ���url����dispData.php��url
# $headers = apache_request_headers();
#
# $referer_url = $headers['Referer'];
# $referer_url = $_SERVER["HTTP_REFERER"];

# DEBUG
echo $referer_url;

# ��ת��dispRefData.php
echo <<<EOS
<script language="javascript">

    document.location.href = "{$_SERVER["HTTP_REFERER"]}";

</script >
EOS;
?>

</body>
</html>
