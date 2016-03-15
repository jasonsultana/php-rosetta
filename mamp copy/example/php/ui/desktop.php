<?php
  session_start();
?>

<!DOCTYPE HTML>
<html>
  <head>
    <!-- Mobile -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title><?php echo $rosetta->getString("title"); ?></title>
    <meta name="description" content="<?php echo $rosetta->getString('metadesc'); ?>" />
    <meta name="keywords" content="language skype lesson english japanese korean teaching online" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="author" content = "Jason Sultana"/>

    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <!-- For Youtube -->
    <meta name="google-site-verification" content="WGbHXqrlIsZYc_xKznGGPa7wEaj673eZXltMlETFdzw" />

    <!-- modernizr enables HTML5 elements and feature detects -->
    <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>

<?php
    $rosetta->getHeader();
?>
  </head>

  <body>
    <div id="container">
      <img src="images/sun.png" alt="sunshine" />
      <div id="main">
        <header>
          <div id="logo">
            <div id="logo_text">
              <h1><a href="index.html">YJLessons<span class="logo_colour">.com</span></a></h1>
              <h2><?php echo $rosetta->getString("subtitle"); ?></h2>
            </div>

            <div id="logo_text2">
              <h3><a href="<?php echo "?lang=en&id=$pageId";?>">English</a></h3>
              <h3><a href="<?php echo "?lang=jp&id=$pageId";?>">日本語</a></h3>
              <h3><a href="<?php echo "?lang=kr&id=$pageId";?>">한국어</a></h3>
            </div>
          </div>
          <nav>
            <ul class="sf-menu" id="nav">
              <li><a href = "<?php echo "?id=home&lang=$lang"; ?>"><?php echo $rosetta->getString("home"); ?></a></li>
              <li><a href = "<?php echo "?id=prices&lang=$lang"; ?>"><?php echo $rosetta->getString("prices"); ?></a></li>
              <li><a href = "<?php echo "?id=freebies&lang=$lang"; ?>"><?php echo $rosetta->getString("freebies"); ?></a></li>
              <li><a href = "<?php echo "?id=contact&lang=$lang"; ?>"><?php echo $rosetta->getString("contact"); ?></a></li>
            </ul>

            <ul class="sf-menu" id = "social">
              <li><a href = "https://www.youtube.com/channel/UCtNgDj63gNB4S6dl7DwGtvw" target = "_blank"><img src = "images/YoutubeLogo.png"/></a></li>
              <li><a href = "https://www.facebook.com/yjlessons/" target = "_blank"><img src = "images/FacebookLogo.png"/></a></li>
            </ul>
          </nav>
        </header>
        <div id="site_content">
          <div id="content">
<?php
          require_once $here . "/php/pages/$pageId.php";
?>
          </div>
        </div>
      </div> <!-- end main -->

      <footer>
        <p><a href="?lang=en">English</a> | <a href="?lang=jp">日本語</a> | <a href="?lang=kr">한국어</a></p>
        <p>Copyright &copy; YJLessons.com</p>
      </footer>
    </div> <!-- Container -->

    <div id="grass"></div>
    <script src = "js/jquery.js"></script>

<?php
    $rosetta->getFooter();
?>
  </body>
</html>