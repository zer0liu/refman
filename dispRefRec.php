<?php
session_start();
/*-------------------------------------------------------------------
 * FileName:	dispRefRec.php
 * Version:		0.15
 * Created at:	2005-10-20	0.1
 * Updated at:	2007-10-12	0.15
 * Created by:	刘海舟	longbow0@163.com
 * Desciption:	显示单条数据
				dispRefRec.php?id=xxx
*/

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Display Reference</title>
<link rel=stylesheet href="./images/style.css">
</head>

<body>
<table id="tbl_container" class="container">
	<tr  class="tr_title">
		<td >
<img src="images/item.GIF" />
<?php
    echo $page_title['disp_rec'][$cur_lang];
?>
		</td>
	</tr>
	<tr>
		<td>
<?php
/* =================================================================
echo '<hr />';
if ( isset($_SESSION['is_admin']) && ($_SESSION['is_admin'] != '') ) {
# 显示数据处理：编辑、删除
echo <<<EOS
			<table width="100%" class="disp_rec">
			     <tr>
				     <td width="94%"></td>
			         <td width="3%">
				         <a href="./editRefRec.php?id={$_GET['id']}">
					     <img border="0" src="./images/edit.png"  alt="编辑">
					 </a>
				     </td>
                     <td width="3%">
			             <a href="./delRefRec.php?id={$_GET['id']}">
			             <img border="0" src="./images/del.png" alt="删除">
				     </a>
			         </td>
			    </tr>
			</table>
EOS;
            }
*/
?>
        </td>
	</tr>
	<tr>
	    <td>
<?php
# 显示数据内容
$dblink = mysql_connect($host, $user, $pass)
					or die ('<br>无法连接数据库' . mysql_error() . '</br>');

# echo '<br>成功连接数据库</br>';

mysql_select_db('refman') or die('<br>' . mysql_error() . '</br>');

$sqlstr = 'SELECT id, title, authors, address, abstract, keywords, journal, pub_year, volume, issue, page_start, page_end, pmid, file_path FROM tbl_ref WHERE id=' . $_GET['id'] . ';';

$result = mysql_query($sqlstr) or die('<br>查询数据错误' . mysql_error() . '</br>');
# 结果行
$row = mysql_fetch_array($result);
			
# 输出表格
echo <<<EOS
             <table class="disp_rec" width="100%">
                 <tr>
				     <td class="disp_rec_key" width="15%">{$ref_item['title'][$cur_lang]}</td>
			         <td class="disp_rec" width="85%">{$row['title']}</td>
				 </tr>

			     <tr>
				     <td class="disp_rec_key" width="15%">{$ref_item['authors'][$cur_lang]}</td>
			         <td class="disp_rec" width="85%">{$row['authors']}</td>
				 </tr>
			     <tr>
				     <td class="disp_rec_key" width="15%">{$ref_item['address'][$cur_lang]}</td>
			         <td class="disp_rec" width="85%">{$row['address']}</td>
				 </tr>
                 <tr>
				     <td class="disp_rec_key" width="15%">{$ref_item['abstract'][$cur_lang]}</td>
                     <td class="disp_rec" width="85%">{$row['abstract']}</td>
				 </tr>
                 <tr>
				     <td class="disp_rec_key" width="15%">{$ref_item['keywords'][$cur_lang]}</td>
                     <td class="disp_rec" width="85%">{$row['keywords']}</td>
				 </tr>
                 <tr>
				     <td class="disp_rec_key" width="15%">{$ref_item['journal'][$cur_lang]}</td>
                     <td class="disp_rec" width="35%">{$row['journal']}</td>
                 </tr>
                 <tr>
				     <td class="disp_rec_key" width="15%">{$ref_item['date'][$cur_lang]}</td>
                     <td class="disp_rec" width="35%">{$row['pub_year']}</td>
				 </tr>
                 <tr>
				     <td class="disp_rec_key" width="10%">{$ref_item['volume'][$cur_lang]}</td>
                     <td class="disp_rec" width="20%">{$row['volume']}</td>
				 </tr>
                 <tr>
				     <td class="disp_rec_key" width="10%">{$ref_item['issue'][$cur_lang]}</td>
                     <td class="disp_rec" width="20%">{$row['issue']}</td>
                 </tr>
                 <tr>
				     <td class="disp_rec_key" width="10%">{$ref_item['page'][$cur_lang]}</td>
                     <td class="disp_rec" width="20%">{$row['page_start']} -{$row['page_end']}</td>
				 </tr>
                 <tr>
				     <td class="disp_rec_key" width="15%">{$ref_item['pmid'][$cur_lang]}</td>
                     <td class="disp_rec" width="85%">{$row['pmid']}</td>
				 </tr>
                 <tr>
				     <td class="disp_rec_key" width="15%">{$ref_item['file_url'][$cur_lang]}</td>
                     <td class="disp_rec" width="85%">
EOS;
if ($row['file_path'] != '') {
echo <<<EOS
                     <a href={$row['file_path']} target="_blank">
					 <img border="0" src="./images/open.png" alt="Open file">
					 </a>
EOS;
			}
			echo '</table>';
			?>
		</td>
	</tr>
</table>


</body>

</html>
