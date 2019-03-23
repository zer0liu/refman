<?php
session_start();

require_once("globalvar.php");
require_once("language.php");

if ( isset( $_SESSION['lang']) ) {
    $cur_lang = $_SESSION['lang'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RefMan MEDLINE Help</title>
<link rel=stylesheet href="images/style.css" />
</head>
<body>
<table id="tbl_medline_help" class="tbl_container">
    <tr class="tr_title">
	<td>
	    <img src="images/item.GIF" />
<?php
echo $page_title['medline_help'][$cur_lang];
?>
	</td>
    </tr>
    <tr>
	<td>
	<img src="images/medline.gif" />
	</td>
    </tr>
</table>
</body>
</html>
