<?php
/*--------------------------------------------------------------------
 * FileName:	createdirs.php
 * Version:		0.15
 * Created at:	2005-10-20	0.1
 * Updated at:	2007-10-11	0.15
 * Created by:	刘海舟	longbow0@163.com
 * Description:	创建上传文件夹。文件夹的结构在文件 globalvar.php 的
				数组 $subject_dir 中描述。
--------------------------------------------------------------------*/

require_once ('globalvar.php');

$folder_created = 0;	//创建的文件夹数

echo '<br>Start create folders</br>';

# 创建存储文件的根目录
if (!(file_exists($file_upload_dir))) {
	mkdir($file_upload_dir) or die("<br>CANNOT create folder!</br>");
}

foreach ($subject_dir as $key_0 => $value_0) { # 第一层"键=>键值"对
# $value_0是数组
		if (is_array($value_0)) {
			foreach ($value_0 as $key_1 => $value_1) { # 第二层"键=>键值" 对
				if ($key_1 == 'base') { # 表示此键值是该目录的'根'，如果不存在，需要建立
					$dir_name = $file_upload_dir . $value_0['base'];
					if (!(file_exists($dir_name))) {
						if (mkdir($dir_name)) {
							echo '<br>Folder ', $dir_name, ' created.</br>';
							$folder_created++;
						}
					}
				}
				else {
					$dir_name = $file_upload_dir . $value_0['base'] . $value_1;
					if (!(file_exists($dir_name))) {
						if (mkdir($dir_name)) {
							echo '<br>Folder ', $dir_name, ' created.</br>';
							$folder_created++;
						}
						else 
							echo '<br>Error: Cannot create folder!</br>';
					}
				}
			}
		}
# $value_0不是数组
		else {
			$dir_name = $file_upload_dir . $value_0;
			if (!(file_exists($dir_name))) {
				if (mkdir($dir_name)) {
					echo '<br>Folder ', $dir_name, ' created.</br>';
					$folder_created++;	
				}
				else {
					echo '<br>Error: Cannot create folder!</br>';
				}
			}
/*			else {
				echo '<br>Folder ', $dir_name, ' already exists.</br>';
			}
*/
		}
}

echo '<br>', $folder_created, ' folder(s) created</br>';

# 跳转回index.html
echo '<script language="javascript">';

echo 'function JumpPage() {';
echo 'document.location.href="index.html";';
echo '}';

echo 'window.setTimeout("JumpPage();",2*1000);';
echo '</script>';

?>