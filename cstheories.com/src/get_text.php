<?php
	function read_data_file() {
		//$file_name = 'files//';
		$file_name = $_GET['file'];
		//$file_name .= '.html';
		echo file_get_contents($file_name,"dp");
		echo $file_name;
	}
	
	function listFolderFiles($dir){
		$ffs = scandir($dir);

		unset($ffs[array_search('.', $ffs, true)]);
		unset($ffs[array_search('..', $ffs, true)]);

		// prevent empty ordered elements
		if (count($ffs) < 1)
			return;
		foreach($ffs as $ff){
			if(is_dir($dir.'/'.$ff)) 	{
				echo '<a href=#'.$ff.' class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">'.$ff.'<i class="fa fa-caret-down"></i></a>';
				echo '<div class="collapse" id='.$ff.'>';
				//echo '<li>Folder:'.$ff;
				listFolderFiles($dir.'/'.$ff);
				echo '</div>';
			}else	{
				//echo 'File:'.strstr($ff,".html",true).'</li>';
				$pos = strpos($ff, ".html");
				if($pos === false)
					continue;
				echo '<div id="menuitems"><a href="#'.$dir.'/'. strstr($ff,".html",true).'" class="list-group-item">'. strstr($ff,".html",true).'</a></div>';
			}
		}
	}
	$action = $_GET['action'];
	switch ($action) {
		case "read_data_file":
			//call the function
			read_data_file();
			break;
		case "listFolderFiles":
			listFolderFiles($dir);
			break;
	}
?>
