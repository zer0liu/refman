<?php
#*--------------------------------------------------------------------
#* FileName: global.php													
#* Create date: 2005-10-17
#* Description: ȫֱ
#---------------------------------------------------------------------

# Default user for browser
$user = 'ref_guest';
$pass = '';

# Server
$host = 'localhost';

# Default interface language
$cur_lang = 'chn';

# Display records per page
$page_size = 20;

# File upload directory
$file_upload_dir = './articles/';
# $file_upload_dir = '/data/articles/';

# Sub directory

# Structure of sub-directory
$subject_dir = array (
	'default' => 'default/',
	'biology' => array (
					'base' => 'biol/',
					'default' => 'default/',
					'microbiology' => 'microbiol/',
					'biochemistry' => 'biochem/',
					'botany' => 'botany/',
					'zoology' => 'zoology/',
					'mol_biology' => 'molbiol/',
					'virology' => 'virol/',
					'physiology' => 'physiol/',
					'environment' => 'environ/',
					'bioinfo' => 'bioinfo/',
					'ecology' => 'ecology/'
				),
	'computer' => array (
					'base' => 'compute/',
					'default' => 'default/',
					'hardware' => 'hardware/',
					'network' => 'network/',
					'database' => 'database/',
					'c' => 'c/',
					'perl' => 'perl/',
					'php' => 'php/',
					'java' => 'java/',
					'xml' => 'xml/'
				),
	'literature' => array (
					'base' => 'litera/',
					'default' => 'default/'
				),
	'chemistry' => array (
					'base' => 'chem/',
					'default' => 'default/',
					'anal_chemistry' => 'analchem/',
					'org_chemistry' => 'orgchem/',
					'inorg_chemistry' => 'inorgchem/',
					'env_chemistry' => 'envchem/',
					'physical_chemistry' => 'phychem/'
				),
	'physics' => array (
					'base' => 'physics/',
					'default' => 'default/'
				)
);
?>
