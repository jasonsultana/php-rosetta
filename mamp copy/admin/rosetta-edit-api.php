<?php
	session_start();
	//TODO: Nonce check

	$eleID = $_POST['id'];
	$eleVal = $_POST['val'];
	$dict = $_POST['dict'];

	$configUrl = dirname(__FILE__) . '/rosetta-config.php';
	if(file_exists($configUrl))
		require $configUrl;
	else
		die("CONFIG URL NOT FOUND");

	$files = scandir(ROSETTA_DICT_PATH);
	foreach($files as $file) {

		if($file == "." || $file == ".." || $file[0] == ".")
			continue;

		$xml = simplexml_load_file(ROSETTA_DICT_PATH . $file);
		$guid = $xml->xpath('/codex/metadata/guid');

		//echo $guid[0][0] . "<br/>";

		if($guid[0][0] == $dict) {
			$string = $xml->xpath('/codex/strings/string[@id = "' . $eleID . '"]');            
			$string[0][0]= $eleVal;

			if($xml->asXML(ROSETTA_DICT_PATH . $file))
				die("OK");
			else
				die("CANT UPDATE FILE");
		} 
	}

	die("MATCHING DICTIONARY FILE NOT FOUND");