<?php
session_start();
/*
 * Filename:	editRefRec.php
 * Desciption:	edit single reference data.
    'admin':	edit all fields
    'manager':	update reference file only
 * Author:	zeroliu
 * Version:
    0.2	2007-12-07  enhanced user managment
*/
require_once("globalvar.php");
require_once("language.php");

if ( isset( $_SESSION['lang'] ) ) {
    $cur_lang = $_SESSION['lang'];
}

if ( isset($_SESSION['is_admin']) && $_SESSION['is_admin'] != '') {
    $user = $_SESSION['admin'];
    $pass = $_SESSION['pass'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RefMan: Edit data</title>
<link rel=stylesheet href="./images/style.css">
</head>

<body>

<table id="tbl_form_container" class="tbl_container" width="100%">
	<tr>
		<td class="td_title">
			<img src="images/item.GIF" />
<?php
    echo $page_title['edit'][$cur_lang];
?>
		</td>
	</tr>
	<tr>
		<td>
<?php
$dblink = mysql_connect($host, $user, $pass)
		or die ('<br>无法连接数据库{ mysql_error() }</br>');

# echo '<br>成功连接数据库</br>';

mysql_select_db('refman') or die('<br>{ mysql_error() }</br>');

$sqlstr = 'SELECT id, title, authors, address, abstract, keywords, journal, pub_year, volume, issue, page_start, page_end, pmid, file_path FROM tbl_ref WHERE id=' . $_GET["id"] . ';';

# DEBUG
# echo $sqlstr;

$result = mysql_query($sqlstr) or die('<br>查询数据错误{ mysql_error() }</br>');

$row = mysql_fetch_array($result);

# 显示表单
echo <<<EOS

	    <form name="frm_addData" method="POST" action="updateRefData.php?cmd=modify" 								enctype="multipart/form-data" class="addrec">
		<input type="hidden" name="ref_id" value="{$row['id']}">
		<table id="tbl_addrefdata" class="form">
			<tr>
				<td>
				{$prompt['item_required'][$cur_lang]}
				</td>
				<td></td>
			</tr>
EOS;

# user 'admin'

## Field 'title'
echo <<<EOS
			<tr>
				<td width="150" class="td_form_item_need">{$ref_item['title'][$cur_lang]}</td>
				<td class="td_form">
				    <input type="text" name="ref_title" size="80" value="{$row['title']}"
EOS;

if ($_SESSION['is_admin'] == 2) { # user 'manager', cannot edit
    echo 'readonly>';
}
else {
    echo '>';
}

## Field 'authors'
echo <<<EOS
				</td>
			</tr>
			<tr>
			    <td width="150" class="td_form_item_need">{$ref_item['authors'][$cur_lang]}</td>
			    <td class="td_form">
			        <input type="text" name="ref_authors" size="80" value="{$row['authors']}"
EOS;

if ($_SESSION['is_admin'] == 2) {
    echo 'readonly>';
}
else {
    echo '>';
}

echo <<<EOS
				</td>
			</tr>
EOS;

## Field 'address'
echo <<<EOS
			<tr>
				<td width="150" class="td_form_item">{$ref_item['address'][$cur_lang]}</td>
				<td class="td_form">
				    <textarea rows="1" name="ref_address" cols="80"
EOS;

if ($_SESSION['is_admin'] == 2) {
    echo 'readonly';
}

echo <<<EOS
>{$row['address']}

				    </textarea>
				</td>
			</tr>
EOS;

## Field 'journal'
echo <<<EOS
			<tr>
				<td width="150" class="td_form_item_need">{$ref_item['journal'][$cur_lang]}
				</td>
				<td class="td_form">
				    <input type="text" name="ref_journal" size="50" value="{$row['journal']}"
EOS;

if ($_SESSION['is_admin'] == 2) {
    echo 'readonly';
}

echo <<<EOS
				    >
				</td>
			</tr>	
EOS;

# Field 'abstract'
echo <<<EOS
			<tr>
			    <td width="150"  class="td_form_item">{$ref_item['abstract'][$cur_lang]}</td>
				<td class="td_form">
				    <textarea rows="4" name="ref_abstract" cols="80"
EOS;

if ($_SESSION['is_admin'] == 2) {
    echo 'readonly';
}

echo <<<EOS
				    >{$row['abstract']}</textarea>
				</td>
			</tr>
EOS;

## Field 'keywords'
echo <<<EOS
			<tr>
				<td width="150" class="td_form">{$ref_item['keywords'][$cur_lang]}</td>
				<td class="td_form">
				    <input type="text" name="ref_keywords" size="90" value="{$row['keywords']}"
EOS;

if ($_SESSION['is_admin'] == 2) {
    echo 'readonly';
}

echo <<<EOS
				    >
				</td>
			</tr>
EOS;

## Field 'date'
echo <<<EOS
			<tr>
				<td width="150" class="td_form_item">{$ref_item['date'][$cur_lang]}</td>
				<td class="td_form">
				    <input type="text" name="ref_date" size="10" maxlength="4" value="{$row['pub_year']}"
EOS;

if ($_SESSION['is_admin'] == 2) {
    echo 'readonly';
}

echo <<<EOS
				    >&nbsp; (yyyy)
				</td>
			</tr>
EOS;

## Field 'volume'
echo <<<EOS
			<tr>
				<td width="150" class="td_form_item">{$ref_item['volume'][$cur_lang]}</td>
				<td class="td_form">
				    <input type="text" name="ref_volume" size="10" value="{$row['volume']}"
EOS;

if ($_SESSION['is_admin'] == 2) {
    echo 'readonly';
}

echo <<<EOS
				    >
				</td>
			</tr>
EOS;

## Field 'issue'
echo <<<EOS
			<tr>
				<td width="150" class="td_form_item">{$ref_item['issue'][$cur_lang]}</td>
				<td class="td_form">
				    <input type="text" name="ref_issue" size="10" value="{$row['issue']}"
EOS;

if ($_SESSION['is_admin'] == 2) {
    echo 'readonly';
}

echo <<<EOS
				    >
				</td>
			</tr>
EOS;

## Field 'start page'
echo <<<EOS
			<tr>
				<td width="150" class="td_form_item">{$ref_item['start_page'][$cur_lang]}</td>
				<td class="td_form">
				    <input type="text" name="ref_startpage" size="12" value="{$row['page_start']}"
EOS;

if ($_SESSION['is_admin'] == 2) {
    echo 'readonly';
}

echo <<<EOS
				    >
				</td>
			</tr>
EOS;

echo <<<EOS
			<tr>
				<td width="150" class="td_form_item">{$ref_item['end_page'][$cur_lang]}</td>
				<td class="td_form">
				    <input type="text" name="ref_endpage" size="12" value="{$row['page_end']}"
EOS;

if ($_SESSION['is_admin'] == 2) {
    echo 'readonly';
}

echo <<<EOS
				    >
				</td>
			</tr>
EOS;

## Field 'pmid'
echo <<<EOS
			<tr>
				<td width="150" class="td_form_item">{$ref_item['pmid'][$cur_lang]}</td>
				<td class="td_form">
				    <input type="text" name="ref_pmid" size="10" value="{$row['pmid']}"
EOS;

if ($_SESSION['is_admin'] == 2) {
    echo 'readonly';
}

echo <<<EOS
				    >
				</td>
			</tr>			
			<tr>
				<td width="150" class="td_form">{$ref_item['type'][$cur_lang]}</td>
				<td class="td_form">
				    <select size="1" name="subject" id="sel_subject" onchange="SelMenu(this.selectedIndex);">
				        <option selected value="default">默认</option>
				        <option value="biology">生物学</option>
				        <option value="computer">计算机</option>
				        <option value="chemistry">化学</option>
				        <option value="physics">物理学</option>
				        <option value="literature">文学</option>
				    </select>
				    <select size="1" name="subject_1" id="sel_subject_1">
				        <option value="default" selected>默认</option>
				    </select>&nbsp;
					<font color="blue">{$prompt['no_chg_no_upload'][$cur_lang]}</font>
				</td>
			</tr>

			<tr>
				<td width="150" class="td_form_item">{$ref_item['upload'][$cur_lang]}</td>
				<td class="td_form">
EOS;

# user 'manager'

##

	if ( $row['file_path'] != '' ) {
	echo <<<EOS
    <a href={$row['file_path']} target="_blank">{$prompt['cur_file'][$cur_lang]}
	<img border="0" src="./images/open.png" alt="Open file">
	</a>
	<p />
EOS;
}

echo <<<EOS
				    <input type="file" name="ref_file" size="60">
					<font color="blue">&nbsp;(&lt; 10 M)</font>
				</td>
			</tr>
		</table>
		
		<input type="hidden" name="parent_url" value="{$_SERVER["HTTP_REFERER"]}" >
		
	    <p>
	    <input type="submit" value="{$button['submit'][$cur_lang]}" name="btn_submit">
	    <input type="reset" value="{$button['reset'][$cur_lang]}" name="btn_reset">
	    </p>
		</form>

EOS;
# 更新数据

?>
		</td>
	</tr>
</table>

<script language="javascript">
<!--
// 创建级联选单
//传入参数sel_index: 所选择的上级选单的索引
function SelMenu(sel_index) {

var subMenu, subMenuVal;	//下级菜单项，对应的值
var subMenuItems, subMenuItemsVal;	
var subMenuLength;
var i;	//循环变量
var curSelect, curSelLength;	//当前select对象，长度

subMenu = new Array();
subMenuVal = new Array();

//-------------------------------------------------------------------
// * 建立菜单项
// * 注意一一对应
//-------------------------------------------------------------------
//默认
subMenu[0] = "默认";
subMenuVal[0] = "default";
//生物学
subMenu[1] = "默认|微生物学|环境生物学|生物信息学|分子生物学|生态学|生物化学|植物学|动物学|病毒学|生理学";
subMenuVal[1] = "default|microbiology|environment|bioinfo|mol_biology|ecology|biochemistry|botany|zoology|virology|physiology";
//计算机
subMenu[2] = "默认|硬件|网络|数据库|程序设计(C/C++)|程序设计(Perl)|程序设计(PHP)|程序设计(Java)|程序设计(HTML/XML)";
subMenuVal[2] = "default|hardware|network|database|c|perl|php|java|xml";
//化学
subMenu[3] = "默认|分析化学|有机化学|环境化学|无机化学|物理化学";
subMenuVal[3] = "default|anal_chemistry|org_chemistry|env_chemistry|inorg_chemistry|physcial_chemistry";
//物理学
subMenu[4] = "默认";
subMenuVal[4] = "default";
//文学
subMenu[5] = "默认";
subMenuVal[5] = "default";
//-------------------------------------------------------------------

//解析菜单项
subMenuItems = new Array();
subMenuItemsVal = new Array();

subMenuItems = subMenu[sel_index].split("|");
subMenuItemsVal = subMenuVal[sel_index].split("|");
//清空当前子菜单
//window.alert(document.frm_addData.sel_subject_1.options.length);
//window.alert(subMenuItems);

//curSelect = document.frm_addData.sel_subject_1;
//curSelLength = curSelect.length;
document.frm_addData.sel_subject_1.length = 0;

//for (i=0; i<curSelLength; i++) {
//	curSelect.options.add("");
//}

//子菜单长度
subMenuLength = subMenuItems.length;

for (i=0; i<subMenuLength; i++) {
	document.frm_addData.sel_subject_1.options.add(new Option(subMenuItems[i], subMenuItemsVal[i]));
}

document.frm_addData.sel_subject_1.options[0].selected = true;
}
//-->
</script>
</body>
</html>
