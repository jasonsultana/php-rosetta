<?php
    error_reporting(E_ALL);
    session_start();

    $configUrl = dirname(__FILE__) . '/rosetta-config.php';
    $loginError = false;
    $loginErrorMessage = "";
    
    if(isset($_GET['logout'])) {
        session_destroy();
        $_SESSION['isLoggedIn'] = "false";
    }

    if(!file_exists($configUrl)) {
        //There is no config file. Move to the setup wizard.
        header("location: rosetta-setup.php");
        exit;
    }
    else {
        require_once $configUrl;
    }

    if(array_key_exists('isLoggedIn', $_SESSION)) {
        if($_SESSION['isLoggedIn'] === "true") {
            //already logged in. Move to the site root.   
            header("location: " . ROSETTA_SITE_ROOT);
            exit;
        }
    }
    
    if(isset($_POST['wp-submit'])) {
        if(ROSETTA_USERNAME != $_POST['user_login']) {
            $loginError = true;
            $loginErrorMessage = "Incorrect Username";
        }
        else if(ROSETTA_PASSWORD != $_POST['user_pass']) {
            $loginError = true;
            $loginErrorMessage = "Correct Username. Incorrect Password";
        }
        else {
            $_SESSION['isLoggedIn'] = "true";
            $_SESSION['adminPath'] = dirname(__FILE__);
            $_SESSION['adminUrl'] = dirname($_SERVER['PHP_SELF']);

            //echo "Redirecting to site root after login: " . ROSETTA_SITE_ROOT;
            header("location: " . ROSETTA_SITE_ROOT);
            exit;
        }
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
    	<div id="login">
    		<h1><a href="" title="Rosetta Admin" tabindex="-1">Rosetta Admin</a></h1>
	
<?php
            if($loginError) {
?>
                <div id="login_error">	
                    <strong>ERROR</strong>: <?php echo $loginErrorMessage; ?><a href="rosetta-login.php?action=lostpassword">Lost your password?</a><br>
                </div>
<?php
            }
?>
            <form name="loginform" id="loginform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            	<p>
            		<label for="user_login">Username<br />
            		<input type="text" name="user_login" id="user_login" class="input" value="" size="20" /></label>
            	</p>
            	<p>
            		<label for="user_pass">Password<br />
            		<input type="password" name="user_pass" id="user_pass" class="input" value="" size="20" /></label>
            	</p>
            		<p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"  /> Remember Me</label></p>
            	<p class="submit">
            		<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Log In" />
            		<input type="hidden" name="redirect_to" value="" />
            		<input type="hidden" name="testcookie" value="1" />
            	</p>
            </form>
            
            <p id="nav">
            	<a href="rosetta-login.php?action=lostpassword" title="Password Lost and Found">Lost your password?</a>
            </p>
            
            <script type="text/javascript">
            function wp_attempt_focus(){
                setTimeout(function(){ 
                    try{
                        d = document.getElementById('user_login');
                        d.focus();
                        d.select();
                    } catch(e){}
                }, 200);
            }
            
            wp_attempt_focus();
            if(typeof wpOnload=='function')wpOnload();
            </script>
            
	        <p id="backtoblog"><a href="<?php echo ROSETTA_SITE_ROOT; ?>" title="Are you lost?">&larr; Back to your website</a></p>
	    </div>
	    <div class="clear"></div>
	</body>
</html>