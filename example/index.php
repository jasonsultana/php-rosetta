<?php
	session_start();
	
    $lang = 'en';
    $langStr = '日本語';
    $langLink = 'jp';
	
    if(array_key_exists('lang', $_GET)) {
        if($_GET['lang'] == 'jp') {
            $lang = 'jp';
            $langStr = 'English';
            $langLink = 'en';
        }
    }
	
	require_once dirname(__FILE__) . '/rosetta.inc.php';
	$rosetta = new rosetta(dirname(__FILE__) . "/lang/$lang.xml", rosetta::LOAD_URL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sample</title>
<!--
Elevate
http://www.templatemo.com/tm-481-elevate
-->
    <!-- load stylesheets -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400">   <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="css/bootstrap.min.css">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" href="css/magnific-popup.css">                                     <!-- Magnific pop up style -->
    <link rel="stylesheet" href="css/templatemo-style.css">                                   <!-- Templatemo style -->

	<script type = "text/javascript" src = "js\jquery-1.11.3.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->
<?php
	$rosetta->getHeader();
?>
      </head>

      <body>
        <div class="container">

            <div class="tm-sidebar">
                <img src="img/menu-top.jpg" alt="Menu top image" class="img-fluid tm-sidebar-image">
                <nav class="tm-main-nav">
                    <ul>
                        <li class="tm-nav-item"><a href="#home" class="tm-nav-item-link"><?php echo $rosetta->getString("home"); ?></a></li>
                        <li class="tm-nav-item"><a href="#about" class="tm-nav-item-link"><?php echo $rosetta->getString("about"); ?></a></li>
                        <li class="tm-nav-item"><a href="login.php" class="tm-nav-item-link" id = "btnLogin"><?php echo $rosetta->getString("login"); ?></a></li>
                        <li class="tm-nav-item"><a href="?lang=<?php echo $langLink; ?>" class="tm-nav-item-link" id = 'btnLang'><?php echo $langStr; ?></a></li>
                    </ul>
                </nav>
            </div>
            
            <div class="tm-main-content">
                
                <section id="home" class="tm-content-box tm-banner margin-b-10">
                    <div class="tm-banner-inner">
                        <h1 class="tm-banner-title"><?php echo $rosetta->getString("title"); ?></h1>    
                    </div>                    
                </section>

                <section>
                    <div id="about"class="tm-content-box flex-2-col">
                        <div class="pad flex-item tm-team-description-container">
                            <h2 class="tm-section-title"><?php echo $rosetta->getString("greeting"); ?></h2>
                            <p class="tm-section-description"><?php echo $rosetta->getString("example1"); ?></p>
                            <p class="tm-section-description"><?php echo $rosetta->getString("example2"); ?></p>    
                        </div>
                        <div class="flex-item">
                            <img src="img/about.jpg" alt="">    
                        </div>                       
                    </div>
                </section>  

                <footer class="tm-footer">
                    <p class="text-xs-center">Copyright &copy; 2016 Company Name 
                    
                    - Design: <a rel="nofollow" href="http://www.templatemo.com/tm-481-elevate" target="_parent">Elevate</a></p>
                </footer>

            </div>
             
        </div>     
<?php
	$rosetta->getFooter();
?>
    </body>
</html>