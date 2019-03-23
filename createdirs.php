<?php
/*--------------------------------------------------------------------
 * FileName:	createdirs.php
 * Version:		0.15
 * Created at:	2005-10-20	0.1
 * Updated at:	2007-10-11	0.15
 * Created by:	������	longbow0@163.com
 * Description:	�����ϴ��ļ��С��ļ��еĽṹ���ļ� globalvar.php ��
				���� $subject_dir ��������
--------------------------------------------------------------------*/

require_once ('globalvar.php');

$folder_created = 0;	//�������ļ�����

echo '<br>Start create folders</br>';

# �����洢�ļ��ĸ�Ŀ¼
if (!(file_exists($file_upload_dir))) {
	mkdir($file_upload_dir) or die("<br>CANNOT create folder!</br>");
}

foreach ($subject_dir as $key_0 => $value_0) { # ��һ��"��=>��ֵ"��
# $value_0������
		if (is_array($value_0)) {
			foreach ($value_0 as $key_1 => $value_1) { # �ڶ���"��=>��ֵ" ��
				if ($key_1 == 'base') { # ��ʾ�˼�ֵ�Ǹ�Ŀ¼��'��'����������ڣ���Ҫ����
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
# $value_0��������
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

# ��ת��index.html
echo '<script language="javascript">';

echo 'function JumpPage() {';
echo 'document.location.href="index.html";';
echo '}';

echo 'window.setTimeout("JumpPage();",2*1000);';
echo '</script>';

?>