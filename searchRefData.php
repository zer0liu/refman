<?php
session_start();

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
<title>Search reference</title>
<link rel=stylesheet href="./images/style.css">
</head>

<body>


<table id="tbl_container" class="tbl_container">
	<tr  class="tr_title">
		<td >
			<img src="images/item.GIF" />
<?php
    echo $page_title['search'][$cur_lang];
?>
		</td>
	</tr>
	<tr>
	<td>
		<form name="search_data" method="post" action="dispRefData.php?cmd=search">
					
		<div align="left">
			<table class="form" id="tbl_search" width="110">
				<tr>
					<td class="td_form">
<?php
echo <<<EOS
						<select size="1" name="query_1">
						<option value="title" selected>{$ref_item['title'][$cur_lang]}</option>
						<option value="authors">{$ref_item['authors'][$cur_lang]}</option>
						<option value="abstract">{$ref_item['abstract'][$cur_lang]}</option>
						<option value="keywords">{$ref_item['keywords'][$cur_lang]}</option>
						<option value="journal">{$ref_item['journal'][$cur_lang]}</option>
						<option value="pub_year">{$ref_item['date'][$cur_lang]}</option>
						<option value="pmid">{$ref_item['pmid'][$cur_lang]}</option>
						</select>
EOS;
?>
					</td>
				    <td class="td_form">
						<input type="text" name="query_value_1" size="80">
					</td>
				</tr>
				<tr>
					<td class="td_form">
<?php
echo <<<EOS
						<select size="1" name="query_2">
						<option value="title" selected>{$ref_item['title'][$cur_lang]}</option>
						<option value="authors">{$ref_item['authors'][$cur_lang]}</option>
						<option value="abstract">{$ref_item['abstract'][$cur_lang]}</option>
						<option value="keywords">{$ref_item['keywords'][$cur_lang]}</option>
						<option value="journal">{$ref_item['journal'][$cur_lang]}</option>
						<option value="pub_year">{$ref_item['date'][$cur_lang]}</option>
						<option value="pmid">{$ref_item['pmid'][$cur_lang]}</option>
						</select>
EOS;
?>
					</td>
					<td class="td_form">
						<input type="text" name="query_value_2" size="80">
					</td>
				</tr>
				<tr>
					<td class="td_form">
<?php
echo <<<EOS
						<select size="1" name="query_3">
						<option value="title" selected>{$ref_item['title'][$cur_lang]}</option>
						<option value="authors">{$ref_item['authors'][$cur_lang]}</option>
						<option value="abstract">{$ref_item['abstract'][$cur_lang]}</option>
						<option value="keywords">{$ref_item['keywords'][$cur_lang]}</option>
						<option value="journal">{$ref_item['journal'][$cur_lang]}</option>
						<option value="pub_year">{$ref_item['date'][$cur_lang]}</option>
						<option value="pmid">{$ref_item['pmid'][$cur_lang]}</option>
						</select>
EOS;
?>
					</td>
				    <td class="td_form">
						<input type="text" name="query_value_3" size="80">
					</td>
				</tr>
				<tr>
					<td class="td_form_item">
<?php
    echo $ref_item['orderby'][$cur_lang];
?>
					</td>
					<td class="td_form">
<?php
echo <<<EOS
						<select size="1" name="query_orderby">
						<option value="title" selected>{$ref_item['title'][$cur_lang]}</option>
						<option value="authors">{$ref_item['authors'][$cur_lang]}</option>
						<option value="abstract">{$ref_item['abstract'][$cur_lang]}</option>
						<option value="keywords">{$ref_item['keywords'][$cur_lang]}</option>
						<option value="journal">{$ref_item['journal'][$cur_lang]}</option>
						<option value="pub_year">{$ref_item['date'][$cur_lang]}</option>
						<option value="pmid">{$ref_item['pmid'][$cur_lang]}</option>
						</select>
EOS;
?>
					</td>								
				</tr>
			</table>
		</div>
					
		<p>
<?php
echo <<<EOS
		    <input type="submit" value="{$button['submit'][$cur_lang]}" name="btn_submit">
		    <input type="reset" value="{$button['reset'][$cur_lang]}" name="btn_reset"></p>
EOS;
?>
		    </form>
		</td>
	</tr>
</table>


</body>

</html>