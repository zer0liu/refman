<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Confirm login</title>
</head>

<body>
<?php
$user = $_POST["account"];
$pass = $_POST["password"];

# 连接数据库
$dblink = mysql_connect('localhost', 'root', '')
		or die ('<br>无法连接数据库' . mysql_error() . '</br>');

# echo '<br>成功连接数据库</br>';
mysql_select_db('refman', $dblink) or die('<br>' . mysql_error() . '</br>');

$sqlstr = <<<EOS
SELECT id FROM `tbl_user`
    WHERE user="$user" && pass=PASSWORD("$pass")
EOS;

( $result = mysql_query($sqlstr, $dblink) ) or die("<br>" . mysql_error() . "</br>");

if ( mysql_num_rows($result) == 0 ) {
    echo '<br>Please login first.</br>';
}
else {
#    session_register("is_admin");
    $_SESSION['is_admin'] = 1;
	echo '<br>Administrator login ok.</br>';
}

echo <<<EOS
<script language="javascript">
function JumpPage() {
//    document.location.href="index.html"
    parent.location.href="menu.php"
}

window.setTimeout("JumpPage();",2*1000)
</script>
EOS;

?>
</body>
</html>
