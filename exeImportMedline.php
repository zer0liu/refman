<?php
session_start();
/*--------------------------------------------------------------------
 * FileName:	exeImportMedlineTest.php
 * Version:		0.15
 * Created at:	2005-10-20	0.1
 * Updated at:	2007-10-11	0.15
 *              2007-12-06	0.20
 * Created by:	刘海舟	longbow0@163.com
 * Description:	import Medline format text file.
*/
require_once("globalvar.php");
require_once("language.php");

if ( isset( $_SESSION['lang'] ) ) {
    $cur_lang = $_SESSION['lang'];
}

# Not administer, retur
if ( !( isset($_SESSION['is_admin']) ) || ( $_SESSION['is_admin'] == '' )) 
    return;

$user = $_SESSION['admin'];
$pass = $_SESSION['pass'];

function getpage($pages) {	//将MEDLINE的xxx - xx形式的页码转换成array('xxx', 'xxx')
	if ($pages == '')
		return array('', '');

	$split_pos = strpos($pages, '-');	//取得'-'的位置

	$page_1 = substr($pages, 0, $split_pos);
	$page_2_0 = substr($pages, $split_pos+1);

	$page_2 = substr($page_1, 0, strlen($page_1)-strlen($page_2_0)) . $page_2_0;

	return array($page_1, $page_2);
}

$pmid = '';
$pub_year = '';
$title = '';
$abstract ='';
$address = '';
$authors = '';
$f_authors = '';
$journal = '';
$volume = '';
$issue = '';
$pages = '';
$cur_val = '';

$total_rec_num = 0;
$inserted_num = 0;
$flag_rec_exist = false;
$rec_exist_num = 0;

# $dblink = mysql_connect('localhost', 'root', '') or die('<br>无法连接数据库' . mysql_error() . '</br>');
$dblink = mysql_connect($host, $user, $pass) or die('<br>无法连接数据库' . mysql_error() . '</br>');

mysql_select_db('refman') or die('<br>' . mysql_error() . '</br>');

## Open file
# if ($_FILES['med_file']['name'] == '') die('<br>请输入文件名！</br>');

if ($_FILES['med_file']['tmp_name'] != '') {    # input a file
    $f_hander = fopen($_FILES['med_file']['tmp_name'], 'rt') or die ('<br>Cannot open file.</br>');
}
else if ($_POST['content'] != '') {    # input texts
    $fp = fopen("_tempref", "w") or die("Cannot write to file '_tempref'!\n");
    fwrite($fp, $_POST['content']);
    fclose($fp);

    $f_hander = fopen("_tempref", "rt") or die('<br>Cannot open file.</br>');
}
else {
    die ("<br>Wrong uploaded file or text.</br>");
}

while (!feof($f_hander)) {

	$row = fgets($f_hander);	//读取一行

	$rkey = trim(substr($row, 0, 4));	//前四个字符

	switch ($rkey) {
		case 'PMID': {	//Pubmed I
                        $total_rec_num++;
			$pmid = trim(substr($row, 6));
			
			$sqlstr = "SELECT id FROM `tbl_ref` WHERE pmid='{$pmid}'";
	
	        $result = mysql_query($sqlstr) or die('<br>' . mysql_error() . '</br>');
			
			if ( mysql_num_rows($result) != 0 ) {	// Reference already EXISTS
			    $rec_exist_num++;
				$flag_rec_exist = true;;
			}
			
			$cur_val = & $pmid;
			break;
		}
		case 'DP': {	//Publish Date
			$pub_year = substr($row, 6, 4);
			$cur_val = & $pub_year;
			break;
		}
		case 'TI': {	//Title
			$title = substr($row, 6);
			$cur_val = & $title;
			break;
		}
		case 'AB': {	//Abstract
			$abstract = substr($row, 6);
			$cur_val = & $abstract;
			break;
		}
		case 'AD': {	//Address
			$address = substr($row, 6);
			$cur_val = & $address;
			break;
		}
		case 'AU': {	//author
			$authors = $authors . substr($row, 6) . ';';
			break;
		}
		case 'FAU': {	//author fullname
			$f_authors = $f_authors . substr($row, 6) . ';';
			break;
		}
		case 'TA': {	//期刊名
			$journal = substr($row, 6);
			break;
		}
		case 'VI':	//卷
			$volume = substr($row, 6);
			break;
		case 'IP':	//期
			$issue = substr($row, 6);
			break;
		case 'PG':	//页码
			$pages = trim(substr($row, 6));
			break;
		case '':	//为空白时
			$cur_val = $cur_val . substr($row, 6);
			break;
		case 'SO': {	//到达段的末尾
		//开始写入数据库
			if ( $flag_rec_exist ) {
			    $flag_rec_exist = false;
			    continue;
			}
			
			$f_authors = trim($f_authors, ';');

			$whole_page = array();

			$whole_page = getpage($pages);

             $sqlstr = "
			        INSERT INTO `tbl_ref` SET 
				        pmid='{$pmid}', 
					    pub_year='{$pub_year}', 
					    title='" . addslashes($title) . "', 
					    abstract='" . addslashes($abstract) . "',
					    authors='" . addslashes($authors) . "',
					    address='" . addslashes($address) . "',
					    journal='" . addslashes($journal) . "',
					    volume='{$volume}',
					    issue='" . addslashes($issue) ."',
					    page_start='{$whole_page[0]}',
					    page_end='{$whole_page[1]}'
                ";
			
			mysql_query($sqlstr) or die('<br>写入数据错误' . mysql_error() . '</br>');;
		
		//写入完毕，初始化参数
			$pmid = '';
			$pub_year = '';
			$title = '';
			$abstract ='';
			$address = '';
			$authors = '';
			$f_authors = '';
			$journal = '';
			$volume = '';
			$issue = '';
			$pages = '';

			$inserted_num++;
		}
		default:	//其他，继续
			continue;
	}
}

fclose($f_hander);

// if ( $inserted_num != 0 ) {
echo '<script language="javascript">';
echo 'window.alert("' . $prompt['total_rec'][$cur_lang] . $total_rec_num . '\n' . $prompt['insert_rec_success'][$cur_lang] . $inserted_num . '\n' . $rec_exist_num . ' ' . $prompt['rec_exist'][$cur_lang] . '");';
#\n{$rec_exist_num}{$prompt['rec_exist'][$cur_lang]}");
echo 'document.location.href="importMedline.php";';
echo '</script >';
EOS;
//}
/*
elseif {
    echo '<script language="javascript">';
	echo 'window.alert("' . $prompt['insert_rec_err'][$cur_lang] . '");';
	echo 'document.location.href="importMedline.php";';
	echo '</script >';
}
*/

?>
