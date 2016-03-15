<?php  
  $didSubmit = false;
  if(isset($_POST['submit']) && !empty($_POST['submit'])) {
    $didSubmit = true;
  }

  $result = 0;
  if($didSubmit) {
    $requiredFields = array("txtName", "txtEmail", "txtSkype", "ddlNativeLang", "ddlStudyLang", "ddlStudyLevel");
    for($i = 0; $i < sizeof($requiredFields); $i++) {
      if(empty($_POST[$requiredFields[$i]])) {
        $result = 1;

        //echo $requiredFields[$i] . "is empty<br/>";
        break;
      }
    }

    if($result == 0) {
      $to = "admin@yjlessons.com";
      $subject = "You have a lesson request from " . $_POST['txtName'];
      $headers = "From: <$_POST[txtEmail]>\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: 8bit";

      $body = "
        Name: " . $_POST['txtName'] . "
        Email: " . $_POST['txtEmail'] . "
        SkypeId: " . $_POST['txtSkype'] . "
        Native Language: " . $_POST['ddlNativeLang'] . "
        Language they wish to study: " . $_POST['ddlStudyLang'] . "
        Their current level: " . $_POST['ddlStudyLevel'] . "
        Their message: " . $_POST['contactMessage'];
        
      $result = !mail($to, $subject, $body, $headers);
    }
  }
?>

<form action = "<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>#result" method = "post" accept-charset="UTF-8">
  <h1 class = "center-text"><?php echo $rosetta->getString("contact_title"); ?></h1>
  
  <div id = "name">
    <h3 class = "center-text"><?php echo $rosetta->getString("whatsurname"); ?></h3>
    <input class="contact" type="text" id = "txtName" name="txtName" value="" required />
  </div>

  <div id = "email">
    <h3 class = "center-text"><?php echo $rosetta->getString("whatsuremail"); ?></h3>
    <input class="contact" type="text" id = "txtEmail" name="txtEmail" value="" required />
  </div>

  <div id = "skype">
    <h3 class = "center-text"><?php echo $rosetta->getString("whatsurskype"); ?></h3>
    <input class="contact" type="text" id = "txtSkype" name="txtSkype" value="" required />
  </div>

  <div id = "native">
    <h3 class = "center-text"><?php echo $rosetta->getString("whatsurnativelang"); ?></h3>
    <select class = "contact" id = "ddlNativeLang" name = "ddlNativeLang">
      <option><?php echo $rosetta->getString("english"); ?></option>
      <option><?php echo $rosetta->getString("japanese"); ?></option>
      <option><?php echo $rosetta->getString("korean"); ?></option>
    </select>
  </div>

  <div id = "studyLang">
    <h3 class = "center-text"><?php echo $rosetta->getString("yourbenkyoushitailang"); ?></h3>
    <select class = "contact" id = "ddlStudyLang" name = "ddlStudyLang">
      <option><?php echo $rosetta->getString("english"); ?></option>
      <option><?php echo $rosetta->getString("japanese"); ?></option>
      <option><?php echo $rosetta->getString("korean"); ?></option>
    </select>
  </div>

  <div id = "studyLevel">
    <h3 class = "center-text"><?php echo $rosetta->getString("yourbenkyoulevel"); ?></h3>
    <select class = "contact" id = "ddlStudyLevel" name = "ddlStudyLevel">
      <option><?php echo $rosetta->getString("notatall"); ?></option>
      <option><?php echo $rosetta->getString("alittle"); ?></option>
      <option><?php echo $rosetta->getString("somewhat"); ?></option>
      <option><?php echo $rosetta->getString("okay"); ?></option>
      <option><?php echo $rosetta->getString("prettywell"); ?></option>
    </select>
  </div>

  <div id = "message">
    <h3 class = 'center-text'><?php echo $rosetta->getString("contactMessage"); ?></h3>
    <textarea class = 'contact' id = 'contactMessage' name = 'contactMessage' rows = '8'></textarea>
  </div>
  
  <div class = "center-text">
    <input class="submit" type="submit" id = "submit" name="submit" value="<?php echo $rosetta->getString('send'); ?>" style = "margin: auto; display: block; margin-top: 20px;"/>
<?php
            if($didSubmit) {
?>
              <a id = "result" name = "result"></a>
              <p id = "lblResult" style = "<?php if($result == 0) echo 'color: blue;'; else echo 'color: red;';?>">
<?php 
                if($result == 0) 
                  echo $rosetta->getString('sendSuccess');
                else
                  echo $rosetta->getString('sendFail');
?>
              </p>

<?php
            }
?>
  </div>
</form>