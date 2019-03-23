<?php
session_start();

require_once("globalvar.php");
require_once("language.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Switch language</title>
</head>

<body>
<?php

if ( isset( $_POST['cur_lang'] ) ) {
    switch ($_POST['cur_lang']) {
	    case 'chn':
		    $_SESSION['lang'] = 'eng';
		    break;
	    case 'eng':
		    $_SESSION['lang'] = 'chn';
		    break;
		default:
		    $_SESSION['lang'] = 'chn';
	}
//    $_SESSION['lang'] = $_POST['xlang'];
}

echo <<<EOS
<script language="javascript">
    document.location.href = "menu.php";
</script >
EOS;
?>
</body>
</html>
