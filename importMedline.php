<?php
session_start();
/*--------------------------------------------------------------------
 * Filename:	importMedline.php
 * Created at:	2005-10-20	0.1
 * Updated at:	2007-10-11	0.15
 *              2007-11-24	0.20
 *              2007-12-06      0.30 Add a new textarea for input.
 * Created by:		longbow0@163.com
 * Description:	import Medline format text file.
-
*/
require_once("globalvar.php");
require_once("language.php");

if ( isset( $_SESSION['lang'] ) ) {
    $cur_lang = $_SESSION['lang'];
}
?>
<html>

<head>
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<title>RefMan: Import Medline Data</title>
<link rel=stylesheet href="./images/style.css">

<script language="javascript">
function formFileCheck() {
    if (document.form_import_medline_file.med_file.value == "") {
        alert("Please input file name!");
    return false;
    }
}
function formTextCheck() {
    if (document.form_import_medline_text.content.value == "") {
	alert("Please input content!");
    return false;
    }
}
</script>

</head>

<body>

<table id="tbl_container" class="container">
	<tr  class="tr_title">
		<td >
			<img src="images/item.GIF" />
<?php
echo $page_title['import'][$cur_lang];
?>
		</td>
	</tr>
	<tr>
	    <td>
		<ul>
		<li>
		    <h2>
<?php
echo $prompt['import_medline_help'][$cur_lang];
?>
	    
	    <a href="medlineHelp.php" target="_blank">
		<img border="0" src="images/help.gif" />
	    </a>
		    </h2>
		</li>
		</ul>
	    </td>
	</tr>
	<tr>
	    <td>
		<form name="form_import_medline_file" method="post" action="exeImportMedline.php" enctype="multipart/form-data" class="addrec" onSubmit="return formFileCheck()">
			<table class="form" width="100%">
				<tr>
				    <td class="td_form"><h3> 
					<ul>
					<li>
<?php
echo $prompt['import_medline_file'][$cur_lang];
?>
					</li>
					</ul>
                                    </h3> 
				    </td>
				</tr>
				<tr>
				    <td class="td_form">
					<br />
					<input type="file" name="med_file" size="60">
					<br />
					</td>
				</tr>
			</table>
					<p>
<?php
echo <<<EOS
					<input type="submit" value="{$button['submit'][$cur_lang]}" name="btn_submit">
					<input type="reset" value="{$button['reset'][$cur_lang]}" name="btn_reset">
EOS;
?>
					</p>
				</form>
			
			</td>
			</tr>

			<tr>
			    <td>
			        <hr />
			    </td>
			</tr>
			<tr>
			    <td class="td_from"><h3>
				<ul><li>
<?php
echo $prompt['import_medline_text'][$cur_lang];
?>
				</li></ul>
			    </h3>
			        <form name="form_import_medline_text" method="post" action="exeImportMedline.php" enctype="multipart/form-data" class="addrec" onSubmit="return formTextCheck()">
				<textarea name="content" cols="80" rows="15"></textarea>
				<br />
				<br />
<?php				
echo <<<EOS
				<input type="submit" value="{$button['submit'][$cur_lang]}" name="btn_submit" />
				<input type="reset" value="{$button['reset'][$cur_lang]}" name="btn_reset" />
EOS;
?>
				</form>
			    </td>
			</tr>
			<tr>
			    <td>
				<hr />
			    </td>
			</tr>
<!--			
			<tr>
			    <td>
			        <img src="images/medline.gif"></img>
			    </td>
			</tr>
-->			
		</table>
</body>

</html>
