<?php
/* =================================================================

用 PCRE 解析 MEDLINE 文本文件

*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
// ================================================================
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
$inserted = 0;

$line_num = 0;
// ===============================================================

/* ===============================================================
* 读文件
* MEDLINE 行格式
PMID- 17925111
DP  - 2007 Oct
PG  - 263-6
TI  - Awareness of Hepatitis C Infection Among Women With and At Risk for HIV.
*/
$f_hander = fopen($_FILES['med_file']['tmp_name'], 'rt') or die ('<br>Cannot open file.</br>');

while (!feof($f_hander)) {
    $line_num++;
    $line = rtrim( fgets($f_hander) );	//读取一行，并除去换行符
	
	if ( $line != '' ) {	// 非空行，进行解析
	    preg_match("/^([A-Z]*)\s*-\s(.*)$/", $line, $match);

        echo '<br>File line: ' . $line_num . '</br>';
        echo '<br>match[0] ' . $match[0] . '</br>';
        echo '<br>match[1] ' . $match[1] . '</br>';
		echo '<br>match[2] ' . $match[2] . '</br>';
		echo '<hr />';
		
        switch ( $match[1] ) {
	        case 'PMID': {	//Pubmed ID
			    $pmid = $match[2];
			    $cur_val = & $pmid;
			    break;
		    }
		    case 'DP': {	//Publish Date
			    $pub_year = substr($match[2], 0, 4);
			    $cur_val = & $pub_year;
			    break;
		    }
		    case 'TI': {	//Title
			    $title = $match[2];
			    $cur_val = & $title;
			    break;
		    }
		    case 'AB': {	//Abstract
			    $abstract = $match[2];
			    $cur_val = & $abstract;
			    break;
		    }
		    case 'AD': {	//Address
			    $address = $match[2];
			    $cur_val = & $address;
			    break;
		    }
		    case 'AU': {	//author
			    $authors = $authors . $match[2] . ';';
			    break;
	        }
		    case 'FAU': {	//author fullname
			    $f_authors = $f_authors . $match[2] . ';';
			    break;
		    }
		    case 'TA': {	//期刊名
			    $journal = $match[2];
			    break;
		    }
		    case 'VI':	//卷
			    $volume = $match[2];
			    break;
		    case 'IP':	//期
			    $issue = $match[2];
			    break;
		    case 'PG':	//页码
			    $pages = $match[2];
			    break;
			case '':	//为空白时
			    $cur_val = $cur_val . $match[2];
			    break;
		    case 'SO': {	//到达段的末尾
			    echo "<br>PMID\t" . $pmid . '</br>';
			    echo "<br>PMID\t" . $pub_year . '</br>';
			    echo "<br>PMID\t" . $title . '</br>';
			    echo "<br>PMID\t" . $abstract . '</br>';
			    echo "<br>PMID\t" . $address . '</br>';
			    echo "<br>PMID\t" . $authors . '</br>';
			    echo "<br>PMID\t" . $f_authors . '</br>';
			    echo "<br>PMID\t" . $journal . '</br>';
			    echo "<br>PMID\t" . $volume . '</br>';
			    echo "<br>PMID\t" . $issue . '</br>';
			    echo "<br>PMID\t" . $pages . '</br>';		
				echo "<hr />";	    
		    }
		}
	}
	
}
?>
</body>
</html>
