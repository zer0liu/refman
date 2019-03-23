<?php
session_start();
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
    unset($_SESSION['is_admin']);
    unset($_SESSION['admin']);
    unset($_SESSION['pass']);
}

echo <<<EOS
<script language="javascript">
    parent.location.href="index.html"
</script >
EOS;

?>
</body>
</html>
