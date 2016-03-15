<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title><?php echo $rosetta->getString("title"); ?></title>
    <meta name="description" content="<?php echo $rosetta->getString('metadesc'); ?>" />
    <meta name="keywords" content="language skype lesson english japanese korean teaching online" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="author" content="Jason Sultana">

    <link href = "css/mobile.css" rel = "stylesheet"/>
    
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap theme -->
    <link href="bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="bootstrap/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">


    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="bootstrap/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body role="document">

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src = 'images/MobileLogo.png'/></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="<?php if($pageId == 'home') echo 'active';?>"><a href = "<?php echo "?id=home&lang=$lang"; ?>"><?php echo $rosetta->getString("home"); ?></a></li>
            <li class="<?php if($pageId == 'prices') echo 'active';?>"><a href = "<?php echo "?id=prices&lang=$lang"; ?>"><?php echo $rosetta->getString("prices"); ?></a></li>
            <li class="<?php if($pageId == 'freebies') echo 'active';?>"><a href = "<?php echo "?id=freebies&lang=$lang"; ?>"><?php echo $rosetta->getString("freebies"); ?></a></li>           
            <li class="<?php if($pageId == 'contact') echo 'active';?>"><a href = "<?php echo "?id=contact&lang=$lang"; ?>"><?php echo $rosetta->getString("contact"); ?></a></li>
          </ul>

          <ul id="social" class = "nav navbar-nav">
            <li><a href = "https://www.youtube.com/channel/UCtNgDj63gNB4S6dl7DwGtvw" target = "_blank"><img src = "images/YoutubeLogo.png"/></a>
                <a href = "https://www.facebook.com/yjlessons/" target = "_blank"><img src = "images/FacebookLogo.png"/></a>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div id = "translation" class = "center-text">
      <span><a href="<?php echo "?lang=en&id=$pageId";?>">English</a></span> |
      <span><a href="<?php echo "?lang=jp&id=$pageId";?>">日本語</a></span> |
      <span><a href="<?php echo "?lang=kr&id=$pageId";?>">한국어</a></span>
    </div>

    <div class="container theme-showcase" role="main">
<?php
      require_once $here . "/php/pages/$pageId.php";
?>
    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bootstrap/assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
