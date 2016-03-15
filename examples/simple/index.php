<?php
	require_once('rosetta.inc.php');

	$file = fopen('english.xml', 'r');
	$xml = fread($file, filesize('english.xml'));
	fclose($file);

	$rosetta = new rosetta(rosetta::makeLanguage($xml));
?>

<html>
	<body>
		<h1><?php echo $rosetta->getString('hello'); ?></h1>
		<p><?php echo $rosetta->getString('goodbye'); ?></p>
	</body>
</html>