<?php
$kasuj = 0; #jezeli chcesz tylko informacje o zakazonych plikach, bez usuwania iframe ustaw na 0
$folder = '.'; #wpisz tutaj nazwe przeszukiwanego folderu, kropka onacza wszystkie foldery
$debug = FALSE;
$pattern="/iframe/";
$password = 'Qwerty!23456';

function findPattern ($pattern, $filename){
	$contents=@file_get_contents($filename);
	//echo "<textarea>".$contents."</textarea>";
	$ncontents=preg_replace($pattern, "", $contents, -1, $count);
	if($count != 0) {
		echo $pattern." test: <b id=pattern>ERROR</b><br/>";
	} else {
			echo $pattern." test: <b id=pattern>OK</b><br/>";
	}
}

function findJS ($filename){
	//echo "function JS, filename:".$filename."<br>";
	$contents=@file_get_contents($filename);	
	//echo "<textarea>".$contents."</textarea>";
	$jsCount = substr_count($contents, 'javascript');
	return $jsCount;
}

function CountFolders($dir) {

    if($dh = opendir($dir)) {

        $files = Array();
        $inner_files = Array();
        $count = 0;
        

        while($file = readdir($dh)) {
            if($file != "." && $file != ".." && $file[0] != '.') {
                if(is_dir($dir . "/" . $file)) {
                	//$countDir++;
                	array_push($files, $dir . "/" . $file);
                    $inner_files = CountFolders($dir . "/" . $file);
                    if(is_array($inner_files)) $files = array_merge($files, $inner_files); 
                } 
            }
        }

        closedir($dh);
        return $files;
        
    }
}

//echo md5($password);

if (isset($_GET['pass'])){
	if (($_GET['pass'])==md5($password)){
		if ($_GET['action']=='folders'){

			$files = CountFolders($folder);	
			$countDir = 0;
						
			foreach ($files as $key=>$file){
	    		$countDir++;
			}
			
			echo "Znaleziono: <b id=dirCount>".$countDir."</b> folderow.<br/>";
		}
		
		if ($_GET['action']=='fSize'){
		
			if (!isset($_GET['filename'])) { $filename = 'index.php'; }
			else { $filename = $_GET['filename'];}
			
			echo "Wielkosc: <b id=size>".filesize($filename)."</b> bytes.<br/>";
		}
		
		if ($_GET['action']=='pattern'){
			if (!isset($_GET['filename'])) { $filename = 'index.php'; }
			else { $filename = $_GET['filename'];}
			
			findPattern ($pattern, $filename);
		}
		
		if ($_GET['action']=='js'){
			$filename = 'index.php';
			$js = findJS ($filename);
			echo "JS: <b id=size>".$js."</b><br/>";
		}
		
	} else { echo "Brak autoryzacji"; }
} else { echo "Brak uprawnien!"; }




?>