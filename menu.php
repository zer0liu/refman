<?php
session_start();

include_once("globalvar.php");
include_once("language.php");

if ( isset( $_SESSION['lang'] ) ) {
    $cur_lang = $_SESSION['lang'];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>main menu</title>

<link rel=stylesheet href="./images/style.css">

</head>

<body>
<?php
echo <<<EOS

<table id="tblMenu" class="main" width="100%">
	<tr>
		<td width="120" align="center" valign="top">
		<table id="tbl_index" class="index">
		    <tr align="bottom" class="tr_title">
			    <td >
				<img src="images/logo_s.png" width="110">
				</td>
			</tr>
<!--
# =================================================================
# Output "主菜单"/"Mainmenu"			
#
-->
			<tr class="tbl_index_head">
				<td align="center">
				{$menu['mainmenu'][$cur_lang]}
				</td>
			</tr>
<!--
# ==================================================================
# Output "浏览"/"browse"
#
-->
			<tr>
				<td align="center"><font color="#FFFF00" size="2">
				    <a href="dispRefData.php?cmd=browse&page=1" target="mainFrame">
                    {$menu['browse'][$cur_lang]}

				</a></font></td>
			</tr>
<!--
菜单项： 搜索
-->
			<tr>
			  <td align="center"><font color="#FFFF00" size="2">
			      <a href="searchRefData.php" target="mainFrame">
                  {$menu['search'][$cur_lang]}
				  </a></font></td>
		  </tr>
EOS;

if ( isset($_SESSION['is_admin']) && ( $_SESSION['is_admin'] != '' ) ) {
echo <<<EOS
          <tr>
              <td align="center"><font color="#FFFF00" size="2">
                  <a href="addRefData.php" target="mainFrame">
				  {$menu['add'][$cur_lang]}

				  </a></font>
			   </td>
          </tr>
<!--
菜单项：导入 Medline 格式数据
-->
          <tr>
              <td align="center"><font color="#FFFF00" size="2">
              <a href="importMedline.php" target="mainFrame">
			  {$menu['import'][$cur_lang]}

			  </a></font></td>
          </tr>
EOS;
}

echo <<<EOS
		  <tr class="tbl_index_head">
			  <td align="center">
			  {$menu['manage'][$cur_lang]}

				</td>
			</tr>	
<!--
菜单项： 管理员登录
-->
			<tr>
				<td align="center"><a href="adminLogin.php" target="mainFrame" target="_blank">
                {$menu['login'][$cur_lang]}
				</a></td>
			</tr>
EOS;


if ( isset($_SESSION['is_admin']) && ( $_SESSION['is_admin'] != '' ) ) {
echo <<<EOS
			<tr>
				<td align="center"><a href="logout.php">
                {$menu['logout'][$cur_lang]}		 
            </a></td>
			</tr>
EOS;
}
# ======================================================================
# 切换语言
#	 
/*

EOS;
                    if ( $cur_lang == 'chn' ) {
					    echo <<<EOS
						<a href="xchgLang.php?xlang=eng">
						{$menu['xlang'][$cur_lang]}
						</a>
EOS;
                    }
					elseif ( $cur_lang == 'eng' ) {
					    echo <<<EOS
						<a href="xchgLang.php?xlang=chn">
						{$menu['xlang'][$cur_lang]}
						</a>
EOS;
					 }
echo <<<EOS
*/

echo <<<EOS
			<tr class="tbl_index_head">
				<td align="center">
                <form name="form_xchg_lang" id="form_xchg_lang" method="post" action="xchgLang.php">
				<input name="cur_lang" type="hidden" value="$cur_lang">
				<input name="submit" type="submit" value="{$menu['xlang'][$cur_lang]}">
				</form>
				</td>
			</tr>
<!--
# ======================================================================
# 版权信息
#
-->
			<tr>
				<td align="center" class="signature">&copy; 2007</td>
			</tr>

			<tr>
				<td align="center" class="signature">by <a href="mailto:longbow0_at_163.com">zeroliu</a></td>
			</tr>
		</table>
	</td>	
	</tr>
</table>	
EOS;
?>		
</body>
</html>
