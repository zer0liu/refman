<html>
<!--
 * Filename:	addDataSuccess.php
 * Version:		0.15
 * Created at:	2005-10-20	0.1
 * Updated at:	2007-10-11	0.15
 * Created by:	刘海舟	longbow0@163.com
 * Description:	Print a information ""
-->
<head>
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Data added successfully!</title>
<link rel=stylesheet href="./images/style.css">
</head>

<body>

<?php
	echo '<br>' . $prompt['add_data_success'][$cur_lang] . '</br>';

	echo '<script language="javascript">';

	echo 'function JumpPage() {';
	echo 'document.location.href="addRefData.html";';
	echo '}';

	echo 'window.setTimeout("JumpPage();",1*1000);';
	echo '</script>';
?>

</html>