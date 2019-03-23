<?php
session_start();
/*--------------------------------------------------------------------
 * Filename:	adminLogin.php
 * Description:	Login page for 'admin' and 'manager' account
 * Author:	zeroliu
 * Version: 
	0.2	2007-12-07: enhanced account management
----------------------------------------------------------------------
*/
require_once("globalvar.php");
require_once("language.php");

if ( isset( $_SESSION['lang'] ) ) {
    $cur_lang = $_SESSION['lang'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link rel=stylesheet href="./images/style.css">
</head>

<body>
<table id="tbl_form_container" class="tbl_container">
	<tr>
		<td class="td_title">
			<img src="images/item.GIF" />
<?php
    echo $page_title['login'][$cur_lang]
?>
		</td>
	</tr>
	<tr>
		<td>
				
<table width="400" border="0" cellpadding="1" cellspacing="1" class="form" id="form_container">
  <tr>
  <td>
<!--
  <h3 class="container">Administrator login:</h3>  
-->
  </td>
  </tr>
  <tr>
    <td><form id="form_login" name="form_login" method="post" action="adminLogin.php">

      <table width="100%" border="0" cellspacing="1" cellpadding="1">
<?php
echo <<<EOS
        <tr>

          <td width="100" class="disp_rec_key">{$login_item['account'][$cur_lang]}</td>
          <td class="disp_rec"><input name="account" type="text" id="account" tabindex="1" maxlength="20" />
            </td>
        </tr>

        <tr>
          <td width="100" class="disp_rec_key">{$login_item['pass'][$cur_lang]}</td>
          <td class="disp_rec"><input name="password" type="password" class="disp_rec" id="password" tabindex="2" maxlength="20" /></td>
		  
        </tr>
EOS;
?>
		<tr>
		<td>&nbsp;</td>
		<td>

		</td>
		</tr>
      </table>
	    <input type="submit" name="Submit" value="Submit" accesskey="S" tabindex="3" />
		<input name="Reset" type="reset" id="Reset" value="Reset" accesskey="R" tabindex="4" />
        </form>
    </td>
  </tr>
</table>
<?php
if ( isset($_POST['account']) ) {
    $user =  $_POST["account"];	# user account for database `refman` administrator
    $admin = 'ref_' . $user;		# account for MySQL server connection
    $pass = $_POST["password"];

# 连接数据库
    $dblink = mysql_connect($host, $admin, $pass)
#    $dblink = mysql_connect('localhost', 'nobody', '')
		or die ('<br>无法连接数据库' . mysql_error() . '</br>');

# echo '<br>成功连接数据库</br>';
    mysql_select_db('refman', $dblink) or die('<br>' . mysql_error() . '</br>');
#
# --------------------------------------------------------------------
#
    $sqlstr = <<<EOS
	SELECT id FROM `tbl_user` WHERE user="$user" && pass=PASSWORD("$pass");
EOS;

    ( $result = mysql_query($sqlstr, $dblink) ) or die("<br>" . mysql_error() . "</br>");

    if ( mysql_num_rows($result) == 0 ) {    # Not admin or manager
echo <<<EOS
    <script language="javascript">
        window.alert("{$prompt['login_err'][$cur_lang]}");
		document.locatin.href="adminLogin.php";
	</script >
EOS;
}
    else {	# Setup session variables
        if ($user == 'admin') {	# admin
	    $_SESSION['is_admin'] = 1;
	}
	else if ($user == 'manager') {	# Manager
	    $_SESSION['is_admin'] = 2;
	}

# variables for furture query
        $_SESSION['admin'] = $admin;
        $_SESSION['pass'] = $pass;
		
echo <<<EOS
    <script language="javascript">
	    window.alert("{$prompt['login_ok'][$cur_lang]}");
		parent.location.href="index.html";
	</script >
EOS;
    }

/*
echo <<<EOS
    <script language="javascript">
        parent.location.href="index.html"
    </script >
EOS;
*/
}
?>
</body>
</html>
