<?php
    session_start();

    $here = dirname(__FILE__);
    require $here . '/rosetta.inc.php';

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

    $dict = $here . "/lang/$lang.xml";
    $file = fopen($dict, 'r');
    $str = fread($file, filesize($dict));
    fclose($file);

    $rosetta = new rosetta($str);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $rosetta->getString("title"); ?></title>
<!--
Elevate
http://www.templatemo.com/tm-481-elevate
-->
    <!-- load stylesheets -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400">   <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="css/bootstrap.min.css">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" href="css/magnific-popup.css">                                     <!-- Magnific pop up style -->
    <link rel="stylesheet" href="css/templatemo-style.css">                                   <!-- Templatemo style -->

<?php
    $rosetta->getHeader();
?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->
      </head>

      <body>
        <div class="container">

            <div class="tm-sidebar">
                <img src="img/menu-top.jpg" alt="Menu top image" class="img-fluid tm-sidebar-image">
                <nav class="tm-main-nav">
                    <ul>
                        <li class="tm-nav-item"><a href="#home" class="tm-nav-item-link"><?php echo $rosetta->getString("home"); ?></a></li>
                        <li class="tm-nav-item"><a href="#about" class="tm-nav-item-link"><?php echo $rosetta->getString("about"); ?></a></li>
                        <li class="tm-nav-item"><a href="#contact" class="tm-nav-item-link"><?php echo $rosetta->getString("contact"); ?></a></li>
                        <li class="tm-nav-item"><a href="#" class="tm-nav-item-link" id = 'btnLang'><?php echo $langStr; ?></a></li>
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
                            <h2 class="tm-section-title"><?php echo $rosetta->getString("about"); ?></h2>
                            <p class="tm-section-description"><?php echo $rosetta->getString("about1"); ?></p>
                            <p class="tm-section-description"><?php echo $rosetta->getString("about2"); ?></p>    
                        </div>
                        <div class="flex-item">
                            <img src="img/about.jpg" alt="">    
                        </div>                       
                        

                    </div>
                    
                </section>

                <section class="tm-content-box">
                    <img src="img/contact.jpg" alt="Contact image" class="img-fluid">

                    <div id="contact" class="pad">
                        <h2 class="tm-section-title"><?php echo $rosetta->getString("contact"); ?></h2>
                        <form action="#contact" method="get" class="contact-form">

                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group-2-col-left">
                                <input type="text" id="contact_name" name="contact_name" class="form-control" placeholder="<?php echo $rosetta->getString("name");?>"  required/>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group-2-col-right">
                                <input type="email" id="contact_email" name="contact_email" class="form-control" placeholder="<?php echo $rosetta->getString("email");?>"  required/>
                            </div>
                            <div class="form-group">
                                <input type="text" id="contact_subject" name="contact_subject" class="form-control" placeholder="<?php echo $rosetta->getString("subject");?>"  required/>
                            </div>
                            <div class="form-group">
                                <textarea id="contact_message" name="contact_message" class="form-control" rows="9" placeholder="<?php echo $rosetta->getString("message");?>" required></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary submit-btn"><?php echo $rosetta->getString("submit");?></button>

                        </form>      
                    </div>
                    
                </section>  

                <footer class="tm-footer">
                    <p class="text-xs-center">Copyright &copy; 2016 Company Name 
                    
                    - Design: <a rel="nofollow" href="http://www.templatemo.com/tm-481-elevate" target="_parent">Elevate</a></p>
                </footer>

            </div>
             
        </div>
        
        <!-- load JS files -->
        
        <script src="js/jquery-1.11.3.min.js"></script>             <!-- jQuery (https://jquery.com/download/) -->
        <script src="js/bootstrap.min.js"></script>                 <!-- Bootstrap (http://v4-alpha.getbootstrap.com/getting-started/download/) -->
        <script src="js/jquery.magnific-popup.min.js"></script>     <!-- Magnific pop-up (http://dimsemenov.com/plugins/magnific-popup/) -->
        <script src="js/jquery.singlePageNav.min.js"></script>      <!-- Single Page Nav (https://github.com/ChrisWojcik/single-page-nav) -->
        <script src="js/jquery.touchSwipe.min.js"></script>         <!-- https://github.com/mattbryson/TouchSwipe-Jquery-Plugin -->
        
        <!-- Templatemo scripts -->
        <script>                      
    
        $(document).ready(function(){

            // Single page nav
            if($(window).width() <= 1139) {
                $('.tm-main-nav').singlePageNav({
                    'currentClass' : "active",
                    offset : 100
                });
            } else {
                $('.tm-main-nav').singlePageNav({
                    'currentClass' : "active",
                    offset : 80
                });
            }

            // Handle nav offset upon window resize
            $(window).resize(function(){
                if($(window).width() <= 1139) {
                    $('.tm-main-nav').singlePageNav({
                        'currentClass' : "active",
                        offset : 100
                    });
                } else {
                    $('.tm-main-nav').singlePageNav({
                        'currentClass' : "active",
                        offset : 80
                    });
                }
            });

            $("#btnLang").click(function(){
                document.location.href = "<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];?>?lang=<?php echo $langLink; ?>";
            });
        });
    
        </script>             

<?php
    $rosetta->getFooter();
?>
    </body>
    </html>