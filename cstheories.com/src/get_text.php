<?php
	function read_data_file() {
		//$file_name = 'files//';
		$file_name = $_GET['file'];
		//$file_name .= '.html';
		echo file_get_contents($file_name,"dp");
		//echo $file_name;
	}
	
	if (isset($_GET['get_data'])) {
		read_data_file();
	}
?>
