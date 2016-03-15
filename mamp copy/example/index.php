<?php
  $here = dirname(__FILE__);

  require $here . '/php/lib/rosetta.inc.php';
  require $here . '/php/lib/Mobile_Detect.inc.php';

  $lang = "en";
  $pageId = "home";

  if(isset($_GET['lang'])) {
    $tmp_lang = $_GET['lang'];

    if($tmp_lang == 'jp')
      $lang = 'jp';

    if($tmp_lang == 'kr')
      $lang = 'kr';
  }

  if(isset($_GET['id'])) {
    $tmpId = $_GET['id'];

    if(file_exists($here . "/php/pages/$tmpId.php"))
      $pageId = $tmpId;
  }

  $dictName = $here . '/lang/' . $lang . '.xml';

  $file = fopen($dictName, 'r');
  $xml = fread($file, filesize($dictName));
  fclose($file);

  $rosetta = new rosetta(rosetta::makeLanguage($xml));

  $detect = new Mobile_Detect;
  if($detect->isMobile()) {
    require $here . '/php/ui/mobile.php';
  }
  else {
    require $here . '/php/ui/desktop.php';
  }
?>