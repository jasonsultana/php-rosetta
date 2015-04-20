<?php
	/* 
		Rosetta Localisation Framework 
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

	class rosetta
	{
		private $languages = array();
		private $currentLang = null;

		public function __construct(language $language)
		{
			$this->addLanguage($language);
			$this->currentLang =& $language;
		}

		public static function makeLanguage($xml)
		{
			$codex = simplexml_load_string($xml, "codex");
			if($codex)
			{
				return new language($codex);
			}
		}

		public function addLanguage(language $language)
		{
			$this->languages[] = $language;
		}

		public function renderSelect($formName = "rosetta_language", $formId = "rosetta_languageSelect")
		{
			if($this->getLanguageCount() > 1)
			{
				echo "<select id=\"".$formId."\" name=\"".$formName."\">\n";
			}
			else
			{
				echo "<select id=\"".$formId."\" name=\"".$formName."\" disabled=\"disabled\">\n";
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
					echo "\t<option value=\"" . $language->getGuid() . "\"" . $extraAttributes . ">" . $language->getName() . " (" . $language->getLocalisedName() . ")</option>\n";
				}
				else
				{
					echo "\t<option value=\"" . $language->getGuid() . "\"" . $extraAttributes . ">" . $language->getName() . "</option>\n";
				}
			}
			echo "</select>\n";		
		}

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
		private $strings;

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
			if(array_key_exists($id, $this->strings))
				return $this->strings[$id];
			else
				return false; 
			
		}

		public function getAllStrings()
		{
			return $this->strings;
		}
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
					$array[(string) $child['id']] = (string) $child;
				}
				elseif($child->getName() == "volume" && ($volume == false || $volume == (string) $child['id']))
				{
					foreach($child->children() as $grandchild)
					{
						if($grandchild->getName() == "string")
						{
							$array[(string) $grandchild['id']] = (string) $grandchild;
						}
					}
				}
			}

			return $array;
		}
	}
