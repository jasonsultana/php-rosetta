<?php
	/* 
		Rosetta Localisation Framework v1.3.
		Original developer: Jake Taylor
		Other contributor(s): Jason Sultana.

		Rosetta provides methods of loading dynamic text (for translation, usually) by loading values from an XML dictionary. It does not concern itself with the storage and loading of 
		XML though. You are free to store the XML in a database, raw file or any other means. Load the XML as a string externally and pass it to Rosetta via:

		//Load some xml into a string...
	
		//...

		$rosetta = new rosetta(rosetta::makeLanguage($str)); //we need one language at least

		//If desired, add new languages via:
			$lang = rosetta::makeLanguage($xml);
			$rosetta->addLanguage($lang);
	*/

	//! Rosetta dynamic text and translation library for PHP
	class rosetta
	{
		private $languages = array();
		private $currentLang = null;

		/**
		
		*/
		public function __construct($str)
		{
			$language = rosetta::makeLanguage($str);
			$this->addLanguage($language);
			$this->currentLang =& $language;
		}

		/**
			Creates an instantiated language object based on supplied XML.
			@param xml String An XML string from a language dictionary.
			@return language A language object loaded from the XML string.
		*/
		public static function makeLanguage($xml)
		{
			$codex = simplexml_load_string($xml, "codex");
			if($codex)
			{
				return new language($codex);
			}
		}

		/**
			Adds an already instantiated language object to the rosetta instance.
			@param language language The language object to add.
		*/
		public function addLanguage(language $language)
		{
			$this->languages[] = $language;
		}

		/**
			Generates HTML to render a language drop down.
			@param formName String The name of the form to make. The default is "rosetta_language".
			@param formId String The id of the form to make. The default is "rosetta_languageSelect".
			@return String The HTML of the dropdown.
		*/
		public function renderSelect($formName = "rosetta_language", $formId = "rosetta_languageSelect")
		{
			$rtn = "";

			if($this->getLanguageCount() > 1)
			{
				$rtn .= "<select id=\"".$formId."\" name=\"".$formName."\">\n";
			}
			else
			{
				$rtn .= "<select id=\"".$formId."\" name=\"".$formName."\" disabled=\"disabled\">\n";
			}
			
			foreach($this->languages as $language)
			{
				$extraAttributes = "";

				if($language->getGuid() === $this->currentLang->getGuid())
				{
					$extraAttributes .= " selected=\"selected\"";
				}

				if($language->getLocalisedName() != false)
				{
					$rtn .= "\t<option value=\"" . $language->getGuid() . "\"" . $extraAttributes . ">" . $language->getName() . " (" . $language->getLocalisedName() . ")</option>\n";
				}
				else
				{
					$rtn .= "\t<option value=\"" . $language->getGuid() . "\"" . $extraAttributes . ">" . $language->getName() . "</option>\n";
				}
			}
			$rtn .= "</select>\n";		
			return $rtn;
		}

		public function isAdminLoggedIn() 
		{
		    if(array_key_exists('isLoggedIn', $_SESSION)) {
		        return $_SESSION['isLoggedIn'] === "true";
		    }

		    return false;
		}
		/**
			Should be called in the HTML head of compliant pages. Pages must use jQuery.
		*/
		public function getHeader() 
		{
			if(array_key_exists('isLoggedIn', $_SESSION)) {
			    if($_SESSION['isLoggedIn'] == "true") {
?>
					<link href = "<?php echo $_SESSION['adminUrl']; ?>/rosetta-custom.css" rel = "stylesheet"/>
					<link href = "<?php echo $_SESSION['adminUrl']; ?>/bootstrap/dist/css/bootstrap.min.css" rel = "stylesheet"/>


					<script>
						window.onload = function() {
							$.get("<?php echo $_SESSION['adminUrl']; ?>/rosetta-nav.php", function(e){
								$("body").append(e); //add a nav to the body at the top 

								window.mode = 'view';

								$("#mode-toggle").click(function() {
									if(window.mode == 'view') {
										$("#mode-toggle").html("Enable view Mode");

										$('.edit').editable(function(value, settings) {
											var eleId = $(this).attr("id");
											
											var count = 0;
											
											var ele = this;
											var t = setInterval(function() {
												if(count > 3)
													count = 1;
												else
													count++;

												var text = "";
												for(var i = 0; i < count; i++)
													text += ".";

												$(ele).html(text);
											}, 500);

											$.post("<?php echo $_SESSION['adminUrl']; ?>/rosetta-edit-api.php", {
												id: eleId,
												val: value,
												dict: $("#rosetta-dict").val()
											}, function(e) {
												clearInterval(t);

												if(e == "OK") {
													$(this).html(value);
												}
												else {
													alert(e);
												}
											});

										    //console.log(this);
										    //console.log(value);
										    //console.log(settings);
										    return(value);
										}, {
										     type    : 'text',
										     submit  : 'OK',
										});

										window.mode = 'edit';
									}
									else if(window.mode == 'edit') {
										$("#mode-toggle").html("Enable edit Mode");
										$('.edit').unbind('click');


										window.mode = "view";
									}
								});
							});
						};
					</script>
<?php
				}
			}
		}

		public function getFooter() 
		{
			if(array_key_exists('isLoggedIn', $_SESSION)) {
			    if($_SESSION['isLoggedIn'] == "true") {
?>
					<script src = "<?php echo $_SESSION['adminUrl']; ?>/jquery.jeditable.js"></script>
					<input id = "rosetta-dict" type = "hidden" value = "<?php echo $this->currentLang->getGuid(); ?>"/>
<?php
				}
			}
		}

		/**
			Sets the current language being used by the rosetta instance, identified by the GUID used in each XML dictionary.
		*/
		public function setLanguage($guid)
		{
			foreach($this->languages as $language)
			{
				if($language->getGuid() == $guid)
				{
					$this->currentLang = $language;
				}
			}
		}

		/**
			Returns a value from the current dictionary, given it's key (it's id).
		*/
		public function getString($id)
		{
			return $this->currentLang->getString($id);
		}

		public function getAllStrings()
		{
			return $this->currentLang->getAllStrings();
		}
		
		public function getLanguageCount()
		{
			return count($this->languages);
		}

		public function getCurrentLanguage()
		{
			return $this->currentLang;
		}

		public function getJson()
		{
			return json_encode($this->getAllStrings(), JSON_PRETTY_PRINT);
		}
	}

	class language
	{
		private $name;
		private $localisedName;
		private $encoding;
		private $guid;
		private $codex;
		private $volume;
		private $strings; //these are of type node

		public function __construct(codex $codex, $volume = false)
		{
			$this->loadCodex($codex, $volume);
		}

		public function loadVolumeStrings($volume)
		{
			$this->volume = $volume;
			$this->loadStrings();
		}

		public function loadAllStrings()
		{
			$this->volume = false;
			$this->loadStrings();
		}

		protected function loadMetadata()
		{
			$this->name = $this->codex->getCodexName();
			$this->localisedName = $this->codex->getLocalisedName();
			$this->encoding = $this->codex->getEncoding();
			$this->guid = $this->codex->getGuid();
		}

		protected function loadStrings()
		{
			$this->strings = $this->codex->getStrings($this->volume);
		}

		public function loadCodex(codex $codex, $volume = false)
		{
			$this->codex = $codex;
			$this->volume = $volume;

			$this->loadMetadata();
			$this->loadStrings();
		}

		public function getName()
		{
			return $this->name;
		}

		public function getLocalisedName()
		{
			return $this->localisedName;
		}

		public function getEncoding()
		{
			return $this->encoding;
		}

		public function getGuid()
		{
			return $this->guid;
		}

		public function getString($id)
		{
			if(array_key_exists($id, $this->strings)) {
				if (session_status() == PHP_SESSION_ACTIVE) {
					if(array_key_exists('isLoggedIn', $_SESSION)) {
					    if($_SESSION['isLoggedIn'] == "true") {
					    	if($this->strings[$id]->type == "text") {
					    		return "<span id = '$id' class = 'edit'>" . $this->strings[$id]->string . "</span>";
					    	}
					    }
					}
				}

				return $this->strings[$id]->string;
			}
			else {
				return false; 				
			}
		}

		public function getAllStrings()
		{
			return $this->strings;
		}
	}

	class node 
	{
		public $string;
		public $type;
	}

	class codex extends SimpleXMLIterator
	{
		public function getCodexName()
		{
			return (string) $this->metadata->name;
		}

		public function getLocalisedName()
		{
			if(isset($this->metadata->localisedName))
			{
				return $this->metadata->localisedName;
			}
			
			return false;
		}

		public function getEncoding()
		{
			return (string) $this->metadata->encoding;
		}

		public function getGuid()
		{
			return (string) $this->metadata->guid;
		}

		public function getStrings($volume = false)
		{
			$array = array();

			foreach($this->strings->children() as $child)
			{
				if($child->getName() == "string")
				{
					$tmp = new node();
					$tmp->string = (string) $child;
					$tmp->type = (string) $child['type'];

					$array[(string) $child['id']] = $tmp;
				}
				elseif($child->getName() == "volume" && ($volume == false || $volume == (string) $child['id']))
				{
					foreach($child->children() as $grandchild)
					{
						if($grandchild->getName() == "string")
						{
							$tmp = new node();
							$tmp->string = (string) $grandchild;
							$tmp->type = (string) $grandchild['type'];

							$array[(string) $grandchild['id']] = $tmp;
						}
					}
				}
			}

			return $array;
		}
	}
