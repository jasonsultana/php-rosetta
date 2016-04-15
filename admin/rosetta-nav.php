<?php
  session_start();
?>

<nav id = "rosetta-nav" class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Rosetta Admin</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a id = 'mode-toggle' href = "#">Enable edit Mode</a></li>
			<li><a target = "_blank" href = "<?php echo $_SESSION['adminUrl']; ?>/rosetta-key-editor.php">Key based editor</a>
            <li><a href = "<?php echo $_SESSION['adminUrl']; ?>/rosetta-setup.php?reset">Reset settings</a></li>
            <li><a href="<?php echo $_SESSION['adminUrl']; ?>/rosetta-login.php?logout">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
</nav>