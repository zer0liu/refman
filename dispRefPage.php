<?php
/*
 * Filename:	dispRefPage.php
 * Description:
    This file is a part of `dispRefData.php`.
    It perform the treatment of a table about pages control of breows/search result
 * Author:	zeroliu
 * Versio:
    0.1	2007-12-07
*/

/*
Text variables for output
*/

/* =================================================================

switch ($cur_lan) {
    case 'chn':
	    {
	        $info_total_rec = $result_info['total_rec']['chn'];
			$info_pages = $result_info['pages']['chn'];
			$info_pre = $result_info['pre']['chn'];
			$info_next = $result_info['next']['chn'];
			$info_front = $result_info['front']['chn'];
			$info_end = $result_info['end']['chn'];
		}
		break;
	case 'eng':
	    {
	        $info_total_rec = $result_info['total_rec']['eng'];
			$info_pages = $result_info['pages']['eng'];
			$info_pre = $result_info['pre']['eng'];
			$info_next = $result_info['next']['eng'];
			$info_front = $result_info['front']['eng'];
			$info_end = $result_info['end']['eng'];		
		}
		break;
}
*/

$info_total_rec = $result_info['total_rec'][$cur_lang];
$info_pages = $result_info['pages'][$cur_lang];
$info_pre = $result_info['pre'][$cur_lang];
$info_next = $result_info['next'][$cur_lang];
$info_front = $result_info['front'][$cur_lang];
$info_end = $result_info['end'][$cur_lang];

if ( (!isset($pre_page)) && (!isset($next_page)) ) {
    $pre_page = $cur_page-1;
    $next_page = $cur_page+1;
}
# ================================================================
echo <<<EOS
					
<table width="100%" class="disp_page">
    <tr>
		<td width="56%"></td>
        <td width="20%">
		    $info_total_rec $total_rec $info_pages $cur_page/$page_no 
		</td>
EOS;

if (($cur_page == 1) && ($total_rec <= $page_size)) {	//为第一页，且总记录数小于每页显示记录数时

echo <<<EOS
		<td width="6%"></td>
		<td width="6%"></td>
		<td width="6%"></td>
		<td width="6%"></td>
EOS;
}
elseif ($cur_page == 1) {	//为第一页时，显示指向下一页的链接

echo <<<EOS

		<td width="6%"></td>
		<td width="6%"></td>
		<td width="6%">
		    <a href="dispRefData.php?cmd=browse&page=$next_page">
			$info_next
			<!--
			    <img border="0" src="./images/next.GIF" alt="$info_next">
			-->
			</a>
		</td>
		<td width="6%">
		    <a href="dispRefData.php?cmd=browse&page=$page_no">
			$info_end
			<!--
			    <img border="0" src="./images/end.GIF" alt="$info_end">
			-->
			</a>
		</td>
EOS;
} //
elseif ($cur_page == $page_no) {	//已到结尾处
echo <<<EOS

		<td width="6%">
		    <a href="dispRefData.php?cmd=browse&page=1">$info_front
			<!--
			    <img border="0" src="./images/start.GIF" alt="$info_front">
			-->
			</a>
		</td>
		<td width="6%">
		    <a href="dispRefData.php?cmd=browse&page=$pre_page">$info_pre
			<!--
			    <img border="0" src="./images/pre.GIF" alt="$info_pre">
			-->
			</a>
		</td>
		<td width="6%"></td>
		<td width="6%"></td>
EOS;
}
else {
	
echo <<<EOS

		<td width="6%">
		    <a href="dispRefData.php?cmd=browse&page=1">$info_front
			<!--
			    <img border="0" src="./images/start.GIF" alt="$info_front">
			-->
			</a>
		</td>
		<td width="6%">
		    <a href="dispRefData.php?cmd=browse&page=$pre_page">$info_pre
			<!--
			    <img border="0" src="./images/pre.GIF" 	alt="$info_pre">
			-->
			</a>
		</td>
		<td width="6%">
		    <a href="dispRefData.php?cmd=browse&page=$next_page">$info_next
			<!--
			    <img border="0" src="./images/next.GIF" alt="$info_next">
			-->
			</a>
		</td>
		<td width="6%">
		    <a href="dispRefData.php?cmd=browse&page=$page_no">$info_end
			<!--
			    <img border="0" src="./images/end.GIF" alt="$info_end">
			-->
			</a>
		</td>
EOS;
}
echo '</tr></table>';
?>
