<?php
session_start();
/* =================================================================
 * Filename:	dispRefData.php
 * Description: 显示文件记录或者查询结果
 * Author:	zeroliu
 * Version:
	0.2 2007-12-07: enhanced account management
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
<title>Browse reference data</title>

<link rel=stylesheet href="./images/style.css">
</head>

<?php
# ==================================================================
##
## Init database connection
##
# 连接数据库
$dblink = mysql_connect($host, $user, $pass) or die ('<br>无法连接数据库' . mysql_error() . '</br>');

mysql_select_db('refman') or die('<br>' . mysql_error() . '</br>');
				
# 构造查询形式:
# dispData.php?cmd=browse(&page=xxx) -- 浏览模式
# 或
# dispData.php?cmd=search(&page=xxx)&journal=xxx&title=xxx -- 查询模式

if ($_GET['cmd'] == 'browse') {	// 浏览模式
	$where_clause = 'WHERE 1';
	$orderby = 'id';
}
elseif ($_GET['cmd'] == 'search') {	// 查询模式
# *** 构造查询语句
	$orderby = $_POST['query_orderby'];
					
	$where_clause = 'WHERE ';
					
//-------------------------------------------------------------------
	if ($_POST['query_value_1'] != '') {	//条件1设置
		$where_clause = $where_clause . $_POST['query_1'] . ' LIKE \'%' . $_POST['query_value_1'] . '%\'';
	}

//-------------------------------------------------------------------
	if ($_POST['query_value_2'] != '') {	//如果条件2设置
		if ($_POST['query_value_1'] != '') {	//如果条件1设置, 加'AND'
			$where_clause = $where_clause . ' AND ' . $_POST['query_2'] . ' LIKE \'%' . $_POST['query_value_2'] . '%\'';
	}
	else {
		$where_clause = $where_clause . $_POST['query_2'] . ' LIKE \'%' . $_POST['query_value_2'] . '%\'';
		}
    }

//-------------------------------------------------------------------
	if ($_POST['query_value_3'] != '') {	//条件3设置
		if (($_POST['query_value_1'] == '') && ($_POST['query_value_2'] == '')) {
//条件1, 2未设置
			$where_clause = $where_clause . $_POST['query_3'] . ' LIKE \'%' . $_POST['query_value_3'] . '%\'';
		}
		else {
//条件1, 2不全为空
			$where_clause = $where_clause . ' AND ' . $_POST['query_3'] . ' LIKE \'%' . $_POST['query_value_3'] . '%\'';
		}
	}

}
				
# DEBUG
# echo '<script language="javascript">';
# echo 'alert("' . $where_clause . '");';
# echo '</script >';

# 获取当前页面编号
if (isset($_GET['page']))
	$cur_page = intval($_GET['page']);	
else
	$cur_page = 1;
				
# 获取结果数量
$sqlstr = 'SELECT count(*) as total_rec from tbl_ref ' . $where_clause;

$result = mysql_query($sqlstr) or die('<br>' . mysql_error() . '</br>');

$row = mysql_fetch_array($result);

$total_rec = $row['total_rec'];
				
# 计算总页面数$page_no
if ($total_rec) {
	if ($total_rec < $page_size)	// 只有一页
		$page_no = 1;
    else {
	    if ($total_rec % $page_size)
		    $page_no = (int)($total_rec / $page_size) + 1; //有余数
	    else
		    $page_no = $total_rec / $page_size;	//没有余数
	    } 
}
else {	//没有结果
	$page_no = 0;	
}

?>

<body>
<table name="tbl_container" id="tbl_container" class="tbl_container">
  <tr class="tr_title">
    <td>
	    <img src="images/item.GIF" /> 
<?php
echo $page_title['browse'][$cur_lang];
?>
	</td>
  </tr>
<!--
显示顶部记录信息。
Dsiplay record, page information and http link on TOP
-->  
  <tr>
    <td>
<?php	
        require("dispRefPage.php");
?>		
	</td>
  </tr>
<!--

-->  
  <tr>
    <td>
<?php
if ($total_rec) {

	$sql_str = 'SELECT id, authors, title, journal, pub_year, file_path FROM tbl_ref ' .$where_clause. ' ORDER BY ' . $orderby . ' LIMIT ' . ($cur_page - 1) * $page_size . ', ' . $page_size . ';';

	$result = mysql_query($sql_str) or die('<br>' . mysql_error() . '</br>');
	
echo <<<EOS
<table  class="query"  id="tbl_dispData" name="" >
	<tr class="query_head" align="center">
EOS;

    if ( isset($_SESSION['is_admin']) && ( $_SESSION['is_admin'] == 1 ) ) { # user 'admin'
	
echo <<<EOS
		<td class="td_query" width="2%"></td>
		<td class="td_query" width="2%"></td>
EOS;
    }
    else if (isset($_SESSION['is_admin']) && ( $_SESSION['is_admin'] == 2 ) ) { # user 'manager'
echo <<<EOS
    <td class="td_query" width="4%"></td>
EOS;
    }

echo <<<EOS
                <td class="td_query" width="5%">{$ref_item['id'][$cur_lang]}</td>
		<td class="td_query" width="22%">{$ref_item['authors'][$cur_lang]}</td>
		<td class="td_query" width="40%">{$ref_item['title'][$cur_lang]}</td>
		<td class="td_query" width="20%">{$ref_item['journal'][$cur_lang]}</td>
		<td class="td_query" width="5%">{$ref_item['date'][$cur_lang]}</td>
		<td class="td_query" width="4%">{$ref_item['file_url'][$cur_lang]}</td>
	</tr>
EOS;

    while ($row = mysql_fetch_array($result)) {
	    echo '<tr>';
	
	    if ( isset($_SESSION['is_admin']) && ( $_SESSION['is_admin'] == 1 ) ) { # user 'admin'

echo <<<EOS
<!-- 编辑记录 -->
		<td class="td_query" width="2%">
		    <a href="./editRefRec.php?id={$row['id']}">
			    <img border="0" src="./images/edit.png" alt="Edit">
			</a>
		</td>
<!-- 删除记录 -->
		<td class="td_query" width="2%">
		    <a href="./delRefRec.php?id={$row['id']}">
			    <img border="0" src="./images/del.png" alt="Delete">
			</a>
		</td>
EOS;
        }
	    else if ( isset($_SESSION['is_admin']) && ( $_SESSION['is_admin'] == 2 )) { # user 'manager'
echo <<<EOS
<!-- 编辑记录 -->
		<td class="td_query" width="4%">
		    <a href="./editRefRec.php?id={$row['id']}">
			<img border="0" src="./images/edit.png" alt="Edit">
		    </a>
		</td>
EOS;
	    }

	echo <<<EOS

                <td class="td_query" align="right" width="5%">{$row['id']}</td>
		<td class="td_query" width="22%">{$row['authors']}</td>
		<td class="td_query" width="40%">
	    <a href="./dispRefRec.php?id={$row['id']}" target="_blank">{$row['title']}</a>
		</td>
		<td class="td_query"  width="20%">{$row['journal']}</td>
		<td class="td_query" align="center"  width="5%">{$row['pub_year']}</td>
		<td class="td_query" align="center"  width="4%">
EOS;

if ( $row['file_path'] != '' ) {
echo <<<EOS
            <a href="{$row['file_path']}"  target="_blank">
		    <img border="0" src="images/open.png" />
			</a>
EOS;
}

echo <<<EOS
		</td>
	</tr>
EOS;
    }
					
echo '</table>';	//表格结束
}
else {
    echo $error['no_result'][$cur_lan];
/*
    switch ($cur_lan) {
	    case 'eng':
		    echo $error['no_result']['eng'];
			break;
		case 'chn':
		    echo $error['no_result']['chn'];
			break;
	}
*/
}
?>
	</td>
  </tr>
<!--
显示底部记录信息。
Dsiplay record, page information and http link on BOTTOM
-->  
  <tr>
    <td>
<?php	
        require("dispRefPage.php");
?>		
	</td>
  </tr>
</table>
</body>
</html>
