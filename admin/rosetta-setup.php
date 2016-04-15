<?php    
	//http://stackoverflow.com/questions/15983782/replacing-single-backslashes-with-double-backslashes-in-php
	function doubleSlashes($input) {
		//Need to use \\ so it ends up being \
		$fileArray = explode("\\", $input);

		//take the first one off the array
		$file = array_shift($fileArray);

		//go thru the rest of the array and add \\\\ then the next folder
		foreach($fileArray as $folder){
			$file .= "\\\\" . $folder;
		}

		return $file;
	}
	
    session_start();

    $configUrl = dirname(__FILE__) . '/rosetta-config.php';

    if(array_key_exists('isLoggedIn', $_SESSION)) {
        if($_SESSION['isLoggedIn'] == "true") {
            if(isset($_GET['reset'])) {
                if(file_exists($configUrl))
                    unlink($configUrl);
            }
        }
    }

    if(file_exists($configUrl)) {
        //redirect to the login page
        header("location: rosetta-login.php");
    }
	
    if(isset($_POST['submit'])) {
		$_POST['dictpath'] = doubleSlashes($_POST['dictpath']);
	
        $f = fopen('rosetta-config.php', 'w');
        fwrite($f, "<?php
                    define('ROSETTA_USERNAME', '{$_POST['uname']}');
                    define('ROSETTA_PASSWORD', '{$_POST['pwd']}');
                    define('ROSETTA_SITE_ROOT', '{$_POST['siteurl']}');
                    define('ROSETTA_DICT_PATH', '{$_POST['dictpath']}');
               ?>"
        );
        fclose($f);
        
        header("location: rosetta-login.php");
    }
?>

<!DOCTYPE html>
	<!--[if IE 8]>
		<html xmlns="http://www.w3.org/1999/xhtml" class="ie8" lang="en-US">
	<![endif]-->
	<!--[if !(IE 8) ]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
	<!--<![endif]-->
	<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    	<title>Rosetta Administrator &rsaquo; Log In</title>
    	<link rel='stylesheet' id='buttons-css'  href='buttons.min.css' type='text/css' media='all' />
        <link rel='stylesheet' id='open-sans-css'  href='https://fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext&#038;ver=4.4.2' type='text/css' media='all' />
        <link rel='stylesheet' id='dashicons-css'  href='dashicons.min.css' type='text/css' media='all' />
        <link rel='stylesheet' id='login-css'  href='login.min.css' type='text/css' media='all' />
        <link rel='stylesheet' href='rosetta-custom.css' type = 'text/css'/>

        <meta name='robots' content='noindex,follow' />
	</head>
	<body class="login login-action-login wp-core-ui  locale-en-us">
    	<div id="setup">
            <h1 class="screen-reader-text">Rosetta Administrator Setup</h1>
            <form method="post" action="rosetta-setup.php">
            	<table class="form-table">
            		<tr>
            			<th scope="row"><label for="uname">User Name</label></th>
            			<td><input name="uname" id="uname" type="text" size="25" value="" /></td>
            			<td>The username that you would like to use.</td>
            		</tr>
            		<tr>
            			<th scope="row"><label for="pwd">Password</label></th>
            			<td><input name="pwd" id="pwd" type="password" size="25" value="" autocomplete="off" /></td>
            			<td>The password that you would like to use.</td>
            		</tr>
            		<tr>
            			<th scope="row"><label for="siteurl">Website URL</label></th>
            			<td><input name="siteurl" id="siteurl" type="text" size="25" value="http://www.mysite.com" /></td>
            			<td>Enter the full URL to your website.</td>
            		</tr>
            		<tr>
            			<th scope="row"><label for="dictpath">Dictionary Path</label></th>
            			<td><input name="dictpath" id="dictpath" type="text" value="/public_html/mysite/dictionaries/" size="25" /></td>
            			<td>A full local path to the folder containing rosetta dictionaries (including a leading and trailing slash).</td>
            		</tr>
            	</table>

            	<p class="step"><input name="submit" type="submit" value="Submit" class="button button-large" /></p>
            </form>
        </div>
    </body>
</html>