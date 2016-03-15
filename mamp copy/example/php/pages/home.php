<div id = "yoko" class = "sidebar">
  <img src="images/yoko.jpg" height = "125px" alt="photo"/>
  <h1><?php echo $rosetta->getString("imyoko"); ?></h1>
  <h3><?php echo $rosetta->getString("imakoreanteacher"); ?></h3>
</div>
<div style = "clear: left;"></div>

<div id = "jason" class = "sidebar">
  <img src="images/jay.jpg" height = "125px" alt="photo"/>
  <div class = "mobileCleaner"></div>
  
  <div style = "text-align: right;">
    <h1><?php echo $rosetta->getString("imjason"); ?></h1>
    <h3><?php echo $rosetta->getString("imanenglishteacher"); ?></h3>
  </div>
</div>
<div style = "clear: both;"></div>

<h4 style = "text-align: center;"><a href = "<?php echo "?lang=$lang&id=contact"; ?>"><?php echo $rosetta->getString("schedulealesson"); ?></a></h4>